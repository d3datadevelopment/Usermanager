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
namespace D3\Usermanager\tests\integration\Actions;

use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Model\d3usermanager;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Object2Group;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\ListModel;

class actionDeleteFromGroupTest extends d3ActionIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
    );
    public $aO2GroupIdList = array(
        'o2groupTestIdNo1',
        'o2groupTestIdNo2',
        'o2groupTestIdNo3',
    );
    public $aGroupsIdList = array(
        'groupTestIdNo1',
        'groupTestIdNo2',
    );

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager($this->sManagerId);

        $this->createGroup($this->aGroupsIdList[0]);
        $this->createGroup($this->aGroupsIdList[1]);

        $this->createUser($this->aUserIdList[0]);
        $this->createUser($this->aUserIdList[1]);
    }

    /**
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);
        $this->deleteUser($this->aUserIdList[0]);
        $this->deleteUser($this->aUserIdList[1]);
        $this->deleteObject('d3ox.usermanager.'.Object2Group::class, $this->aO2GroupIdList[0]);

        $aQueries = [
            "DELETE FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[0]}'",
            "DELETE FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[1]}'",
        ];
        foreach ($aQueries as $sQuery) {
            DatabaseProvider::getDb()->execute($sQuery);
        }
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerSingleGroupsExists()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCustFromGroup_status', true);
        $oManager->setValue('aCustRemoveGroup', array($this->aGroupsIdList[0]));
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMultiGroupsExists()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCustFromGroup_status', true);
        $oManager->setValue('aCustRemoveGroup', array($this->aGroupsIdList[0], $this->aGroupsIdList[1]));
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerSingleGroupsNotExists()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCustFromGroup_status', true);
        $oManager->setValue('aCustRemoveGroup', array('unknownGroupId'));
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerNoGroups()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCustFromGroup_status', true);
        $oManager->setValue('aCustRemoveGroup', array());
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return ListModel
     * @throws Exception
     */
    public function getFilledResultList()
    {
        return $this->getResultList(array($this->aUserIdList[0]));
    }

    /**
     * @test
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function actionChangeConcernedUserSingleGroupsExistsAssigned()
    {
        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[0],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[1],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[1],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[3],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[1],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerSingleGroupsExists());
        $oExecute->startJobItemExecution();

        // check assignment pass
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[0]}' AND oxgroupsid IN ('{$this->aGroupsIdList[1]}') AND oxgroupsid NOT IN ('{$this->aGroupsIdList[0]}')";

        $this->assertSame(
            1,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );

        // check other assignments
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[1]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}')";
        $this->assertSame(
            1,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );
    }

    /**
     * @test
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function actionChangeConcernedUserMultiGroupsExistsAssigned()
    {
        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[0],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[1],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[1],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[2],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[1],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerMultiGroupsExists());
        $oExecute->startJobItemExecution();

        // check assignment pass
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[0]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}', '{$this->aGroupsIdList[1]}')";
        $this->assertSame(
            0,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );

        // check other assignments
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[1]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}')";
        $this->assertSame(
            1,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );
    }

    /**
     * @test
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function actionChangeConcernedUserSingleGroupsExistsNotAssigned()
    {
        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[0],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[1],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[1],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[1],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerSingleGroupsExists());
        $oExecute->startJobItemExecution();

        // check assignment pass
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[0]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}', '{$this->aGroupsIdList[1]}')";
        $this->assertSame(
            1,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );

        // check other assignments
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[1]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}')";
        $this->assertSame(
            1,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );
    }

    /**
     * @test
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function actionChangeConcernedUserSingleGroupsNotExistsNotAssigned()
    {
        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[0],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[1],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[1],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[2],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[1],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerSingleGroupsNotExists());
        $oExecute->startJobItemExecution();

        // check assignment pass
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[0]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}', '{$this->aGroupsIdList[1]}')";
        $this->assertSame(
            2,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );

        // check other assignments
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[0]}' AND oxgroupsid IN ('unknownGroupId')";
        $this->assertSame(
            0,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid != '{$this->aUserIdList[0]}' AND oxgroupsid IN ('unknownGroupId')";
        $this->assertSame(
            0,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[1]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}')";
        $this->assertSame(
            1,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );
    }

    /**
     * @test
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function actionChangeConcernedUserNoGroups()
    {
        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[0],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[1],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => $this->aGroupsIdList[1],
            )
        );

        $this->createObject(
            'd3ox.usermanager.'.Object2Group::class,
            $this->aO2GroupIdList[2],
            array(
                'oxshopid'      => 1,
                'oxobjectid'    => $this->aUserIdList[1],
                'oxgroupsid'    => $this->aGroupsIdList[0],
            )
        );

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerNoGroups());
        $oExecute->startJobItemExecution();

        // check assignment pass
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[0]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}', '{$this->aGroupsIdList[1]}')";
        $this->assertSame(
            2,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );
        $sSelect = "SELECT count(*) FROM oxobject2group WHERE oxobjectid = '{$this->aUserIdList[1]}' AND oxgroupsid IN ('{$this->aGroupsIdList[0]}')";
        $this->assertSame(
            1,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );
    }
}
