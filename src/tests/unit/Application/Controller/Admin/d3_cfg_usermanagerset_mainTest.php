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
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Filegenerator\d3filegeneratorcronsh;
use D3\ModCfg\Application\Model\Shopcompatibility\d3ShopCompatibilityAdapterHandler;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\ViewConfig;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use stdClass;

class d3_cfg_usermanagerset_mainTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_cfg_usermanagerset_main */
    protected $_oController;

    /**
     * setup basic requirements
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function setUp()
    {
        parent::setUp();

        $this->_oController = d3GetModCfgDIC()->get(d3_cfg_usermanagerset_main::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::__construct
     * @test
     */
    public function constructorPass()
    {
        $this->assertSame(
            'd3usermanager',
            d3GetModCfgDIC()->getParameter('d3.usermanager.modcfgid')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getManager
     * @test
     * @throws ReflectionException
     */
    public function getManagerReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanager::class,
            $this->callMethod($this->_oController, 'getManager')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getBaseCronPW
     * @test
     * @throws ReflectionException
     */
    public function cronPwPass()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getBaseCronPW'])
            ->getMock();
        $oManagerMock->method('getBaseCronPW')->willReturn('testBaseCronPw');

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods(['getManager'])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);

        $this->_oController = $oControllerMock;

        $this->assertEquals(
            'testBaseCronPw',
            $this->callMethod($this->_oController, 'getBaseCronPW')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getViewConfig
     * @test
     * @throws ReflectionException
     */
    public function getViewConfigReturnsRightInstance()
    {
        $this->assertInstanceOf(
            ViewConfig::class,
            $this->callMethod($this->_oController, 'getViewConfig')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getD3Str
     * @test
     * @throws ReflectionException
     */
    public function getD3StrReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3str::class,
            $this->callMethod($this->_oController, 'getD3Str')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCronLink
     * @test
     * @throws ReflectionException
     */
    public function cronLinkWithCustPasswordAndCronjobIdPass()
    {
        /** @var d3_cfg_mod|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $map = [
            ['sCronPassword', 'testCronPassword']
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->setMethods(['generateParameterUrl'])
            ->getMock();
        $oD3StrMock->method('generateParameterUrl')->with(
            $this->stringContains('http://www.example.net/modules/public/d3_usermanager_cron.php'),
            $this->logicalAnd(
                $this->contains('testCjId'),
                $this->contains('testCronPassword')
            )
        )->willReturn('testUrl');

        /** @var ViewConfig|MockObject $oViewConfMock */
        $oViewConfMock = $this->getMockBuilder(ViewConfig::class)
            ->setMethods([
                'getModuleUrl',
                'getActiveShopId'
            ])
            ->getMock();
        $oViewConfMock->method('getModuleUrl')->willReturn('http://www.example.net/modules/public/d3_usermanager_cron.php');
        $oViewConfMock->method('getActiveShopId')->willReturn(1);

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods([
                'getViewConfig',
                'd3GetSet',
                'getBaseCronPW',
                'getD3Str'])
            ->getMock();
        $oControllerMock->method('getViewConfig')->willReturn($oViewConfMock);
        $oControllerMock->method('d3GetSet')->willReturn($oModCfgMock);
        $oControllerMock->method('getBaseCronPW')->willReturn('testBaseCronPassword');
        $oControllerMock->method('getD3Str')->willReturn($oD3StrMock);

        $this->_oController = $oControllerMock;

        $this->assertEquals(
            'testUrl',
            $this->callMethod($this->_oController, 'getCronLink', array(true, 'testCjId'))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCronLink
     * @test
     * @throws ReflectionException
     */
    public function cronLinkWithBasePasswordAndNoCronjobIdPass()
    {
        /** @var d3_cfg_mod|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $map = [
            ['sCronPassword', '']
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->setMethods(['generateParameterUrl'])
            ->getMock();
        $oD3StrMock->method('generateParameterUrl')->with(
            $this->stringContains('http://www.example.net/modules/public/d3_usermanager_cron.php'),
            $this->logicalAnd(
                $this->logicalNot(
                    $this->contains('testCjId')
                ),
                $this->contains('testBaseCronPassword')
            )
        )->willReturn('testUrl');

        /** @var ViewConfig|MockObject $oViewConfMock */
        $oViewConfMock = $this->getMockBuilder(ViewConfig::class)
            ->setMethods([
                'getModuleUrl',
                'getActiveShopId'
            ])
            ->getMock();
        $oViewConfMock->method('getModuleUrl')->willReturn('http://www.example.net/modules/public/d3_usermanager_cron.php');
        $oViewConfMock->method('getActiveShopId')->willReturn(1);

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods([
                'getViewConfig',
                'd3GetSet',
                'getBaseCronPW',
                'getD3Str'])
            ->getMock();
        $oControllerMock->method('getViewConfig')->willReturn($oViewConfMock);
        $oControllerMock->method('d3GetSet')->willReturn($oModCfgMock);
        $oControllerMock->method('getBaseCronPW')->willReturn('testBaseCronPassword');
        $oControllerMock->method('getD3Str')->willReturn($oD3StrMock);

        $this->_oController = $oControllerMock;

        $this->assertEquals(
            'testUrl',
            $this->callMethod($this->_oController, 'getCronLink', array(true))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCronLink
     * @test
     * @throws ReflectionException
     */
    public function cronLinkWithoutPasswordAndNoCronjobIdPass()
    {
        /** @var d3_cfg_mod|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $map = [
            ['sCronPassword', '']
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->setMethods(['generateParameterUrl'])
            ->getMock();
        $oD3StrMock->method('generateParameterUrl')->with(
            $this->stringContains('http://www.example.net/modules/public/d3_usermanager_cron.php'),
            $this->logicalAnd(
                $this->logicalNot(
                    $this->contains('testCjId')
                ),
                $this->logicalNot(
                    $this->contains('testBaseCronPassword')
                )
            )
        )->willReturn('testUrl');

        /** @var ViewConfig|MockObject $oViewConfMock */
        $oViewConfMock = $this->getMockBuilder(ViewConfig::class)
            ->setMethods([
                'getModuleUrl',
                'getActiveShopId'
            ])
            ->getMock();
        $oViewConfMock->method('getModuleUrl')->willReturn('http://www.example.net/modules/public/d3_usermanager_cron.php');
        $oViewConfMock->method('getActiveShopId')->willReturn(1);

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods([
                'getViewConfig',
                'd3GetSet',
                'getBaseCronPW',
                'getD3Str'])
            ->getMock();
        $oControllerMock->method('getViewConfig')->willReturn($oViewConfMock);
        $oControllerMock->method('d3GetSet')->willReturn($oModCfgMock);
        $oControllerMock->method('getBaseCronPW')->willReturn('testBaseCronPassword');
        $oControllerMock->method('getD3Str')->willReturn($oD3StrMock);

        $this->_oController = $oControllerMock;

        $this->assertEquals(
            'testUrl',
            $this->callMethod($this->_oController, 'getCronLink', array(false))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCronPath
     * @test
     * @throws ReflectionException
     */
    public function cronPathWithCronjobIdPass()
    {
        /** @var ViewConfig|MockObject $oViewConfMock */
        $oViewConfMock = $this->getMockBuilder(ViewConfig::class)
            ->setMethods(['getActiveShopId'])
            ->getMock();
        $oViewConfMock->method('getActiveShopId')->willReturn(1);

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods(['getViewConfig'])
            ->getMock();
        $oControllerMock->method('getViewConfig')->willReturn($oViewConfMock);

        $this->_oController = $oControllerMock;

        $this->assertRegExp(
            '/(?!http).*php.*\/d3_usermanager_cron\srun\s[0-9]\stestCjId/i',
            $this->callMethod($this->_oController, 'getCronPath', array('testCjId'))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCronPath
     * @test
     * @throws ReflectionException
     */
    public function cronPathWithNoCronjobIdPass()
    {
        define(VENDOR_PATH, 'TESTPATH');

        /** @var ViewConfig|MockObject $oViewConfMock */
        $oViewConfMock = $this->getMockBuilder(ViewConfig::class)
            ->setMethods(['getActiveShopId'])
            ->getMock();
        $oViewConfMock->method('getActiveShopId')->willReturn(1);

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods(['getViewConfig'])
            ->getMock();
        $oControllerMock->method('getViewConfig')->willReturn($oViewConfMock);

        $this->_oController = $oControllerMock;

        $this->assertRegExp(
            '/(?!http).*php.*\/d3_usermanager_cron\srun\s[0-9]/i',
            $this->callMethod($this->_oController, 'getCronPath', array())
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getAvailableCronjobIds
     * @test
     * @throws ReflectionException
     */
    public function canGetAvailableCronjobIds()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getAvailableCronjobIds'])
            ->getMock();
        $oManagerMock->method('getAvailableCronjobIds')->willReturn(array(1,5,8,'foobar'));

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods(['getManager'])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            array(1,5,8,'foobar'),
            $this->callMethod($this->_oController, 'getAvailableCronjobIds')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCJIDDesc
     * @test
     * @throws ReflectionException
     */
    public function canGetCjIdDescriptionForOne()
    {
        $aCjId = array(
            'count' => 1,
            'id'    => 'testid'
        );

        $sDesc = $this->callMethod($this->_oController, 'getCJIDDesc', array($aCjId));
        $this->assertContains('testid', $sDesc);
        $this->assertContains('1', $sDesc);
        $this->assertTrue(strlen($sDesc) > 11);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCJIDDesc
     * @test
     * @throws ReflectionException
     */
    public function canGetCjIdDescriptionForMultiple()
    {
        $aCjId = array(
            'count' => 5,
            'id'    => 'testid'
        );

        $sDesc = $this->callMethod($this->_oController, 'getCJIDDesc', array($aCjId));
        $this->assertContains('testid', $sDesc);
        $this->assertContains('5', $sDesc);
        $this->assertTrue(strlen($sDesc) > 11);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCronTimestampVarName
     * @test
     * @throws ReflectionException
     */
    public function canGetCronTimestampVarNameWithoutCronId()
    {
        $this->assertTrue(
            strlen($this->callMethod($this->_oController, 'getCronTimestampVarName')) > 5
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCronTimestampVarName
     * @test
     * @throws ReflectionException
     */
    public function canGetCronTimestampVarNameWithCronId()
    {
        $sVarName = $this->callMethod($this->_oController, 'getCronTimestampVarName', array('testid'));

        $this->assertTrue(strlen($sVarName) > 6);
        $this->assertContains('testid', $sVarName);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getFileGeneratorCronSh
     * @test
     * @throws ReflectionException
     */
    public function getFileGeneratorCronShReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3filegeneratorcronsh::class,
            $this->callMethod($this->_oController, 'getFileGeneratorCronSh')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCronProviderList
     * @test
     * @throws ReflectionException
     */
    public function canGetCronProviderList()
    {
        $expected = ['contentList'];

        /** @var d3filegeneratorcronsh|MockObject $oFileGeneratorCronShMock */
        $oFileGeneratorCronShMock = $this->getMockBuilder(d3filegeneratorcronsh::class)
            ->setMethods(['getContentList'])
            ->getMock();
        $oFileGeneratorCronShMock->method('getContentList')->willReturn($expected);

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods(['getFileGeneratorCronSh'])
            ->getMock();
        $oControllerMock->method('getFileGeneratorCronSh')->willReturn($oFileGeneratorCronShMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $expected,
            $this->callMethod($this->_oController, 'getCronProviderList')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::getCompatibilityAdapterHandler
     * @test
     * @throws ReflectionException
     */
    public function getCompatibilityAdapterHandlerReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3ShopCompatibilityAdapterHandler::class,
            $this->callMethod($this->_oController, 'getCompatibilityAdapterHandler')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::d3GetActiveShop
     * @test
     * @throws ReflectionException
     */
    public function getActiveShopReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Shop::class,
            $this->callMethod($this->_oController, 'd3GetActiveShop')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main::generateCronShFile
     * @test
     * @throws ReflectionException
     */
    public function canGenerateCronShFile()
    {
        $_POST['cronid'] = 'testCronId';

        /** @var d3ShopCompatibilityAdapterHandler|MockObject $oShopCompatibilityAdapterHandlerMock */
        $oShopCompatibilityAdapterHandlerMock = $this->getMockBuilder(d3ShopCompatibilityAdapterHandler::class)
            ->setMethods(['call'])
            ->getMock();
        $oShopCompatibilityAdapterHandlerMock->method('call')->willReturnCallback(array($this, 'shopCompatHandlerCallback'));

        /** @var Shop|MockObject $oShopMock */
        $oShopMock = $this->getMockBuilder(Shop::class)
            ->setMethods(['getId'])
            ->getMock();
        $oShopMock->method('getId')->willReturn('shopid');

        /** @var d3filegeneratorcronsh|MockObject $oFileGeneratorCronShMock */
        $oFileGeneratorCronShMock = $this->getMockBuilder(d3filegeneratorcronsh::class)
            ->setMethods([
                'setContentType',
                'setScriptPath',
                'setSortedParameterList',
                'startDownload'])
            ->getMock();
        $oFileGeneratorCronShMock->method('setContentType')->willReturn(true);
        $oFileGeneratorCronShMock->method('setScriptPath')->willReturn(true);
        $oFileGeneratorCronShMock->method('setSortedParameterList')->willReturn(true);
        $oFileGeneratorCronShMock->expects($this->once())->method('startDownload')->with(
            $this->stringContains('d3usermanager_shopid_testCronId.sh')
        )->willReturn(true);

        /** @var d3_cfg_usermanagerset_main|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanagerset_main::class)
            ->setMethods([
                'getCompatibilityAdapterHandler',
                'd3GetActiveShop',
                'getFileGeneratorCronSh'
            ])
            ->getMock();
        $oControllerMock->method('getCompatibilityAdapterHandler')->willReturn($oShopCompatibilityAdapterHandlerMock);
        $oControllerMock->method('d3GetActiveShop')->willReturn($oShopMock);
        $oControllerMock->method('getFileGeneratorCronSh')->willReturn($oFileGeneratorCronShMock);

        $this->_oController = $oControllerMock;

        $this->callMethod($this->_oController, 'generateCronShFile');
    }

    /**
     * @return string
     */
    public function shopCompatHandlerCallback(): string
    {
        $args = func_get_args();
        return '/module/path/'.$args[1][1];
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