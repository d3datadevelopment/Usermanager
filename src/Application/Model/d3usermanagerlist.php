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

namespace D3\Usermanager\Application\Model;

use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanagerlist as ManagerList;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Configuration\d3modprofilelist;
use D3\ModCfg\Application\Model\d3utils;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Database\Adapter\DatabaseInterface;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class d3usermanagerlist extends d3modprofilelist
{
    /**
     * List Object class name
     *
     * @var string
     */
    protected $_sObjectsInListName = Manager::class;

    /**
     * @param $sFolderId
     * @return ManagerList
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function d3GetManuallyManagerJobsByFolder($sFolderId)
    {
        /** @var Manager $oListObject */
        $oListObject = $this->getBaseObject();
        $sFieldList = $oListObject->getSelectFields();
        $sQ = "select $sFieldList from " . $oListObject->getViewName();

        $sQ .= " where ";
        $sQ = $this->d3AddActiveSnippet($oListObject, $sQ, true, false);
        $sQ = $this->d3AddFolderSelection($sFolderId, $oListObject, $sQ);
        $sQ .= " ORDER BY ".$oListObject->getViewName().".oxsort ASC, ".$oListObject->getViewName().".oxfolder ASC";

        $this->selectString($sQ);

        /** @var $oManager Manager */
        foreach ($this->getArray() as $sKey => $oManager) {
            if (false == $this->canExecutedManually($oManager)) {
                $this->offsetUnset($sKey);
            }
        }

        return $this;
    }

    /**
     * @return ManagerList
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function d3GetUserSaveTriggeredManagerTasks()
    {
        if ($this->d3GetSet()->isDemo() ||
            in_array(
                true,
                array_map(array($this->d3GetSet(),'getLicenseConfigData'),array(d3usermanager_conf::SERIAL_BIT_STANDARD_EDITION))
            )
        ) {
            /** @var Manager $oListObject */
            $oListObject = $this->getBaseObject();
            $sFieldList = $oListObject->getSelectFields();
            $sQ = "select $sFieldList from " . $oListObject->getViewName();

            $sQ .= " where ";
            $sQ = $this->d3AddActiveSnippet($oListObject, $sQ, true, false);
            $sQ .= ' AND ' . $oListObject->getViewName() . '.D3_UM_USERSAVETRIGGERED = 1';
            $sQ .= " ORDER BY " . $oListObject->getViewName() . ".oxsort ASC, " . $oListObject->getViewName() . ".oxfolder ASC";
            $this->selectString($sQ);

            /** @var $oManager Manager */
            foreach ($this->getArray() as $sKey => $oManager) {
                if (false == $oManager->getLicenseActive()) {
                    $this->offsetUnset($sKey);
                }
            }
        }

        return $this;
    }

    /**
     * @return $this
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function d3GetOrderFinishTriggeredManagerTasks()
    {
        if ($this->d3GetSet()->isDemo() ||
            in_array(
                true,
                array_map(array($this->d3GetSet(),'getLicenseConfigData'),array(d3usermanager_conf::SERIAL_BIT_STANDARD_EDITION))
            )
        ) {
            /** @var d3usermanager $oListObject */
            $oListObject = $this->getBaseObject();
            $sFieldList = $oListObject->getSelectFields();
            $sQ = "select $sFieldList from " . $oListObject->getViewName();

            $sQ .= " where ";
            $sQ = $this->d3AddActiveSnippet($oListObject, $sQ, true, false);
            $sQ .= ' AND ' . $oListObject->getViewName() . '.D3_UM_ORDERFINISHTRIGGERED = 1';
            $sQ .= " ORDER BY " . $oListObject->getViewName() . ".oxsort ASC, " . $oListObject->getViewName() . ".oxfolder ASC";
            $this->selectString($sQ);

            /** @var $oManager d3usermanager */
            foreach ($this->getArray() as $sKey => $oManager) {
                if (false == $oManager->getLicenseActive()) {
                    $this->offsetUnset($sKey);
                }
            }
        }

        return $this;
    }

    /**
     * @param Manager $oManager
     *
     * @return bool
     * @throws DatabaseConnectionException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function canExecutedManually(Manager $oManager)
    {
        return $oManager->getFieldData('D3_UM_EXECMANUALLY') &&
               $oManager->getLicenseActive();
    }

    /**
     * @param Manager $oListObject
     * @param                $sQ
     * @param bool $blManually
     * @param bool $blUseCommonActiveCheck (oxactive field)
     *
     * @return string
     * @throws DatabaseConnectionException
     * @throws Exception
     */
    public function d3AddActiveSnippet(Manager $oListObject, $sQ, $blManually = false, $blUseCommonActiveCheck = true)
    {
        $sActiveSnippet = $oListObject->getSqlActiveSnippet();

        /** @var d3utils $d3Utils */
        $d3Utils = d3GetModCfgDIC()->get(d3utils::class);

        if ($blUseCommonActiveCheck && $sActiveSnippet) {
            $sQ .= " $sActiveSnippet ";
        } else {
            $sQ .= " 1 ";
        }

        if ($blManually) {
            $sFieldName = $d3Utils->getMultiLangFieldName(
                'D3_UM_EXECMANUALLY',
                '',
                $oListObject
            );
        } else {
            $sFieldName = $d3Utils->getMultiLangFieldName(
                'oxactive',
                '',
                $oListObject
            );
        }

        $sQ .= " AND " . $oListObject->getViewName() . "." . $sFieldName . " = 1 ";

        return $sQ;
    }

    /**
     * @param               $sFolderId
     * @param Manager       $oListObject
     * @param               $sQ
     *
     * @return string
     * @throws Exception
     */
    public function d3AddFolderSelection($sFolderId, Manager $oListObject, $sQ)
    {
        /** @var DatabaseInterface $oDb */
        $oDb = d3GetModCfgDIC()->get('d3ox.usermanager.'.DatabaseInterface::class.'.num');

        if ($sFolderId && $sFolderId != '-1') {
            $sQ .= " AND " . $oListObject->getViewName() . ".oxfolder = " . $oDb->quote($sFolderId);
        }

        return $sQ;
    }

    /**
     * @param bool|string $iCronJobId
     */
    public function setCronJobId($iCronJobId)
    {
        /** @var Manager $oBaseObject */
        $oBaseObject = $this->getBaseObject();
        $oBaseObject->setCronJobIdFilter($iCronJobId);
    }

    /**
     * @return d3_cfg_mod
     * @throws Exception
     */
    public function d3GetSet()
    {
        return d3GetModCfgDIC()->get('d3.usermanager.modcfg');
    }
}
