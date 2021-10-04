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

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_trigger;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use stdClass;

class d3_cfg_usermanageritem_triggerTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_cfg_usermanageritem_trigger */
    protected $_oController;

    /**
     * setup basic requirements
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->_oController = d3GetModCfgDIC()->get(d3_cfg_usermanageritem_trigger::class);
    }

    public function tearDown() : void
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_trigger::render
     * @test
     * @throws ReflectionException
     */
    public function renderPass()
    {
        $this->assertStringContainsStringIgnoringCase(
            '.tpl',
            $this->callMethod($this->_oController, 'render')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_trigger::addDefaultValues
     * @test
     * @throws ReflectionException
     */
    public function changeDefaultValuesPostPass()
    {
        $_POST = [
            'editval' => ['d3modprofile__d3_cronjobid' => 'foo'],
        ];

        /** @var d3_cfg_usermanageritem_trigger|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_trigger::class)
            ->onlyMethods(['fixCronjobId'])
            ->getMock();
        $oControllerMock->method('fixCronjobId')->willReturn('newCjId');

        $this->_oController = $oControllerMock;

        $this->assertSame(
            array('foo' => 'bar'),
            $this->callMethod($this->_oController, 'addDefaultValues', array(array('foo' => 'bar')))
        );

        $this->assertEquals('newCjId', $_POST['editval']['d3modprofile__d3_cronjobid']);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_trigger::addDefaultValues
     * @test
     * @throws ReflectionException
     */
    public function changeDefaultValuesGetPass()
    {
        $_GET = [
            'editval' => ['d3modprofile__d3_cronjobid' => 'foo'],
        ];

        /** @var d3_cfg_usermanageritem_trigger|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_trigger::class)
            ->onlyMethods(['fixCronjobId'])
            ->getMock();
        $oControllerMock->method('fixCronjobId')->willReturn('newCjId');

        $this->_oController = $oControllerMock;

        $this->assertSame(
            array('foo' => 'bar'),
            $this->callMethod($this->_oController, 'addDefaultValues', array(array('foo' => 'bar')))
        );

        $this->assertEquals('newCjId', $_GET['editval']['d3modprofile__d3_cronjobid']);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_trigger::fixCronjobId
     * @test
     * @throws ReflectionException
     */
    public function fixCronJobIdPass()
    {
        $this->assertEquals(
            'test_Id',
            $this->callMethod(
                $this->_oController,
                'fixCronjobId',
                array('test Id')
            )
        );
        $this->assertEquals(
            'test-Id',
            $this->callMethod(
                $this->_oController,
                'fixCronjobId',
                array('test-Id')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_trigger::triggersAreAllowed
     * @test
     * @throws ReflectionException
     */
    public function triggersAreAllowedPass()
    {
        /** @var MockObject|d3_cfg_mod $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['isDemo'])
            ->getMock();
        $oModCfgMock->method('isDemo')->willReturn(true);

        /** @var MockObject|d3usermanager $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['d3getModCfg'])
            ->getMock();
        $oManagerMock->expects($this->any())->method('d3getModCfg')->willReturn($oModCfgMock);

        /** @var d3_cfg_usermanageritem_trigger|MockObject $oActionMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_trigger::class)
            ->addMethods(['getManager'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'triggersAreAllowed'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_trigger::scriptsAreAllowed
     * @test
     * @throws ReflectionException
     */
    public function scriptsAreAllowedPass()
    {
        /** @var MockObject|d3_cfg_mod $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['isDemo'])
            ->getMock();
        $oModCfgMock->method('isDemo')->willReturn(true);

        /** @var MockObject|d3usermanager $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['d3getModCfg'])
            ->getMock();
        $oManagerMock->expects($this->any())->method('d3getModCfg')->willReturn($oModCfgMock);

        /** @var d3_cfg_usermanageritem_trigger|MockObject $oActionMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_trigger::class)
            ->addMethods(['getManager'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'scriptsAreAllowed'
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
}
