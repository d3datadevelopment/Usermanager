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
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementHasUserbasketTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
    );
    public $aUserBasketIdList = array(
        'userBasketIdNo1',
        'userBasketIdNo2',
    );

    /**
     * Set up fixture.
     * @throws Exception
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->createTestData();
    }

    /**
     * Tear down fixture.
     */
    public function tearDown() : void
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
                'oxtitle'     => 'savedbasket'
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
                'oxtitle'     => 'wishlist'
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__,
            )
        );
    }

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
    public function getConfiguredManagerSet()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckUserBasket_status', true);
        $oManager->setValue('sCheckUserBasketType', 'exist');

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagernotset()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckUserBasket_status', true);
        $oManager->setValue('sCheckUserBasketType', 'notexist');

        return $oManager;
    }

    /**
     * @test
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function requirementsSelectsRightUsersSet()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerSet());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
        );
    }

    /**
     * @test
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function requirementsSelectsRightUsersNotSet()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagernotset());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 1
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
        );
    }
}
