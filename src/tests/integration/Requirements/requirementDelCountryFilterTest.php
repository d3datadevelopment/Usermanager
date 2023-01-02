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

class requirementDelCountryFilterTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
        'userTestIdNo4',
    );
    public $aAddressIdList = array(
        'addressAssignIdNo1',
        'addressAssignIdNo2',
        'addressAssignIdNo3',
        'addressAssignIdNo4',
    );
    public $aCountryIdList = [
        'testCountry1',
        'testCountry2'
    ];

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
            'oxaddress',
            $this->aAddressIdList[0],
            array(
                'oxuserid'    => $this->aUserIdList[0],
                'oxcountryid'   => 'testCountry1'
            )
        );

        $this->createBaseModelObject(
            'oxaddress',
            $this->aAddressIdList[1],
            array(
                'oxuserid'    => $this->aUserIdList[0],
                'oxcountryid'   => 'testCountry2'
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxaddress',
            $this->aAddressIdList[2],
            array(
                'oxuserid'    => $this->aUserIdList[1],
                'oxcountryid'   => 'testCountry1'
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxaddress',
            $this->aAddressIdList[3],
            array(
                'oxuserid'    => $this->aUserIdList[2]
            )
        );

        $this->createUser(
            $this->aUserIdList[3],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        foreach ($this->aCountryIdList as $sId) {
            $this->createBaseModelObject('oxcountry', $sId);
        }
    }

    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);

        foreach ($this->aUserIdList as $sUserId) {
            $this->deleteUser($sUserId);
        }

        foreach ($this->aAddressIdList as $sAddressAssignId) {
            $this->deleteBaseModelObject('oxaddress', $sAddressAssignId);
        }

        foreach ($this->aCountryIdList as $sId) {
            $this->deleteBaseModelObject('oxcountry', $sId);
        }
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerSingle()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckDelCountry_status', true);
        $oManager->setValue('aDelCountryId', ['testCountry1']);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerMulti()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckDelCountry_status', true);
        $oManager->setValue('aDelCountryId', ['testCountry1', 'testCountry2']);

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
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
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
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerMulti());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
        );
    }
}
