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
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\ListModel;

class actionDeleteUserTest extends d3ActionIntegrationTestCase
{
    public $sManagerId = 'managerTestId';

    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
    );

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager($this->sManagerId);

        $this->createUser($this->aUserIdList[0]);
        $this->createUser($this->aUserIdList[1]);
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
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCustDelete_status', true);
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
     * @throws DBALException
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

        $sSelect = "SELECT count(*) FROM oxuser WHERE oxid IN ('{$this->aUserIdList[0]}')";
        $this->assertSame(
            0,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );

        $sSelect = "SELECT count(*) FROM oxuser WHERE oxid IN ('{$this->aUserIdList[1]}')";
        $this->assertSame(
            1,
            (int) DatabaseProvider::getDb()->getOne($sSelect)
        );

    }
}
