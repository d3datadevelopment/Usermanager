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

class requirementVouchernumberTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3'
    );
    public $aOrderIdList = array(
        'OrderIdNo1',
        'OrderIdNo2'
    );
    public $aVoucherIdList = array(
        'voucherIdNo1',
        'voucherIdNo2'
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
            $this->aUserIdList[0],
            array(
                'oxcompany' => __CLASS__,
            )
        );

        $this->createOrder(
            $this->aOrderIdList[0],
            array(
                'oxuserid'  => $this->aUserIdList[0]
            )
        );

        $this->createBaseModelObject(
            'oxvouchers',
            $this->aVoucherIdList[0],
            array(
                'oxorderid'   => $this->aOrderIdList[0],
                'oxuserid'    => $this->aUserIdList[0],
                'oxvoucherserieid'     => __CLASS__,
                'oxvouchernr'   => 'testVoucherNr'
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
                'oxuserid'  => $this->aUserIdList[1]
            )
        );

        $this->createBaseModelObject(
            'oxvouchers',
            $this->aVoucherIdList[1],
            array(
                'oxorderid'   => $this->aOrderIdList[1],
                'oxuserid'    => $this->aUserIdList[1],
                'oxvoucherserieid'     => __CLASS__,
                'oxvouchernr'   => 'testfailVoucherNr'
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__,
            )
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

        foreach ($this->aVoucherIdList as $sVoucherId) {
            $this->deleteBaseModelObject('oxvouchers', $sVoucherId);
        }
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blVoucherNumber_status', true);
        $oManager->setValue('sVoucherNumberValue', 'testVoucherNr');

        return $oManager;
    }

    /**
     * @test
     * @coversNothing
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
        $oListGenerator = $this->getListGenerator($this->getConfiguredManager());
        $oUserList = $oListGenerator->getConcernedItems();

        $this->assertGreaterThanOrEqual(1, $oUserList->count());
        $this->assertTrue($oUserList->offsetExists( $this->aUserIdList[0]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[1]));
        $this->assertFalse($oUserList->offsetExists( $this->aUserIdList[2]));
    }
}
