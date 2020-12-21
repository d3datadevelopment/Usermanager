<?php

namespace D3\Usermanager\tests\integration;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Controller\d3usermanager_response as ResponseController;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\User as Item;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class executeCronTest extends d3IntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
    );

    public $dCurrentValue = '1';
    public $dExpectedValue = '0';

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager($this->sManagerId);

        $this->createUser(
            $this->aUserIdList[0],
            array(
                'oxactive'  => $this->dCurrentValue,
                'oxzip'     => '09381',
                'oxcompany' => __CLASS__,
                'oxshopid'  => '1'
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxactive'  => $this->dCurrentValue,
                'oxzip'     => '09382',
                'oxcompany' => __CLASS__,
                'oxshopid'  => '1'
            )
        );

        $oManager = $this->getManagerMock($this->sManagerId);
        $oManager->assign(
            array(
                'D3_CRONJOBID'    => 'testId'
            )
        );

        $oManager->setValue('blActionCustActivate_status', true);
        $oManager->setValue('sActionCustActivateType', 'notset');

        $oManager->setValue('blCheckInvZipRange_status', true);
        $oManager->setValue('sInvZipRangeFromValue', '09381');
        $oManager->setValue('sInvZipRangeToValue', '09381');

        $oManager->setValue('blItemExecute', true);

        $oManager->save();
    }

    /**
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);
        $this->deleteUser( $this->aUserIdList[0]);
        $this->deleteUser( $this->aUserIdList[1]);
    }

    /**
     * @return Manager
     * @throws Exception
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCustActivate_status', true);
        $oManager->setValue('sActionCustActivateType', 'notset');

        $oManager->setValue('blCheckInvZipRange_status', true);
        $oManager->setValue('sInvZipRangeFromValue', '09381');
        $oManager->setValue('sInvZipRangeToValue', '09381');

        $oManager->setValue('blItemExecute', true);

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
    public function runCronOk()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');
        $set->setValue('blCronActive', true);
        $set->assign(array('oxactive' => 1));
        $set->saveNoLicenseRefresh();

        /** @var $oResponse ResponseController */
        $oResponse = d3GetModCfgDIC()->get(ResponseController::class);

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';

        $oResponse->init();

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign(array('oxactive' => 1));
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $this->assertSame(
            $this->dExpectedValue,
            $oItem->getFieldData('oxactive')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[1]);
        $this->assertSame(
            $this->dCurrentValue,
            $oItem->getFieldData('oxactive')
        );
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
    public function runCronInactiveModule()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');

        $set->setValue('blCronActive', true);
        $set->assign(array('oxactive' => 0));
        $set->saveNoLicenseRefresh();

        /** @var $oResponse ResponseController */
        $oResponse = d3GetModCfgDIC()->get(ResponseController::class);

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';

        ob_start();
        $oResponse->init();
        ob_end_clean();

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign(array('oxactive' => 1));
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $this->assertSame(
            $this->dCurrentValue,
            $oItem->getFieldData('oxactive')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[1]);
        $this->assertSame(
            $this->dCurrentValue,
            $oItem->getFieldData('oxactive')
        );
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
    public function runDisabledCron()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');
        $set->setValue('blCronActive', false);
        $set->assign(array('oxactive' => 1));
        $set->saveNoLicenseRefresh();

        /** @var $oResponse ResponseController */
        $oResponse = d3GetModCfgDIC()->get(ResponseController::class);

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';

        $oResponse->init();

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign(array('oxactive' => 1));
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $this->assertSame(
            $this->dCurrentValue,
            $oItem->getFieldData('oxactive')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[1]);
        $this->assertSame(
            $this->dCurrentValue,
            $oItem->getFieldData('oxactive')
        );
    }
}