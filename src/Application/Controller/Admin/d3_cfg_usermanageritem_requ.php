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

use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanagerlist as ManagerList;
use D3\Usermanager\Application\Model\d3usermanager_vars as VariablesTrait;
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirement_abstract as RequirementAbstractModel;
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirementgrouplist as RequirementGroupListModel;
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirementlist as RequirementListModel;
use Exception;
use OxidEsales\Eshop\Application\Model\DeliveryList;
use OxidEsales\Eshop\Application\Model\PaymentList;
use OxidEsales\Eshop\Application\Model\CountryList;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Model\ListModel;

class d3_cfg_usermanageritem_requ extends d3_cfg_usermanageritem_settings
{
    use VariablesTrait;

    protected $_sThisTemplate = "d3_cfg_usermanageritem_requ.tpl";
    protected $_aTransStatus = array('OK', 'ERROR', 'NOT_OK');
    protected $_sMenuSubItemTitle = 'd3mxusermanager_items';

    public function save()
    {
        // @codeCoverageIgnoreStart
        if (!defined('OXID_PHP_UNIT')) {
            parent::save();
        }
        // @codeCoverageIgnoreEnd

        $aMissingRequiredValues = array();
        /** @var RequirementAbstractModel $oRequirement */
        foreach ($this->getRequirementList() as $sId => $oRequirement) {
            if ($this->getProfile()->getValue($oRequirement->getActiveSwitchParameter()) && false == $oRequirement->hasRequiredValues()) {
                $aMissingRequiredValues[] = $sId;
            }
        }

        if (count($aMissingRequiredValues)) {
            $this->addTplParam('missingRequValuesActions', $aMissingRequiredValues);
        }
    }

    /**
     * @return ListModel
     * @throws Exception
     */
    public function getPaymentList()
    {
        /** @var PaymentList $oPaymentList */
        $oPaymentList = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.PaymentList::class);
        return $this->_getObjectList($oPaymentList, null, 'oxdesc ASC');
    }

    /**
     * @return ListModel
     * @throws Exception
     */
    public function getDeliveryList()
    {
        /** @var DeliveryList $oDeliveryList */
        $oDeliveryList = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.DeliveryList::class);
        return $this->_getObjectList($oDeliveryList, null, 'oxtitle ASC');
    }

    /**
     * @return ListModel
     * @throws Exception
     */
    public function getCountryList()
    {
        /** @var CountryList $oCountryList */
        $oCountryList = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.CountryList::class);
        return $this->_getObjectList($oCountryList, null, 'oxtitle ASC');
    }

    /**
     * @return ManagerList
     * @throws Exception
     */
    public function getJobList()
    {
        $sCurrentId = $this->getViewDataElement('edit')->getId();
        /** @var $oManagerList ManagerList */
        $oManagerList = d3GetModCfgDIC()->get(ManagerList::class);
        $oManagerList->setCustomSorting('oxsort ASC');
        $oManagerList->getList();
        $oManagerList->offsetUnset($sCurrentId);
        return $oManagerList;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getLanguageList()
    {
        $oLang = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Language::class);
        return $oLang->getLanguageArray();
    }

    /**
     * @return array
     */
    public function getTransStatusList()
    {
        return $this->_aTransStatus;
    }

    /**
     * Sets default values for empty article (currently does nothing), returns
     * array with parameters.
     *
     * @param array $aParams Parameters, to set default values
     *
     * @return array
     */
    public function addDefaultValues($aParams)
    {
        return $aParams;
    }

    /**
     * @param Manager $oManager
     * @return RequirementGroupListModel
     * @throws Exception
     */
    public function getRequirementGroupList(Manager $oManager)
    {
        d3GetModCfgDIC()->set(
            RequirementGroupListModel::class.'.args.usermanager',
            $oManager
        );

        /** @var RequirementGroupListModel $requGroupModel */
        $requGroupModel = d3GetModCfgDIC()->get(RequirementGroupListModel::class);
        return $requGroupModel;
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

        /** @var RequirementListModel $requListModel */
        $requListModel = d3GetModCfgDIC()->get(RequirementListModel::class);
        return $requListModel;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getGroupedRequirementList(): array
    {
        /** @var Manager $oManager */
        $oManager = $this->getProfile();
        $oRequList = $this->getRequirementGroupList($oManager);
        $oRequList->setGroups($oManager->getConfiguration()->getGroupedRequirementIdList());

        return $oRequList->getGroupList();
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
}
