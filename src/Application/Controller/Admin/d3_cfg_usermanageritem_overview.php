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
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\Usermanager\Application\Model\Actions\d3usermanager_actionlist as ActionListModel;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanager_vars as VariablesTrait;
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirementlist as RequirementListModel;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action as ItemActionController;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ as ItemRequirementController;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\User as ItemModel;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Request;

class d3_cfg_usermanageritem_overview extends d3_cfg_mod_main
{
    use VariablesTrait;

    protected $_sSetModId = 'd3usermanager';
    protected $_sModId = 'd3usermanager';
    protected $_sThisTemplate = "d3_cfg_usermanageritem_overview.tpl";
    protected $_sMenuItemTitle = 'd3mxusermanager';
    protected $_sMenuSubItemTitle = 'd3mxusermanager_items';
    protected $_blUseOwnOxid = true;
    protected $_aNaviItems = array(
        'new' => array(
            'sScript' => 'top.oxid.admin.editThis( -1 );return false;',
            'sTranslationId' => 'D3_TOOLTIPS_NEWUSERMANAGER',
        ),
    );
    protected $_sD3ObjectClass = Manager::class;
    protected $_sRequestData;

    /**
     * @return ItemActionController
     * @throws Exception
     */
    public function getActionAdminController()
    {
        /** @var ItemActionController $action */
        $action = d3GetModCfgDIC()->get(ItemActionController::class);
        return $action;
    }

    /**
     * @return ItemRequirementController
     * @throws Exception
     */
    public function getRequirementAdminController()
    {
        /** @var ItemRequirementController $requ */
        $requ = d3GetModCfgDIC()->get(ItemRequirementController::class);
        return $requ;
    }

    /**
     * @param $sName
     * @param $aArguments
     *
     * @return mixed
     * @throws Exception
     */
    public function __call($sName, $aArguments)
    {
        $oActionView = $this->getActionAdminController();
        if (method_exists($oActionView, $sName)) {
            return call_user_func_array(array($oActionView, $sName), $aArguments);
        }

        $oRequView = $this->getRequirementAdminController();
        if (method_exists($oRequView, $sName)) {
            return call_user_func_array(array($oRequView, $sName), $aArguments);
        }

        return parent::__call($sName, $aArguments);
    }

    /**
     * @param Manager $oManager
     * @return RequirementListModel
     * @throws Exception
     */
    public function getRequirementListObject(Manager $oManager)
    {
        d3GetModCfgDIC()->set(
            RequirementListModel::class.'.args.usermanager',
            $oManager
        );

        /** @var RequirementListModel $requList */
        $requList = d3GetModCfgDIC()->get(RequirementListModel::class);
        return $requList;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getRequirementList()
    {
        /** @var Manager $oManager */
        $oManager = $this->getProfile();
        $oRequList = $this->getRequirementListObject($oManager);
        $oRequList->setRequirements($oManager->getConfiguration()->getRequirementIdList());

        return $oRequList->getRequirementList();
    }

    /**
     * @param Manager $oManager
     * @return ActionListModel
     * @throws Exception
     */
    public function getActionListObject(Manager $oManager)
    {
        d3GetModCfgDIC()->set(
            ActionListModel::class.'.args.usermanager',
            $oManager
        );
        d3GetModCfgDIC()->set(
            ActionListModel::class.'.args.user',
            d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.ItemModel::class)
        );

        /** @var ActionListModel $actionlist */
        $actionlist = d3GetModCfgDIC()->get(ActionListModel::class);
        return $actionlist;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getActionList()
    {
        /** @var Manager $oManager */
        $oManager = $this->getProfile();
        $oActionList = $this->getActionListObject($oManager);
        $oActionList->setActions($oManager->getConfiguration()->getActionIdList());

        return $oActionList->getActionList();
    }

    /**
     * @return bool
     */
    public function isEditMode()
    {
        return false;
    }

    /**
     * @throws Exception
     */
    public function setRequestData()
    {
        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $this->_sRequestData = $request->getRequestEscapedParameter('sRequestData');
    }

    /**
     * @return string
     */
    protected function _getRequestData()
    {
        return $this->_sRequestData;
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    public function getToFinishedCount()
    {
        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $iRequestCount = $request->getRequestEscapedParameter('toFinishedCount');

        if ($this->canRequestData(__FUNCTION__)) {
            /** @var Manager $oProfile */
            $oProfile = $this->getProfile();
            return $oProfile->getListGenerator()->getConcernedItemCount();
        } elseif ($this->canUseRequestData($iRequestCount)) {
            return $iRequestCount;
        }

        return '';
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    public function getFinishedCount()
    {
        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $iRequestCount = $request->getRequestEscapedParameter('finishedCount');

        if ($this->canRequestData(__FUNCTION__)) {
            /** @var Manager $oProfile */
            $oProfile = $this->getProfile();
            return $oProfile->getListGenerator()->getFinishedItemCount();
        } elseif ($this->canUseRequestData($iRequestCount)) {
            return $iRequestCount;
        }

        return '';
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    public function getFinishedMonthCount()
    {
        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $iRequestCount = $request->getRequestEscapedParameter('finishedMonthCount');

        if ($this->canRequestData(__FUNCTION__)) {
            /** @var Manager $oProfile */
            $oProfile = $this->getProfile();
            return $oProfile->getListGenerator()->getFinishedMonthItemCount();
        } elseif ($this->canUseRequestData($iRequestCount)) {
            return $iRequestCount;
        }

        return '';
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    public function getNotFinishedCount()
    {
        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $iRequestCount = $request->getRequestEscapedParameter('notFinishedCount');

        if ($this->canRequestData(__FUNCTION__)) {
            /** @var Manager $oProfile */
            $oProfile = $this->getProfile();
            return $oProfile->getListGenerator()->getNotFinishedItemCount();
        } elseif ($this->canUseRequestData($iRequestCount)) {
            return $iRequestCount;
        }

        return '';
    }

    /**
     * @param $sFunctionName
     *
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function canRequestData($sFunctionName)
    {
        return !$this->getDataOnDemand()
            || $this->_getRequestData() == $sFunctionName;
    }

    /**
     * @param $iRequestCount
     *
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function canUseRequestData($iRequestCount)
    {
        return $this->getDataOnDemand()
            && strlen($iRequestCount);
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DBALException
     * @throws DatabaseErrorException
     */
    public function getDataOnDemand()
    {
        return $this->d3GetSet()->getValue('blCalcStatOnDemand');
    }

    /**
     * @param $sRequestName
     * @param $sFunctionName
     *
     * @return bool
     * @throws Exception
     */
    public function hasRequestedData($sRequestName, $sFunctionName)
    {
        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $iRequestCount = $request->getRequestEscapedParameter($sRequestName);

        if (strlen($iRequestCount) || $this->_getRequestData() == $sFunctionName) {
            return true;
        }

        return false;
    }

    /**
     * @return Manager
     * @throws Exception
     */
    public function getManager()
    {
        /** @var Manager $manager */
        $manager = d3GetModCfgDIC()->get(Manager::class);
        return $manager;
    }

    /**
     * @return Language
     * @throws Exception
     */
    public function getLang()
    {
        /** @var Language $lang */
        $lang = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Language::class);

        return $lang;
    }

    /**
     * @param $sManagerId
     * @return string
     * @throws Exception
     */
    public function getManagerTitle($sManagerId)
    {
        $oManager = $this->getManager();
        if ($oManager->load($sManagerId)) {
            return $oManager->getFieldData('oxtitle');
        }

        return $this->getLang()->translateString('D3_USERMANAGER_REQU_OTHERJOB_UNKNOWNJOBID').' "'.$sManagerId.'"';
    }
}
