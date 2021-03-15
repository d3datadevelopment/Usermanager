<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          https://www.oxidmodule.com
 */

namespace D3\Usermanager\tests\integration\Admin;

use D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Modules\Application\Model\d3_order_usermanager;
use D3\Usermanager\Modules\Application\Model\d3_user_usermanager;
use D3\Usermanager\tests\integration\d3IntegrationTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\User as Item;
use OxidEsales\Eshop\Core\Registry;
use ReflectionException;

class jobExecuteTest extends d3IntegrationTestCase
{
    /** @var d3_usermanager_jobs */
    public $_oController;
    public $sManagerId = 'managerTestId';
    public $aArticleIdList = array(
        'articleTestIdNo1'
    );
    public $aCountryIdList = [
        'testCountryId1Pass'
    ];
    public $aUserIdList = array(
        'userTestIdNo1'
    );

    public $sCurrentValue = 'current';
    public $sExpectedValue = 'expected';

    public function setUp()
    {
        parent::setUp();

        $this->_oController = oxNew(d3_usermanager_jobs::class);
    }

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
            [
                'oxactive'      => 1,
                'oxcountryid'   => $this->aCountryIdList[0],
                'oxfname'       => __CLASS__,
                'oxlname'       => $this->sCurrentValue,
            ]
        );

        $this->getConfiguredManager()->save();
    }

    /**
     * @throws DBALException
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);

        foreach ($this->aCountryIdList as $sId) {
            $this->deleteBaseModelObject( 'oxcountry', $sId);
        }

        $this->deleteUser($this->aUserIdList[0]);
    }

    /**
     * @return Manager
     * @throws Exception
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->assign(
            [
                'D3_CRONJOBID'    => 'testId'
            ]
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
     *
     * @param $methodname
     *
     * @throws ReflectionException
     * @dataProvider execMethodDataProvider
     */
    public function testExecUsermanagerOk($methodname)
    {
        $_GET['usermanagerid'] = $this->sManagerId;
        $_GET['oxid'] = $this->aUserIdList[0];

        // prevent trigger action in test preparation
        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, true);
        Registry::getSession()->setVariable(d3_order_usermanager::PREVENTION_FINALIZEORDER, true);

        $this->callMethod(
            $this->_oController,
            $methodname
        );

        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, false);
        Registry::getSession()->setVariable(d3_order_usermanager::PREVENTION_FINALIZEORDER, false);

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sExpectedValue,
            $oItem->getFieldData('oxlname')
        );
    }

    /**
     * @test
     *
     * @param $methodname
     *
     * @throws ReflectionException
     * @dataProvider execMethodDataProvider
     */
    public function testExecUsermanagerInvalidRequirementConfigUnchecked($methodname)
    {
        $_GET['usermanagerid'] = $this->sManagerId;
        $_GET['oxid'] = $this->aUserIdList[0];

        $manager = $this->getConfiguredManager();
        $manager->setValue( 'aInvCountryId', [ 'notExistingCountryId' ] );
        $manager->setValue( 'sManuallyExecMeetCondition', false );
        $manager->save();

        // prevent trigger action in test preparation
        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, true);
        Registry::getSession()->setVariable(d3_order_usermanager::PREVENTION_FINALIZEORDER, true);

        $this->callMethod(
            $this->_oController,
            $methodname
        );

        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, false);
        Registry::getSession()->setVariable(d3_order_usermanager::PREVENTION_FINALIZEORDER, false);

        $this->getConfiguredManager()->save();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sExpectedValue,
            $oItem->getFieldData('oxlname')
        );
    }

    /**
     * @test
     *
     * @param $methodname
     *
     * @throws ReflectionException
     * @dataProvider execMethodDataProvider
     */
    public function testExecUsermanagerInvalidRequirementConfigChecked($methodname)
    {
        $_GET['usermanagerid'] = $this->sManagerId;
        $_GET['oxid'] = $this->aUserIdList[0];

        $manager = $this->getConfiguredManager();
        $manager->setValue( 'aInvCountryId', [ 'notExistingCountryId' ] );
        $manager->setValue( 'sManuallyExecMeetCondition', true );
        $manager->save();

        $this->callMethod(
            $this->_oController,
            $methodname
        );

        $this->getConfiguredManager()->save();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );
    }

    /**
     * @test
     *
     * @param $methodname
     *
     * @throws ReflectionException
     * @dataProvider execMethodDataProvider
     */
    public function testExecUsermanagerInvalidActionConfig($methodname)
    {
        $_GET['usermanagerid'] = $this->sManagerId;
        $_GET['oxid'] = $this->aUserIdList[0];

        $manager = $this->getConfiguredManager();
        $manager->setValue('sActionAddField_field', 'invalidFieldName');
        $manager->save();

        $this->callMethod(
            $this->_oController,
            $methodname
        );

        $this->getConfiguredManager()->save();

        /** @var Item $oItem */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);
        $oItem->load($this->aUserIdList[0]);
        $this->assertSame(
            $this->sCurrentValue,
            $oItem->getFieldData('oxlname')
        );
    }

    /**
     * @return string[][]
     */
    public function execMethodDataProvider()
    {
        return [
            'instantExecute'        => ['d3execusermanager'],
            'changedContentExecute' => ['d3ExecChangedusermanager']
        ];
    }

    /**
     * @test
     * @throws ReflectionException
     */
    public function testExecChangedContentsOk()
    {
        $_GET['usermanagerid'] = $this->sManagerId;
        $_GET['oxid'] = $this->aUserIdList[0];

        $this->callMethod(
            $this->_oController,
            'execChangedContents'
        );

        $this->assertInternalType(
            'array',
            $this->callMethod(
                $this->_oController,
                'getViewDataElement',
                ['aMailContent']
            )
        );
    }

    /**
     * @test
     * @throws ReflectionException
     */
    public function testExecChangedContentsInvalidRequirementConfigUnchecked()
    {
        $_GET['usermanagerid'] = $this->sManagerId;
        $_GET['oxid'] = $this->aUserIdList[0];

        $manager = $this->getConfiguredManager();
        $manager->setValue( 'aInvCountryId', [ 'notExistingCountryId' ] );
        $manager->setValue( 'sManuallyExecMeetCondition', false );
        $manager->save();

        $this->callMethod(
            $this->_oController,
            'execChangedContents'
        );

        $this->getConfiguredManager()->save();

        $this->assertInternalType(
            'array',
            $this->callMethod(
                $this->_oController,
                'getViewDataElement',
                ['aMailContent']
            )
        );
    }

    /**
     * @test
     * @throws ReflectionException
     */
    public function testExecChangedContentsInvalidRequirementConfigChecked()
    {
        $_GET['usermanagerid'] = $this->sManagerId;
        $_GET['oxid'] = $this->aUserIdList[0];

        $manager = $this->getConfiguredManager();
        $manager->setValue( 'aInvCountryId', [ 'notExistingCountryId' ] );
        $manager->setValue( 'sManuallyExecMeetCondition', true );
        $manager->save();

        $this->callMethod(
            $this->_oController,
            'execChangedContents'
        );

        $this->getConfiguredManager()->save();

        $this->assertNull(
            $this->callMethod(
                $this->_oController,
                'getViewDataElement',
                ['aMailContent']
            )
        );
    }

    /**
     * @test
     * @throws ReflectionException
     */
    public function testExecChangedContentsInvalidActionConfig()
    {
        $_GET['usermanagerid'] = $this->sManagerId;
        $_GET['oxid'] = $this->aUserIdList[0];

        $manager = $this->getConfiguredManager();
        $manager->setValue('sActionAddField_field', 'invalidFieldName');
        $manager->save();

        $this->callMethod(
            $this->_oController,
            'execChangedContents'
        );

        $this->getConfiguredManager()->save();

        $this->assertNull(
            $this->callMethod(
                $this->_oController,
                'getViewDataElement',
                ['aMailContent']
            )
        );
    }
}
