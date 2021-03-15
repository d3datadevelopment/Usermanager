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
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirement_wishlistcount;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementWishlistCountTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
        'userTestIdNo4',
        'userTestIdNo5',
    );
    public $aUserBasketIdList = array(
        'userBasketIdNo1',
        'userBasketIdNo2',
        'userBasketIdNo3',
        'userBasketIdNo4',
        'userBasketIdNo5',
        'userBasketIdNo6',
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
                'oxtitle'     => 'wishlist'
            )
        );

        $this->createBaseModelObject(
            'oxuserbaskets',
            $this->aUserBasketIdList[1],
            array(
                'oxuserid'    => $this->aUserIdList[0],
                'oxtitle'     => 'wishlist'
            )
        );

        $this->createBaseModelObject(
            'oxuserbaskets',
            $this->aUserBasketIdList[2],
            array(
                'oxuserid'    => $this->aUserIdList[0],
                'oxtitle'     => 'wishlist'
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
            $this->aUserBasketIdList[3],
            array(
                'oxuserid'    => $this->aUserIdList[1],
                'oxtitle'     => 'wishlist'
            )
        );

        $this->createBaseModelObject(
            'oxuserbaskets',
            $this->aUserBasketIdList[4],
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

        $this->createBaseModelObject(
            'oxuserbaskets',
            $this->aUserBasketIdList[5],
            array(
                'oxuserid'    => $this->aUserIdList[2],
                'oxtitle'     => 'wishlist'
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
            $this->aUserBasketIdList[5],
            array(
                'oxuserid'    => $this->aUserIdList[3],
                'oxtitle'     => 'noticelist'
            )
        );

        $this->createUser(
            $this->aUserIdList[4],
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
    public function getConfiguredManagerHigher()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blWishListCount_status', true);
        $oManager->setValue('sWishListCountType', d3usermanager_requirement_wishlistcount::TYPE_HIGHER);
        $oManager->setValue('sWishListCountValue', '2');

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerLower()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blWishListCount_status', true);
        $oManager->setValue('sWishListCountType', d3usermanager_requirement_wishlistcount::TYPE_LESS);
        $oManager->setValue('sWishListCountValue', '2');

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
    public function requirementsSelectsRightUsersHigher()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerHigher());
        $oUserList = $oListGenerator->getConcernedItems();

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
    public function requirementsSelectsRightUsersNotSet()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerLower());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 4
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && $oUserList->offsetExists( $this->aUserIdList[3])
            && $oUserList->offsetExists( $this->aUserIdList[4])
        );
    }
}
