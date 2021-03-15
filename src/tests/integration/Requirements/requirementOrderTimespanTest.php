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
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirement_ordertimespan;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementOrderTimespanTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
        'userTestIdNo4',
        'userTestIdNo5'
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
     *
     * @throws DBALException
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

        $this->createOrder(
            $this->aOrderIdList[0],
            array(
                'oxuserid'  => $this->aUserIdList[0],
                'oxorderdate'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')))
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createOrder(
            $this->aOrderIdList[1],
            array(
                'oxuserid'  => $this->aUserIdList[1],
                'oxorderdate'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -10 minute'))
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createOrder(
            $this->aOrderIdList[2],
            array(
                'oxuserid'  => $this->aUserIdList[2],
                'oxorderdate'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -10 hour'))
            )
        );

        $this->createUser(
            $this->aUserIdList[3],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createOrder(
            $this->aOrderIdList[3],
            array(
                'oxuserid'  => $this->aUserIdList[3],
                'oxorderdate'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -10 day'))
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
     * @throws DBALException
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
    public function getConfiguredManagerMinMinute()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderTimespan_status', true);
        $oManager->setValue('sOrderTimespanValue', '5');
        $oManager->setValue('sOrderTimespanOrderType', d3usermanager_requirement_ordertimespan::ORDERTYPE_LAST);
        $oManager->setValue('sOrderTimespanUnit', d3usermanager_requirement_ordertimespan::UNIT_MINUTE);
        $oManager->setValue('sOrderTimespanType', d3usermanager_requirement_ordertimespan::TYPE_MIN);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinHour()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderTimespan_status', true);
        $oManager->setValue('sOrderTimespanValue', '5');
        $oManager->setValue('sOrderTimespanOrderType', d3usermanager_requirement_ordertimespan::ORDERTYPE_LAST);
        $oManager->setValue('sOrderTimespanUnit', d3usermanager_requirement_ordertimespan::UNIT_HOUR);
        $oManager->setValue('sOrderTimespanType', d3usermanager_requirement_ordertimespan::TYPE_MIN);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinDay()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderTimespan_status', true);
        $oManager->setValue('sOrderTimespanValue', '5');
        $oManager->setValue('sOrderTimespanOrderType', d3usermanager_requirement_ordertimespan::ORDERTYPE_LAST);
        $oManager->setValue('sOrderTimespanUnit', d3usermanager_requirement_ordertimespan::UNIT_DAY);
        $oManager->setValue('sOrderTimespanType', d3usermanager_requirement_ordertimespan::TYPE_MIN);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxMinute()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderTimespan_status', true);
        $oManager->setValue('sOrderTimespanValue', '5');
        $oManager->setValue('sOrderTimespanOrderType', d3usermanager_requirement_ordertimespan::ORDERTYPE_LAST);
        $oManager->setValue('sOrderTimespanUnit', d3usermanager_requirement_ordertimespan::UNIT_MINUTE);
        $oManager->setValue('sOrderTimespanType', d3usermanager_requirement_ordertimespan::TYPE_MAX);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxHour()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderTimespan_status', true);
        $oManager->setValue('sOrderTimespanValue', '5');
        $oManager->setValue('sOrderTimespanOrderType', d3usermanager_requirement_ordertimespan::ORDERTYPE_LAST);
        $oManager->setValue('sOrderTimespanUnit', d3usermanager_requirement_ordertimespan::UNIT_HOUR);
        $oManager->setValue('sOrderTimespanType', d3usermanager_requirement_ordertimespan::TYPE_MAX);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxDay()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderTimespan_status', true);
        $oManager->setValue('sOrderTimespanValue', '5');
        $oManager->setValue('sOrderTimespanOrderType', d3usermanager_requirement_ordertimespan::ORDERTYPE_LAST);
        $oManager->setValue('sOrderTimespanUnit', d3usermanager_requirement_ordertimespan::UNIT_DAY);
        $oManager->setValue('sOrderTimespanType', d3usermanager_requirement_ordertimespan::TYPE_MAX);

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
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertGreaterThanOrEqual(3, $oUserList->count());
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[0]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[1]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[2]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[3]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[4]));
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
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertGreaterThanOrEqual(2, $oUserList->count());
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[0]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[1]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[2]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[3]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[4]));
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
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertGreaterThanOrEqual(1, $oUserList->count());
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[0]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[1]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[2]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[3]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[4]));
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
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertGreaterThanOrEqual(1, $oUserList->count());
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[0]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[1]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[2]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[3]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[4]));
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
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertGreaterThanOrEqual(2, $oUserList->count());
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[0]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[1]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[2]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[3]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[4]));
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
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertGreaterThanOrEqual(3, $oUserList->count());
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[0]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[1]));
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[2]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[3]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[4]));
    }
}
