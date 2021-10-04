<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

declare(strict_types = 1);

namespace D3\Usermanager\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Filegenerator\d3filegeneratorcronsh;
use D3\ModCfg\Application\Model\Shopcompatibility\d3ShopCompatibilityAdapterHandler;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanager_vars as VariablesTrait;
use Doctrine\DBAL\Exception as DoctrineException;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\ViewConfig;

class d3_cfg_usermanagerset_main extends d3_cfg_mod_main
{
    use VariablesTrait;

    protected $_sModId = 'd3usermanager';

    protected $_sThisTemplate = "d3_cfg_usermanagerset_main.tpl";
    protected $_blHasDebugSwitch = true;
    protected $_sDebugHelpTextIdent = 'D3_USERMANAGER_SET_DEBUG_DESC';
    protected $_sMenuItemTitle = 'd3mxusermanager';
    protected $_sMenuSubItemTitle = 'd3mxusermanager_settings';

    /**
     * constructor.
     */
    public function __construct()
    {
        d3GetModCfgDIC()->setParameter($this->_DIC_Instance_Id.'modcfgid', $this->_sModId);

        parent::__construct();
    }

    /**
     * @return Manager
     */
    public function getManager(): Manager
    {
        /** @var Manager $manager */
        $manager = d3GetModCfgDIC()->get(Manager::class);

        return $manager;
    }

    /**
     * get basic cronjob access password; for cases only, if no password is set
     *
     * @return string
     */
    public function getBaseCronPW(): string
    {
        return $this->getManager()->getBaseCronPW();
    }

    /**
     * @return ViewConfig
     */
    public function getViewConfig(): ViewConfig
    {
        // don't use DIC because of circular reference
        if ($this->_oViewConf === null) {
            $this->_oViewConf = oxNew(ViewConfig::class);
        }

        return $this->_oViewConf;
    }

    /**
     * @return d3str
     */
    public function getD3Str(): d3str
    {
        /** @var d3str $d3str */
        $d3str = d3GetModCfgDIC()->get(d3str::class);
        return $d3str;
    }

    /**
     * @param bool $blUsePw
     * @param bool|int $iCronJobId
     *
     * @return string
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     */
    public function getCronLink($blUsePw = true, $iCronJobId = false): string
    {
        $sBaseUrl = $this->getViewConfig()->getModuleUrl('d3usermanager').'public/d3_usermanager_cron.php';

        $aParameters = [
            'shp' => $this->getViewConfig()->getActiveShopId(),
        ];

        if ($iCronJobId !== false) {
            $aParameters['cjid'] = $iCronJobId;
        }

        if ($blUsePw) {
            $aParameters['key'] = $this->d3GetSet()->getValue('sCronPassword') ?
                $this->d3GetSet()->getValue('sCronPassword') :
                $this->getBaseCronPW();
        }

        return $this->getD3Str()->generateParameterUrl($sBaseUrl, $aParameters);
    }

    /**
     * @param bool|int $iCronJobId
     *
     * @return string
     */
    public function getCronPath($iCronJobId = false): string
    {
        $sScriptPath = VENDOR_PATH.'bin/d3_usermanager_cron';

        $aParameters = array(
            'task'  => 'run',
            'shp'   => $this->getViewConfig()->getActiveShopId(),
        );

        if ($iCronJobId !== false) {
            $aParameters['cjid'] = $iCronJobId;
        }

        return 'php ' . $sScriptPath." ".implode(' ', $aParameters);
    }

    /**
     * @return array
     * @throws DatabaseConnectionException
     * @throws DoctrineException
     */
    public function getAvailableCronjobIds(): array
    {
        return $this->getManager()->getAvailableCronjobIds();
    }

    /**
     * @param bool|array $aCJID
     * @return string
     */
    public function getCJIDDesc($aCJID): string
    {
        /** @var Language $oLang */
        $oLang = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Language::class);
        if ($aCJID['count'] == 1) {
            return sprintf(
                $oLang->translateString('D3_USERMANAGER_SET_CRON_JOBID', null, true),
                $aCJID['id'],
                $aCJID['count']
            );
        } else {
            return sprintf(
                $oLang->translateString('D3_USERMANAGER_SET_CRON_JOBSID', null, true),
                $aCJID['id'],
                $aCJID['count']
            );
        }
    }

    /**
     * @param bool|int $iCronJobId
     *
     * @return string
     */
    public function getCronTimestampVarName($iCronJobId = false): string
    {
        $sVarName = "sCronExecTimestamp";

        if ($iCronJobId !== false) {
            $sVarName .= $iCronJobId;
        }

        return $sVarName;
    }

    /**
     * @return d3filegeneratorcronsh
     */
    public function getFileGeneratorCronSh(): d3filegeneratorcronsh
    {
        /** @var d3filegeneratorcronsh $filegenerator */
        $filegenerator = d3GetModCfgDIC()->get(d3filegeneratorcronsh::class);

        return $filegenerator;
    }

    /**
     * @return array
     */
    public function getCronProviderList(): array
    {
        return $this->getFileGeneratorCronSh()->getContentList();
    }

    /**
     * @return d3ShopCompatibilityAdapterHandler
     */
    public function getCompatibilityAdapterHandler(): d3ShopCompatibilityAdapterHandler
    {
        /** @var d3ShopCompatibilityAdapterHandler $compatiblityHandler */
        $compatiblityHandler = d3GetModCfgDIC()->get(d3ShopCompatibilityAdapterHandler::class);
        return $compatiblityHandler;
    }

    /**
     * @return Shop
     */
    public function d3GetActiveShop(): Shop
    {
        /** @var Config $config */
        $config = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Config::class);

        return $config->getActiveShop();
    }

    /**
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function generateCronShFile()
    {
        $sScriptPath = VENDOR_PATH.'bin/d3_usermanager_cron';

        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $sCronId = $request->getRequestEscapedParameter('cronid');

        $oShop = $this->d3GetActiveShop();
        $aParameters = array(
            0 => 'run',
            1 => $oShop->getId(),
            2 => $sCronId,
        );

        $oD3ShGenerator = $this->getFileGeneratorCronSh();
        $oD3ShGenerator->setContentType($request->getRequestEscapedParameter('crontype'));
        $oD3ShGenerator->setScriptPath($sScriptPath);
        $oD3ShGenerator->setSortedParameterList($aParameters);
        $oD3ShGenerator->startDownload('d3usermanager_'.$oShop->getId()."_".$sCronId.".sh");
    }
}
