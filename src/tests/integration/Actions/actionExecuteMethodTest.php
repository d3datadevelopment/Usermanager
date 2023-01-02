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
use Doctrine\DBAL\Exception as DoctrineException;
use Exception;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\ListModel;

class actionExecuteMethodTest extends d3ActionIntegrationTestCase
{
    public $sManagerId = 'managerTestId';

    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
    );

    public $given    = 'CurrentCity';
    public $expected = 'TestCity';

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager($this->sManagerId);

        $this->createUser(
            $this->aUserIdList[0],
            [
                'oxcity'   => $this->given
            ]
        );

        $this->createUser(
            $this->aUserIdList[1],
            [
                'oxcity'   => $this->given
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
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionUserExecuteMethod_status', true);
        $oManager->setValue('sActionExecuteMethod_name', 'd3usermanagerTestMethod');
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
    public function actionChangeConcernedUser()
    {
        $oExecute = $this->getExecuteMock($this->getConfiguredManager());
        $oExecute->startJobItemExecution();

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[0]);
        $this->assertEquals(
            $this->expected,
            $oUser->getFieldData('oxcity')
        );

        /** @var User $oUser */
        $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
        $oUser->load($this->aUserIdList[1]);
        $this->assertEquals(
            $this->given,
            $oUser->getFieldData('oxcity')
        );
    }
}
