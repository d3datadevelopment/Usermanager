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
use D3\ModCfg\Application\Model\Log\d3NullLogger;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Modules\Application\Model\d3_user_usermanager;
use Doctrine\DBAL\Exception as DoctrineException;
use Exception;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\ListModel;
use OxidEsales\Eshop\Core\Registry;

class actionSetFieldValueTest extends d3ActionIntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
    );

    public $sCurrentValue = 'CurrentCity';
    public $sExpectedValue = 'TestCity';

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager($this->sManagerId);

        $this->createUser(
            $this->aUserIdList[0],
            [
                'oxcity'   => $this->sCurrentValue
            ]
        );

        $this->createUser(
            $this->aUserIdList[1],
            [
                'oxcity'   => $this->sCurrentValue
            ]
        );
    }

    /**
     * @throws DoctrineException
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);
        $this->deleteUser($this->aUserIdList[0]);
        $this->deleteUser($this->aUserIdList[1]);
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerExistingSingleLangField()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionUserAddFieldValue_status', true);
        $oManager->setValue('sActionAddField_field', 'oxcity');
        $oManager->setValue('sActionAddField_value', $this->sExpectedValue);
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerNotExistingSingleLangField()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionUserAddFieldValue_status', true);
        $oManager->setValue('sActionAddField_field', 'd3TestField');
        $oManager->setValue('sActionAddField_value', $this->sExpectedValue);
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManagerNotExistingMultiLangField()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionUserAddFieldValue_status', true);
        $oManager->setValue('sActionAddField_field', 'd3TestField_1');
        $oManager->setValue('sActionAddField_value', $this->sExpectedValue);
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return ListModel
     * @throws Exception
     */
    public function getFilledResultList()
    {
        return $this->getResultList(array($this->aUserIdList[0]));
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
    public function actionChangeConcernedUserExistingSingleLangField()
    {
        // prevent save trigger action in test
        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, true);

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerExistingSingleLangField());
        $oExecute->startJobItemExecution();

        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, false);

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sExpectedValue,
            $oUser->getFieldData('oxcity')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[1]);
        $this->assertSame(
            $this->sCurrentValue,
            $oUser->getFieldData('oxcity')
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
    public function actionChangeConcernedUserNotExistingSingleLangField()
    {
        d3GetModCfgDIC()->set('d3ox.usermanager.Logger', d3GetModCfgDIC()->get(d3NullLogger::class));

        // prevent save trigger action in test
        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, true);

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerNotExistingSingleLangField());
        $oExecute->startJobItemExecution();

        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, false);

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[0]);
        $this->assertNull(
            $oUser->getFieldData('d3TestField')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[1]);
        $this->assertNull(
            $oUser->getFieldData('d3TestField')
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
    public function actionChangeConcernedUserNotExistingMultiLangField()
    {
        d3GetModCfgDIC()->set('d3ox.usermanager.Logger', d3GetModCfgDIC()->get(d3NullLogger::class));

        // prevent save trigger action in test
        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, true);

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerNotExistingMultiLangField());
        $oExecute->startJobItemExecution();

        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, false);

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[0]);
        $this->assertNull(
            $oUser->getFieldData('d3TestField_1')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[1]);
        $this->assertNull(
            $oUser->getFieldData('d3TestField_1')
        );
    }
}
