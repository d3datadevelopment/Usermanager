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
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirement_orderfieldfilter;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementOrderFieldTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
    );
    public $aOrderIdList = array(
        'orderTestIdNo1',
        'orderTestIdNo2',
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
            $this->aUserIdList[0]
        );

        $this->createOrder(
            $this->aOrderIdList[0],
            array(
                'oxorderdate'   => '2018-01-01 00:00:00',
                'oxuserid'      => $this->aUserIdList[0],
                'oxbillcompany' => __CLASS__,
                'oxcardid'   => 'testContent',
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
                'oxcardid'      => null,
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
    public function getConfiguredManagerContent()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderField_status', true);
        $oManager->setValue('sOrderField_FieldName', 'oxcardid');
        $oManager->setValue('sCheckOrderFieldType', 'content');
        $oManager->setValue('sOrderField_FieldValue', 'testContent');

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
    public function requirementsSelectsRightUsersContent()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerContent());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() === 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerNotEmpty()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderField_status', true);
        $oManager->setValue('sOrderField_FieldName', 'oxcardid');
        $oManager->setValue('sCheckOrderFieldType', 'notempty');
        $oManager->setValue('sOrderField_FieldValue', '');

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
    public function requirementsSelectsRightUsersArticleCountryDelSingle()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerNotEmpty());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerEmpty()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderField_status', true);
        $oManager->setValue('sOrderField_FieldName', 'oxcardid');
        $oManager->setValue('sCheckOrderFieldType', 'empty');
        $oManager->setValue('sOrderField_FieldValue', '');

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
    public function requirementsSelectsRightUsersEmpty()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerEmpty());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 1
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
        );
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerFieldNotExist()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckOrderField_status', true);
        $oManager->setValue('sOrderField_FieldName', 'notexistingfield');
        $oManager->setValue('sCheckOrderFieldType', d3usermanager_requirement_orderfieldfilter::TYPE_EMPTY);
        $oManager->setValue('sOrderField_FieldValue', '');

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
    public function requirementsSelectsRightUsersFieldNotExist()
    {
        $this->expectException(d3usermanager_requirementException::class);

        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerFieldNotExist());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() === 0
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
        );
    }
}
