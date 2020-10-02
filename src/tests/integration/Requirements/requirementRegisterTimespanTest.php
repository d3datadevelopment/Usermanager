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
use D3\Usermanager\tests\integration\Requirements\d3RequirementIntegrationTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementRegisterTimespanTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
        'userTestIdNo4',
        'userTestIdNo5'
    );

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
                'oxregister' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')))
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxcompany' => __CLASS__,
                'oxregister' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -10 minute')),
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__,
                'oxregister' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -10 hour'))
            )
        );

        $this->createUser(
            $this->aUserIdList[3],
            array(
                'oxcompany' => __CLASS__,
                'oxregister' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -10 day'))
            )
        );

        $this->createUser(
            $this->aUserIdList[4],
            array(
                'oxcompany' => __CLASS__
            )
        );
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
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinMinute()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckRegisterTimespan_status', true);
        $oManager->setValue('sRegisterTimespanValue', '5');
        $oManager->setValue('sRegisterTimespanUnit', 'minute');
        $oManager->setValue('sRegisterTimespanType', 'minimum');

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinHour()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckRegisterTimespan_status', true);
        $oManager->setValue('sRegisterTimespanValue', '5');
        $oManager->setValue('sRegisterTimespanUnit', 'hour');
        $oManager->setValue('sRegisterTimespanType', 'minimum');

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinDay()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckRegisterTimespan_status', true);
        $oManager->setValue('sRegisterTimespanValue', '5');
        $oManager->setValue('sRegisterTimespanUnit', 'day');
        $oManager->setValue('sRegisterTimespanType', 'minimum');

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxMinute()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckRegisterTimespan_status', true);
        $oManager->setValue('sRegisterTimespanValue', '5');
        $oManager->setValue('sRegisterTimespanUnit', 'minute');
        $oManager->setValue('sRegisterTimespanType', 'maximum');

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxHour()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckRegisterTimespan_status', true);
        $oManager->setValue('sRegisterTimespanValue', '5');
        $oManager->setValue('sRegisterTimespanUnit', 'hour');
        $oManager->setValue('sRegisterTimespanType', 'maximum');

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxDay()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckRegisterTimespan_status', true);
        $oManager->setValue('sRegisterTimespanValue', '5');
        $oManager->setValue('sRegisterTimespanUnit', 'day');
        $oManager->setValue('sRegisterTimespanType', 'maximum');

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
    public function requirementsSelectsRightMinMinute()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMinMinute());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 3
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
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
    public function requirementsSelectsRightMinHour()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMinHour());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 2
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
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
    public function requirementsSelectsRightMinDay()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMinDay());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 1
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
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
    public function requirementsSelectsRightMaxMinute()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMaxMinute());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
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
    public function requirementsSelectsRightMaxHour()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMaxHour());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
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
    public function requirementsSelectsRightMaxDay()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMaxDay());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 3
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
        );
    }
}
