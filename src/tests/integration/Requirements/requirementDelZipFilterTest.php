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

class requirementDelZipFilterTest extends d3RequirementIntegrationTestCase
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
        'addressAssignIdNo5',
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
            'oxaddress',
            $this->aAddressIdList[0],
            array(
                'oxuserid'    => $this->aUserIdList[0],
                'oxzip'       => '09381'
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
                'oxzip'       => '09382'
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
                'oxuserid'    => $this->aUserIdList[2],
                'oxzip'       => '09384'
            )
        );

        $this->createUser(
            $this->aUserIdList[3],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createBaseModelObject(
            'oxaddress',
            $this->aAddressIdList[4],
            array(
                'oxuserid'    => $this->aUserIdList[3],
                'oxzip'       => '09385'
            )
        );
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
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckDelZipRange_status', true);
        $oManager->setValue('sDelZipRangeFromValue', '09382');
        $oManager->setValue('sDelZipRangeToValue', '09384');

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
    public function requirementsSelectsRightUsers()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManager());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertTrue(
            $oUserList->count() >= 2
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
            && false == $oUserList->offsetExists( $this->aUserIdList[3])
        );
    }
}
