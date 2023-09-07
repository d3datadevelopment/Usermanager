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

namespace D3\Usermanager\Setup;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3bitmask;
use D3\ModCfg\Application\Model\d3database;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Install\d3install_updatebase;
use D3\ModCfg\Application\Model\Installwizzard\d3installdbrecord;
use Exception;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\ConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Facts\Facts;
use ReflectionException;

class d3usermanager_update extends d3install_updatebase
{
    public $sModKey = 'd3usermanager';
    public $sModName = 'Kundenmanager';
    public $sModVersion = '5.1.3.0';
    public $sModRevision = '5130';
    public $sBaseConf = 
    '6fiv2==WXZWOHY4SWNhaXBML3VUWkl4am1sUzVxMk5zYk9Yc2lTWUNQSFZaOStVMHFSaVNWTzNicEh0Z
Xh1b09LQTVBUzN2cWhKczkvSldNazc0SDdWN0xXbGdWMFNTNndybURnVGJRanBZLzRycTUyTFBWQmc5d
HFhaFYzbWozMEEzMkxtSGFWbkxnaytVZWUzM25aRW1PWkhmVzVqcy9udUY3REFXNHJMc3Vnbkt4a1I0R
GVqNnZTNFRaYW5sOGhwc0huVEV1ZlhGOHpKZERaaXoxTWNsWGQzSUhYeVR2aXQ1YUo2T3FhL0F0TFh2R
npCMVJIU2t5eWlNVjdQL3V5OW9tTEhOQUVMZDlsRVk4a2RFRFVGcC9rM0hsZE9NZC9CRStvZk5TZ1BYe
lBIdklLTG1qMm1YQjJROWY3VTFLUTAxMm1uQnJ2Z3lTZy9WNmxsbHIreXV2d0h3PT0=';
    public $sRequirements = '';
    public $sBaseValue = 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTYlM0ElN0JzJTNBMjMlM0ElMjJkM19jZmdfbW9kX19hRm9sZGVyTGlzdCUyMiUzQmElM0E0JTNBJTdCaSUzQTAlM0JzJTNBMjMlM0ElMjJEM19VU0VSTUFOQUdFUl9VU0VSX05FVyUyMiUzQmklM0ExJTNCcyUzQTMwJTNBJTIyRDNfVVNFUk1BTkFHRVJfVVNFUl9FWFRSQUNUSU9OJTIyJTNCaSUzQTIlM0JzJTNBMjklM0ElMjJEM19VU0VSTUFOQUdFUl9VU0VSX1JFVEVOVElPTiUyMiUzQmklM0EzJTNCcyUzQTMxJTNBJTIyRDNfVVNFUk1BTkFHRVJfVVNFUl9NQUlOVEVOQU5DRSUyMiUzQiU3RHMlM0EyNCUzQSUyMmQzX2NmZ19tb2RfX2JsQ3JvbkFjdGl2ZSUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMyUzQSUyMmQzX2NmZ19tb2RfX2lNYXhVc2VyQ250JTIyJTNCcyUzQTIlM0ElMjI1MCUyMiUzQnMlM0EyNSUzQSUyMmQzX2NmZ19tb2RfX3NDcm9uUGFzc3dvcmQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyOCUzQSUyMmQzX2NmZ19tb2RfX2FMaWNlbnNlSW5mb01haWwlMjIlM0JhJTNBMSUzQSU3QnMlM0E0MiUzQSUyMk5PTElDS0VZX180NzkzNjM4NzAyYjY3NzE1ZjFkZmJmYzgzMjQ2NjkxNCUyMiUzQnMlM0ExOSUzQSUyMjIwMjAtMTAtMTIlMjAwOSUzQTE2JTNBMDglMjIlM0IlN0RzJTNBMzAlM0ElMjJkM19jZmdfbW9kX19ibENhbGNTdGF0T25EZW1hbmQlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0IlN0Q=';

    public $sMinModCfgVersion = '6.0.0.0';

    protected $_aUpdateMethods = array(
        array('check' => 'doesUser2UserManagerTableNotExist',
              'do'    => 'addUser2UserManagerTable'),
        array('check' => 'doesModCfgItemNotExist',
              'do'    => 'addModCfgItem'),
        array('check' => 'checkFields',
              'do'    => 'fixFields'),
        array('check' => 'checkIndizes',
              'do'    => 'fixIndizes'),
        array('check' => 'checkCronPasswordSet',
              'do'    => 'createCronPassword'),
        array('check' => 'needExampleJobList',
              'do'    => 'addExampleJobList'),
        array('check' => 'isExampleContentMissingInDatabase',
              'do'    => 'addExampleContentList'),
        array('check' => 'requireExample2ShopRelation',
              'do'    => 'addExample2ShopRelation'),
        array('check' => 'hasUnregisteredFiles',
              'do'    => 'showUnregisteredFiles'),
        array('check' => 'checkModCfgSameRevision',
              'do'    => 'updateModCfgSameRevision'),
    );

    // Standardwerte für checkMultiLangTables() und fixRegisterMultiLangTables()
    public $aMultiLangTables = array();

    public $aFields = array(
        'PROF_EXECMANUALLY'        => array(
            'sTableName'  => 'd3modprofile',
            'sFieldName'  => 'D3_UM_EXECMANUALLY',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'user manager: job is manually executable',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'PROF_USERSAVETRIGGERED'        => array(
            'sTableName'  => 'd3modprofile',
            'sFieldName'  => 'D3_UM_USERSAVETRIGGERED',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'user manager: job will executed on user::save',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'PROF_ORDERFINISHTRIGGERED'        => array(
            'sTableName'  => 'd3modprofile',
            'sFieldName'  => 'D3_UM_ORDERFINISHTRIGGERED',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'user manager: job will executed after order::finalizeOrder',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'PROF_MARKUSER'        => array(
            'sTableName'  => 'd3modprofile',
            'sFieldName'  => 'D3_UM_MARKUSER',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'user manager: mark users as finished',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'PROF_CRONJOBID'        => array(
            'sTableName'  => 'd3modprofile',
            'sFieldName'  => 'D3_CRONJOBID',
            'sType'       => 'VARCHAR(8)',
            'blNull'      => false,
            'sDefault'    => 0,
            'sComment'    => 'ID for identifying via cronjob',
            'sExtra'      => '',
            'blMultilang' => false,
        ),

        'O_OXID'    => array(
            'sTableName'  => 'd3user2usermanager',
            'sFieldName'  => 'OXID',
            'sType'       => 'CHAR(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'O_OXUSERID'    => array(
            'sTableName'  => 'd3user2usermanager',
            'sFieldName'  => 'OXUSERID',
            'sType'       => 'CHAR(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'O_OXUSERMANAGERID'    => array(
            'sTableName'  => 'd3user2usermanager',
            'sFieldName'  => 'OXUSERMANAGERID',
            'sType'       => 'CHAR(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'O_OXREMARKID'    => array(
            'sTableName'  => 'd3user2usermanager',
            'sFieldName'  => 'OXREMARKID',
            'sType'       => 'CHAR(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'O_OXEXECDATE'    => array(
            'sTableName'  => 'd3user2usermanager',
            'sFieldName'  => 'OXEXECDATE',
            'sType'       => 'TIMESTAMP',
            'blNull'      => false,
            'sDefault'    => 'CURRENT_TIMESTAMP',
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'O_OXDONTUSEFORCHECK'    => array(
            'sTableName'  => 'd3user2usermanager',
            'sFieldName'  => 'OXDONTUSEFORCHECK',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXREMARKTYPE'    => array(
            'sTableName'  => 'oxremark',
            'sFieldName'  => 'OXTYPE',
            'sType'       => 'ENUM("d3um")',
            'blNull'      => false,
            'sDefault'    => 'r',
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
    );

    public $aIndizes = array(
        'MP_D3_UM_EXECMANUALLY' => array(
            'sTableName' => 'd3modprofile',
            'sType'      => d3database::INDEX_TYPE_INDEX,
            'sName'      => 'D3_UM_EXECMANUALLY',
            'aFields'    => array(
                'D3_UM_EXECMANUALLY' => 'D3_UM_EXECMANUALLY',
            ),
        ),
        'MP_D3_UM_USERSAVETRIGGERED' => array(
            'sTableName' => 'd3modprofile',
            'sType'      => d3database::INDEX_TYPE_INDEX,
            'sName'      => 'D3_UM_USERSAVETRIGGERED',
            'aFields'    => array(
                'D3_UM_USERSAVETRIGGERED' => 'D3_UM_USERSAVETRIGGERED',
            ),
        ),
        'MP_D3_UM_ORDERFINISHTRIGGERED' => array(
            'sTableName' => 'd3modprofile',
            'sType'      => d3database::INDEX_TYPE_INDEX,
            'sName'      => 'D3_UM_ORDERFINISHTRIGGERED',
            'aFields'    => array(
                'D3_UM_ORDERFINISHTRIGGERED' => 'D3_UM_ORDERFINISHTRIGGERED',
            ),
        ),
        'O_OXID' => array(
            'sTableName' => 'd3user2usermanager',
            'sType'      => d3database::INDEX_TYPE_PRIMARY,
            'sName'      => 'PRIMARY',
            'aFields'    => array(
                'OXID' => 'OXID',
            ),
        ),
        'O2UM_OXUSERMANAGERID' => array(
            'sTableName' => 'd3user2usermanager',
            'sType'      => d3database::INDEX_TYPE_INDEX,
            'sName'      => 'OXUSERMANAGERID',
            'aFields'    => array(
                'OXUSERMANAGERID' => 'OXUSERMANAGERID',
            ),
        ),
        'O2UM_OXUSERID' => array(
            'sTableName' => 'd3user2usermanager',
            'sType'      => d3database::INDEX_TYPE_INDEX,
            'sName'      => 'OXUSERID',
            'aFields'    => array(
                'OXUSERID' => 'OXUSERID',
            ),
        ),
    );

    protected $_aRefreshMetaModuleIds = array('d3usermanager');

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function doesUser2UserManagerTableNotExist(): bool
    {
        return $this->_checkTableNotExist('d3user2usermanager');
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws ConnectionException
     */
    public function addUser2UserManagerTable(): bool
    {
        $blRet = false;
        if ($this->doesUser2UserManagerTableNotExist()) {
            $this->setInitialExecMethod(__METHOD__);
            $blRet  = $this->_addTable2(
                'd3user2usermanager',
                $this->aFields,
                $this->aIndizes,
                'user to usermanageritem assignment',
                'MyISAM'
            );
        }

        return $blRet;
    }

    /**
     * @return d3installdbrecord
     */
    public function d3GetInstallDbRecord(): d3installdbrecord
    {
        d3GetModCfgDIC()->set(
            d3installdbrecord::class.'.arg_updatebase',
            $this
        );

        /** @var d3installdbrecord $dbRecord */
        $dbRecord = d3GetModCfgDIC()->get(d3installdbrecord::class);
        return $dbRecord;
    }

    /**
     * required for unitTests
     * @return Config
     */
    public function d3GetConfig(): Config
    {
        /** @var Config $config */
        $config = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);
        return $config;
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws Exception
     */
    public function doesModCfgItemNotExist(): bool
    {
        $blRet = false;
        foreach ($this->d3GetConfig()->getShopIds() as $sShopId) {
            $aWhere = array(
                'oxmodid'       => $this->sModKey,
                'oxnewrevision' => $this->sModRevision,
                'oxshopid'      => $sShopId,
            );

            $blRet = $this->d3GetInstallDbRecord()->checkTableRecordNotExist('d3_cfg_mod', $aWhere);

            if ($blRet == true) {
                return true;
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function addModCfgItem(): bool
    {
        $blRet = false;

        if ($this->doesModCfgItemNotExist()) {
            foreach ($this->d3GetConfig()->getShopIds() as $sShopId) {
                $aWhere = array(
                    'oxmodid'       => $this->sModKey,
                    'oxshopid'      => $sShopId,
                    'oxnewrevision' => $this->sModRevision,
                );

                if ($this->d3GetInstallDbRecord()->checkTableRecordNotExist('d3_cfg_mod', $aWhere)) {
                    // update don't use this property
                    unset($aWhere['oxnewrevision']);

                    $aInsertFields = array(
                        array (
                            'fieldname'     => 'OXID',
                            'content'       => "md5('" . $this->sModKey . " " . $sShopId . " de')",
                            'force_update'  => true,
                            'use_quote'     => false,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXSHOPID',
                            'content'       => $sShopId,
                            'force_update'  => true,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXMODID',
                            'content'       => $this->sModKey,
                            'force_update'  => true,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXNAME',
                            'content'       => $this->sModName,
                            'force_update'  => true,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXACTIVE',
                            'content'       => "0",
                            'force_update'  => false,
                            'use_quote'     => false,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXBASECONFIG',
                            'content'       => $this->sBaseConf,
                            'force_update'  => true,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXSERIAL',
                            'content'       => "",
                            'force_update'  => false,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXINSTALLDATE',
                            'content'       => "NOW()",
                            'force_update'  => true,
                            'use_quote'     => false,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXVERSION',
                            'content'       => $this->sModVersion,
                            'force_update'  => true,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXSHOPVERSION',
                            'content'       => oxNew(Facts::class)->getEdition(),
                            'force_update'  => true,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array (
                            'fieldname'     => 'OXREQUIREMENTS',
                            'content'       => $this->sRequirements,
                            'force_update'  => true,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array(
                            'fieldname'     => 'OXVALUE',
                            'content'       => $this->sBaseValue,
                            'force_update'  => false,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        ),
                        array(
                            'fieldname'     => 'OXNEWREVISION',
                            'content'       => $this->sModRevision,
                            'force_update'  => true,
                            'use_quote'     => true,
                            'use_multilang' => false,
                        )
                    );

                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('d3_cfg_mod', $aInsertFields, $aWhere);

                    if ($this->getStepByStepMode()) {
                        break;
                    }
                }
            }
        }
        return $blRet;
    }

    /**
     * @return bool true, if new password must set
     */
    public function checkCronPasswordSet(): bool
    {
        /** @var d3_cfg_mod $set */
        $set = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        $password = $set->getValue('sCronPassword');
        return false === $password || is_null($password) || (is_string($password) && strlen($password) <= 0);
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function createCronPassword(): bool
    {
        $message = Registry::getLang()->translateString('D3_USERMANAGER_SETUP_CRONPASSWORD') . PHP_EOL.PHP_EOL;
        $this->setActionLog('msg', $message, __METHOD__);

        if ($this->hasExecute()) {
            /** @var d3str $oD3str */
            $oD3str = d3GetModCfgDIC()->get(d3str::class);
            $password = $oD3str->random_str(12);

            /** @var d3_cfg_mod $set */
            $set = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
            $set->setValue('sCronPassword', $password);
            $set->saveNoLicenseRefresh();
        }

        return true;
    }

    /**
     * @return bool true, if update is required
     * @throws Exception
     */
    public function needExampleJobList(): bool
    {
        $blRet = false;

        /** @var d3database $db */
        $db = d3GetModCfgDIC()->get('d3.usermanager.database');
        $qb = $db->getQueryBuilder();
        // change this to your inividual check criterias
        $qb->select('count(oxid) ')->from('d3modprofile')
           ->where('oxmodid = '.$qb->createNamedParameter('d3usermanager'))
           ->setMaxResults(1);

        if ($qb->execute()->fetchOne() == 0) {
            $blRet = true;
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function addExampleJobList(): bool
    {
        $blRet = true;

        foreach ($this->getExampleJobInsertList() as $aJobContentInfos) {
            $blRet = $this->_addExampleJobItem($aJobContentInfos['table'], $aJobContentInfos['content']);

            if (false == $blRet) {
                break;
            }
        }

        $this->setUpdateBreak(true);

        return $blRet;
    }

    /**
     * @return bool true, if update is required
     * @throws Exception
     */
    public function isExampleContentMissingInDatabase(): bool
    {
        $blRet = false;

        $aIdentList = [];
        foreach ($this->getExampleContentInsertList() as $aJobContentInfos) {
            $aInsertFields = $this->{$aJobContentInfos['content']}($this->d3GetConfig()->getActiveShop());
            foreach ($aInsertFields as $aInsertField) {
                if (is_string($aInsertField['fieldname']) && strtoupper($aInsertField['fieldname']) == 'OXLOADID') {
                    $aIdentList[] = $aInsertField['content'];
                }
            }
        }

        if (count($aIdentList)) {
            // change this to your inividual check criterias
            /** @var d3database $db */
            $db = d3GetModCfgDIC()->get('d3.usermanager.database');
            $qb = $db->getQueryBuilder();
            $qb->select('count(oxid) < '.count($aIdentList))
                ->from('oxcontents')
                ->where(
                        $qb->expr()->in('oxloadid', implode(', ', array_map(
                            function($value) use ($qb) {
                                return $qb->createNamedParameter($value);
                            },
                            $aIdentList
                        )))
                    )
                ->setMaxResults(1);

            return (bool) $qb->execute()->fetchOne();
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function addExampleContentList(): bool
    {
        $blRet = true;

        foreach ($this->getExampleContentInsertList() as $aJobContentInfos) {
            $blRet = $this->_addExampleJobItem($aJobContentInfos['table'], $aJobContentInfos['content']);

            if (!$blRet) {
                break;
            }
        }

        $this->setUpdateBreak(true);

        return $blRet;
    }

    /**
     * @return bool true, if update is required
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ParameterNotFoundException
     * @throws ConnectionException
     */
    public function requireExample2ShopRelation(): bool
    {
        startProfile(__METHOD__);

        $this->setInitialExecMethod(__METHOD__);

        foreach ($this->getExampleJobInsertList() as $aJobContentInfos) {
            $sGetFieldContentMethodName = $aJobContentInfos['content'];
            /** @var $oShop Shop */
            foreach ($this->getShopListByActiveModule('d3usermanager') as $oShop) {
                $aCheckFields = $this->{$sGetFieldContentMethodName}($oShop);

                if ($this->_require2ShopRelation($aJobContentInfos['table'], $aCheckFields)) {
                    stopProfile(__METHOD__);
                    return true;
                }
            }
        }

        stopProfile(__METHOD__);
        return false;
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ParameterNotFoundException
     * @throws ConnectionException
     */
    public function addExample2ShopRelation(): bool
    {
        $blRet = true;

        foreach ($this->getExampleJobInsertList() as $aJobContentInfos) {
            $sGetFieldContentMethodName = $aJobContentInfos['content'];
            /** @var $oShop Shop */
            foreach ($this->getShopListByActiveModule('d3usermanager') as $oShop) {
                $aInsertFields = $this->{$sGetFieldContentMethodName}($oShop);
                $blRet = $this->_add2ShopRelation($aJobContentInfos['table'], $aInsertFields);
            }

            if (!$blRet) {
                break;
            }
        }

        $this->setUpdateBreak(true);

        return $blRet;
    }

    /**
     * @return array
     */
    public function getExampleJobInsertList(): array
    {
        return array(
            array(
                'content'   => 'getExampleJobItem1InsertFields',
                'table'     => 'd3modprofile'
            ),
            array(
                'content'   => 'getExampleJobItem2InsertFields',
                'table'     => 'd3modprofile'
            ),
            array(
                'content'   => 'getExampleJobItem3InsertFields',
                'table'     => 'd3modprofile'
            ),
            array(
                'content'   => 'getExampleJobItem4InsertFields',
                'table'     => 'd3modprofile'
            ),
            array(
                'content'   => 'getExampleJobItem5InsertFields',
                'table'     => 'd3modprofile'
            ),
        );
    }

    /**
     * @return array
     */
    public function getExampleContentInsertList(): array
    {
        return array(
            array(
                'content'   => 'getExampleContent1InsertFields',
                'table'     => 'oxcontents'
            ),
            array(
                'content'   => 'getExampleContent2InsertFields',
                'table'     => 'oxcontents'
            ),
        );
    }

    /**
     * @return d3bitmask
     */
    public function getD3BitMask(): d3bitmask
    {
        /** @var d3bitmask $bitMask */
        $bitMask = d3GetModCfgDIC()->get(d3bitmask::class);
        return $bitMask;
    }

    /**
     * @param Shop $oShop
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function getExampleJobItem1InsertFields(Shop $oShop): array
    {
        $sShopId = $oShop->getId();
        $iShopBit = strlen($sShopId) == 1 ? $this->getD3BitMask()->getIntByBitPosition((int) $sShopId) : '1';

        return array(
            array (
                'fieldname'     => 'OXID',
                'content'       => "MD5('" . $this->sModKey . " job01 " . $sShopId . "')",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPID',
                'content'       => $sShopId,
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPINCL',
                'content'       => $iShopBit,
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPEXCL',
                'content'       => '0',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVE',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVEFROM',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVETO',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXMODID',
                'content'       => 'd3usermanager',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTITLE',
                'content'       => 'Newsletter-Export',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'de'),
                'content'       => 'Newsletter-Export',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'en'),
                'content'       => 'newsletter export',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHORTDESC',
                'content'       => 'Wird der Newsletterversand bei Ihnen über eine separate Software oder einen externen Dienst durchgeführt, können Sie mit dieser Aufgabe eine exportierbare Liste aller Ihrer Empfänger erstellen. Dem Listenformat sind dabei keine Grenzen gesetzt.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXSHORTDESC', 'de'),
                'content'       => 'Wird der Newsletterversand bei Ihnen über eine separate Software oder einen externen Dienst durchgeführt, können Sie mit dieser Aufgabe eine exportierbare Liste aller Ihrer Empfänger erstellen. Dem Listenformat sind dabei keine Grenzen gesetzt.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXCREATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXUPDATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXUPDATE', 'de'),
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXMODVERSION',
                'content'       => $this->sModVersion,
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXLOG',
                'content'       => '15',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => true,
            ),
            array(
                'fieldname'     => 'OXVALUE',
                'content'       => 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTEwOCUzQSU3QnMlM0ExMyUzQSUyMmJsSXRlbUV4ZWN1dGUlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTQlM0ElMjJibEl0ZW1NYWlsU2VuZCUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EyNSUzQSUyMmlVbm1hcmtFeGVjRGVsYXlUaW1lVmFsdWUlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjQlM0ElMjJzVW5tYXJrRXhlY0RlbGF5VGltZVVuaXQlMjIlM0JzJTNBNCUzQSUyMmRheXMlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrQWN0aXZlVXNlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjAlM0ElMjJzQ2hlY2tBY3RpdmVVc2VyVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTMwJTNBJTIyYmxDaGVja1JlZ2lzdGVyVXNlckZyb21fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIyJTNBJTIyc1JlZ2lzdGVyVXNlckZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI4JTNBJTIyYmxDaGVja1JlZ2lzdGVyVXNlclRvX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNSZWdpc3RlclVzZXJUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzAlM0ElMjJibENoZWNrUmVnaXN0ZXJUaW1lc3Bhbl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblR5cGUlMjIlM0JzJTNBNyUzQSUyMm1pbmltdW0lMjIlM0JzJTNBMjIlM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjElM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblVuaXQlMjIlM0JzJTNBNiUzQSUyMm1pbnV0ZSUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tGcm9tVXNlck5yX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNiUzQSUyMnNGcm9tVXNlck5yVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMiUzQSUyMmJsQ2hlY2tUb1VzZXJOcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTQlM0ElMjJzVG9Vc2VyTnJWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI2JTNBJTIyYmxDaGVja1Bhc3N3b3JkVXNlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjIlM0ElMjJzQ2hlY2tQYXNzd29yZFVzZXJUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjElM0ElMjJibENoZWNrSW5Hcm91cF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTQlM0ElMjJhQ3VzdEluR3JvdXBJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja05vdEluR3JvdXBfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE3JTNBJTIyYUN1c3ROb3RJbkdyb3VwSWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyOCUzQSUyMmJsQ2hlY2tOZXdzbGV0dGVyVXNlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjQlM0ElMjJzQ2hlY2tOZXdzbGV0dGVyVXNlclR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyNSUzQSUyMmJsQ2hlY2tIYXNCaXJ0aGRheV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMzElM0ElMjJibENoZWNrQmlydGhkYXRlVXNlckZyb21fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIzJTNBJTIyc0JpcnRoZGF0ZVVzZXJGcm9tVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyOSUzQSUyMmJsQ2hlY2tCaXJ0aGRhdGVVc2VyVG9fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIxJTNBJTIyc0JpcnRoZGF0ZVVzZXJUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjMlM0ElMjJibENoZWNrVmFsaWRNYWlsX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0ExOSUzQSUyMnNDaGVja1ZhbGlkTWFpbFR5cGUlMjIlM0JzJTNBNSUzQSUyMnZhbGlkJTIyJTNCcyUzQTE4JTNBJTIyYmxDaGVja0Jvbmlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTklM0ElMjJzQm9uaVR5cGUlMjIlM0JzJTNBNCUzQSUyMmxlc3MlMjIlM0JzJTNBMTAlM0ElMjJzQm9uaVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjklM0ElMjJibENoZWNrRGVsaXZlcnlBZGRyZXNzX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyNSUzQSUyMnNDaGVja0RlbGl2ZXJ5QWRkcmVzc1R5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyMyUzQSUyMmJsQ2hlY2tJbnZHZW5kZXJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE5JTNBJTIyc0NoZWNrSW52R2VuZGVyVHlwZSUyMiUzQnMlM0EyJTNBJTIybXIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrSW52Q291bnRyeV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTMlM0ElMjJhSW52Q291bnRyeUlkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJibENoZWNrSW52WmlwUmFuZ2Vfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIxJTNBJTIyc0ludlppcFJhbmdlRnJvbVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMTklM0ElMjJzSW52WmlwUmFuZ2VUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrSW52Q29tcGFueV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjAlM0ElMjJzQ2hlY2tJbnZDb21wYW55VHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTIyJTNBJTIyYmxDaGVja0ludlVzdElkX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExOCUzQSUyMnNDaGVja0ludlVzdElkVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTI2JTNBJTIyYmxDaGVja0ludlVzZXJGaWVsZF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjMlM0ElMjJzSW52VXNlckZpZWxkX0ZpZWxkTmFtZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIyJTNBJTIyc0NoZWNrSW52VXNlckZpZWxkVHlwZSUyMiUzQnMlM0E3JTNBJTIyY29udGVudCUyMiUzQnMlM0EyNCUzQSUyMnNJbnZVc2VyRmllbGRfRmllbGRWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIzJTNBJTIyYmxDaGVja0RlbEdlbmRlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTklM0ElMjJzQ2hlY2tEZWxHZW5kZXJUeXBlJTIyJTNCcyUzQTIlM0ElMjJtciUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tEZWxDb3VudHJ5X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExMyUzQSUyMmFEZWxDb3VudHJ5SWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNSUzQSUyMmJsQ2hlY2tEZWxaaXBSYW5nZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzRGVsWmlwUmFuZ2VGcm9tVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExOSUzQSUyMnNEZWxaaXBSYW5nZVRvVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tEZWxDb21wYW55X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNDaGVja0RlbENvbXBhbnlUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjYlM0ElMjJibENoZWNrRGVsVXNlckZpZWxkX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMyUzQSUyMnNEZWxVc2VyRmllbGRfRmllbGROYW1lJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjIlM0ElMjJzQ2hlY2tEZWxVc2VyRmllbGRUeXBlJTIyJTNCcyUzQTclM0ElMjJjb250ZW50JTIyJTNCcyUzQTI0JTNBJTIyc0RlbFVzZXJGaWVsZF9GaWVsZFZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJibENoZWNrSGFzTm9PcmRlcnNfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI3JTNBJTIyYmxDaGVja01pbk9yZGVyQ291bnRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI0JTNBJTIyc0NoZWNrTWluT3JkZXJDb3VudFZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrTWF4T3JkZXJDb3VudF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjQlM0ElMjJzQ2hlY2tNYXhPcmRlckNvdW50VmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EzMCUzQSUyMmJsQ2hlY2tPcmRlck1pblRpbWVzcGFuX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMiUzQSUyMnNPcmRlck1pblRpbWVzcGFuVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMnNPcmRlck1pblRpbWVzcGFuVW5pdCUyMiUzQnMlM0E2JTNBJTIybWludXRlJTIyJTNCcyUzQTMwJTNBJTIyYmxDaGVja09yZGVyTWF4VGltZXNwYW5fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIyJTNBJTIyc09yZGVyTWF4VGltZXNwYW5WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIxJTNBJTIyc09yZGVyTWF4VGltZXNwYW5Vbml0JTIyJTNCcyUzQTYlM0ElMjJtaW51dGUlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrT3JkZXJMYW5ndWFnZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTglM0ElMjJhT3JkZXJJbkxhbmd1YWdlSWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNiUzQSUyMmJsQ2hlY2tPcmRlclBheW1lbnRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE1JTNBJTIyYU9yZGVyUGF5bWVudElkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrT3JkZXJEZWxpdmVyeV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTYlM0ElMjJhT3JkZXJEZWxpdmVyeUlkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJibEFjdGlvbkN1c3QyR3JvdXBfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTEzJTNBJTIyYUN1c3RBZGRHcm91cCUyMiUzQmElM0ExJTNBJTdCaSUzQTAlM0JzJTNBMTQlM0ElMjJveGlkbmV3c2xldHRlciUyMiUzQiU3RHMlM0EyOCUzQSUyMmJsQWN0aW9uQ3VzdEZyb21Hcm91cF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTYlM0ElMjJhQ3VzdFJlbW92ZUdyb3VwJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjclM0ElMjJibEFjdGlvbkN1c3RBY3RpdmF0ZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjMlM0ElMjJzQWN0aW9uQ3VzdEFjdGl2YXRlVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTI1JTNBJTIyYmxBY3Rpb25DdXN0RGVsZXRlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzMiUzQSUyMmJsQWN0aW9uVXNlckFkZEZpZWxkVmFsdWVfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIxJTNBJTIyc0FjdGlvbkFkZEZpZWxkX2ZpZWxkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjElM0ElMjJzQWN0aW9uQWRkRmllbGRfdmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMyUzQSUyMmJsQWN0aW9uTWFpbHNlbmRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIwJTNBJTIyc1NlbmRNYWlsRnJvbVN1YmplY3QlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNSUzQSUyMnNTZW5kTWFpbEZyb21UZW1wbGF0ZW5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EzMCUzQSUyMnNTZW5kTWFpbEZyb21UZW1wbGF0ZW5hbWVQbGFpbiUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTE4JTNBJTIyc1NlbmRNYWlsRnJvbVRoZW1lJTIyJTNCcyUzQTglM0ElMjJmcm9udGVuZCUyMiUzQnMlM0EyNCUzQSUyMnNTZW5kTWFpbEZyb21Db250ZW50bmFtZSUyMiUzQnMlM0EzMiUzQSUyMjg3MDllNDVmMzFhODY5MDllOWY5OTkyMjJlODBiMWQwJTIyJTNCcyUzQTI5JTNBJTIyc1NlbmRNYWlsRnJvbUNvbnRlbnRuYW1lUGxhaW4lMjIlM0JzJTNBMzIlM0ElMjI4NzA5ZTQ1ZjMxYTg2OTA5ZTlmOTk5MjIyZTgwYjFkMCUyMiUzQnMlM0EyMCUzQSUyMmJsU2VuZE1haWxUb0N1c3RvbWVyJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE3JTNBJTIyYmxTZW5kTWFpbFRvT3duZXIlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTglM0ElMjJibFNlbmRNYWlsVG9DdXN0b20lMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjQlM0ElMjJzU2VuZE1haWxUb0N1c3RvbUFkZHJlc3MlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMmJsQWN0aW9uRXhwb3J0X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0ExNiUzQSUyMmFFeHBvcnRGaWVsZExpc3QlMjIlM0JhJTNBNiUzQSU3QmklM0EwJTNCcyUzQTQlM0ElMjJveGlkJTIyJTNCaSUzQTElM0JzJTNBMTAlM0ElMjJveHVzZXJuYW1lJTIyJTNCaSUzQTIlM0JzJTNBOCUzQSUyMm94Y3VzdG5yJTIyJTNCaSUzQTMlM0JzJTNBOSUzQSUyMm94Y29tcGFueSUyMiUzQmklM0E0JTNCcyUzQTclM0ElMjJveGZuYW1lJTIyJTNCaSUzQTUlM0JzJTNBNyUzQSUyMm94bG5hbWUlMjIlM0IlN0RzJTNBMTklM0ElMjJzRXhwb3J0VGVtcGxhdGVuYW1lJTIyJTNCcyUzQTI5JTNBJTIyZDN1c2VybWFuYWdlciUyRkNTVi1Wb3JsYWdlLnRwbCUyMiUzQnMlM0ExNiUzQSUyMnNFeHBvcnRFeHRlbnNpb24lMjIlM0JzJTNBNCUzQSUyMi50eHQlMjIlM0IlN0Q=',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXFOLDER',
                'content'       => 'D3_USERMANAGER_USER_RETENTION',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXSORT',
                'content'       => '1000',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXWRITEPROTECTION',
                'content'       => "0",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_EXECMANUALLY',
                'content'       => "0",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'D3_UM_MARKUSER',
                'content'       => '0',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
        );
    }

    /**
     * @param Shop $oShop
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function getExampleJobItem2InsertFields(Shop $oShop): array
    {
        $sShopId = $oShop->getId();
        $iShopBit = strlen($sShopId) == 1 ? $this->getD3BitMask()->getIntByBitPosition((int) $sShopId) : '1';

        return array(
            array (
                'fieldname'     => 'OXID',
                'content'       => "MD5('" . $this->sModKey . " job02 " . $sShopId . "')",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPID',
                'content'       => $sShopId,
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPINCL',
                'content'       => $iShopBit,
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPEXCL',
                'content'       => '0',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVE',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVEFROM',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVETO',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXMODID',
                'content'       => 'd3usermanager',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTITLE',
                'content'       => 'Geburtstagsglückwünsche',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'de'),
                'content'       => 'Geburtstagsglückwünsche',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'en'),
                'content'       => 'birthday wishes',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHORTDESC',
                'content'       => 'Senden Sie den Geburtstagskindern unter Ihren Kunden einen personalisierten Glückwunsch. Dies ruft Ihren Shop wieder ins Gedächtnis und macht Freude.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXSHORTDESC', 'de'),
                'content'       => 'Senden Sie den Geburtstagskindern unter Ihren Kunden einen personalisierten Glückwunsch. Dies ruft Ihren Shop wieder ins Gedächtnis und macht Freude.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXCREATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXUPDATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXUPDATE', 'de'),
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXMODVERSION',
                'content'       => $this->sModVersion,
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXLOG',
                'content'       => '15',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => true,
            ),
            array(
                'fieldname'     => 'OXVALUE',
                'content'       => 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTEwOSUzQSU3QnMlM0ExMyUzQSUyMmJsSXRlbUV4ZWN1dGUlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTQlM0ElMjJibEl0ZW1NYWlsU2VuZCUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EyNSUzQSUyMmlVbm1hcmtFeGVjRGVsYXlUaW1lVmFsdWUlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjQlM0ElMjJzVW5tYXJrRXhlY0RlbGF5VGltZVVuaXQlMjIlM0JzJTNBNCUzQSUyMmRheXMlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrQWN0aXZlVXNlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjAlM0ElMjJzQ2hlY2tBY3RpdmVVc2VyVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTMwJTNBJTIyYmxDaGVja1JlZ2lzdGVyVXNlckZyb21fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIyJTNBJTIyc1JlZ2lzdGVyVXNlckZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI4JTNBJTIyYmxDaGVja1JlZ2lzdGVyVXNlclRvX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNSZWdpc3RlclVzZXJUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzAlM0ElMjJibENoZWNrUmVnaXN0ZXJUaW1lc3Bhbl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblR5cGUlMjIlM0JzJTNBNyUzQSUyMm1pbmltdW0lMjIlM0JzJTNBMjIlM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjElM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblVuaXQlMjIlM0JzJTNBNiUzQSUyMm1pbnV0ZSUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tGcm9tVXNlck5yX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNiUzQSUyMnNGcm9tVXNlck5yVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMiUzQSUyMmJsQ2hlY2tUb1VzZXJOcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTQlM0ElMjJzVG9Vc2VyTnJWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI2JTNBJTIyYmxDaGVja1Bhc3N3b3JkVXNlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjIlM0ElMjJzQ2hlY2tQYXNzd29yZFVzZXJUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjElM0ElMjJibENoZWNrSW5Hcm91cF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTQlM0ElMjJhQ3VzdEluR3JvdXBJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja05vdEluR3JvdXBfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE3JTNBJTIyYUN1c3ROb3RJbkdyb3VwSWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyOCUzQSUyMmJsQ2hlY2tOZXdzbGV0dGVyVXNlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjQlM0ElMjJzQ2hlY2tOZXdzbGV0dGVyVXNlclR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyNSUzQSUyMmJsQ2hlY2tIYXNCaXJ0aGRheV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMzElM0ElMjJibENoZWNrQmlydGhkYXRlVXNlckZyb21fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIzJTNBJTIyc0JpcnRoZGF0ZVVzZXJGcm9tVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyOSUzQSUyMmJsQ2hlY2tCaXJ0aGRhdGVVc2VyVG9fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIxJTNBJTIyc0JpcnRoZGF0ZVVzZXJUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjMlM0ElMjJibENoZWNrVmFsaWRNYWlsX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExOSUzQSUyMnNDaGVja1ZhbGlkTWFpbFR5cGUlMjIlM0JzJTNBNSUzQSUyMnZhbGlkJTIyJTNCcyUzQTE4JTNBJTIyYmxDaGVja0Jvbmlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTklM0ElMjJzQm9uaVR5cGUlMjIlM0JzJTNBNCUzQSUyMmxlc3MlMjIlM0JzJTNBMTAlM0ElMjJzQm9uaVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjklM0ElMjJibENoZWNrRGVsaXZlcnlBZGRyZXNzX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyNSUzQSUyMnNDaGVja0RlbGl2ZXJ5QWRkcmVzc1R5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyMyUzQSUyMmJsQ2hlY2tJbnZHZW5kZXJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE5JTNBJTIyc0NoZWNrSW52R2VuZGVyVHlwZSUyMiUzQnMlM0EyJTNBJTIybXIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrSW52Q291bnRyeV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTMlM0ElMjJhSW52Q291bnRyeUlkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJibENoZWNrSW52WmlwUmFuZ2Vfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIxJTNBJTIyc0ludlppcFJhbmdlRnJvbVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMTklM0ElMjJzSW52WmlwUmFuZ2VUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrSW52Q29tcGFueV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjAlM0ElMjJzQ2hlY2tJbnZDb21wYW55VHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTIyJTNBJTIyYmxDaGVja0ludlVzdElkX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExOCUzQSUyMnNDaGVja0ludlVzdElkVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTI2JTNBJTIyYmxDaGVja0ludlVzZXJGaWVsZF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjMlM0ElMjJzSW52VXNlckZpZWxkX0ZpZWxkTmFtZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIyJTNBJTIyc0NoZWNrSW52VXNlckZpZWxkVHlwZSUyMiUzQnMlM0E3JTNBJTIyY29udGVudCUyMiUzQnMlM0EyNCUzQSUyMnNJbnZVc2VyRmllbGRfRmllbGRWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIzJTNBJTIyYmxDaGVja0RlbEdlbmRlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTklM0ElMjJzQ2hlY2tEZWxHZW5kZXJUeXBlJTIyJTNCcyUzQTIlM0ElMjJtciUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tEZWxDb3VudHJ5X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExMyUzQSUyMmFEZWxDb3VudHJ5SWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNSUzQSUyMmJsQ2hlY2tEZWxaaXBSYW5nZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzRGVsWmlwUmFuZ2VGcm9tVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExOSUzQSUyMnNEZWxaaXBSYW5nZVRvVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tEZWxDb21wYW55X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNDaGVja0RlbENvbXBhbnlUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjYlM0ElMjJibENoZWNrRGVsVXNlckZpZWxkX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMyUzQSUyMnNEZWxVc2VyRmllbGRfRmllbGROYW1lJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjIlM0ElMjJzQ2hlY2tEZWxVc2VyRmllbGRUeXBlJTIyJTNCcyUzQTclM0ElMjJjb250ZW50JTIyJTNCcyUzQTI0JTNBJTIyc0RlbFVzZXJGaWVsZF9GaWVsZFZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJibENoZWNrSGFzTm9PcmRlcnNfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI3JTNBJTIyYmxDaGVja01pbk9yZGVyQ291bnRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI0JTNBJTIyc0NoZWNrTWluT3JkZXJDb3VudFZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrTWF4T3JkZXJDb3VudF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjQlM0ElMjJzQ2hlY2tNYXhPcmRlckNvdW50VmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EzMCUzQSUyMmJsQ2hlY2tPcmRlck1pblRpbWVzcGFuX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMiUzQSUyMnNPcmRlck1pblRpbWVzcGFuVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMnNPcmRlck1pblRpbWVzcGFuVW5pdCUyMiUzQnMlM0E2JTNBJTIybWludXRlJTIyJTNCcyUzQTMwJTNBJTIyYmxDaGVja09yZGVyTWF4VGltZXNwYW5fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIyJTNBJTIyc09yZGVyTWF4VGltZXNwYW5WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIxJTNBJTIyc09yZGVyTWF4VGltZXNwYW5Vbml0JTIyJTNCcyUzQTYlM0ElMjJtaW51dGUlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrT3JkZXJMYW5ndWFnZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTglM0ElMjJhT3JkZXJJbkxhbmd1YWdlSWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNiUzQSUyMmJsQ2hlY2tPcmRlclBheW1lbnRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE1JTNBJTIyYU9yZGVyUGF5bWVudElkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrT3JkZXJEZWxpdmVyeV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTYlM0ElMjJhT3JkZXJEZWxpdmVyeUlkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJibEFjdGlvbkN1c3QyR3JvdXBfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTEzJTNBJTIyYUN1c3RBZGRHcm91cCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI4JTNBJTIyYmxBY3Rpb25DdXN0RnJvbUdyb3VwX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNiUzQSUyMmFDdXN0UmVtb3ZlR3JvdXAlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNyUzQSUyMmJsQWN0aW9uQ3VzdEFjdGl2YXRlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMyUzQSUyMnNBY3Rpb25DdXN0QWN0aXZhdGVUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjUlM0ElMjJibEFjdGlvbkN1c3REZWxldGVfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTMyJTNBJTIyYmxBY3Rpb25Vc2VyQWRkRmllbGRWYWx1ZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzQWN0aW9uQWRkRmllbGRfZmllbGQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMnNBY3Rpb25BZGRGaWVsZF92YWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIzJTNBJTIyYmxBY3Rpb25NYWlsc2VuZF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjAlM0ElMjJzU2VuZE1haWxGcm9tU3ViamVjdCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyc1NlbmRNYWlsRnJvbVRlbXBsYXRlbmFtZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTMwJTNBJTIyc1NlbmRNYWlsRnJvbVRlbXBsYXRlbmFtZVBsYWluJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMTglM0ElMjJzU2VuZE1haWxGcm9tVGhlbWUlMjIlM0JzJTNBOCUzQSUyMmZyb250ZW5kJTIyJTNCcyUzQTE5JTNBJTIyc1NlbmRNYWlsRnJvbVNvdXJjZSUyMiUzQnMlM0EzJTNBJTIyY21zJTIyJTNCcyUzQTI0JTNBJTIyc1NlbmRNYWlsRnJvbUNvbnRlbnRuYW1lJTIyJTNCcyUzQTI2JTNBJTIyYWQ1NDJlNDk5NzU3MDlhNzIuNTIyNjExMjElMjIlM0JzJTNBMjklM0ElMjJzU2VuZE1haWxGcm9tQ29udGVudG5hbWVQbGFpbiUyMiUzQnMlM0EyNiUzQSUyMmFkNTQyZTQ5OTllYzAxZGQzLjA3MjE0MDQ5JTIyJTNCcyUzQTIwJTNBJTIyYmxTZW5kTWFpbFRvQ3VzdG9tZXIlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMTclM0ElMjJibFNlbmRNYWlsVG9Pd25lciUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExOCUzQSUyMmJsU2VuZE1haWxUb0N1c3RvbSUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyNCUzQSUyMnNTZW5kTWFpbFRvQ3VzdG9tQWRkcmVzcyUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIxJTNBJTIyYmxBY3Rpb25FeHBvcnRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE2JTNBJTIyYUV4cG9ydEZpZWxkTGlzdCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTE5JTNBJTIyc0V4cG9ydFRlbXBsYXRlbmFtZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTE2JTNBJTIyc0V4cG9ydEV4dGVuc2lvbiUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCJTdE',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXFOLDER',
                'content'       => 'D3_USERMANAGER_USER_RETENTION',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXSORT',
                'content'       => '2000',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXWRITEPROTECTION',
                'content'       => "0",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_EXECMANUALLY',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_MARKUSER',
                'content'       => '1',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
        );
    }

    /**
     * @param Shop $oShop
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getExampleJobItem3InsertFields(Shop $oShop): array
    {
        $sShopId = $oShop->getId();
        $iShopBit = strlen($sShopId) == 1 ? $this->getD3BitMask()->getIntByBitPosition((int) $sShopId) : '1';

        return array(
            array (
                'fieldname'     => 'OXID',
                'content'       => "MD5('" . $this->sModKey . " job03 " . $sShopId . "')",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPID',
                'content'       => $sShopId,
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPINCL',
                'content'       => $iShopBit,
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPEXCL',
                'content'       => '0',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVE',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVEFROM',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVETO',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXMODID',
                'content'       => 'd3usermanager',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTITLE',
                'content'       => 'Stammkunden-Zuordnung',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'de'),
                'content'       => 'Stammkunden-Zuordnung',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'en'),
                'content'       => 'assign patrons',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHORTDESC',
                'content'       => 'Premiumkunden (hohe Bestellanzahl und gute Bonität) werden in spezielle Kundengruppe verschoben, um z.B. zusätzliche Kaufanreize zu ermöglichen.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXSHORTDESC', 'de'),
                'content'       => 'Premiumkunden (hohe Bestellanzahl und gute Bonität) werden in spezielle Kundengruppe verschoben, um z.B. zusätzliche Kaufanreize zu ermöglichen.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXCREATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXUPDATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXUPDATE', 'de'),
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXMODVERSION',
                'content'       => $this->sModVersion,
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXLOG',
                'content'       => '15',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => true,
            ),
            array(
                'fieldname'     => 'OXVALUE',
                'content'       => 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTEwOCUzQSU3QnMlM0ExMyUzQSUyMmJsSXRlbUV4ZWN1dGUlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTQlM0ElMjJibEl0ZW1NYWlsU2VuZCUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EyNSUzQSUyMmlVbm1hcmtFeGVjRGVsYXlUaW1lVmFsdWUlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjQlM0ElMjJzVW5tYXJrRXhlY0RlbGF5VGltZVVuaXQlMjIlM0JzJTNBNCUzQSUyMmRheXMlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrQWN0aXZlVXNlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjAlM0ElMjJzQ2hlY2tBY3RpdmVVc2VyVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTMwJTNBJTIyYmxDaGVja1JlZ2lzdGVyVXNlckZyb21fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIyJTNBJTIyc1JlZ2lzdGVyVXNlckZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI4JTNBJTIyYmxDaGVja1JlZ2lzdGVyVXNlclRvX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNSZWdpc3RlclVzZXJUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzAlM0ElMjJibENoZWNrUmVnaXN0ZXJUaW1lc3Bhbl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjElM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblR5cGUlMjIlM0JzJTNBNyUzQSUyMm1pbmltdW0lMjIlM0JzJTNBMjIlM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblZhbHVlJTIyJTNCcyUzQTIlM0ElMjI5MCUyMiUzQnMlM0EyMSUzQSUyMnNSZWdpc3RlclRpbWVzcGFuVW5pdCUyMiUzQnMlM0EzJTNBJTIyZGF5JTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja0Zyb21Vc2VyTnJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE2JTNBJTIyc0Zyb21Vc2VyTnJWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIyJTNBJTIyYmxDaGVja1RvVXNlck5yX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNCUzQSUyMnNUb1VzZXJOclZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjYlM0ElMjJibENoZWNrUGFzc3dvcmRVc2VyX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMiUzQSUyMnNDaGVja1Bhc3N3b3JkVXNlclR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyMSUzQSUyMmJsQ2hlY2tJbkdyb3VwX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNCUzQSUyMmFDdXN0SW5Hcm91cElkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrTm90SW5Hcm91cF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMTclM0ElMjJhQ3VzdE5vdEluR3JvdXBJZCUyMiUzQmElM0ExJTNBJTdCaSUzQTAlM0JzJTNBMTYlM0ElMjJveGlkcG93ZXJzaG9wcGVyJTIyJTNCJTdEcyUzQTI4JTNBJTIyYmxDaGVja05ld3NsZXR0ZXJVc2VyX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyNCUzQSUyMnNDaGVja05ld3NsZXR0ZXJVc2VyVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTI1JTNBJTIyYmxDaGVja0hhc0JpcnRoZGF5X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzMSUzQSUyMmJsQ2hlY2tCaXJ0aGRhdGVVc2VyRnJvbV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjMlM0ElMjJzQmlydGhkYXRlVXNlckZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI5JTNBJTIyYmxDaGVja0JpcnRoZGF0ZVVzZXJUb19zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzQmlydGhkYXRlVXNlclRvVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMyUzQSUyMmJsQ2hlY2tWYWxpZE1haWxfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE5JTNBJTIyc0NoZWNrVmFsaWRNYWlsVHlwZSUyMiUzQnMlM0E4JTNBJTIybm90dmFsaWQlMjIlM0JzJTNBMTglM0ElMjJibENoZWNrQm9uaV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBOSUzQSUyMnNCb25pVHlwZSUyMiUzQnMlM0E2JTNBJTIyaGlnaGVyJTIyJTNCcyUzQTEwJTNBJTIyc0JvbmlWYWx1ZSUyMiUzQnMlM0EzJTNBJTIyNTAwJTIyJTNCcyUzQTI5JTNBJTIyYmxDaGVja0RlbGl2ZXJ5QWRkcmVzc19zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjUlM0ElMjJzQ2hlY2tEZWxpdmVyeUFkZHJlc3NUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjMlM0ElMjJibENoZWNrSW52R2VuZGVyX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExOSUzQSUyMnNDaGVja0ludkdlbmRlclR5cGUlMjIlM0JzJTNBMiUzQSUyMm1yJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja0ludkNvdW50cnlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTEzJTNBJTIyYUludkNvdW50cnlJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyYmxDaGVja0ludlppcFJhbmdlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMSUzQSUyMnNJbnZaaXBSYW5nZUZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTE5JTNBJTIyc0ludlppcFJhbmdlVG9WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja0ludkNvbXBhbnlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIwJTNBJTIyc0NoZWNrSW52Q29tcGFueVR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyMiUzQSUyMmJsQ2hlY2tJbnZVc3RJZF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTglM0ElMjJzQ2hlY2tJbnZVc3RJZFR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyNiUzQSUyMmJsQ2hlY2tJbnZVc2VyRmllbGRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIzJTNBJTIyc0ludlVzZXJGaWVsZF9GaWVsZE5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMiUzQSUyMnNDaGVja0ludlVzZXJGaWVsZFR5cGUlMjIlM0JzJTNBNyUzQSUyMmNvbnRlbnQlMjIlM0JzJTNBMjQlM0ElMjJzSW52VXNlckZpZWxkX0ZpZWxkVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMyUzQSUyMmJsQ2hlY2tEZWxHZW5kZXJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE5JTNBJTIyc0NoZWNrRGVsR2VuZGVyVHlwZSUyMiUzQnMlM0EyJTNBJTIybXIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrRGVsQ291bnRyeV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTMlM0ElMjJhRGVsQ291bnRyeUlkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJibENoZWNrRGVsWmlwUmFuZ2Vfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIxJTNBJTIyc0RlbFppcFJhbmdlRnJvbVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMTklM0ElMjJzRGVsWmlwUmFuZ2VUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrRGVsQ29tcGFueV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjAlM0ElMjJzQ2hlY2tEZWxDb21wYW55VHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTI2JTNBJTIyYmxDaGVja0RlbFVzZXJGaWVsZF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjMlM0ElMjJzRGVsVXNlckZpZWxkX0ZpZWxkTmFtZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIyJTNBJTIyc0NoZWNrRGVsVXNlckZpZWxkVHlwZSUyMiUzQnMlM0E3JTNBJTIyY29udGVudCUyMiUzQnMlM0EyNCUzQSUyMnNEZWxVc2VyRmllbGRfRmllbGRWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyYmxDaGVja0hhc05vT3JkZXJzX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyNyUzQSUyMmJsQ2hlY2tNaW5PcmRlckNvdW50X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EyNCUzQSUyMnNDaGVja01pbk9yZGVyQ291bnRWYWx1ZSUyMiUzQnMlM0ExJTNBJTIyNSUyMiUzQnMlM0EyNyUzQSUyMmJsQ2hlY2tNYXhPcmRlckNvdW50X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyNCUzQSUyMnNDaGVja01heE9yZGVyQ291bnRWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTMwJTNBJTIyYmxDaGVja09yZGVyTWluVGltZXNwYW5fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIyJTNBJTIyc09yZGVyTWluVGltZXNwYW5WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIxJTNBJTIyc09yZGVyTWluVGltZXNwYW5Vbml0JTIyJTNCcyUzQTYlM0ElMjJtaW51dGUlMjIlM0JzJTNBMzAlM0ElMjJibENoZWNrT3JkZXJNYXhUaW1lc3Bhbl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjIlM0ElMjJzT3JkZXJNYXhUaW1lc3BhblZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjElM0ElMjJzT3JkZXJNYXhUaW1lc3BhblVuaXQlMjIlM0JzJTNBNiUzQSUyMm1pbnV0ZSUyMiUzQnMlM0EyNyUzQSUyMmJsQ2hlY2tPcmRlckxhbmd1YWdlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExOCUzQSUyMmFPcmRlckluTGFuZ3VhZ2VJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI2JTNBJTIyYmxDaGVja09yZGVyUGF5bWVudF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTUlM0ElMjJhT3JkZXJQYXltZW50SWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNyUzQSUyMmJsQ2hlY2tPcmRlckRlbGl2ZXJ5X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNiUzQSUyMmFPcmRlckRlbGl2ZXJ5SWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNSUzQSUyMmJsQWN0aW9uQ3VzdDJHcm91cF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMTMlM0ElMjJhQ3VzdEFkZEdyb3VwJTIyJTNCYSUzQTElM0ElN0JpJTNBMCUzQnMlM0ExNiUzQSUyMm94aWRwb3dlcnNob3BwZXIlMjIlM0IlN0RzJTNBMjglM0ElMjJibEFjdGlvbkN1c3RGcm9tR3JvdXBfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE2JTNBJTIyYUN1c3RSZW1vdmVHcm91cCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI3JTNBJTIyYmxBY3Rpb25DdXN0QWN0aXZhdGVfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIzJTNBJTIyc0FjdGlvbkN1c3RBY3RpdmF0ZVR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyNSUzQSUyMmJsQWN0aW9uQ3VzdERlbGV0ZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMzIlM0ElMjJibEFjdGlvblVzZXJBZGRGaWVsZFZhbHVlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMSUzQSUyMnNBY3Rpb25BZGRGaWVsZF9maWVsZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIxJTNBJTIyc0FjdGlvbkFkZEZpZWxkX3ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjMlM0ElMjJibEFjdGlvbk1haWxzZW5kX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNTZW5kTWFpbEZyb21TdWJqZWN0JTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJzU2VuZE1haWxGcm9tVGVtcGxhdGVuYW1lJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzAlM0ElMjJzU2VuZE1haWxGcm9tVGVtcGxhdGVuYW1lUGxhaW4lMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExOCUzQSUyMnNTZW5kTWFpbEZyb21UaGVtZSUyMiUzQnMlM0E4JTNBJTIyZnJvbnRlbmQlMjIlM0JzJTNBMjQlM0ElMjJzU2VuZE1haWxGcm9tQ29udGVudG5hbWUlMjIlM0JzJTNBMzIlM0ElMjI4NzA5ZTQ1ZjMxYTg2OTA5ZTlmOTk5MjIyZTgwYjFkMCUyMiUzQnMlM0EyOSUzQSUyMnNTZW5kTWFpbEZyb21Db250ZW50bmFtZVBsYWluJTIyJTNCcyUzQTMyJTNBJTIyODcwOWU0NWYzMWE4NjkwOWU5Zjk5OTIyMmU4MGIxZDAlMjIlM0JzJTNBMjAlM0ElMjJibFNlbmRNYWlsVG9DdXN0b21lciUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNyUzQSUyMmJsU2VuZE1haWxUb093bmVyJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE4JTNBJTIyYmxTZW5kTWFpbFRvQ3VzdG9tJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI0JTNBJTIyc1NlbmRNYWlsVG9DdXN0b21BZGRyZXNzJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjElM0ElMjJibEFjdGlvbkV4cG9ydF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTYlM0ElMjJhRXhwb3J0RmllbGRMaXN0JTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMTklM0ElMjJzRXhwb3J0VGVtcGxhdGVuYW1lJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMTYlM0ElMjJzRXhwb3J0RXh0ZW5zaW9uJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0IlN0Q=',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXFOLDER',
                'content'       => 'D3_USERMANAGER_USER_MAINTENANCE',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXSORT',
                'content'       => '3000',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXWRITEPROTECTION',
                'content'       => "0",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_EXECMANUALLY',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_MARKUSER',
                'content'       => '0',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
        );
    }

    /**
     * @param Shop $oShop
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function getExampleJobItem4InsertFields(Shop $oShop): array
    {
        $sShopId = $oShop->getId();
        $iShopBit = strlen($sShopId) == 1 ? $this->getD3BitMask()->getIntByBitPosition((int) $sShopId) : '1';

        return array(
            array (
                'fieldname'     => 'OXID',
                'content'       => "MD5('" . $this->sModKey . " job04 " . $sShopId . "')",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPID',
                'content'       => $sShopId,
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPINCL',
                'content'       => $iShopBit,
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPEXCL',
                'content'       => '0',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVE',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVEFROM',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVETO',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXMODID',
                'content'       => 'd3usermanager',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTITLE',
                'content'       => 'Bestellabbrecher reaktivieren',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'de'),
                'content'       => 'Bestellabbrecher reaktivieren',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'en'),
                'content'       => 'find orderbreak',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHORTDESC',
                'content'       => 'Alle Kunden mit Kundenkonto, die noch keine Bestellung auslösten, können z.B. mit Sonderrabatten zum ersten Kauf bewegt werden. Diese Aufgabe kann durch Prüfung auf stehengelassene Warenkörbe weiter verfeinert werden.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXSHORTDESC', 'de'),
                'content'       => 'Alle Kunden mit Kundenkonto, die noch keine Bestellung auslösten, können z.B. mit Sonderrabatten zum ersten Kauf bewegt werden. Diese Aufgabe kann durch Prüfung auf stehengelassene Warenkörbe weiter verfeinert werden.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXCREATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXUPDATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXUPDATE', 'de'),
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXMODVERSION',
                'content'       => $this->sModVersion,
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXLOG',
                'content'       => '15',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => true,
            ),
            array(
                'fieldname'     => 'OXVALUE',
                'content'       => 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTEwOSUzQSU3QnMlM0ExMyUzQSUyMmJsSXRlbUV4ZWN1dGUlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTQlM0ElMjJibEl0ZW1NYWlsU2VuZCUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EyNSUzQSUyMmlVbm1hcmtFeGVjRGVsYXlUaW1lVmFsdWUlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjQlM0ElMjJzVW5tYXJrRXhlY0RlbGF5VGltZVVuaXQlMjIlM0JzJTNBNCUzQSUyMmRheXMlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrQWN0aXZlVXNlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjAlM0ElMjJzQ2hlY2tBY3RpdmVVc2VyVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTMwJTNBJTIyYmxDaGVja1JlZ2lzdGVyVXNlckZyb21fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIyJTNBJTIyc1JlZ2lzdGVyVXNlckZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI4JTNBJTIyYmxDaGVja1JlZ2lzdGVyVXNlclRvX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNSZWdpc3RlclVzZXJUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzAlM0ElMjJibENoZWNrUmVnaXN0ZXJUaW1lc3Bhbl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblR5cGUlMjIlM0JzJTNBNyUzQSUyMm1pbmltdW0lMjIlM0JzJTNBMjIlM0ElMjJzUmVnaXN0ZXJUaW1lc3BhblZhbHVlJTIyJTNCcyUzQTElM0ElMjIzJTIyJTNCcyUzQTIxJTNBJTIyc1JlZ2lzdGVyVGltZXNwYW5Vbml0JTIyJTNCcyUzQTMlM0ElMjJkYXklMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrRnJvbVVzZXJOcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTYlM0ElMjJzRnJvbVVzZXJOclZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjIlM0ElMjJibENoZWNrVG9Vc2VyTnJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE0JTNBJTIyc1RvVXNlck5yVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNiUzQSUyMmJsQ2hlY2tQYXNzd29yZFVzZXJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIyJTNBJTIyc0NoZWNrUGFzc3dvcmRVc2VyVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTIxJTNBJTIyYmxDaGVja0luR3JvdXBfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE0JTNBJTIyYUN1c3RJbkdyb3VwSWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tOb3RJbkdyb3VwX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNyUzQSUyMmFDdXN0Tm90SW5Hcm91cElkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjglM0ElMjJibENoZWNrTmV3c2xldHRlclVzZXJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI0JTNBJTIyc0NoZWNrTmV3c2xldHRlclVzZXJUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjUlM0ElMjJibENoZWNrSGFzQmlydGhkYXlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTMxJTNBJTIyYmxDaGVja0JpcnRoZGF0ZVVzZXJGcm9tX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMyUzQSUyMnNCaXJ0aGRhdGVVc2VyRnJvbVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjklM0ElMjJibENoZWNrQmlydGhkYXRlVXNlclRvX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMSUzQSUyMnNCaXJ0aGRhdGVVc2VyVG9WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIzJTNBJTIyYmxDaGVja1ZhbGlkTWFpbF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTklM0ElMjJzQ2hlY2tWYWxpZE1haWxUeXBlJTIyJTNCcyUzQTglM0ElMjJub3R2YWxpZCUyMiUzQnMlM0ExOCUzQSUyMmJsQ2hlY2tCb25pX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0E5JTNBJTIyc0JvbmlUeXBlJTIyJTNCcyUzQTQlM0ElMjJsZXNzJTIyJTNCcyUzQTEwJTNBJTIyc0JvbmlWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI5JTNBJTIyYmxDaGVja0RlbGl2ZXJ5QWRkcmVzc19zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjUlM0ElMjJzQ2hlY2tEZWxpdmVyeUFkZHJlc3NUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjMlM0ElMjJibENoZWNrSW52R2VuZGVyX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExOSUzQSUyMnNDaGVja0ludkdlbmRlclR5cGUlMjIlM0JzJTNBMiUzQSUyMm1yJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja0ludkNvdW50cnlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTEzJTNBJTIyYUludkNvdW50cnlJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyYmxDaGVja0ludlppcFJhbmdlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMSUzQSUyMnNJbnZaaXBSYW5nZUZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTE5JTNBJTIyc0ludlppcFJhbmdlVG9WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja0ludkNvbXBhbnlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIwJTNBJTIyc0NoZWNrSW52Q29tcGFueVR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyMiUzQSUyMmJsQ2hlY2tJbnZVc3RJZF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTglM0ElMjJzQ2hlY2tJbnZVc3RJZFR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyNiUzQSUyMmJsQ2hlY2tJbnZVc2VyRmllbGRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIzJTNBJTIyc0ludlVzZXJGaWVsZF9GaWVsZE5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMiUzQSUyMnNDaGVja0ludlVzZXJGaWVsZFR5cGUlMjIlM0JzJTNBNyUzQSUyMmNvbnRlbnQlMjIlM0JzJTNBMjQlM0ElMjJzSW52VXNlckZpZWxkX0ZpZWxkVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMyUzQSUyMmJsQ2hlY2tEZWxHZW5kZXJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE5JTNBJTIyc0NoZWNrRGVsR2VuZGVyVHlwZSUyMiUzQnMlM0EyJTNBJTIybXIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrRGVsQ291bnRyeV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTMlM0ElMjJhRGVsQ291bnRyeUlkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjUlM0ElMjJibENoZWNrRGVsWmlwUmFuZ2Vfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIxJTNBJTIyc0RlbFppcFJhbmdlRnJvbVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMTklM0ElMjJzRGVsWmlwUmFuZ2VUb1ZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrRGVsQ29tcGFueV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjAlM0ElMjJzQ2hlY2tEZWxDb21wYW55VHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTI2JTNBJTIyYmxDaGVja0RlbFVzZXJGaWVsZF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjMlM0ElMjJzRGVsVXNlckZpZWxkX0ZpZWxkTmFtZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIyJTNBJTIyc0NoZWNrRGVsVXNlckZpZWxkVHlwZSUyMiUzQnMlM0E3JTNBJTIyY29udGVudCUyMiUzQnMlM0EyNCUzQSUyMnNEZWxVc2VyRmllbGRfRmllbGRWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyYmxDaGVja0hhc05vT3JkZXJzX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EyNyUzQSUyMmJsQ2hlY2tNaW5PcmRlckNvdW50X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyNCUzQSUyMnNDaGVja01pbk9yZGVyQ291bnRWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI3JTNBJTIyYmxDaGVja01heE9yZGVyQ291bnRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI0JTNBJTIyc0NoZWNrTWF4T3JkZXJDb3VudFZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzAlM0ElMjJibENoZWNrT3JkZXJNaW5UaW1lc3Bhbl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjIlM0ElMjJzT3JkZXJNaW5UaW1lc3BhblZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjElM0ElMjJzT3JkZXJNaW5UaW1lc3BhblVuaXQlMjIlM0JzJTNBNiUzQSUyMm1pbnV0ZSUyMiUzQnMlM0EzMCUzQSUyMmJsQ2hlY2tPcmRlck1heFRpbWVzcGFuX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMiUzQSUyMnNPcmRlck1heFRpbWVzcGFuVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMnNPcmRlck1heFRpbWVzcGFuVW5pdCUyMiUzQnMlM0E2JTNBJTIybWludXRlJTIyJTNCcyUzQTI3JTNBJTIyYmxDaGVja09yZGVyTGFuZ3VhZ2Vfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE4JTNBJTIyYU9yZGVySW5MYW5ndWFnZUlkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjYlM0ElMjJibENoZWNrT3JkZXJQYXltZW50X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNSUzQSUyMmFPcmRlclBheW1lbnRJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI3JTNBJTIyYmxDaGVja09yZGVyRGVsaXZlcnlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE2JTNBJTIyYU9yZGVyRGVsaXZlcnlJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyYmxBY3Rpb25DdXN0Mkdyb3VwX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExMyUzQSUyMmFDdXN0QWRkR3JvdXAlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyOCUzQSUyMmJsQWN0aW9uQ3VzdEZyb21Hcm91cF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTYlM0ElMjJhQ3VzdFJlbW92ZUdyb3VwJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjclM0ElMjJibEFjdGlvbkN1c3RBY3RpdmF0ZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjMlM0ElMjJzQWN0aW9uQ3VzdEFjdGl2YXRlVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTI1JTNBJTIyYmxBY3Rpb25DdXN0RGVsZXRlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzMiUzQSUyMmJsQWN0aW9uVXNlckFkZEZpZWxkVmFsdWVfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIxJTNBJTIyc0FjdGlvbkFkZEZpZWxkX2ZpZWxkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjElM0ElMjJzQWN0aW9uQWRkRmllbGRfdmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMyUzQSUyMmJsQWN0aW9uTWFpbHNlbmRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTIwJTNBJTIyc1NlbmRNYWlsRnJvbVN1YmplY3QlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNSUzQSUyMnNTZW5kTWFpbEZyb21UZW1wbGF0ZW5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EzMCUzQSUyMnNTZW5kTWFpbEZyb21UZW1wbGF0ZW5hbWVQbGFpbiUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTE4JTNBJTIyc1NlbmRNYWlsRnJvbVRoZW1lJTIyJTNCcyUzQTglM0ElMjJmcm9udGVuZCUyMiUzQnMlM0ExOSUzQSUyMnNTZW5kTWFpbEZyb21Tb3VyY2UlMjIlM0JzJTNBMyUzQSUyMmNtcyUyMiUzQnMlM0EyNCUzQSUyMnNTZW5kTWFpbEZyb21Db250ZW50bmFtZSUyMiUzQnMlM0EzMiUzQSUyMmE5Njc2NGIxYTNlYWU3YzM2MDRmNThmMWIzMDI5NzFiJTIyJTNCcyUzQTI5JTNBJTIyc1NlbmRNYWlsRnJvbUNvbnRlbnRuYW1lUGxhaW4lMjIlM0JzJTNBMzIlM0ElMjJlMDA3NWM0N2M3MTI2YzkxNTdiZDI1MmNhODU1MWE2MSUyMiUzQnMlM0EyMCUzQSUyMmJsU2VuZE1haWxUb0N1c3RvbWVyJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTE3JTNBJTIyYmxTZW5kTWFpbFRvT3duZXIlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTglM0ElMjJibFNlbmRNYWlsVG9DdXN0b20lMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjQlM0ElMjJzU2VuZE1haWxUb0N1c3RvbUFkZHJlc3MlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMmJsQWN0aW9uRXhwb3J0X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNiUzQSUyMmFFeHBvcnRGaWVsZExpc3QlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExOSUzQSUyMnNFeHBvcnRUZW1wbGF0ZW5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExNiUzQSUyMnNFeHBvcnRFeHRlbnNpb24lMjIlM0JzJTNBMCUzQSUyMiUyMiUzQiU3RA==',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXFOLDER',
                'content'       => 'D3_USERMANAGER_USER_EXTRACTION',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXSORT',
                'content'       => '4000',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXWRITEPROTECTION',
                'content'       => "0",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_EXECMANUALLY',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_MARKUSER',
                'content'       => '0',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
        );
    }

    /**
     * @param Shop $oShop
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getExampleJobItem5InsertFields(Shop $oShop): array
    {
        $sShopId = $oShop->getId();
        $iShopBit = strlen($sShopId) == 1 ? $this->getD3BitMask()->getIntByBitPosition((int) $sShopId) : '1';

        return array(
            array (
                'fieldname'     => 'OXID',
                'content'       => "MD5(RAND())",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPID',
                'content'       => $sShopId,
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPINCL',
                'content'       => $iShopBit,
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPEXCL',
                'content'       => '0',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVE',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVEFROM',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVETO',
                'content'       => '0000-00-00 00:00:00',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXMODID',
                'content'       => 'd3usermanager',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTITLE',
                'content'       => 'Kunden segmentieren',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'de'),
                'content'       => 'Kunden segmentieren',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXTITLE', 'en'),
                'content'       => 'segment customers',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHORTDESC',
                'content'       => 'Gruppieren Sie Ihre Kunden z.B. nach gekauften Kategorieartikeln oder verwendeten Zahlarten, um diese Kunden mit gezieltem Marketing direkter ansprechen zu können. Legen Sie für jedes Segment eine entsprechende Aufgabe an.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXSHORTDESC', 'de'),
                'content'       => 'Gruppieren Sie Ihre Kunden z.B. nach gekauften Kategorieartikeln oder verwendeten Zahlarten, um diese Kunden mit gezieltem Marketing direkter ansprechen zu können. Legen Sie für jedes Segment eine entsprechende Aufgabe an.',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXCREATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXUPDATE',
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('d3modprofile', 'OXUPDATE', 'de'),
                'content'       => 'NOW()',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXMODVERSION',
                'content'       => $this->sModVersion,
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXLOG',
                'content'       => '15',
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => true,
            ),
            array(
                'fieldname'     => 'OXVALUE',
                'content'       => 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTEyNyUzQSU3QnMlM0ExMyUzQSUyMmJsSXRlbUV4ZWN1dGUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExNCUzQSUyMmJsSXRlbU1haWxTZW5kJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTI1JTNBJTIyaVVubWFya0V4ZWNEZWxheVRpbWVWYWx1ZSUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EyNCUzQSUyMnNVbm1hcmtFeGVjRGVsYXlUaW1lVW5pdCUyMiUzQnMlM0E0JTNBJTIyZGF5cyUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tBY3RpdmVVc2VyX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EyMCUzQSUyMnNDaGVja0FjdGl2ZVVzZXJUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMzAlM0ElMjJibENoZWNrUmVnaXN0ZXJVc2VyRnJvbV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjIlM0ElMjJzUmVnaXN0ZXJVc2VyRnJvbVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjglM0ElMjJibENoZWNrUmVnaXN0ZXJVc2VyVG9fc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIwJTNBJTIyc1JlZ2lzdGVyVXNlclRvVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EzMCUzQSUyMmJsQ2hlY2tSZWdpc3RlclRpbWVzcGFuX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMSUzQSUyMnNSZWdpc3RlclRpbWVzcGFuVHlwZSUyMiUzQnMlM0E3JTNBJTIybWluaW11bSUyMiUzQnMlM0EyMiUzQSUyMnNSZWdpc3RlclRpbWVzcGFuVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMnNSZWdpc3RlclRpbWVzcGFuVW5pdCUyMiUzQnMlM0E2JTNBJTIybWludXRlJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja0Zyb21Vc2VyTnJfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE2JTNBJTIyc0Zyb21Vc2VyTnJWYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIyJTNBJTIyYmxDaGVja1RvVXNlck5yX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNCUzQSUyMnNUb1VzZXJOclZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjYlM0ElMjJibENoZWNrUGFzc3dvcmRVc2VyX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMiUzQSUyMnNDaGVja1Bhc3N3b3JkVXNlclR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyMSUzQSUyMmJsQ2hlY2tJbkdyb3VwX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNCUzQSUyMmFDdXN0SW5Hcm91cElkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjQlM0ElMjJibENoZWNrTm90SW5Hcm91cF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTclM0ElMjJhQ3VzdE5vdEluR3JvdXBJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI4JTNBJTIyYmxDaGVja05ld3NsZXR0ZXJVc2VyX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyNCUzQSUyMnNDaGVja05ld3NsZXR0ZXJVc2VyVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTI1JTNBJTIyYmxDaGVja0hhc0JpcnRoZGF5X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EzMSUzQSUyMmJsQ2hlY2tCaXJ0aGRhdGVVc2VyRnJvbV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjMlM0ElMjJzQmlydGhkYXRlVXNlckZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI5JTNBJTIyYmxDaGVja0JpcnRoZGF0ZVVzZXJUb19zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzQmlydGhkYXRlVXNlclRvVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMiUzQSUyMmJsQ2hlY2tBZ2VDaGVja19zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTMlM0ElMjJzQWdlQ2hlY2tUeXBlJTIyJTNCcyUzQTQlM0ElMjJsZXNzJTIyJTNCcyUzQTE0JTNBJTIyc0FnZUNoZWNrVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMyUzQSUyMmJsQ2hlY2tWYWxpZE1haWxfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE5JTNBJTIyc0NoZWNrVmFsaWRNYWlsVHlwZSUyMiUzQnMlM0E4JTNBJTIybm90dmFsaWQlMjIlM0JzJTNBMTglM0ElMjJibENoZWNrQm9uaV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBOSUzQSUyMnNCb25pVHlwZSUyMiUzQnMlM0E0JTNBJTIybGVzcyUyMiUzQnMlM0ExMCUzQSUyMnNCb25pVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyOSUzQSUyMmJsQ2hlY2tEZWxpdmVyeUFkZHJlc3Nfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI1JTNBJTIyc0NoZWNrRGVsaXZlcnlBZGRyZXNzVHlwZSUyMiUzQnMlM0EzJTNBJTIyc2V0JTIyJTNCcyUzQTIzJTNBJTIyYmxDaGVja0ludkdlbmRlcl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTklM0ElMjJzQ2hlY2tJbnZHZW5kZXJUeXBlJTIyJTNCcyUzQTIlM0ElMjJtciUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tJbnZDb3VudHJ5X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExMyUzQSUyMmFJbnZDb3VudHJ5SWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNSUzQSUyMmJsQ2hlY2tJbnZaaXBSYW5nZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzSW52WmlwUmFuZ2VGcm9tVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExOSUzQSUyMnNJbnZaaXBSYW5nZVRvVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tJbnZDb21wYW55X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNDaGVja0ludkNvbXBhbnlUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjIlM0ElMjJibENoZWNrSW52VXN0SWRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE4JTNBJTIyc0NoZWNrSW52VXN0SWRUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjMlM0ElMjJibENoZWNrRGVsR2VuZGVyX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExOSUzQSUyMnNDaGVja0RlbEdlbmRlclR5cGUlMjIlM0JzJTNBMiUzQSUyMm1yJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja0RlbENvdW50cnlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTEzJTNBJTIyYURlbENvdW50cnlJZCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyYmxDaGVja0RlbFppcFJhbmdlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMSUzQSUyMnNEZWxaaXBSYW5nZUZyb21WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTE5JTNBJTIyc0RlbFppcFJhbmdlVG9WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI0JTNBJTIyYmxDaGVja0RlbENvbXBhbnlfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIwJTNBJTIyc0NoZWNrRGVsQ29tcGFueVR5cGUlMjIlM0JzJTNBMyUzQSUyMnNldCUyMiUzQnMlM0EyNSUzQSUyMmJsQ2hlY2tIYXNOb09yZGVyc19zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrTWluT3JkZXJDb3VudF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjQlM0ElMjJzQ2hlY2tNaW5PcmRlckNvdW50VmFsdWUlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMjclM0ElMjJibENoZWNrTWF4T3JkZXJDb3VudF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjQlM0ElMjJzQ2hlY2tNYXhPcmRlckNvdW50VmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNSUzQSUyMmJsQ2hlY2tNYXhPcmRlclN1bV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzQ2hlY2tNYXhPcmRlclN1bVR5cGUlMjIlM0JzJTNBMTMlM0ElMjJveHRvdGFsbmV0c3VtJTIyJTNCcyUzQTIyJTNBJTIyc0NoZWNrTWF4T3JkZXJTdW1WYWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyYmxDaGVja01pbk9yZGVyU3VtX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMSUzQSUyMnNDaGVja01pbk9yZGVyU3VtVHlwZSUyMiUzQnMlM0ExMyUzQSUyMm94dG90YWxuZXRzdW0lMjIlM0JzJTNBMjIlM0ElMjJzQ2hlY2tNaW5PcmRlclN1bVZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzAlM0ElMjJibENoZWNrT3JkZXJNaW5UaW1lc3Bhbl9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjIlM0ElMjJzT3JkZXJNaW5UaW1lc3BhblZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjElM0ElMjJzT3JkZXJNaW5UaW1lc3BhblVuaXQlMjIlM0JzJTNBNiUzQSUyMm1pbnV0ZSUyMiUzQnMlM0EzMCUzQSUyMmJsQ2hlY2tPcmRlck1heFRpbWVzcGFuX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMiUzQSUyMnNPcmRlck1heFRpbWVzcGFuVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMnNPcmRlck1heFRpbWVzcGFuVW5pdCUyMiUzQnMlM0E2JTNBJTIybWludXRlJTIyJTNCcyUzQTI2JTNBJTIyYmxDaGVja09yZGVyUGF5bWVudF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMTUlM0ElMjJhT3JkZXJQYXltZW50SWQlMjIlM0JhJTNBMSUzQSU3QmklM0EwJTNCcyUzQTE0JTNBJTIyb3hpZGNyZWRpdGNhcmQlMjIlM0IlN0RzJTNBMjclM0ElMjJibENoZWNrT3JkZXJEZWxpdmVyeV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTYlM0ElMjJhT3JkZXJEZWxpdmVyeUlkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrT3JkZXJMYW5ndWFnZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTglM0ElMjJhT3JkZXJJbkxhbmd1YWdlSWQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tVc2VyQmFza2V0X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMCUzQSUyMnNDaGVja1VzZXJCYXNrZXRUeXBlJTIyJTNCcyUzQTUlM0ElMjJleGlzdCUyMiUzQnMlM0EyNiUzQSUyMmJsQ2hlY2tJbnZVc2VyRmllbGRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIzJTNBJTIyc0ludlVzZXJGaWVsZF9GaWVsZE5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMiUzQSUyMnNDaGVja0ludlVzZXJGaWVsZFR5cGUlMjIlM0JzJTNBNyUzQSUyMmNvbnRlbnQlMjIlM0JzJTNBMjQlM0ElMjJzSW52VXNlckZpZWxkX0ZpZWxkVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNiUzQSUyMmJsQ2hlY2tEZWxVc2VyRmllbGRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIzJTNBJTIyc0RlbFVzZXJGaWVsZF9GaWVsZE5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMiUzQSUyMnNDaGVja0RlbFVzZXJGaWVsZFR5cGUlMjIlM0JzJTNBNyUzQSUyMmNvbnRlbnQlMjIlM0JzJTNBMjQlM0ElMjJzRGVsVXNlckZpZWxkX0ZpZWxkVmFsdWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNCUzQSUyMmJsQ2hlY2tPcmRlckZpZWxkX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMSUzQSUyMnNPcmRlckZpZWxkX0ZpZWxkTmFtZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTIwJTNBJTIyc0NoZWNrT3JkZXJGaWVsZFR5cGUlMjIlM0JzJTNBNyUzQSUyMmNvbnRlbnQlMjIlM0JzJTNBMjIlM0ElMjJzT3JkZXJGaWVsZF9GaWVsZFZhbHVlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMjclM0ElMjJibENoZWNrRXhlY3V0ZU1ldGhvZF9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMzAlM0ElMjJzUmVxdWlyZW1lbnRFeGVjdXRlTWV0aG9kX25hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNyUzQSUyMmJsQWN0aW9uQ3VzdEFjdGl2YXRlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0EyMyUzQSUyMnNBY3Rpb25DdXN0QWN0aXZhdGVUeXBlJTIyJTNCcyUzQTMlM0ElMjJzZXQlMjIlM0JzJTNBMjUlM0ElMjJibEFjdGlvbkN1c3QyR3JvdXBfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTEzJTNBJTIyYUN1c3RBZGRHcm91cCUyMiUzQmElM0ExJTNBJTdCaSUzQTAlM0JzJTNBMTYlM0ElMjJveGlkcG93ZXJzaG9wcGVyJTIyJTNCJTdEcyUzQTI4JTNBJTIyYmxBY3Rpb25DdXN0RnJvbUdyb3VwX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNiUzQSUyMmFDdXN0UmVtb3ZlR3JvdXAlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMyUzQSUyMmJsQWN0aW9uTWFpbHNlbmRfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTIwJTNBJTIyc1NlbmRNYWlsRnJvbVN1YmplY3QlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyNSUzQSUyMnNTZW5kTWFpbEZyb21UZW1wbGF0ZW5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EzMCUzQSUyMnNTZW5kTWFpbEZyb21UZW1wbGF0ZW5hbWVQbGFpbiUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTE4JTNBJTIyc1NlbmRNYWlsRnJvbVRoZW1lJTIyJTNCcyUzQTglM0ElMjJmcm9udGVuZCUyMiUzQnMlM0EyNCUzQSUyMnNTZW5kTWFpbEZyb21Db250ZW50bmFtZSUyMiUzQnMlM0EzMiUzQSUyMjg3MDllNDVmMzFhODY5MDllOWY5OTkyMjJlODBiMWQwJTIyJTNCcyUzQTI5JTNBJTIyc1NlbmRNYWlsRnJvbUNvbnRlbnRuYW1lUGxhaW4lMjIlM0JzJTNBMzIlM0ElMjI4NzA5ZTQ1ZjMxYTg2OTA5ZTlmOTk5MjIyZTgwYjFkMCUyMiUzQnMlM0EyMCUzQSUyMmJsU2VuZE1haWxUb0N1c3RvbWVyJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTE3JTNBJTIyYmxTZW5kTWFpbFRvT3duZXIlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMTglM0ElMjJibFNlbmRNYWlsVG9DdXN0b20lMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjQlM0ElMjJzU2VuZE1haWxUb0N1c3RvbUFkZHJlc3MlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMmJsQWN0aW9uRXhwb3J0X3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQnMlM0ExNiUzQSUyMmFFeHBvcnRGaWVsZExpc3QlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExOSUzQSUyMnNFeHBvcnRUZW1wbGF0ZW5hbWUlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0ExNiUzQSUyMnNFeHBvcnRFeHRlbnNpb24lMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EzMiUzQSUyMmJsQWN0aW9uVXNlckV4ZWN1dGVNZXRob2Rfc3RhdHVzJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI1JTNBJTIyc0FjdGlvbkV4ZWN1dGVNZXRob2RfbmFtZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTMyJTNBJTIyYmxBY3Rpb25Vc2VyQWRkRmllbGRWYWx1ZV9zdGF0dXMlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBMjElM0ElMjJzQWN0aW9uQWRkRmllbGRfZmllbGQlMjIlM0JzJTNBMCUzQSUyMiUyMiUzQnMlM0EyMSUzQSUyMnNBY3Rpb25BZGRGaWVsZF92YWx1ZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTI1JTNBJTIyYmxBY3Rpb25DdXN0RGVsZXRlX3N0YXR1cyUyMiUzQnMlM0ExJTNBJTIyMCUyMiUzQiU3RA==',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXFOLDER',
                'content'       => '',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array(
                'fieldname'     => 'OXSORT',
                'content'       => '5000',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXWRITEPROTECTION',
                'content'       => "0",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_EXECMANUALLY',
                'content'       => "0",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'D3_UM_MARKUSER',
                'content'       => '1',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
        );
    }

    /**
     * @param Shop $oShop
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getExampleContent1InsertFields(Shop $oShop): array
    {
        $sShopId = $oShop->getId();

        return array(
            array (
                'fieldname'     => 'OXID',
                'content'       => "MD5('" . $this->sModKey . " content01 " . $sShopId . "')",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXLOADID',
                'content'       => "d3orderbreakhtml",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPID',
                'content'       => $sShopId,
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSNIPPET',
                'content'       => "1",
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTYPE',
                'content'       => "0",
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVE',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXPOSITION',
                'content'       => "",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTITLE',
                'content'       => "Bestellabbruch",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'de'),
                'content'       => "Bestellabbruch",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'en'),
                'content'       => "order break",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXCONTENT',
                'content'       => "<p style='font-family: Verdana, Arial, sans-serif; font-size:11px;'>Hallo [{\$oUser->oxuser__oxsal->value|oxmultilangsal}] [{\$oUser->getFieldData('oxuser')}] [{\$oUser->getFieldData('oxlname')}],<br /><br />Wir haben uns sehr über Ihren Besuch unseres Shops gefreut.<br />Wie wir festgestellt haben, haben Sie sich als Kunde registriert,<br />dann jedoch keine Bestellung aufgegeben.<br /><br />Um unsere Services und die Abläufe in unserem Shop zu verbessern,<br />würden wir uns über Ihre Antwort zu den Gründen freuen. Vielen Dank im Voraus.<br /><br />Ihr [{\$shop->getFieldData('oxname')}]-Team<br /><br /><br />Nach der Registrierung habe ich keine Bestellung vorgenommen, weil<br /><br />[ ] Ich den/die Artikel anderswo günstiger bekommen habe<br /><br />[ ] Der/die Artikel entsprachen doch nicht meinen Vorstellungen<br /><br />[ ] Der Bestellprozess war mir zu kompliziert<br /><br />[ ] Ihr Shop war mir nicht vertrauenswürdig genug<br /><br />[ ] Nicht die Zahlungsarten angeboten werden, die ich bevorzuge. Es fehlte:<br /><br />..........................................................<br /><br />[ ] Es eine Fehlermeldung gab. Die Fehlermeldung lautete:<br /><br />..........................................................<br /><br />[ ] Es andere technische Probleme gab, und zwar:<br /><br />..........................................................<br /><br />[ ] Sonstige Gründe:<br /><br />..........................................................</p>",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXCATID',
                'content'       => "",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXFOLDER',
                'content'       => "CMSFOLDER_USERINFO",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
        );
    }

    /**
     * @param Shop $oShop
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getExampleContent2InsertFields(Shop $oShop): array
    {
        $sShopId = $oShop->getId();

        return array(
            array (
                'fieldname'     => 'OXID',
                'content'       => "MD5('" . $this->sModKey . " content02 " . $sShopId . "')",
                'force_update'  => false,
                'use_quote'     => false,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXLOADID',
                'content'       => "d3orderbreakplain",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSHOPID',
                'content'       => $sShopId,
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXSNIPPET',
                'content'       => "1",
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTYPE',
                'content'       => "0",
                'force_update'  => true,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXACTIVE',
                'content'       => "1",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXPOSITION',
                'content'       => "",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXTITLE',
                'content'       => "Bestellabbruch (plain)",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'de'),
                'content'       => "Bestellabbruch (plain)",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'en'),
                'content'       => "order break (plain)",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXCONTENT',
                'content'       => "Hallo [{\$oUser->oxuser__oxsal->value|oxmultilangsal}] [{\$oUser->oxuser__oxfname->getRawValue()}] [{\$oUser->oxuser__oxlname->getRawValue()}],\r\n\r\nWir haben uns sehr \über Ihren Besuch unseres Shops gefreut.\r\nWie wir festgestellt haben, haben Sie sich als Kunde registriert,\r\nhaben dann jedoch keine Bestellung aufgegeben.\r\n\r\nUm unsere Services und die Abläufe in unserem Shop zu verbessern,\r\nwürden wir uns über Ihre Antwort zu den Gr\ünden freuen. Vielen Dank im Voraus.\r\n\r\nIhr [{\$shop->oxshops__oxname->getRawValue()}]-Team\r\n\r\n\r\nNach der Registrierung habe ich keine Bestellung vorgenommen, weil\r\n\r\n[ ] Ich den/die Artikel anderswo günstiger bekommen habe\r\n\r\n[ ] Der/die Artikel entsprachen doch nicht meinen Vorstellungen\r\n\r\n[ ] Der Bestellprozess war mir zu kompliziert\r\n\r\n[ ] Ihr Shop war mir nicht vertrauenswürdig genug\r\n\r\n[ ] Nicht die Zahlungsarten angeboten werden, die ich bevorzuge. Es fehlte:\r\n\r\n..........................................................\r\n\r\n[ ] Es eine Fehlermeldung gab. Die Fehlermeldung lautete:\r\n\r\n..........................................................\r\n\r\n[ ] Es andere technische Probleme gab, und zwar:\r\n\r\n..........................................................\r\n\r\n[ ] Sonstige Gründe:\r\n\r\n..........................................................",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
            ),
            array (
                'fieldname'     => 'OXCATID',
                'content'       => "",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
            array (
                'fieldname'     => 'OXFOLDER',
                'content'       => "CMSFOLDER_USERINFO",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
            ),
        );
    }

    /**
     * @param $sTableName
     *
     * @param $sGetFieldContentMethodName
     * @return bool
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _addExampleJobItem($sTableName, $sGetFieldContentMethodName): bool
    {
        $blRet = false;

        /** @var $oShop Shop */
        foreach ($this->getShopListByActiveModule('d3usermanager') as $oShop) {
            $aWhere = array();
            $aInsertFields = $this->{$sGetFieldContentMethodName}($oShop);

            $this->setInitialExecMethod(__METHOD__);
            $blRet  = $this->_updateTableItem2($sTableName, $aInsertFields, $aWhere);

            if ($this->getStepByStepMode()) {
                break;
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws ReflectionException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function hasUnregisteredFiles(): bool
    {
        return $this->_hasUnregisteredFiles('d3usermanager', array('d3FileRegister'));
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws ReflectionException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function showUnregisteredFiles(): bool
    {
        return $this->_showUnregisteredFiles('d3usermanager', array('d3FileRegister'));
    }
}
