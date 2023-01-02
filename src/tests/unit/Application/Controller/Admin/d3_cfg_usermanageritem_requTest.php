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

namespace D3\Usermanager\tests\unit\Application\Controller\Admin;

use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_conf;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirementgrouplist;
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirementlist;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Exception;
use OxidEsales\Eshop\Application\Model\CountryList;
use OxidEsales\Eshop\Application\Model\Delivery;
use OxidEsales\Eshop\Application\Model\DeliveryList;
use OxidEsales\Eshop\Application\Model\PaymentList;
use OxidEsales\Eshop\Core\Config;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;

class d3_cfg_usermanageritem_requTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_cfg_usermanageritem_requ */
    protected $_oController;

    /**
     * setup basic requirements
     * @throws Exception
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->_oController = d3GetModCfgDIC()->get(d3_cfg_usermanageritem_requ::class);

        $oSampleManager = d3GetModCfgDIC()->get(d3usermanager::class);
        $oSampleManager->setId('testId');
        $oSampleManager->save();

        $oTestDelivery = d3GetModCfgDIC()->get('d3ox.usermanager.'.Delivery::class);
        $oTestDelivery->setId('testId');
        $oTestDelivery->save();

        $aViewData = array_merge(
            $this->_oController->getViewData(),
            array('edit' => $oSampleManager)
        );

        $this->_oController->setViewData($aViewData);
    }

    /**
     * @throws Exception
     */
    public function tearDown() : void
    {
        parent::tearDown();

        unset($this->_oController);

        $oSampleManager = d3GetModCfgDIC()->get(d3usermanager::class);
        $oSampleManager->delete('testId');

        $oTestDelivery = d3GetModCfgDIC()->get('d3ox.usermanager.'.Delivery::class);
        $oTestDelivery->delete('testId');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::save
     * @test
     * @throws ReflectionException
     */
    public function canSaveNoMissingValues()
    {
        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $getValueMap = [['blCheckTrackcode_status', true]];
        $oProfileMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3_cfg_usermanageritem_requ|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_requ::class)
            ->onlyMethods(['getProfile'])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->callMethod($this->_oController, 'save');
        $this->assertNull($this->_oController->getViewDataElement('missingRequValuesActions'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::save
     * @test
     * @throws ReflectionException
     */
    public function canSaveMissingValues()
    {
        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $getValueMap = [['blCheckInGroup_status', true]];
        $oProfileMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3_cfg_usermanageritem_requ|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_requ::class)
            ->onlyMethods(['getProfile'])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->callMethod($this->_oController, 'save');
        $aMissing = $this->_oController->getViewDataElement('missingRequValuesActions');
        $this->assertIsArray($aMissing);
        $this->assertCount(1, $aMissing);
        $this->assertContains('inGroupFilter', $aMissing);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getPaymentList
     * @test
     * @throws ReflectionException
     */
    public function getPaymentListPass()
    {
        /** @var PaymentList $oList */
        $oList = $this->callMethod(
            $this->_oController,
            'getPaymentList'
        );

        $this->assertInstanceOf(
            PaymentList::class,
            $oList
        );
        $this->assertNotEmpty($oList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getDeliveryList
     * @test
     * @throws ReflectionException
     */
    public function getDeliveryListPass()
    {
        /** @var DeliveryList $oList */
        $oList = $this->callMethod(
            $this->_oController,
            'getDeliveryList'
        );

        $this->assertInstanceOf(
            DeliveryList::class,
            $oList
        );
        $this->assertNotEmpty($oList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getCountryList
     * @test
     * @throws ReflectionException
     */
    public function getCountryListPass()
    {
        /** @var CountryList $oList */
        $oList = $this->callMethod(
            $this->_oController,
            'getCountryList'
        );

        $this->assertInstanceOf(
            CountryList::class,
            $oList
        );
        $this->assertNotEmpty($oList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getJobList
     * @test
     * @throws ReflectionException
     */
    public function getUsermanagerJobListPass()
    {
        /** @var d3usermanagerlist $oList */
        $oList = $this->callMethod(
            $this->_oController,
            'getJobList'
        );

        $this->assertInstanceOf(
            d3usermanagerlist::class,
            $oList
        );
        $this->assertNotEmpty($oList, 'usermanager job list shouldn\t empty');
        $this->assertFalse($oList->offsetExists('testId'), 'current object shouldn\'t contain in job list');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getLanguageList
     * @test
     * @throws ReflectionException
     */
    public function getLanguageListPass()
    {
        /** @var array $aList */
        $aList = $this->callMethod(
            $this->_oController,
            'getLanguageList'
        );

        $this->assertIsArray($aList
        );
        $this->assertNotEmpty($aList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getTransStatusList
     * @test
     * @throws ReflectionException
     */
    public function getTransStatusListPass()
    {
        /** @var array $aTransStatusList */
        $aTransStatusList = $this->callMethod(
            $this->_oController,
            'getTransStatusList'
        );

        $this->assertIsArray($aTransStatusList);
        $this->assertNotEmpty($aTransStatusList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::addDefaultValues
     * @test
     * @throws ReflectionException
     */
    public function addDefaultValuesReturnValues()
    {
        $aValues = array(
            'key1'  => 'value1',
            'key2'  => 'value2',
        );

        $this->assertSame(
            $aValues,
            $this->callMethod(
                $this->_oController,
                'addDefaultValues',
                array($aValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getRequirementGroupList
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function getRequirementGroupListReturnsRightInstance()
    {
        $oManager = d3GetModCfgDIC()->get(d3usermanager::class);

        $this->assertInstanceOf(
            d3usermanager_requirementgrouplist::class,
            $this->callMethod(
                $this->_oController,
                'getRequirementGroupList',
                array($oManager)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getRequirementListObject
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetRequirementListObject()
    {
        $this->assertInstanceOf(
            d3usermanager_requirementlist::class,
            $this->callMethod(
                $this->_oController,
                'getRequirementListObject',
                array(d3GetModCfgDIC()->get(d3usermanager::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getRequirementList
     * @test
     * @throws ReflectionException
     */
    public function canGetRequirementList()
    {
        $aRequList = $this->callMethod($this->_oController, 'getRequirementList');
        $this->assertIsArray($aRequList
        );
        $this->assertNotEmpty($aRequList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::getGroupedRequirementList
     * @test
     * @throws ReflectionException
     */
    public function getGroupedRequirementListPass()
    {
        $mExpected = [ 'item1', 'item2' ];

        /** @var d3usermanager_conf|MockObject $oManagerConfMock */
        $oManagerConfMock = $this->getMockBuilder(d3usermanager_conf::class)
            ->onlyMethods(['getGroupedRequirementIdList'])
            ->getMock();
        $oManagerConfMock->method('getGroupedRequirementIdList')->willReturn($mExpected);

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getConfiguration'])
            ->getMock();
        $oProfileMock->method('getConfiguration')->willReturn($oManagerConfMock);

        /** @var d3usermanager_requirementgrouplist|MockObject $oRequGroupListMock */
        $oRequGroupListMock = $this->getMockBuilder(d3usermanager_requirementgrouplist::class)
            ->onlyMethods([
                'setGroups',
                'getGroupList'
            ])
            ->setConstructorArgs([$oProfileMock])
            ->getMock();
        $oRequGroupListMock->method('setGroups')->willReturn(true);
        $oRequGroupListMock->method('getGroupList')->willReturn($mExpected);

        /** @var d3_cfg_usermanageritem_requ|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_requ::class)
            ->onlyMethods([
                'getProfile',
                'getRequirementGroupList'
            ])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);
        $oControllerMock->method('getRequirementGroupList')->willReturn($oRequGroupListMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getGroupedRequirementList'
            )
        );
    }

    /**
     * @param $sLicenseKey
     * @param d3usermanager $oManager
     * @return null
     */
    protected function _setModuleLicenseKey($sLicenseKey, $oManager = null)
    {
        return null;
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ::d3GetConfig
     * @test
     * @throws ReflectionException
     */
    public function d3GetConfigReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Config::class,
            $this->callMethod(
                $this->_oController,
                'd3GetConfig'
            )
        );
    }
}
