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

namespace D3\Usermanager\tests\unit\publicDir;

use D3\ModCfg\Application\Model\Exception\d3PreventExitException;
use D3\Usermanager\Application\Controller\d3usermanager_response;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\publicDir\d3_usermanager_cron;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Session;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use splitbrain\phpcli\Exception as Exception;
use splitbrain\phpcli\Options;

class d3_usermanager_cronTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_usermanager_cron */
    protected $_oController;

    /**
     * setup basic requirements
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->_oController = oxNew( d3_usermanager_cron::class);
    }

    public function tearDown() : void
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::__construct
     * @test
     * @throws ReflectionException
     */
    public function constructorCLIPass()
    {
        $controllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods(['isCLI'])
            ->disableOriginalConstructor()
            ->getMock();
        $controllerMock->method('isCLI')->willReturn(true);

        $this->callMethod(
            $controllerMock,
            '__construct'
        );

        $this->assertInstanceOf(
            Options::class,
            $this->getValue(
                $controllerMock,
                'options'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::__construct
     * @test
     * @throws ReflectionException
     */
    public function constructorNonCLIPass()
    {
        $controllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods(['isCLI'])
            ->disableOriginalConstructor()
            ->getMock();
        $controllerMock->method('isCLI')->willReturn(false);

        $this->callMethod(
            $controllerMock,
            '__construct'
        );

        $this->assertNull(
            $this->getValue(
                $controllerMock,
                'options'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::isCLI
     * @test
     * @throws ReflectionException
     */
    public function isCLIPass()
    {
        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'isClI'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::setup
     * @test
     * @throws ReflectionException
     */
    public function canSetup()
    {
        /** @var Options|MockObject $oModelMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'registerOption',
                'registerCommand',
                'registerArgument'
            ])
            ->getMock();
        $oOptionsMock->expects($this->exactly(3))->method('registerOption')->willReturn(true);
        $oOptionsMock->expects($this->exactly(2))->method('registerCommand')->willReturn(true);
        $oOptionsMock->expects($this->exactly(3))->method('registerArgument')->willReturn(true);

        $this->callMethod(
            $this->_oController,
            'setup',
            array(
                $oOptionsMock
            )
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::parseOptions
     * @test
     * @throws ReflectionException
     */
    public function canParseOptions()
    {
        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods(['registerOption'])
            ->setConstructorArgs([$this->getValue($this->_oController, 'colors')])
            ->getMock();
        $oOptionsMock->expects($this->atLeast(3))->method('registerOption');

        $this->setValue(
            $oOptionsMock,
            'args',
            array()
        );
        $oOptionsMock->parseOptions();

        $this->setValue($this->_oController, 'options', $oOptionsMock);

        $this->callMethod(
            $this->_oController,
            'parseOptions'
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::main
     * @test
     * @throws ReflectionException
     */
    public function mainShowVersion()
    {
        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'getOpt',
                'getCmd'
            ])
            ->setConstructorArgs([$this->getValue($this->_oController, 'colors')])
            ->getMock();
        $oOptionsMock->method('getOpt')->will($this->returnCallback(
            function($param) {
                return $param == d3_usermanager_cron::OPTION_VERSION;
            }
        ));
        $oOptionsMock->expects($this->never())->method('getCmd')->willReturn(false);

        $this->setValue(
            $oOptionsMock,
            'args',
            array()
        );
        $oOptionsMock->parseOptions();

        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods(['info'])
            ->getMock();
        $oControllerMock->expects($this->once())->method('info')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'main',
            array($oOptionsMock)
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::main
     * @test
     * @throws ReflectionException
     */
    public function mainUseQuietCmdDefaultNoCJID()
    {
        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'getOpt',
                'getCmd'
            ])
            ->setConstructorArgs([$this->getValue($this->_oController, 'colors')])
            ->getMock();
        $oOptionsMock->method('getOpt')->will($this->returnCallback(
            function($param) {
                return $param == d3_usermanager_cron::OPTION_QUIET;
            }
        ));
        $oOptionsMock->method('getCmd')->willReturn(false);

        $this->setValue(
            $oOptionsMock,
            'args',
            array()
        );
        $oOptionsMock->parseOptions();

        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods(['translateFixedStrings'])
            ->getMock();
        $oControllerMock->expects($this->once())->method('translateFixedStrings')->willReturn('');

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'main',
            array($oOptionsMock)
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::main
     * @test
     * @throws ReflectionException
     */
    public function mainUseQuietCmdDefaultUnvalidCJID()
    {
        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'getOpt',
                'getCmd',
                'getArgs'
            ])
            ->setConstructorArgs(
                [$this->getValue($this->_oController, 'colors')]
            )
            ->getMock();
        $oOptionsMock->method('getOpt')->willReturn(false);
        $oOptionsMock->method('getCmd')->willReturn(false);
        $oOptionsMock->method('getArgs')->willReturn(['1', '1234561', 'key']);

        $this->setValue(
            $oOptionsMock,
            'args',
            ['1', '1234561', 'key']
        );
        $oOptionsMock->parseOptions();

        /** @var d3usermanager_response|MockObject $oResponseMock */
        $oResponseMock = $this->getMockBuilder(d3usermanager_response::class)
            ->onlyMethods(['initCli'])
            ->getMock();
        $oResponseMock->expects($this->never())->method('initCli')->willReturn(true);
        d3GetModCfgDIC()->set( d3usermanager_response::class, $oResponseMock);

        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods([
                'translateFixedStrings',
                'success',
                'error'
            ])
            ->getMock();
        $oControllerMock->expects($this->never())->method('translateFixedStrings')->willReturn('');
        $oControllerMock->expects($this->never())->method('success')->willReturn(true);
        $oControllerMock->expects($this->once())->method('error')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'main',
            array($oOptionsMock)
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::main
     * @test
     * @throws ReflectionException
     */
    public function mainUseQuietCmdDefaultUnvalidShopId()
    {
        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'getOpt',
                'getCmd',
                'getArgs'
            ])
            ->setConstructorArgs(
                [$this->getValue($this->_oController, 'colors')]
            )
            ->getMock();
        $oOptionsMock->method('getOpt')->willReturn(false);
        $oOptionsMock->method('getCmd')->willReturn(false);
        $oOptionsMock->method('getArgs')->willReturn(['5', '1234561', 'key']);

        $this->setValue(
            $oOptionsMock,
            'args',
            ['5', '1234561', 'key']
        );
        $oOptionsMock->parseOptions();

        /** @var Session|MockObject $oSessionMock */
        $oSessionMock = $this->getMockBuilder(Session::class)
            ->onlyMethods(['setVariable'])
            ->getMock();
        $oSessionMock->expects($this->never())->method('setVariable')
            ->with($this->equalTo('d3usermanager_quiet'))->willReturn(false);
        d3GetModCfgDIC()->set('d3ox.usermanager.'.Session::class, $oSessionMock);

        /** @var d3usermanager_response|MockObject $oResponseMock */
        $oResponseMock = $this->getMockBuilder(d3usermanager_response::class)
            ->onlyMethods(['init'])
            ->getMock();
        $oResponseMock->expects($this->never())->method('init')->willReturn(true);
        d3GetModCfgDIC()->set( d3usermanager_response::class, $oResponseMock);

        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->onlyMethods(['getShopIds'])
            ->getMock();
        $oConfigMock->method('getShopIds')->willReturn([0, 1, 2]);
        d3GetModCfgDIC()->set( 'd3ox.usermanager.' . Config::class , $oConfigMock);

        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods([
                'translateFixedStrings',
                'success',
                'error'
            ])
            ->getMock();
        $oControllerMock->expects($this->never())->method('translateFixedStrings')->willReturn('');
        $oControllerMock->expects($this->never())->method('success')->willReturn(true);
        $oControllerMock->expects($this->once())->method('error')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'main',
            array($oOptionsMock)
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::main
     * @test
     * @throws ReflectionException
     */
    public function mainUseQuietCmdDefaultValidCJID()
    {
        $aAvailableIds = d3GetModCfgDIC()->get(d3usermanager::class)->getAvailableCronjobIds();

        if (0 === count($aAvailableIds)) {
            $this->fail('no available cronjob ids for running test');
        }

        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'getOpt',
                'getCmd',
                'getArgs'
            ])
            ->setConstructorArgs(
                [$this->getValue($this->_oController, 'colors')]
            )
            ->getMock();
        $oOptionsMock->method('getOpt')->willReturn(false);
        $oOptionsMock->method('getCmd')->willReturn(false);
        $oOptionsMock->method('getArgs')->willReturn(['1', end($aAvailableIds)['id'], 'key']);

        $this->setValue(
            $oOptionsMock,
            'args',
            ['1', end($aAvailableIds)['id'], 'key']
        );
        $oOptionsMock->parseOptions();

        /** @var d3usermanager_response|MockObject $oResponseMock */
        $oResponseMock = $this->getMockBuilder(d3usermanager_response::class)
            ->onlyMethods(['initCli'])
            ->getMock();
        $oResponseMock->expects($this->once())->method('initCli')->willReturn(true);
        d3GetModCfgDIC()->set( d3usermanager_response::class, $oResponseMock);

        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods([
                'translateFixedStrings',
                'success',
                'error'
            ])
            ->getMock();
        $oControllerMock->expects($this->never())->method('translateFixedStrings')->willReturn('');
        $oControllerMock->expects($this->once())->method('success')->willReturn(true);
        $oControllerMock->expects($this->never())->method('error')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'main',
            array($oOptionsMock)
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::main
     * @test
     * @throws ReflectionException
     */
    public function mainCmdRun()
    {
        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'getOpt',
                'getCmd'
            ])
            ->setConstructorArgs([$this->getValue($this->_oController, 'colors')])
            ->getMock();
        $oOptionsMock->method('getCmd')->willReturn(d3_usermanager_cron::COMMAND_RUN);
        $oOptionsMock->method('getOpt')->willReturn(false);

        $this->setValue(
            $oOptionsMock,
            'args',
            array()
        );
        $oOptionsMock->parseOptions();

        /** @var d3usermanager_response|MockObject $oResponseMock */
        $oResponseMock = $this->getMockBuilder(d3usermanager_response::class)
            ->onlyMethods(['initCli'])
            ->getMock();
        $oResponseMock->expects($this->once())->method('initCli')->willReturn(true);
        d3GetModCfgDIC()->set( d3usermanager_response::class, $oResponseMock);

        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods(['success'])
            ->getMock();
        $oControllerMock->expects($this->once())->method('success')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'main',
            array($oOptionsMock)
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::main
     * @test
     * @throws ReflectionException
     */
    public function mainCmdStatus()
    {
        /** @var d3usermanager_response|MockObject $oResponseMock */
        $oResponseMock = $this->getMockBuilder(d3usermanager_response::class)
            ->onlyMethods(['getLastExecDateInfo'])
            ->getMock();
        $oResponseMock->expects($this->atLeastOnce())->method('getLastExecDateInfo')->willReturn(['content1', 'content2']);

        d3GetModCfgDIC()->set( d3usermanager_response::class, $oResponseMock );

        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'getOpt',
                'getCmd'
            ])
            ->setConstructorArgs([$this->getValue($this->_oController, 'colors')])
            ->getMock();
        $oOptionsMock->method('getCmd')->willReturn(d3_usermanager_cron::COMMAND_STATUS);
        $oOptionsMock->method('getOpt')->willReturn(false);

        $this->setValue(
            $oOptionsMock,
            'args',
            array()
        );
        $oOptionsMock->parseOptions();

        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods(['info'])
            ->getMock();
        $oControllerMock->expects($this->once())->method('info')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'main',
            [$oOptionsMock]
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::main
     * @test
     * @throws ReflectionException
     */
    public function mainHandleException()
    {
        /** @var Options|MockObject $oOptionsMock */
        $oOptionsMock = $this->getMockBuilder(Options::class)
            ->onlyMethods([
                'getOpt',
                'getCmd'
            ])
            ->setConstructorArgs([$this->getValue($this->_oController, 'colors')])
            ->getMock();
        $oOptionsMock->method('getCmd')->willReturn(d3_usermanager_cron::COMMAND_RUN);
        $oOptionsMock->method('getOpt')->willReturn(false);

        $this->setValue(
            $oOptionsMock,
            'args',
            array()
        );
        $oOptionsMock->parseOptions();

        /** @var d3usermanager_response|MockObject $oResponseMock */
        $oResponseMock = $this->getMockBuilder(d3usermanager_response::class)
            ->onlyMethods(['initCli'])
            ->getMock();
        $oResponseMock->expects($this->once())->method('initCli')->willThrowException(new Exception('excMsg'));
        d3GetModCfgDIC()->set( d3usermanager_response::class, $oResponseMock);

        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods(['error'])
            ->getMock();
        $oControllerMock->expects($this->once())->method('error')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'main',
            array($oOptionsMock)
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::execute
     * @test
     * @throws ReflectionException
     */
    public function executeThrowRightException()
    {
        /** @var d3_usermanager_cron|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_cron::class)
            ->onlyMethods(['main'])
            ->getMock();
        $oControllerMock->method('main')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->expectException(d3PreventExitException::class);

        $this->callMethod(
            $this->_oController,
            'execute'
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::translateFixedStrings
     * @test
     * @throws ReflectionException
     */
    public function translateFixedStringsPassed()
    {
        $this->assertSame(
            'abc D3_USERMANAGER_CLI_COMMAND def',
            $this->callMethod(
                $this->_oController,
                'translateFixedStrings',
                array(
                    'abc This tool accepts a command as first parameter as outlined below: def'
                )
            )
        );
    }

    /**
     * @covers \D3\Usermanager\publicDir\d3_usermanager_cron::translateFixedStrings
     * @test
     * @throws ReflectionException
     */
    public function translateFixedStringsFailed()
    {
        $this->assertSame(
            'abc This tool accepts a foo command as first parameter as outlined below: def',
            $this->callMethod(
                $this->_oController,
                'translateFixedStrings',
                array(
                    'abc This tool accepts a foo command as first parameter as outlined below: def'
                )
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
