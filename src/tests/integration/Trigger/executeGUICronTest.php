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

namespace D3\Usermanager\tests\integration\Trigger;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3NullLogger;
use D3\Usermanager\Application\Controller\d3usermanager_response as ResponseController;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\tests\integration\d3IntegrationTestCase;
use Doctrine\DBAL\Exception as DoctrineException;
use Exception;
use OxidEsales\Eshop\Application\Model\User as Item;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use ReflectionException;

class executeGUICronTest extends d3IntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aCountryIdList = [
        'testCountryId1Pass',
        'testCountryId2Pass'
    ];
    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2'
    );

    public $sCurrentValue = 'current';
    public $sExpectedValue = 'expected';

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $this->createManager($this->sManagerId);

        foreach ($this->aCountryIdList as $sId) {
            $this->createBaseModelObject( 'oxcountry', $sId, [ 'oxtitle' => __METHOD__ ] );
        }

        $this->createUser(
            $this->aUserIdList[0],
            array(
                'oxactive'     => 1,
                'oxcountryid'   => $this->aCountryIdList[0],
                'oxfname' => __CLASS__,
                'oxlname' => $this->sCurrentValue,
            )
        );

        $this->createUser(
            $this->aUserIdList[1],
            array(
                'oxactive'     => 1,
                'oxcountryid'   => $this->aCountryIdList[1],
                'oxfname' => __CLASS__,
                'oxlname' => $this->sCurrentValue,
            )
        );

        $this->getConfiguredManager()->save();
    }

    /**
     * @throws DoctrineException
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);

        foreach ($this->aCountryIdList as $sId) {
            $this->deleteBaseModelObject( 'oxcountry', $sId);
        }

        $this->deleteUser($this->aUserIdList[0]);
        $this->deleteUser($this->aUserIdList[1]);
    }

    /**
     * @return Manager
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->assign(
            array(
                'D3_CRONJOBID'    => 'testId'
            )
        );
        $oManager->setValue('blActionUserAddFieldValue_status', true);
        $oManager->setValue('sActionAddField_field', 'oxlname');
        $oManager->setValue('sActionAddField_value', $this->sExpectedValue);

        $oManager->setValue('blCheckInvCountry_status', true);
        $oManager->setValue( 'aInvCountryId', [ $this->aCountryIdList[0] ] );

        $oManager->setValue('blItemExecute', true);

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
    public function runCronOk()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');
        $set->setValue('blCronActive', true);
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';
        $_GET['key'] = $set->getValue('sCronPassword');

        $this->setCLIArguments(['script', '-q', 'run', 1, 'testId']);

        ob_start();
        /** @var ResponseController $cron */
        $cron = oxNew(ResponseController::class);
        $cron->init();
        ob_end_clean();

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sExpectedValue,
            $oItem->getFieldData('oxlname')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[1]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );
    }

    /**
     * @test
     *
     * @param $password
     *
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DoctrineException
     * @throws StandardException
     * @throws ReflectionException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @dataProvider runCronCanceledWrongPasswordConfigDataProvider
     */
    public function runCronCanceledWrongPasswordConfig($password)
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');
        $set->setValue('blCronActive', true);
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';
        $_GET['key'] = $password;

        $this->setCLIArguments(['script', 'run', 1, 'testId']);

        ob_start();
        /** @var ResponseController $cron */
        $cron = oxNew(ResponseController::class);
        $cron->init();
        $msg = ob_get_clean();

        $this->getConfiguredManager()->save();

        $this->assertRegExp(
            '@WRONGPASSWORD@',
            $msg
        );

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[1]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );
    }

    /**
     * @return string[][]
     */
    public function runCronCanceledWrongPasswordConfigDataProvider()
    {
        return [
            'unset password' => [''],
            'wrong password' => ['wrongpassword']
        ];
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
    public function runCronCanceledInvalidRequirementConfig()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');
        $set->setValue('blCronActive', true);
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        $manager = $this->getConfiguredManager();
        $manager->setValue( 'aInvCountryId', [ 'notExistingCountryId' ] );
        $manager->save();

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';
        $_GET['key'] = $set->getValue('sCronPassword');

        $this->setCLIArguments(['script', 'run', 1, 'testId']);
        Registry::set('logger', oxNew(d3NullLogger::class));

        ob_start();
        /** @var ResponseController $cron */
        $cron = oxNew(ResponseController::class);
        $cron->init();
        $msg = ob_get_clean();

        $this->getConfiguredManager()->save();

        $this->assertTrue(
            (bool) strlen(trim($msg))
        );

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[1]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
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
    public function runCronCanceledInvalidActionConfig()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');
        $set->setValue('blCronActive', true);
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        $manager = $this->getConfiguredManager();
        $manager->setValue('sActionAddField_field', 'invalid');
        $manager->save();

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';
        $_GET['key'] = $set->getValue('sCronPassword');

        $this->setCLIArguments(['script', 'run', 1, 'testId']);
        Registry::set('logger', oxNew(d3NullLogger::class));

        ob_start();
        /** @var ResponseController $cron */
        $cron = oxNew(ResponseController::class);
        $cron->init();
        $msg = ob_get_clean();

        $this->getConfiguredManager()->save();

        $this->assertTrue(
            (bool) strlen(trim($msg))
        );

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[1]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
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
    public function runCronInactiveModule()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');

        $set->setValue('blCronActive', true);
        $set->assign(array('oxactive' => 0));
        $set->saveNoLicenseRefresh();

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';
        $_GET['key'] = $set->getValue('sCronPassword');

        $this->setCLIArguments(['script', 'run', 1, 'testId']);

        ob_start();
        /** @var ResponseController $cron */
        $cron = oxNew(ResponseController::class);
        $cron->init();
        $msg = ob_get_clean();

        $this->assertRegExp(
            '@.*MODULEDISABLED.*@',
            $msg
        );

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign(array('oxactive' => 1));
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[1]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
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
    public function runDisabledCron()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $blCurrentCronStatus = $set->getValue('blCronActive');
        $set->setValue('blCronActive', false);
        $set->assign(array('oxactive' => 1));
        $set->saveNoLicenseRefresh();

        $_GET['shp'] = 1;
        $_GET['cjid'] = 'testId';
        $_GET['key'] = $set->getValue('sCronPassword');

        $this->setCLIArguments(['script', 'run', 1, 'testId']);

        ob_start();
        /** @var ResponseController $cron */
        $cron = oxNew(ResponseController::class);
        $cron->init();
        $msg = ob_get_clean();

        $this->assertRegExp(
            '@.*UNAVAILABLE.*@',
            $msg
        );

        $set->setValue('blCronActive', $blCurrentCronStatus);
        $set->assign(array('oxactive' => 1));
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[1]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );
    }

    /**
     * @param array $arguments
     */
    public function setCLIArguments($arguments)
    {
        global $argv;
        $argv = $_SERVER['argv'] = $GLOBALS['HTTP_SERVER_VARS']['argv'] = $arguments;
    }
}
