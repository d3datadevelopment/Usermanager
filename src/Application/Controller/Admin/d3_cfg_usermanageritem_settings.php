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
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3database;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanager_vars as VariablesTrait;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Model\ListModel;
use OxidEsales\Eshop\Core\Model\MultiLanguageModel;

class d3_cfg_usermanageritem_settings extends d3_cfg_mod_main
{
    use VariablesTrait;

    protected $_sModId = 'd3usermanager';
    protected $_sMenuItemTitle = 'd3mxusermanager';
    protected $_blUseOwnOxid = true;
    protected $_aNaviItems = array(
        'new' => array(
            'sScript' => 'top.oxid.admin.editThis( -1 );return false;',
            'sTranslationId' => 'D3_TOOLTIPS_NEWUSERMANAGER',
        ),
    );
    protected $_sD3ObjectClass = Manager::class;

    /**
     * constructor.
     */
    public function __construct()
    {
        d3GetModCfgDIC()->setParameter($this->_DIC_Instance_Id.'modcfgid', $this->_sModId);

        parent::__construct();
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getItemFolders()
    {
        /** @var Config $config */
        $config = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Config::class);

        return $config->getConfigParam('aUserfolder');
    }

    /**
     * @return ListModel
     * @throws Exception
     */
    public function getGroupsList()
    {
        /** @var $oGroupsList ListModel */
        $oGroupsList = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.ListModel::class);
        $oGroupsList->init('oxgroups');
        return $this->_getObjectList($oGroupsList, null, 'oxtitle ASC');
    }

    /**
     * @param ListModel   $oObjectList
     * @param null|string $sWhere
     * @param null|string $sOrderBy
     *
     * @return ListModel
     * @throws DBALException
     */
    protected function _getObjectList($oObjectList, $sWhere = null, $sOrderBy = null)
    {
        startProfile(__METHOD__);

        /** @var Language $oLang */
        $oLang = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Language::class);

        /** @var MultiLanguageModel $oObject */
        $oObject = $oObjectList->getBaseObject();
        if ($oObject->isMultilang()) {
            $oObject->setLanguage($oLang->getTplLanguage());
        }
        $sFieldList = $oObject->getSelectFields();

        /** @var d3database $db */
        $db = d3GetModCfgDIC()->get('d3.usermanager.database');
        $qb = $db->getQueryBuilder();
        $qb->select($sFieldList)
            ->from($oObject->getViewName());
            
        if ($sWhere) {
            $qb->add('where', $sWhere);
        }
        if ($sOrderBy) {
            $qb->add('orderBy', $sOrderBy);
        }
            
        $oObjectList->selectString($qb->getSQL(), $qb->getParameters());

        stopProfile(__METHOD__);

        return $oObjectList;
    }

    /**
     * @return bool
     */
    public function isEditMode()
    {
        return true;
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function getRestrictionMessage()
    {
        /** @var Language $oLang */
        $oLang = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Language::class);

        /** @var d3_cfg_mod $oModCfg */
        $oModCfg =  d3GetModCfgDIC()->get($this->_DIC_Instance_Id.'modcfg');

        return sprintf(
            $oLang->translateString('D3_USERMANAGER_ERROR_RESTRICTIONS'),
            $oModCfg->getLicenseConfigData('sEditionId', 'unknown')
        );
    }
}
