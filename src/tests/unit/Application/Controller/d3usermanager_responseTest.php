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

namespace D3\Usermanager\tests\unit\Application\Controller;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\Usermanager\Application\Controller\d3usermanager_response;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_cronUnavailableException;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Language;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use stdClass;

class d3usermanager_responseTest extends d3UsermanagerUnitTestCase
{
    /** @var d3usermanager_response */
    protected $_oController;

    /**
     * setup basic requirements
     *
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function setUp()
    {
        parent::setUp();

        $this->_oController = d3GetModCfgDIC()->get(d3usermanager_response::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::__construct
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
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::init
     * @test
     * @throws ReflectionException
     */
    public function initOutputSuccessMessageToBrowser()
    {
        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_startExecution',
                'isBrowserCall'
            ])
            ->getMock();
        $oControllerMock->expects($this->once())->method('_startExecution')->willReturn(false);
        $oControllerMock->expects($this->once())->method('isBrowserCall')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->expectOutputRegex('@[a-z0-9]{1,}@i'); // output not empty
        $this->callMethod($this->_oController, 'init');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::init
     * @test
     * @throws ReflectionException
     */
    public function initDontOutputSuccessMessageToServer()
    {
        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_startExecution',
                'isBrowserCall'
            ])
            ->getMock();
        $oControllerMock->expects($this->once())->method('_startExecution')->willReturn(false);
        $oControllerMock->expects($this->once())->method('isBrowserCall')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->expectOutputRegex('@^$@'); // output is empty
        $this->callMethod($this->_oController, 'init');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::init
     * @test
     * @throws ReflectionException
     */
    public function initDontOutputSuccessMessageInCaseOfException()
    {
        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_startExecution',
                'isBrowserCall'
            ])
            ->getMock();
        $oControllerMock->expects($this->once())->method('_startExecution')->willReturn(true);
        $oControllerMock->expects($this->once())->method('isBrowserCall')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->expectOutputRegex('@^$@'); // output is empty
        $this->callMethod($this->_oController, 'init');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_startExecution
     * @test
     * @throws ReflectionException
     */
    public function startExecutionPassWithoutException()
    {
        /** @var d3log|MockObject $oLogMock */
        $oLogMock = $this->getMockBuilder(d3log::class)
            ->setMethods(['log'])
            ->getMock();
        $oLogMock->method('log')->willReturn(true);

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods([
                'd3getLog',
                'setValue',
                'saveNoLicenseRefresh'
            ])
            ->getMock();
        $oModCfgMock->method('d3getLog')->willReturn($oLogMock);
        $oModCfgMock->method('setValue')->willReturn(true);
        $oModCfgMock->method('saveNoLicenseRefresh')->willReturn(true);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_getSet',
                '_checkUnavailableCronjob',
                '_getCronTimestampVarName',
                '_startJobs'])
            ->getMock();
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);
        $oControllerMock->method('_checkUnavailableCronjob')->willReturn(true);
        $oControllerMock->method('_getCronTimestampVarName')->willReturn(true);
        $oControllerMock->expects($this->once())->method('_startJobs')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oController,
                '_startExecution'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_startExecution
     * @test
     * @throws ReflectionException
     */
    public function startExecutionPassWithCronUnavailableException()
    {
        /** @var d3log|MockObject $oLogMock */
        $oLogMock = $this->getMockBuilder(d3log::class)
            ->setMethods(['log'])
            ->getMock();
        $oLogMock->method('log')->willReturn(true);

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods([
                'd3getLog',
                'setValue',
                'saveNoLicenseRefresh'
            ])
            ->getMock();
        $oModCfgMock->method('d3getLog')->willReturn($oLogMock);
        $oModCfgMock->method('setValue')->willReturn(true);
        $oModCfgMock->method('saveNoLicenseRefresh')->willReturn(true);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_getSet',
                '_checkUnavailableCronjob',
                '_getCronTimestampVarName',
                '_startJobs'])
            ->getMock();
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);
        $oControllerMock->method('_checkUnavailableCronjob')->will($this->returnCallback(array($this, 'unavailableCronjobCallback')));
        $oControllerMock->method('_getCronTimestampVarName')->willReturn(true);
        $oControllerMock->expects($this->never())->method('_startJobs')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                '_startExecution'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_startExecution
     * @test
     * @throws ReflectionException
     */
    public function startExecutionPassWithStandardException()
    {
        /** @var d3log|MockObject $oLogMock */
        $oLogMock = $this->getMockBuilder(d3log::class)
            ->setMethods(['log'])
            ->getMock();
        $oLogMock->method('log')->willReturn(true);

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods([
                'd3getLog',
                'setValue',
                'saveNoLicenseRefresh'
            ])
            ->getMock();
        $oModCfgMock->method('d3getLog')->willReturn($oLogMock);
        $oModCfgMock->method('setValue')->willReturn(true);
        $oModCfgMock->method('saveNoLicenseRefresh')->willReturn(true);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_getSet',
                '_checkUnavailableCronjob',
                '_getCronTimestampVarName',
                '_startJobs'])
            ->getMock();
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);
        $oControllerMock->method('_checkUnavailableCronjob')->will($this->returnCallback(array($this, 'standardExceptionCallback')));
        $oControllerMock->method('_getCronTimestampVarName')->willReturn(true);
        $oControllerMock->expects($this->never())->method('_startJobs')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                '_startExecution'
            )
        );

        $fileName = 'd3usermanagerExceptionsTest.txt';
        $sLogFolder = str_replace(basename(OX_LOG_FILE), '', OX_LOG_FILE);
        $sLogFile = $sLogFolder.$fileName;

        // backward compatibility for OXID < 6.1
        if (method_exists(StandardException::class, 'setLogFileName')
            && file_exists($sLogFile)
        ) {
            $file = file_get_contents($sLogFile);
            unlink($sLogFile);
            $this->assertContains('cron unavailable', $file);
        } elseif (file_exists(OX_LOG_FILE)) {
            $file = file_get_contents(OX_LOG_FILE);
            file_put_contents(OX_LOG_FILE, '');
            $this->assertContains('cron unavailable', $file);
        }
    }

    /**
     * @throws StandardException
     * @throws Exception
     */
    public function standardExceptionCallback()
    {
        d3GetModCfgDIC()->setParameter(
            'd3ox.usermanager.'.StandardException::class.'.args.message',
            'cron unavailable'
        );

        /** @var StandardException $oException */
        $oException = d3GetModCfgDIC()->get('d3ox.usermanager.'.StandardException::class);

        throw $oException;
    }

    /**
     * @throws d3usermanager_cronUnavailableException
     * @throws Exception
     */
    public function unavailableCronjobCallback()
    {
        d3GetModCfgDIC()->setParameter(
            d3usermanager_cronUnavailableException::class.'.args.message',
            'cron unavailable'
        );

        /** @var d3usermanager_cronUnavailableException $oException */
        $oException = d3GetModCfgDIC()->get(d3usermanager_cronUnavailableException::class);
        $oException->d3disableScreenMessage();

        throw $oException;
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::getManagerList
     * @test
     * @throws ReflectionException
     */
    public function getListReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanagerlist::class,
            $this->callMethod(
                $this->_oController,
                'getManagerList'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::getManagerExecute
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function getManagerExecuteReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanager_execute::class,
            $this->callMethod(
                $this->_oController,
                'getManagerExecute',
                array(d3GetModCfgDIC()->get(d3usermanager::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_startJobs
     * @test
     * @throws ReflectionException
     */
    public function startedJobsCountPass()
    {
        /** @var d3log|MockObject $oLogMock */
        $oLogMock = $this->getMockBuilder(d3log::class)
            ->setMethods(['log'])
            ->getMock();
        $oLogMock->method('log')->willReturn(true);

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'getId',
                'd3GetLog',
                'load'
            ])
            ->getMock();
        $oManagerMock->method('getId')->willReturn('sId');
        $oManagerMock->method('d3GetLog')->willReturn($oLogMock);
        $oManagerMock->method('load')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->setMethods([
                'setManager',
                'startJobExecution',
                'finishJobExecution'
            ])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->method('setManager')->willReturn(true);
        $oManagerExecuteMock->expects($this->exactly(3))->method('startJobExecution')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);

        /** @var d3usermanagerlist|MockObject $oListMock */
        $oListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods([
                'setCronJobId',
                'setCustomSorting',
                'selectString'
            ])
            ->getMock();
        $oListMock->method('setCronJobId')->willReturn(true);
        $oListMock->method('setCustomSorting')->willReturn(true);
        $oListMock->method('selectString')->willReturn(true);
        $oListMock->offsetSet('item1', $oManagerMock);
        $oListMock->offsetSet('item2', $oManagerMock);
        $oListMock->offsetSet('item3', $oManagerMock);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                'getManagerList',
                'getManager',
                'getManagerExecute'
            ])
            ->getMock();
        $oControllerMock->method('getManagerList')->willReturn($oListMock);
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $this->callMethod($this->_oController, '_startJobs');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::getManager
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
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_checkAccessKey
     * @test
     * @throws ReflectionException
     */
    public function baseAccessKeyPassedToSetOne()
    {
        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $map = [
            ['sCronPassword', ''],
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getBaseCronPW'])
            ->getMock();
        $oManagerMock->method('getBaseCronPW')->willReturn('sBaseCronPw');

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_getSet',
                'hasValidAccessKey',
                'getManager'
            ])
            ->getMock();
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->expects($this->any())->method('hasValidAccessKey')->with(
            $this->equalTo('sBaseCronPw'),
            $this->equalTo('sSetCronPw')
        )->willReturn(true);

        $this->_oController = $oControllerMock;

        $_GET['key'] = 'sSetCronPw';

        $this->assertTrue(
            $this->callMethod($this->_oController, '_checkAccessKey')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_checkAccessKey
     * @test
     * @throws ReflectionException
     */
    public function registeredAccessKeyPassedToSetOne()
    {
        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $map = [
            ['sCronPassword', 'sRegCronPw'],
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getBaseCronPW'])
            ->getMock();
        $oManagerMock->method('getBaseCronPW')->willReturn('sBaseCronPw');

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_getSet',
                'hasValidAccessKey',
                'getManager'
            ])
            ->getMock();
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->expects($this->any())->method('hasValidAccessKey')->with(
            $this->equalTo('sRegCronPw'),
            $this->equalTo('sSetCronPw')
        )->willReturn(true);

        $this->_oController = $oControllerMock;

        $_GET['key'] = 'sSetCronPw';

        $this->assertTrue(
            $this->callMethod($this->_oController, '_checkAccessKey')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_getSet
     * @test
     * @throws ReflectionException
     */
    public function getSetReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3_cfg_mod::class,
            $this->callMethod($this->_oController, '_getSet')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::showDisabledMessage
     * @test
     * @throws ReflectionException
     */
    public function disabledMessageWillNotShow()
    {
        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods([
                'getValue',
                'hasDebugMode'
            ])
            ->getMock();
        $map = [
            ['blCronActive', false],
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);
        $oModCfgMock->method('hasDebugMode')->willReturn(false);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                'isBrowserCall',
                '_getSet'
            ])
            ->getMock();
        $oControllerMock->method('isBrowserCall')->willReturn(false);
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->assertFalse($this->callMethod($this->_oController, 'showDisabledMessage'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::showDisabledMessage
     * @test
     * @throws ReflectionException
     */
    public function disabledMessageWillShowBecauseDebug()
    {
        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods([
                'getValue',
                'hasDebugMode'
            ])
            ->getMock();
        $map = [
            ['blCronActive', false],
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);
        $oModCfgMock->method('hasDebugMode')->willReturn(true);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                'isBrowserCall',
                '_getSet'
            ])
            ->getMock();
        $oControllerMock->method('isBrowserCall')->willReturn(false);
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->assertTrue($this->callMethod($this->_oController, 'showDisabledMessage'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::showDisabledMessage
     * @test
     * @throws ReflectionException
     */
    public function disabledMessageWillShowBecauseBrowserCall()
    {
        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods([
                'getValue',
                'hasDebugMode'
            ])
            ->getMock();
        $map = [
            ['blCronActive', false],
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);
        $oModCfgMock->method('hasDebugMode')->willReturn(false);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                'isBrowserCall',
                '_getSet'
            ])
            ->getMock();
        $oControllerMock->method('isBrowserCall')->willReturn(true);
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->assertTrue($this->callMethod($this->_oController, 'showDisabledMessage'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::isBrowserCall
     * @test
     * @throws ReflectionException
     */
    public function isNoBrowserCall()
    {
        $_SERVER['REMOTE_ADDR'] = '';
        $_SERVER['HTTP_USER_AGENT'] = '';

        $this->assertFalse(
            $this->callMethod(
                $this->_oController,
                'isBrowserCall'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::isBrowserCall
     * @test
     * @throws ReflectionException
     */
    public function isBrowserCallBecauseUserAgent()
    {
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0';

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'isBrowserCall'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::isBrowserCall
     * @test
     * @throws ReflectionException
     */
    public function isBrowserCallBecauseRemoteAddr()
    {
        $_SERVER['REMOTE_ADDR'] = '192.168.133.1';

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'isBrowserCall'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::hasValidAccessKey
     * @test
     * @throws ReflectionException
     */
    public function remoteCallHasValidAccessKey()
    {
        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods(['isBrowserCall'])
            ->getMock();
        $oControllerMock->method('isBrowserCall')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'hasValidAccessKey',
                array('requAccessKey', 'requAccessKey')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::hasValidAccessKey
     * @test
     * @throws ReflectionException
     */
    public function remoteCallHasInvalidAccessKey()
    {
        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods(['isBrowserCall'])
            ->getMock();
        $oControllerMock->method('isBrowserCall')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oController,
                'hasValidAccessKey',
                array('requAccessKey', 'passedAccessKey')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::hasValidAccessKey
     * @test
     * @throws ReflectionException
     */
    public function serverCallDontRequireAccessKey()
    {
        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods(['isBrowserCall'])
            ->getMock();
        $oControllerMock->method('isBrowserCall')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'hasValidAccessKey',
                array('requAccessKey', 'passedAccessKey')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_checkUnavailableCronjob
     * @test
     * @throws ReflectionException
     */
    public function unavailableInactiveCronjobPass()
    {
        /** @var d3usermanager_cronUnavailableException|MockObject $oExceptionMock */
        $oExceptionMock = $this->getMockBuilder(d3usermanager_cronUnavailableException::class)
            ->setMethods(['debugOut'])
            ->getMock();
        $oExceptionMock->method('debugOut')->willReturn(true);

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['isActive'])
            ->getMock();
        $oModCfgMock->method('isActive')->willReturn(false);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_checkAccessKey',
                'getCronUnavailableException',
                '_getSet'
            ])
            ->getMock();
        $oControllerMock->method('_checkAccessKey')->willReturn(true);
        $oControllerMock->method('getCronUnavailableException')->willReturn($oExceptionMock);
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->expectException(d3usermanager_cronunavailableexception::class);

        $this->callMethod($this->_oController, '_checkUnavailableCronjob');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_checkUnavailableCronjob
     * @test
     * @throws ReflectionException
     */
    public function unavailableCronjobWrongAccessKeyPass()
    {
        /** @var d3usermanager_cronUnavailableException|MockObject $oExceptionMock */
        $oExceptionMock = $this->getMockBuilder(d3usermanager_cronUnavailableException::class)
            ->setMethods(['debugOut'])
            ->getMock();
        $oExceptionMock->method('debugOut')->willReturn(true);

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['isActive'])
            ->getMock();
        $oModCfgMock->method('isActive')->willReturn(true);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_checkAccessKey',
                'getCronUnavailableException',
                '_getSet'
            ])
            ->getMock();
        $oControllerMock->method('_checkAccessKey')->willReturn(false);
        $oControllerMock->method('getCronUnavailableException')->willReturn($oExceptionMock);
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->expectException(d3usermanager_cronunavailableexception::class);

        $this->callMethod($this->_oController, '_checkUnavailableCronjob');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_checkUnavailableCronjob
     * @test
     * @throws ReflectionException
     */
    public function unavailableEnabledCronjobPass()
    {
        /** @var d3usermanager_cronUnavailableException|MockObject $oExceptionMock */
        $oExceptionMock = $this->getMockBuilder(d3usermanager_cronUnavailableException::class)
            ->setMethods(['debugOut'])
            ->getMock();
        $oExceptionMock->method('debugOut')->willReturn(true);

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['isActive'])
            ->getMock();
        $oModCfgMock->expects($this->atLeastOnce())->method('isActive')->willReturn(true);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_checkAccessKey',
                'getCronUnavailableException',
                '_getSet',
                '_checkDisabledCronjob'])
            ->getMock();
        $oControllerMock->expects($this->any())->method('_checkAccessKey')->willReturn(true);
        $oControllerMock->method('getCronUnavailableException')->willReturn($oExceptionMock);
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);
        $oControllerMock->expects($this->any())->method('_checkDisabledCronjob')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            '_checkUnavailableCronjob'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_checkDisabledCronjob
     * @test
     * @throws ReflectionException
     */
    public function disabledCronjobWithDisabledMessagePass()
    {
        /** @var d3usermanager_cronUnavailableException|MockObject $oExceptionMock */
        $oExceptionMock = $this->getMockBuilder(d3usermanager_cronUnavailableException::class)
            ->setMethods(['debugOut'])
            ->getMock();
        $oExceptionMock->method('debugOut')->willReturn(true);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                'showDisabledMessage',
                'getCronUnavailableException'
            ])
            ->getMock();
        $oControllerMock->method('showDisabledMessage')->willReturn(true);
        $oControllerMock->method('getCronUnavailableException')->willReturn($oExceptionMock);

        $this->_oController = $oControllerMock;

        $this->expectException(d3usermanager_cronunavailableexception::class);

        $this->callMethod($this->_oController, '_checkDisabledCronjob');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_checkDisabledCronjob
     * @test
     * @throws ReflectionException
     */
    public function disabledCronjobWithInactiveCronPass()
    {
        /** @var d3usermanager_cronUnavailableException|MockObject $oExceptionMock */
        $oExceptionMock = $this->getMockBuilder(d3usermanager_cronUnavailableException::class)
            ->setMethods(['debugOut'])
            ->getMock();
        $oExceptionMock->method('debugOut')->willReturn(true);

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $map = [
            ['blCronActive', false]
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                'showDisabledMessage',
                'getCronUnavailableException',
                '_getSet'
            ])
            ->getMock();
        $oControllerMock->method('showDisabledMessage')->willReturn(false);
        $oControllerMock->method('getCronUnavailableException')->willReturn($oExceptionMock);
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->expectException(d3usermanager_cronunavailableexception::class);

        $this->callMethod($this->_oController, '_checkDisabledCronjob');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_checkDisabledCronjob
     * @test
     * @throws ReflectionException
     */
    public function disabledCronjobCheckDontPassWithEnabledCronjob()
    {
        /** @var d3usermanager_cronUnavailableException|MockObject $oExceptionMock */
        $oExceptionMock = $this->getMockBuilder(d3usermanager_cronUnavailableException::class)
            ->setMethods(['debugOut'])
            ->getMock();
        $oExceptionMock->method('debugOut')->willReturn(true);

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $map = [
            ['blCronActive', true]
        ];
        $oModCfgMock->expects($this->atLeastOnce())->method('getValue')
                                           ->with($this->equalTo('blCronActive'))->willReturnMap($map);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                'showDisabledMessage',
                'getCronUnavailableException',
                '_getSet'
            ])
            ->getMock();
        $oControllerMock->expects($this->any())->method('showDisabledMessage')->willReturn(false);
        $oControllerMock->method('getCronUnavailableException')->willReturn($oExceptionMock);
        $oControllerMock->method('_getSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->callMethod($this->_oController, '_checkDisabledCronjob');
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::getCronUnavailableException
     * @test
     * @throws ReflectionException
     */
    public function getCronUnavailableExceptionReturnsRightInstance()
    {
        /** @var d3usermanager_cronUnavailableException $oInstance */
        $oInstance = $this->callMethod(
            $this->_oController,
            'getCronUnavailableException',
            array('testMessage')
        );

        $this->assertInstanceOf(
            d3usermanager_cronUnavailableException::class,
            $oInstance
        );
        $this->assertEquals('testMessage', $oInstance->getMessage());
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_getCronJobIdParameter
     * @test
     * @throws ReflectionException
     */
    public function canGetUnsetCjIdParameter()
    {
        $_GET['cjid'] = null;

        $this->assertEquals(0, $this->callMethod($this->_oController, '_getCronJobIdParameter'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_getCronJobIdParameter
     * @test
     * @throws ReflectionException
     */
    public function canGetSetCjIdParameter()
    {
        $_GET['cjid'] = 'foo';

        $this->assertEquals('foo', $this->callMethod($this->_oController, '_getCronJobIdParameter'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_getCronTimestampVarName
     * @test
     * @throws ReflectionException
     */
    public function cronTimestampVarNameWithoutJobParameterPass()
    {
        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods(['_getCronJobIdParameter'])
            ->getMock();
        $oControllerMock->expects($this->any())->method('_getCronJobIdParameter')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertContains('Timestamp', $this->callMethod($this->_oController, '_getCronTimestampVarName'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::_getCronTimestampVarName
     * @test
     * @throws ReflectionException
     */
    public function cronTimestampVarNameWithJobParameterPass()
    {
        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods(['_getCronJobIdParameter'])
            ->getMock();
        $oControllerMock->expects($this->any())->method('_getCronJobIdParameter')->willReturn('testJobId');

        $this->_oController = $oControllerMock;

        $sReturn = $this->callMethod($this->_oController, '_getCronTimestampVarName');
        $this->assertContains('Timestamp', $sReturn);
        $this->assertContains('testJobId', $sReturn);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::getLastExecDate
     * @test
     * @throws ReflectionException
     */
    public function getLastExecDatePassed()
    {
        $testValue = 'testValue';

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $map = [
            ['tsVarName', $testValue]
        ];
        $oModCfgMock->method('getValue')->willReturnMap($map);

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_getCronTimestampVarName',
                '_getSet'
            ])
            ->getMock();
        $oControllerMock->expects($this->once())->method('_getCronTimestampVarName')->willReturn('tsVarName');
        $oControllerMock->expects($this->once())->method('_getSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $testValue,
            $this->callMethod(
                $this->_oController, 'getLastExecDate'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::getLastExecDateInfo
     * @test
     * @throws ReflectionException
     */
    public function getLastExecDateInfoPassed()
    {
        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->setMethods(['translateString'])
            ->getMock();
        $oLangMock->method('translateString')->willReturn('%1$s -- %2$s');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getAvailableCronjobIds'])
            ->getMock();
        $oManagerMock->method('getAvailableCronjobIds')->willReturn(
            [
                [
                    'id'    => 0,
                    'count' => 5
                ],
                [
                    'id'    => 1,
                    'count' => 9
                ],
                [
                    'id'    => 4,
                    'count' => 12
                ]
            ]
        );

        /** @var d3usermanager_response|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3usermanager_response::class)
            ->setMethods([
                '_getCronJobIdParameter',
                'getManager',
                'getLastExecDate',
                'getLang'
            ])
            ->getMock();
        $oControllerMock->expects($this->once())->method('_getCronJobIdParameter')->willReturn('1');
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getLastExecDate')->willReturn('2020-02-02');
        $oControllerMock->method('getLang')->willReturn($oLangMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            [
                0 => '1 -- 9',
                1 => '1 -- 2020-02-02'
            ],
            $this->callMethod(
                $this->_oController,
                'getLastExecDateInfo'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\d3usermanager_response::getLang
     * @test
     * @throws ReflectionException
     */
    public function getLangReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Language::class,
            $this->callMethod(
                $this->_oController,
                'getLang'
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
