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
use D3\ModCfg\Application\Model\d3filesystem;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Exception\wrongModIdException;
use D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_configurationcheck;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanager_touserassignment;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_requirementException;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_smartyException;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_templaterendererExceptionInterface;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Exception;
use Monolog\Logger;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Session;
use OxidEsales\Eshop\Core\Model\ListModel;
use OxidEsales\Eshop\Core\UtilsView;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use ReflectionException;
use stdClass;

class d3_usermanager_jobsTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_usermanager_jobs */
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

        $this->_oController = d3GetModCfgDIC()->get(d3_usermanager_jobs::class);
    }

    public function tearDown() : void
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::__construct
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::__construct
     * @test
     */
    public function constructorException()
    {
        /** @var d3_usermanager_jobs|MockObject $controller */
        $controller = $this->getMockBuilder(d3_usermanager_jobs::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        d3GetModCfgDIC()->setParameter('d3.usermanager.modcfgid', 'differentModCfgid');

        $this->expectException(wrongModIdException::class);

        $this->callMethod(
            $controller,
            '__construct'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getItemObject
     * @test
     * @throws ReflectionException
     */
    public function getItemObjectReturnsRightInstance()
    {
        $this->assertInstanceOf(
            User::class,
            $this->callMethod($this->_oController, 'getItemObject')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3GetSession
     * @test
     * @throws ReflectionException
     */
    public function getSessionReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Session::class,
            $this->callMethod($this->_oController, 'd3GetSession')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::render
     * @test
     * @throws ReflectionException
     */
    public function renderPass()
    {
        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
                           ->onlyMethods(['load'])
                           ->getMock();
        $oItemMock->expects($this->once())->method('load')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getEditObjectId',
                'getItemObject',
                '_d3GetManuallyManagerJobs'
            ])
            ->getMock();
        $oControllerMock->method('getEditObjectId')->willReturn('testOxId');
        $oControllerMock->method('getItemObject')->willReturn($oItemMock);
        $oControllerMock->method('_d3GetManuallyManagerJobs')->willReturn($oManagerListMock);

        $this->_oController = $oControllerMock;

        $this->assertStringContainsStringIgnoringCase(
            '.tpl',
            $this->callMethod($this->_oController, 'render')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::changeFolder
     * @test
     * @throws ReflectionException
     */
    public function canChangeFolder()
    {
        $_POST['jobfolder'] = 'newSelectedFolder';

        /** @var Session|MockObject $oSessionMock */
        $oSessionMock = $this->getMockBuilder(Session::class)
            ->onlyMethods(['setVariable'])
            ->getMock();
        $oSessionMock->expects($this->once())->method('setVariable')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods(['d3GetSession'])
            ->getMock();
        $oControllerMock->method('d3GetSession')->willReturn($oSessionMock);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'changeFolder'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getManagerList
     * @test
     * @throws ReflectionException
     */
    public function getManagerListReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanagerlist::class,
            $this->callMethod($this->_oController, 'getManagerList')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3GetManagerJobs
     * @test
     * @throws ReflectionException
     */
    public function canGetManagerJobs()
    {
        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['getList'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('getList')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods(['getManagerList'])
            ->getMock();
        $oControllerMock->method('getManagerList')->willReturn($oManagerListMock);

        $this->_oController = $oControllerMock;

        $this->assertInstanceOf(
            d3usermanagerlist::class,
            $this->callMethod($this->_oController, 'd3GetManagerJobs')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::_d3GetManuallyManagerJobs
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetManuallyExecutableManagerJobsNoConditionCheck()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $oManagerMock->method('getValue')->willReturn(false);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods(['userMeetsConditions'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(true);

        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetManuallyManagerJobsByFolder', 'offsetUnset'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('d3GetManuallyManagerJobsByFolder')->willReturnSelf();
        $oManagerListMock->expects($this->never())->method('offsetUnset');
        $oManagerListMock->offsetSet('No1', $oManagerMock);
        $oManagerListMock->offsetSet('No2', $oManagerMock);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManagerList',
                'getManagerExecute'
            ])
            ->getMock();
        $oControllerMock->method('getManagerList')->willReturn($oManagerListMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $generatedList = $this->callMethod(
            $this->_oController,
            '_d3GetManuallyManagerJobs',
            array('sTestFolderId')
        );
        $this->assertInstanceOf(
            ListModel::class,
            $generatedList
        );
        $this->assertCount(2, $generatedList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::_d3GetManuallyManagerJobs
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetManuallyExecutableManagerJobsConditionCheckPass()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $oManagerMock->method('getValue')->willReturn(false);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods(['userMeetsConditions'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->method('userMeetsConditions')->will($this->onConsecutiveCalls(false, true));

        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetManuallyManagerJobsByFolder', 'offsetUnset'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('d3GetManuallyManagerJobsByFolder')->willReturnSelf();
        $oManagerListMock->expects($this->never())->method('offsetUnset');
        $oManagerListMock->offsetSet('No1', $oManagerMock);
        $oManagerListMock->offsetSet('No2', $oManagerMock);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManagerList',
                'getManagerExecute'
            ])
            ->getMock();
        $oControllerMock->method('getManagerList')->willReturn($oManagerListMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $generatedList = $this->callMethod(
            $this->_oController,
            '_d3GetManuallyManagerJobs',
            array('sTestFolderId')
        );
        $this->assertInstanceOf(
            ListModel::class,
            $generatedList
        );
        $this->assertCount(2, $generatedList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::_d3GetManuallyManagerJobs
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetManuallyExecutableManagerJobsConditionCheckFailed()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods(['userMeetsConditions'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->method('userMeetsConditions')->will($this->onConsecutiveCalls(false, true));

        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetManuallyManagerJobsByFolder', 'offsetUnset'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('d3GetManuallyManagerJobsByFolder')->willReturnSelf();
        $oManagerListMock->expects($this->once())->method('offsetUnset');
        $oManagerListMock->offsetSet('No1', $oManagerMock);
        $oManagerListMock->offsetSet('No2', $oManagerMock);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManagerList',
                'getManagerExecute'
            ])
            ->getMock();
        $oControllerMock->method('getManagerList')->willReturn($oManagerListMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $generatedList = $this->callMethod(
            $this->_oController,
            '_d3GetManuallyManagerJobs',
            array('sTestFolderId')
        );
        $this->assertInstanceOf(
            ListModel::class,
            $generatedList
        );
        // offsetUnset doesn't work, because it's mocked
        // $this->assertCount(1, $generatedList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::_d3GetManuallyManagerJobs
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function cannotGetManuallyExecutableManagerJobsBecauseUnvalidConfiguration()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_requirementException|MockObject $exception */
        $exception = $this->getMockBuilder(d3usermanager_requirementException::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UtilsView|MockObject $utilsViewMock */
        $utilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsViewMock->expects($this->atLeastOnce())->method('addErrorToDisplay')->willReturn(true);
        d3GetModCfgDIC()->set('d3ox.usermanager.'.UtilsView::class, $utilsViewMock);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->addMethods(['orderMeetsConditions'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->method('orderMeetsConditions')->willThrowException($exception);

        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetManuallyManagerJobsByFolder', 'offsetUnset'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('d3GetManuallyManagerJobsByFolder')->willReturnSelf();
        $oManagerListMock->expects($this->never())->method('offsetUnset');
        $oManagerListMock->offsetSet('No1', $oManagerMock);
        $oManagerListMock->offsetSet('No2', $oManagerMock);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManagerList',
                'getManagerExecute'
            ])
            ->getMock();
        $oControllerMock->method('getManagerList')->willReturn($oManagerListMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $generatedList = $this->callMethod(
            $this->_oController,
            '_d3GetManuallyManagerJobs',
            array('sTestFolderId')
        );
        $this->assertInstanceOf(
            ListModel::class,
            $generatedList
        );
        $this->assertEmpty($generatedList);
        // offsetUnset doesn't work, because it's mocked
        // $this->assertCount(1, $generatedList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3GetJobList
     * @test
     * @throws ReflectionException
     */
    public function canGetJobList()
    {
        $aArray = array(
            '1' => '2',
        );

        /** @var ListModel|MockObject $oJobListMock */
        $oJobListMock = $this->getMockBuilder(ListModel::class)
            ->onlyMethods(['getArray'])
            ->getMock();
        $oJobListMock->method('getArray')->willReturn($aArray);

        $this->setValue($this->_oController, '_aJobList', $oJobListMock);

        $this->assertSame(
            $aArray,
            $this->callMethod(
                $this->_oController,
                'd3GetJobList'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getManager
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getManagerExecute
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3execusermanager
     * @test
     * @throws ReflectionException
     */
    public function usermanagerStartExecutionNoConditionCheck()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->never())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(false);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->expects($this->once())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(false);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManager',
                'getManagerExecute'
            ])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'd3execusermanager'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3execusermanager
     * @test
     * @throws ReflectionException
     */
    public function usermanagerStartExecutionConditionCheckPass()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->never())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->expects($this->once())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManager',
                'getManagerExecute',
                'checkForConfigurationException'
            ])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'd3execusermanager'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3execusermanager
     * @test
     * @param $exceptionClass
     * @throws ReflectionException
     * @dataProvider cannotExecChangedContentsBecauseOfExceptionDataProvider
     */
    public function usermanagerStartExecutionConditionCheckFailed($exceptionClass)
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->never())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->expects($this->never())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->never())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(false);

        /** @var Logger|MockObject $loggerMock */
        $loggerMock = $this->getMockBuilder(Logger::class)
           ->disableOriginalConstructor()
           ->onlyMethods(['error'])
           ->getMock();
        $loggerMock->expects($this->once())->method('error');

        d3GetModCfgDIC()->set('d3ox.usermanager.Logger', $loggerMock);

        /** @var d3usermanager_requirementException|d3usermanager_templaterendererExceptionInterface|MockObject $exception */
        $exception = $this->getMockBuilder($exceptionClass)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManager',
                'getManagerExecute',
                'checkForConfigurationException',
            ])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);
        $oControllerMock->method('checkForConfigurationException')->willThrowException($exception);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'd3execusermanager'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3ExecChangedUserManager
     * @test
     * @throws ReflectionException
     */
    public function changedUsermanagerStartExecutionNoConditionCheck()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->once())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(false);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->expects($this->once())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(false);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManager',
                'getManagerExecute'
            ])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'd3ExecChangedUserManager'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3ExecChangedUserManager
     * @test
     * @throws ReflectionException
     */
    public function changedUsermanagerStartExecutionConditionCheckPass()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->once())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->expects($this->once())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManager',
                'getManagerExecute',
                'checkForConfigurationException'
            ])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'd3ExecChangedUserManager'
        );
    }

    /**
     * @covers       \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3ExecChangedUserManager
     * @test
     * @param $exceptionClass
     * @throws ReflectionException
     * @dataProvider cannotExecChangedContentsBecauseOfExceptionDataProvider
     */
    public function changedUsermanagerStartExecutionConditionCheckFailed($exceptionClass)
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->once())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->expects($this->never())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->never())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(false);

        /** @var Logger|MockObject $loggerMock */
        $loggerMock = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['error'])
            ->getMock();
        $loggerMock->expects($this->once())->method('error');

        d3GetModCfgDIC()->set('d3ox.usermanager.Logger', $loggerMock);

        /** @var d3usermanager_requirementException|d3usermanager_templaterendererExceptionInterface|MockObject $exception */
        $exception = $this->getMockBuilder($exceptionClass)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManager',
                'getManagerExecute',
                'checkForConfigurationException'
            ])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getManagerExecute')->willReturn($oManagerExecuteMock);
        $oControllerMock->method('checkForConfigurationException')->willThrowException($exception);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'd3ExecChangedUserManager'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getUserManagerAssignment
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function userManagerAssignmentReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanager_touserassignment::class,
            $this->callMethod(
                $this->_oController,
                'getUserManagerAssignment',
                array(d3GetModCfgDIC()->get(d3usermanager::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3resetUserManagerAssignment
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canStartResettingUserManagerAssignment()
    {
        /** @var d3usermanager_execute|MockObject $oManagerAssignmentMock */
        $oManagerAssignmentMock = $this->getMockBuilder(d3usermanager_touserassignment::class)
            ->onlyMethods(['resetAssignment'])
            ->setConstructorArgs([d3GetModCfgDIC()->get(d3usermanager::class)])
            ->getMock();
        $oManagerAssignmentMock->expects($this->once())->method('resetAssignment')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'getManager',
                'getUserManagerAssignment'
            ])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn(d3GetModCfgDIC()->get(d3usermanager::class));
        $oControllerMock->method('getUserManagerAssignment')->willReturn($oManagerAssignmentMock);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'd3resetUserManagerAssignment'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getFolderList
     * @test
     * @throws ReflectionException
     */
    public function canGetManagerFolderList()
    {
        $aFolderList = array(
            'Folder#1',
            'Folder#2',
        );

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['d3getSelectableFolderList'])
            ->getMock();
        $oManagerMock->expects($this->once())->method('d3getSelectableFolderList')->willReturn($aFolderList);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods(['getManager'])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $aFolderList,
            $this->callMethod(
                $this->_oController,
                'getFolderList'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::execChangedContents
     * @test
     * @throws ReflectionException
     */
    public function canExecChangedContents()
    {
        $_POST['oxid'] = 'testItemId';

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'load',
                'getEditableContent'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->once())->method('getEditableContent')->with(
            $this->stringContains('testItemId')
        )->willReturn(['foo123' => 'bar']);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods(['getManager'])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'execChangedContents'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::execChangedContents
     * @test
     * @param $exceptionClass
     * @throws ReflectionException
     * @dataProvider cannotExecChangedContentsBecauseOfExceptionDataProvider
     */
    public function cannotExecChangedContentsBecauseOfException($exceptionClass)
    {
        $_POST['oxid'] = 'testItemId';

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'load',
                'getEditableContent'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->never())->method('getEditableContent')->with(
            $this->stringContains('testItemId')
        )->willReturn([]);

        /** @var d3usermanager_requirementException|MockObject $exception */
        $exception = $this->getMockBuilder($exceptionClass)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UtilsView|MockObject $utilsViewMock */
        $utilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsViewMock->expects($this->atLeastOnce())->method('addErrorToDisplay')->willReturn(true);
        d3GetModCfgDIC()->set('d3ox.usermanager.'.UtilsView::class, $utilsViewMock);

        /** @var Logger|MockObject $loggerMock */
        $loggerMock = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['error'])
            ->getMock();
        $loggerMock->expects($this->once())->method('error');

        d3GetModCfgDIC()->set('d3ox.usermanager.Logger', $loggerMock);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods(['getManager', 'checkForConfigurationException'])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('checkForConfigurationException')->willThrowException($exception);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'execChangedContents'
        );
    }

    /**
     * @return string[][]
     */
    public function cannotExecChangedContentsBecauseOfExceptionDataProvider(): array
    {
        return [
            'unvalid configuration' => [d3usermanager_requirementException::class],
            'smarty rendering error'    => [d3usermanager_smartyException::class]
        ];
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getUserMessages
     * @test
     * @throws ReflectionException
     */
    public function getUserMessagesHasRightType()
    {
        $this->assertIsArray($this->callMethod(
                $this->_oController,
                'getUserMessages'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getLang
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getHelpURL
     * @test
     * @throws ReflectionException
     */
    public function canGetHelpUrlWithExtension()
    {
        /** @var d3filesystem|MockObject $oFileSystemMock */
        $oFileSystemMock = $this->getMockBuilder(d3filesystem::class)
            ->onlyMethods(['splitFilename'])
            ->getMock();
        $oFileSystemMock->method('splitFilename')->willReturn(
            array('name' => 'filename', 'ext' => 'html')
        );

        d3GetModCfgDIC()->set(d3filesystem::class, $oFileSystemMock);

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->onlyMethods([
                'unprefixedslashit',
                'trailingslashit'
            ])
            ->getMock();
        $oD3StrMock->method('unprefixedslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));
        $oD3StrMock->expects($this->never())->method('trailingslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));

        d3GetModCfgDIC()->set(d3str::class, $oD3StrMock);

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods(['translateString'])
            ->getMock();
        $oLangMock->method('translateString')->willReturn('modulepath');

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['getHelpURL'])
            ->getMock();
        $oModCfgMock->method('getHelpURL')->willReturn('https://faq.d3data.de/module/');

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'd3GetSet',
                'getLang'
            ])
            ->getMock();
        $oControllerMock->method('d3GetSet')->willReturn($oModCfgMock);
        $oControllerMock->method('getLang')->willReturn($oLangMock);

        $this->setValue($oControllerMock, '_sHelpLinkMLAdd', 'foobar');

        $this->_oController = $oControllerMock;

        $this->assertEquals(
            'https://faq.d3data.de/module/modulepath',
            $this->callMethod($this->_oController, 'getHelpURL')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getHelpURL
     * @test
     * @throws ReflectionException
     */
    public function canGetHelpUrlWithoutExtension()
    {
        /** @var d3filesystem|MockObject $oFileSystemMock */
        $oFileSystemMock = $this->getMockBuilder(d3filesystem::class)
            ->onlyMethods(['splitFilename'])
            ->getMock();
        $oFileSystemMock->method('splitFilename')->willReturn(
            array('name' => 'filename', 'ext' => '')
        );

        d3GetModCfgDIC()->set(d3filesystem::class, $oFileSystemMock);

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->onlyMethods([
                'unprefixedslashit',
                'trailingslashit'
            ])
            ->getMock();
        $oD3StrMock->method('unprefixedslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));
        $oD3StrMock->expects($this->once())->method('trailingslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));

        d3GetModCfgDIC()->set(d3str::class, $oD3StrMock);

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods(['translateString'])
            ->getMock();
        $oLangMock->method('translateString')->willReturn('modulepath');

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['getHelpURL'])
            ->getMock();
        $oModCfgMock->method('getHelpURL')->willReturn('https://faq.d3data.de/module/');

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->onlyMethods([
                'd3GetSet',
                'getLang'
            ])
            ->getMock();
        $oControllerMock->method('d3GetSet')->willReturn($oModCfgMock);
        $oControllerMock->method('getLang')->willReturn($oLangMock);

        $this->setValue($oControllerMock, '_sHelpLinkMLAdd', 'foobar');

        $this->_oController = $oControllerMock;

        $this->assertEquals(
            'https://faq.d3data.de/module/modulepath',
            $this->callMethod($this->_oController, 'getHelpURL')
        );
    }

    /**
     * @return mixed
     */
    public function firstArgumentReturnCallback()
    {
        $args = func_get_args();
        return $args[0];
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3GetSet
     * @test
     * @throws ReflectionException
     */
    public function getSetReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3_cfg_mod::class,
            $this->callMethod($this->_oController, 'd3GetSet')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getLink
     * @test
     * @throws ReflectionException
     */
    public function getLinkReturnsString()
    {
        $this->assertIsString($this->callMethod(
                $this->_oController,
                'getLink'
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::checkForConfigurationException
     * @test
     * @param $configuration
     * @throws ReflectionException
     * @dataProvider canCheckForConfigurationExceptionDataProvider
     */
    public function canCheckForConfigurationException($configuration)
    {
        /** @var d3usermanager_configurationcheck|MockObject $confCheckMock */
        $confCheckMock = $this->getMockBuilder(d3usermanager_configurationcheck::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['checkThrowingExceptions'])
            ->getMock();
        $confCheckMock->expects($this->once())->method('checkThrowingExceptions');
        d3GetModCfgDIC()->set(d3usermanager_configurationcheck::class, $confCheckMock);

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $oManagerMock->method('getValue')->willReturn($configuration);

        $this->callMethod(
            $this->_oController,
            'checkForConfigurationException',
            [$oManagerMock]
        );
    }

    /**
     * @return array[]
     */
    public function canCheckForConfigurationExceptionDataProvider(): array
    {
        return [
            [d3usermanager_configurationcheck::REQUIREMENTS_AND_ACTIONS],
            [d3usermanager_configurationcheck::ACTIONS_ONLY]
        ];
    }
}
