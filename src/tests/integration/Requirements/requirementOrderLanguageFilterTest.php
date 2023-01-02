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
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ;
use D3\Usermanager\Application\Model\d3usermanager;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementOrderLanguageFilterTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
    );
    public $aOrderIdList = array(
        'orderTestIdNo1',
        'orderTestIdNo2',
        'orderTestIdNo3',
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
        $languageIdList = array_keys(array_change_key_case(
            oxNew(d3_cfg_usermanageritem_requ::class)->getLanguageList()
        ));

        if (false == count($languageIdList)) {
            $this->markTestSkipped('no languages for tests available');
        }
        $langId1 = array_slice($languageIdList, 0, 1)[0];
        $langId2 = array_slice($languageIdList, 1, 1)[0] ?? $langId1;

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
                'oxlang'        => $langId1,
            )
        );

        $this->createUser(
            $this->aUserIdList[1]
        );

        $this->createOrder(
            $this->aOrderIdList[1],
            array(
                'oxuserid'      => $this->aUserIdList[1],
                'oxorderdate'   => '2018-01-01 00:00:00',
                'oxbillcompany' => __CLASS__,
                'oxlang'        => $langId2,
            )
        );

        $this->createUser(
            $this->aUserIdList[2]
        );

        $this->createOrder(
            $this->aOrderIdList[2],
            array(
                'oxuserid'      => $this->aUserIdList[2],
                'oxorderdate'   => '2018-01-01 00:00:00',
                'oxbillcompany' => __CLASS__,
                'oxlang'        => '99',
            )
        );
    }

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
    public function getConfiguredManagerSingle()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $languageIdList = array_keys(array_change_key_case(
            oxNew(d3_cfg_usermanageritem_requ::class)->getLanguageList()
        ));

        if (false == count($languageIdList)) {
            $this->markTestSkipped('no languages for tests available');
        }
        $langId1 = array_slice($languageIdList, 0, 1)[0];

        $oManager->setValue('blCheckOrderLanguage_status', true);
        $oManager->setValue('aOrderInLanguageId', [$langId1]);

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
    public function requirementsSelectsRightUsersSingle()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerSingle());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMulti()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $languageIdList = array_keys(array_change_key_case(
            oxNew(d3_cfg_usermanageritem_requ::class)->getLanguageList()
        ));

        if (false == count($languageIdList)) {
            $this->markTestSkipped('no languages for tests available');
        }
        $langId1 = array_slice($languageIdList, 0, 1)[0];
        $langId2 = array_slice($languageIdList, 1, 1)[0] ?? $langId1;

        $oManager->setValue('blCheckOrderLanguage_status', true);
        $oManager->setValue('aOrderInLanguageId', [$langId1, $langId2]);

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
    public function requirementsSelectsRightUsersMulti()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMulti());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
        );
    }
}
