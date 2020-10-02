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
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_requirementException;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementOrderMinSumTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
        'userTestIdNo4',
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
                'oxorderdate'   => '2018-01-01 00:00:00',
                'oxuserid'      => $this->aUserIdList[0],
                'oxbillcompany' => __CLASS__,
                'oxtotalnetsum' => 7,
                'oxtotalbrutsum'=> 57,
                'oxtotalordersum'=> 107,
                'oxdelcost'     => 157,
                'oxpaycost'     => 207,
                'oxcurrate'     => 1
            )
        );

        $this->createOrder(
            $this->aOrderIdList[1],
            array(
                'oxorderdate'   => '2018-01-01 00:00:00',
                'oxuserid'      => $this->aUserIdList[0],
                'oxbillcompany' => __CLASS__,
                'oxtotalnetsum' => 10,
                'oxtotalbrutsum'=> 60,
                'oxtotalordersum'=> 110,
                'oxdelcost'     => 160,
                'oxpaycost'     => 210,
                'oxcurrate'     => 1
            )
        );

        $this->createUser(
            $this->aUserIdList[1]
        );

        $this->createOrder(
            $this->aOrderIdList[2],
            array(
                'oxuserid'      => $this->aUserIdList[1],
                'oxorderdate'   => '2018-01-01 00:00:00',
                'oxbillcompany' => __CLASS__,
                'oxlang'        => 98,
                'oxtotalnetsum' => 15,
                'oxtotalbrutsum'=> 65,
                'oxtotalordersum'=> 115,
                'oxdelcost'     => 165,
                'oxpaycost'     => 215,
                'oxcurrate'     => 1
            )
        );

        $this->createUser(
            $this->aUserIdList[2]
        );

        $this->createOrder(
            $this->aOrderIdList[3],
            array(
                'oxuserid'      => $this->aUserIdList[2],
                'oxorderdate'   => '2018-01-01 00:00:00',
                'oxbillcompany' => __CLASS__,
                'oxlang'        => 98,
                'oxtotalnetsum' => 15,
                'oxtotalbrutsum'=> 65,
                'oxtotalordersum'=> 115,
                'oxdelcost'     => 165,
                'oxpaycost'     => 215,
                'oxcurrate'     => 0.75
            )
        );

        $this->createUser(
            $this->aUserIdList[3]
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
    public function getConfiguredManagerTotalNetSum()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckMinOrderSum_status', true);
        $oManager->setValue('sCheckMinOrderSumType', 'oxtotalnetsum');
        $oManager->setValue('sCheckMinOrderSumValue', '16');

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
    public function requirementsSelectsRightUsersTotalNetSum()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerTotalNetSum());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerTotalBrutSum()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckMinOrderSum_status', true);
        $oManager->setValue('sCheckMinOrderSumType', 'oxtotalbrutsum');
        $oManager->setValue('sCheckMinOrderSumValue', '116');

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
    public function requirementsSelectsRightUsersTotalBrutSum()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerTotalBrutSum());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerTotalOrderSum()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckMinOrderSum_status', true);
        $oManager->setValue('sCheckMinOrderSumType', 'oxtotalordersum');
        $oManager->setValue('sCheckMinOrderSumValue', '150');

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
    public function requirementsSelectsRightUsersTotalOrderSum()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerTotalOrderSum());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerDelCostSum()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckMinOrderSum_status', true);
        $oManager->setValue('sCheckMinOrderSumType', 'oxdelcost');
        $oManager->setValue('sCheckMinOrderSumValue', '300');

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
    public function requirementsSelectsRightUsersDelCostSum()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerDelCostSum());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerPayCostSum()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckMinOrderSum_status', true);
        $oManager->setValue('sCheckMinOrderSumType', 'oxpaycost');
        $oManager->setValue('sCheckMinOrderSumValue', '280');

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
    public function requirementsSelectsRightUsersPayCostSum()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerPayCostSum());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
        );
    }
}
