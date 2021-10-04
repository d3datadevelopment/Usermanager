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
use Doctrine\DBAL\Exception as DoctrineException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class requirementBirthdateFromTest extends d3RequirementIntegrationTestCase
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
     * @throws DoctrineException
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
                'oxcompany'     => __CLASS__,
                'oxbirthdate'   => '1979-01-01'
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxcompany' => __CLASS__,
                'oxbirthdate'   => '1980-05-11'
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__,
                'oxbirthdate'   => '1980-05-12'
            )
        );

        $this->createUser(
            $this->aUserIdList[3],
            array(
                'oxcompany' => __CLASS__,
                'oxbirthdate'   => '1980-05-13'
            )
        );

        $this->createUser(
            $this->aUserIdList[4],
            array(
                'oxcompany' => __CLASS__,
                'oxbirthdate'   => '1981-01-01'
            )
        );

        $this->createUser(
            $this->aUserIdList[5],
            array(
                'oxcompany' => __CLASS__,
                'oxbirthdate'   => '0000-00-00'
            )
        );
    }

    /**
     * @throws DoctrineException
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);

        foreach ($this->aUserIdList as $sUserId) {
            $this->deleteUser($sUserId);
        }
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckBirthdateUserFrom_status', true);
        $oManager->setValue('sBirthdateUserFromValue', '12.05.1980');

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
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
            && $oUserList->offsetExists( $this->aUserIdList[3])
            && $oUserList->offsetExists( $this->aUserIdList[4])
            && false == $oUserList->offsetExists( $this->aUserIdList[5])
        );
    }
}
