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

class requirementOrderMaxTimespanTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
        'userTestIdNo4',
        'userTestIdNo5',
    );
    public $aOrderIdList = array(
        'orderTestIdNo1',
        'orderTestIdNo2',
        'orderTestIdNo3',
        'orderTestIdNo4',
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
            $this->aUserIdList[0]
        );

        $this->createOrder(
            $this->aOrderIdList[0],
            array(
                'oxorderdate'   => date('Y-m-d H:i:s'),
                'oxuserid'      => $this->aUserIdList[0],
                'oxbillcompany' => __CLASS__,
            )
        );

        $this->createUser(
            $this->aUserIdList[1]
        );

        $this->createOrder(
            $this->aOrderIdList[1],
            array(
                'oxorderdate'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' - 8 minute')),
                'oxuserid'      => $this->aUserIdList[1],
                'oxbillcompany' => __CLASS__,
            )
        );

        $this->createUser(
            $this->aUserIdList[2]
        );

        $this->createOrder(
            $this->aOrderIdList[2],
            array(
                'oxorderdate'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' - 2 hour')),
                'oxuserid'      => $this->aUserIdList[2],
                'oxbillcompany' => __CLASS__,
            )
        );

        $this->createUser(
            $this->aUserIdList[3]
        );

        $this->createOrder(
            $this->aOrderIdList[3],
            array(
                'oxorderdate'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' - 2 day')),
                'oxuserid'      => $this->aUserIdList[3],
                'oxbillcompany' => __CLASS__,
            )
        );

        $this->createUser(
            $this->aUserIdList[4]
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

        foreach ($this->aOrderIdList as $sOrderId) {
            $this->deleteOrder($sOrderId);
        }
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinute()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderMaxTimespan_status', true);
        $oManager->setValue('sOrderMaxTimespanUnit', 'minute');
        $oManager->setValue('sOrderMaxTimespanValue', '5');

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
    public function requirementsSelectsRightUsersMinute()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMinute());
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
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerHour()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderMaxTimespan_status', true);
        $oManager->setValue('sOrderMaxTimespanUnit', 'hour');
        $oManager->setValue('sOrderMaxTimespanValue', '1');

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
    public function requirementsSelectsRightUsersHour()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerHour());
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
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerDay()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderMaxTimespan_status', true);
        $oManager->setValue('sOrderMaxTimespanUnit', 'day');
        $oManager->setValue('sOrderMaxTimespanValue', '1');

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
    public function requirementsSelectsRightUsersDay()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerDay());
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
