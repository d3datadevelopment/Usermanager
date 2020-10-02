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

namespace D3\Usermanager\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Filegenerator\d3filegeneratorcronsh;
use D3\ModCfg\Application\Model\Shopcompatibility\d3ShopCompatibilityAdapterHandler;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanager_vars as VariablesTrait;
use Doctrine\DBAL\DBALException;
use Exception;
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
     * @throws Exception
     */
    public function getManager()
    {
        return d3GetModCfgDIC()->get(Manager::class);
    }

    /**
     * get basic cronjob access password; for cases only, if no password is set
     *
     * @return string
     * @throws Exception
     */
    public function getBaseCronPW()
    {
        return $this->getManager()->getBaseCronPW();
    }

    /**
     * @return ViewConfig
     * @throws Exception
     */
    public function getViewConfig()
    {
        // don't use DIC because of circular reference
        if ($this->_oViewConf === null) {
            $this->_oViewConf = oxNew(ViewConfig::class);
        }

        return $this->_oViewConf;
    }

    /**
     * @return d3str
     * @throws Exception
     */
    public function getD3Str()
    {
        return d3GetModCfgDIC()->get(d3str::class);
    }

    /**
     * @param bool $blUsePw
     * @param bool|int $iCronJobId
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws Exception
     */
    public function getCronLink($blUsePw, $iCronJobId = false)
    {
        $sBaseUrl = $this->getViewConfig()->getModuleUrl('d3usermanager').'public/d3_usermanager_cron.php';

        $aParameters = array(
            'shp' => $this->getViewConfig()->getActiveShopId(),
        );

        if ($iCronJobId !== false) {
            $aParameters['cjid'] = $iCronJobId;
        }

        if ($blUsePw) {
            $aParameters['key'] = $this->d3GetSet()->getValue('sCronPassword') ?
                $this->d3GetSet()->getValue('sCronPassword') :
                $this->getBaseCronPW();
        }

        $sURL   = $this->getD3Str()->generateParameterUrl($sBaseUrl, $aParameters);

        return $sURL;
    }

    /**
     * @param bool|int $iCronJobId
     *
     * @return string
     * @throws Exception
     */
    public function getCronPath($iCronJobId = false)
    {
        $sScriptPath = VENDOR_PATH.'bin/d3_usermanager_cron';

        $aParameters = array(
            'task'  => 'run',
            'shp'   => $this->getViewConfig()->getActiveShopId(),
        );

        if ($iCronJobId !== false) {
            $aParameters['cjid'] = $iCronJobId;
        }

        $sPath   = 'php ' . $sScriptPath." ".implode(' ', $aParameters);

        return $sPath;
    }

    /**
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function getAvailableCronjobIds()
    {
        return $this->getManager()->getAvailableCronjobIds();
    }

    /**
     * @param bool|array $aCJID
     * @return string
     * @throws Exception
     */
    public function getCJIDDesc($aCJID)
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
    public function getCronTimestampVarName($iCronJobId = false)
    {
        $sVarName = "sCronExecTimestamp";

        if ($iCronJobId !== false) {
            $sVarName .= $iCronJobId;
        }

        return $sVarName;
    }

    /**
     * @return d3filegeneratorcronsh
     * @throws Exception
     */
    public function getFileGeneratorCronSh()
    {
        return d3GetModCfgDIC()->get(d3filegeneratorcronsh::class);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getCronProviderList()
    {
        return $this->getFileGeneratorCronSh()->getContentList();
    }

    /**
     * @return d3ShopCompatibilityAdapterHandler
     * @throws Exception
     */
    public function getCompatibilityAdapterHandler()
    {
        return d3GetModCfgDIC()->get(d3ShopCompatibilityAdapterHandler::class);
    }

    /**
     * @return Shop
     * @throws Exception
     */
    public function d3GetActiveShop()
    {
        /** @var Config $config */
        $config = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Config::class);

        return $config->getActiveShop();
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function generateCronShFile()
    {
        $sScriptPath = VENDOR_PATH.'bin/d3_usermanager_cron';

        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $sCronId = $request->getRequestEscapedParameter('cronid');

        /** @var Shop $oShop */
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
