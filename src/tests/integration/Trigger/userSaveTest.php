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

namespace D3\Usermanager\tests\integration;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3NullLogger;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use Exception;
use OxidEsales\Eshop\Application\Model\User as Item;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use PHPUnit\Framework\MockObject\MockObject;

class userSaveTest extends d3IntegrationTestCase
{
    public $sManagerId = 'managerTestId';
    public $aCountryIdList = [
        'testCountryId1Pass'
    ];
    public $aUserIdList = array(
        'userTestIdNo1'
    );

    public $sCurrentValue = 'current';
    public $sExpectedValue = 'expected';

    /**
     * @throws Exception
     */
    public function createTestData()
    {
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

        $this->getConfiguredManager()->save();
    }

    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);

        foreach ($this->aCountryIdList as $sId) {
            $this->deleteBaseModelObject( 'oxcountry', $sId);
        }

        $this->deleteUser( $this->aUserIdList[0]);
    }

    /**
     * @return Manager
     * @throws Exception
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->assign(
            array(
                'D3_CRONJOBID'              => 'testId',
                'd3_um_usersavetriggered'  => '1'
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
    public function runTriggerOk()
    {
        $set = d3_cfg_mod::get('d3usermanager');
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $oItem->save();

        // require reload
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $this->assertSame(
            $this->sExpectedValue,
            (string) $oItem->getFieldData('oxlname')
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
    public function runTriggerCanceledInvalidRequirementConfig()
    {
        d3GetModCfgDIC()->set('d3ox.usermanager.Logger', d3GetModCfgDIC()->get(d3NullLogger::class));

        $set = d3_cfg_mod::get('d3usermanager');
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        $manager = $this->getConfiguredManager();
        $manager->setValue( 'aInvCountryId', [ 'notExistingCountryId' ] );
        $manager->save();

        /** @var d3usermanagerlist|MockObject $usermanagerlistmock */
        $usermanagerlistmock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetUserSaveTriggeredManagerTasks'])
            ->getMock();
        $usermanagerlistmock->offsetSet($manager->getId(), $manager);
        $usermanagerlistmock->method('d3GetUserSaveTriggeredManagerTasks')->willReturnSelf();


        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $oItem->save();

        $this->getConfiguredManager()->save();

        // require reload
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            (string) $oItem->getFieldData('oxlname')
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
    public function runTriggerCanceledInvalidActionConfig()
    {
        d3GetModCfgDIC()->set('d3ox.usermanager.Logger', d3GetModCfgDIC()->get(d3NullLogger::class));

        $manager = $this->getConfiguredManager();
        $manager->setValue('sActionAddField_field', 'invalidFieldName');

        $definitions = d3GetModCfgDIC()->getDefinitions();

        /** @var d3usermanagerlist|MockObject $usermanagerlistmock */
        $usermanagerlistmock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetUserSaveTriggeredManagerTasks'])
            ->getMock();
        $usermanagerlistmock->offsetSet($manager->getId(), $manager);
        $usermanagerlistmock->method('d3GetUserSaveTriggeredManagerTasks')->willReturnSelf();

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $usermanagerlistmock);

        $set = d3_cfg_mod::get('d3usermanager');
        $set->assign( [ 'oxactive' => 1 ] );
        $set->saveNoLicenseRefresh();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $oItem->save();

        d3GetModCfgDIC()->reset();
        d3GetModCfgDIC()->setDefinitions($definitions);

        $this->getConfiguredManager()->save();

        // require reload
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            (string) $oItem->getFieldData('oxlname')
        );
    }

    /**
     * @test
     * @throws Exception
     */
    public function runDisabledTrigger()
    {
        $manager = $this->getConfiguredManager();
        $manager->assign(['d3_um_usersavetriggered'  => '0']);
        $manager->save();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $oItem->save();

        // require reload
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load( $this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            (string) $oItem->getFieldData('oxlname')
        );
    }
}
