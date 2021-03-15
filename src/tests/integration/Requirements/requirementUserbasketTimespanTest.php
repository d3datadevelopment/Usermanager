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

class requirementUserbasketTimespanTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
        'userTestIdNo4',
        'userTestIdNo5',
        'userTestIdNo6',
    );
    public $aUserBasketIdList = array(
        'userBasketIdNo1',
        'userBasketIdNo2',
        'userBasketIdNo3',
        'userBasketIdNo4',
        'userBasketIdNo5',
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
            'oxuserbaskets',
            $this->aUserBasketIdList[0],
            array(
                'oxuserid'    => $this->aUserIdList[0],
                'oxtitle'     => 'savedbasket',
                'oxupdate'     => strtotime(date('Y-m-d H:i:s'))
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxuserbaskets',
            $this->aUserBasketIdList[1],
            array(
                'oxuserid'    => $this->aUserIdList[1],
                'oxtitle'     => 'savedbasket',
                'oxupdate'     => strtotime(date('Y-m-d H:i:s') . ' -10 minute')
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxuserbaskets',
            $this->aUserBasketIdList[2],
            array(
                'oxuserid'    => $this->aUserIdList[2],
                'oxtitle'     => 'savedbasket',
                'oxupdate'     => strtotime(date('Y-m-d H:i:s') . ' -10 hour')
            )
        );

        $this->createUser(
            $this->aUserIdList[3],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxuserbaskets',
            $this->aUserBasketIdList[3],
            array(
                'oxuserid'    => $this->aUserIdList[3],
                'oxtitle'     => 'savedbasket',
                'oxupdate'     => strtotime(date('Y-m-d H:i:s') . ' -10 day')
            )
        );

        $this->createUser(
            $this->aUserIdList[4],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxuserbaskets',
            $this->aUserBasketIdList[4],
            array(
                'oxuserid'    => $this->aUserIdList[4],
                'oxtitle'     => 'wishlist'
            )
        );

        $this->createUser(
            $this->aUserIdList[5],
            array(
                'oxcompany' => __CLASS__,
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

        foreach ($this->aUserBasketIdList as $sUserBasketId) {
            $this->deleteBaseModelObject('oxuserbaskets', $sUserBasketId);
        }
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxMinute()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckUserBasketTimespan_status', true);
        $oManager->setValue('sUserBasketTimespanType', 'maximum');
        $oManager->setValue('sUserBasketTimespanUnit', 'minute');
        $oManager->setValue('sUserBasketTimespanValue', 5);

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
    public function requirementsSelectsRightUsersMaxMinute()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMaxMinute());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
            && false == $oUserList->offsetExists( $this->aUserIdList[5])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxHour()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckUserBasketTimespan_status', true);
        $oManager->setValue('sUserBasketTimespanType', 'maximum');
        $oManager->setValue('sUserBasketTimespanUnit', 'hour');
        $oManager->setValue('sUserBasketTimespanValue', 5);

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
    public function requirementsSelectsRightUsersMaxHour()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMaxHour());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
            && false == $oUserList->offsetExists( $this->aUserIdList[5])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMaxDay()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckUserBasketTimespan_status', true);
        $oManager->setValue('sUserBasketTimespanType', 'maximum');
        $oManager->setValue('sUserBasketTimespanUnit', 'day');
        $oManager->setValue('sUserBasketTimespanValue', 5);

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
    public function requirementsSelectsRightUsersMaxDay()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMaxDay());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 3
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
            && false == $oUserList->offsetExists( $this->aUserIdList[5])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinMinute()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckUserBasketTimespan_status', true);
        $oManager->setValue('sUserBasketTimespanType', 'minimum');
        $oManager->setValue('sUserBasketTimespanUnit', 'minute');
        $oManager->setValue('sUserBasketTimespanValue', 5);

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
    public function requirementsSelectsRightUsersMinMinute()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMinMinute());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 3
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
            && false == $oUserList->offsetExists( $this->aUserIdList[5])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinHour()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckUserBasketTimespan_status', true);
        $oManager->setValue('sUserBasketTimespanType', 'minimum');
        $oManager->setValue('sUserBasketTimespanUnit', 'hour');
        $oManager->setValue('sUserBasketTimespanValue', 5);

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
    public function requirementsSelectsRightUsersMinHour()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMinHour());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 2
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
            && false == $oUserList->offsetExists( $this->aUserIdList[5])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMinDay()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckUserBasketTimespan_status', true);
        $oManager->setValue('sUserBasketTimespanType', 'minimum');
        $oManager->setValue('sUserBasketTimespanUnit', 'day');
        $oManager->setValue('sUserBasketTimespanValue', 5);

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
    public function requirementsSelectsRightUsersMinDay()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMinDay());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 1
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && $oUserList->offsetExists( $this->aUserIdList[3])
            && false == $oUserList->offsetExists( $this->aUserIdList[4])
            && false == $oUserList->offsetExists( $this->aUserIdList[5])
        );
    }
}
