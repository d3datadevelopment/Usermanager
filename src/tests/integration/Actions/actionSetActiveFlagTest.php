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
namespace D3\Usermanager\tests\integration\Actions;

use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Model\d3usermanager;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\ListModel;

class actionSetActiveFlagTest extends d3ActionIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
        'userTestIdNo3',
        'userTestIdNo4',
    );

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager($this->sManagerId);

        $this->createUser(
            $this->aUserIdList[0],
            array(
                'oxactive'   => '0'
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxactive'   => '1'
            )
        );

        $this->createUser(
            $this->aUserIdList[2],
            array(
                'oxactive'   => '0',
                'oxcompany'  => __METHOD__
            )
        );

        $this->createUser(
            $this->aUserIdList[3],
            array(
                'oxactive'   => '1',
                'oxcompany'  => __METHOD__
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
        $this->deleteUser($this->aUserIdList[0]);
        $this->deleteUser($this->aUserIdList[1]);
        $this->deleteUser($this->aUserIdList[2]);
        $this->deleteUser($this->aUserIdList[3]);
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerSetActive()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCustActivate_status', true);
        $oManager->setValue('sActionCustActivateType', 'set');
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerUnsetActive()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCustActivate_status', true);
        $oManager->setValue('sActionCustActivateType', 'notset');
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return ListModel
     * @throws Exception
     */
    public function getFilledResultList()
    {
        return $this->getResultList([$this->aUserIdList[0], $this->aUserIdList[1]]);
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
    public function actionChangeConcernedUserSetActive()
    {
        $oExecute = $this->getExecuteMock($this->getConfiguredManagerSetActive());
        $oExecute->startJobItemExecution();

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[0]);
        $this->assertSame(
            '1',
            $oUser->getFieldData('oxactive')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[1]);
        $this->assertSame(
            '1',
            $oUser->getFieldData('oxactive')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[2]);
        $this->assertSame(
            '0',
            $oUser->getFieldData('oxactive')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[3]);
        $this->assertSame(
            '1',
            $oUser->getFieldData('oxactive')
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
    public function actionChangeConcernedUserUnsetActive()
    {
        $oExecute = $this->getExecuteMock($this->getConfiguredManagerUnsetActive());
        $oExecute->startJobItemExecution();

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[0]);
        $this->assertSame(
            '0',
            $oUser->getFieldData('oxactive')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[1]);
        $this->assertSame(
            '0',
            $oUser->getFieldData('oxactive')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[2]);
        $this->assertSame(
            '0',
            $oUser->getFieldData('oxactive')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[3]);
        $this->assertSame(
            '1',
            $oUser->getFieldData('oxactive')
        );
    }
}
