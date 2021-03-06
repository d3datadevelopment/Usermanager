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

class requirementValidNewsletterMailTest extends d3RequirementIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3'
    );
    public $aNewsSubscribedIdList = array(
        'newsletterIdNo1',
        'newsletterIdNo2',
        'newsletterIdNo3'
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
                'oxcompany' => __CLASS__
            )
        );

        $this->createBaseModelObject(
            'oxnewssubscribed',
            $this->aNewsSubscribedIdList[0],
            array(
                'oxuserid'    => $this->aUserIdList[0],
                'oxdboptin'   => '1',
                'oxemailfailed' => '0',
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxcompany' => __CLASS__,
                'oxemailfailed' => '1',
            )
        );

        $this->createBaseModelObject(
            'oxnewssubscribed',
            $this->aNewsSubscribedIdList[1],
            array(
                'oxuserid'    => $this->aUserIdList[1],
                'oxdboptin'   => '1',
                'oxemailfailed' => '1',
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxcompany' => __CLASS__
            )
        );

        $this->createBaseModelObject(
            'oxnewssubscribed',
            $this->aNewsSubscribedIdList[2],
            array(
                'oxuserid'    => $this->aUserIdList[2],
                'oxdboptin'   => '1'
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

        foreach ($this->aNewsSubscribedIdList as $sNewsletterId) {
            $this->deleteBaseModelObject('oxnewssubscribed', $sNewsletterId);
        }
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerValid()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckValidMail_status', true);
        $oManager->setValue('sCheckValidMailType', 'valid');

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagernotvalid()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blCheckValidMail_status', true);
        $oManager->setValue('sCheckValidMailType', 'notvalid');

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
    public function requirementsSelectsRightUsersValid()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagerValid());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 2
            && $oUserList->offsetExists( $this->aUserIdList[0])
            && false == $oUserList->offsetExists( $this->aUserIdList[1])
            && $oUserList->offsetExists( $this->aUserIdList[2])
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
    public function requirementsSelectsRightUsersNotValid()
    {
        $oListGenerator = $this->getListGenerator($this->getConfiguredManagernotvalid());
        $oUserList = $oListGenerator->getConcernedUsers();

        $this->assertTrue(
            $oUserList->count() >= 1
            && false == $oUserList->offsetExists( $this->aUserIdList[0])
            && $oUserList->offsetExists( $this->aUserIdList[1])
            && false == $oUserList->offsetExists( $this->aUserIdList[2])
        );
    }
}
