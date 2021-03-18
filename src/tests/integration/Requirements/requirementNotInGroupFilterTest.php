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
namespace D3\Usermanager\tests\integration\Requirements;

use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Model\d3usermanager;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementNotInGroupFilterTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
    );
    public $aGroupAssignIdList = array(
        'groupAssignIdNo1',
        'groupAssignIdNo2',
        'groupAssignIdNo3',
    );
    public $aGroupIdList = [
        'sGroupId1Pass',
        'sGroupId2Pass',
        'sGroupId3Pass'
    ];

    /**
     * Set up fixture.
     * @throws Exception
     */
    public function setUp()
    {
        parent::setUp();

        $this->createTestData();
    }

    /**
     * Tear down fixture.
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function tearDown()
    {
        $this->cleanTestData();

        parent::tearDown();
    }

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager(
            $this->sManagerId
        );

        $this->createUser(
            $this->aUserIdList[0],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxobject2group',
            $this->aGroupAssignIdList[0],
            array(
                'oxobjectid'    => $this->aUserIdList[0],
                'oxgroupsid'    => 'sGroupId3Pass',
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxobject2group',
            $this->aGroupAssignIdList[1],
            array(
                'oxobjectid'    => $this->aUserIdList[1],
                'oxgroupsid'    => 'sGroupId2Pass',
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxobject2group',
            $this->aGroupAssignIdList[2],
            array(
                'oxobjectid'    => $this->aUserIdList[2],
                'oxgroupsid'    => 'sGroupId1Pass',
            )
        );

        foreach ($this->aGroupIdList as $sId) {
            $this->createBaseModelObject('oxgroups', $sId);
        }
    }

    /**
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);

        foreach ($this->aUserIdList as $sUserId) {
            $this->deleteUser($sUserId);
        }

        foreach ($this->aGroupAssignIdList as $sGroupAssignId) {
            $this->deleteBaseModelObject('oxobject2group', $sGroupAssignId);
        }

        foreach ($this->aGroupIdList as $sId) {
            $this->deleteBaseModelObject('oxgroups', $sId);
        }
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerSingle()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckNotInGroup_status', true);
        $oManager->setValue('aCustNotInGroupId', array('sGroupId1Pass'));

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMulti()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckNotInGroup_status', true);
        $oManager->setValue('aCustNotInGroupId', array('sGroupId1Pass', 'sGroupId2Pass'));

        return $oManager;
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
    public function requirementsSelectsRightUsersMulti()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMulti());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
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
    public function requirementsSelectsRightUsersSingle()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerSingle());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
        );
    }
}
