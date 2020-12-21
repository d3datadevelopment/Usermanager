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
use D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanager_touserassignment;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Session;
use OxidEsales\Eshop\Core\Model\ListModel;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use stdClass;

class d3_usermanager_jobsTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_usermanager_jobs */
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

        $this->_oController = d3GetModCfgDIC()->get(d3_usermanager_jobs::class);
    }

    public function tearDown()
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
        /** @var Order|MockObject $oOrderMock */
        $oOrderMock = $this->getMockBuilder(Order::class)
            ->setMethods(['load'])
            ->getMock();
        $oOrderMock->expects($this->once())->method('load')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
                'getEditObjectId',
                'getItemObject',
                '_d3GetManuallyManagerJobs'
            ])
            ->getMock();
        $oControllerMock->method('getEditObjectId')->willReturn('testOxId');
        $oControllerMock->method('getItemObject')->willReturn($oOrderMock);
        $oControllerMock->method('_d3GetManuallyManagerJobs')->willReturn($oOrderMock);

        $this->_oController = $oControllerMock;

        $this->assertContains(
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
            ->setMethods(['setVariable'])
            ->getMock();
        $oSessionMock->expects($this->once())->method('setVariable')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods(['d3GetSession'])
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
            ->setMethods(['getList'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('getList')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods(['getManagerList'])
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
            ->setMethods(['getValue'])
            ->getMock();
        $oManagerMock->method('getValue')->willReturn(false);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->setMethods(['userMeetsConditions'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(true);

        /** @var ListModel|MockObject $oListMock */
        $oListMock = $this->getMockBuilder(ListModel::class)
            ->setMethods(['offsetUnset'])
            ->getMock();
        $oListMock->expects($this->never())->method('offsetUnset');
        $oListMock->offsetSet('No1', $oManagerMock);
        $oListMock->offsetSet('No2', $oManagerMock);

        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods(['d3GetManuallyManagerJobsByFolder'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('d3GetManuallyManagerJobsByFolder')->willReturn($oListMock);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
            ->setMethods(['getValue'])
            ->getMock();
        $oManagerMock->method('getValue')->willReturn(false);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->setMethods(['userMeetsConditions'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->method('userMeetsConditions')->will($this->onConsecutiveCalls(false, true));

        /** @var ListModel|MockObject $oListMock */
        $oListMock = $this->getMockBuilder(ListModel::class)
            ->setMethods(['offsetUnset'])
            ->getMock();
        $oListMock->expects($this->never())->method('offsetUnset');
        $oListMock->offsetSet('No1', $oManagerMock);
        $oListMock->offsetSet('No2', $oManagerMock);

        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods(['d3GetManuallyManagerJobsByFolder'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('d3GetManuallyManagerJobsByFolder')->willReturn($oListMock);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
            ->setMethods(['getValue'])
            ->getMock();
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->setMethods(['userMeetsConditions'])
            ->setConstructorArgs([$oManagerMock])
            ->getMock();
        $oManagerExecuteMock->method('userMeetsConditions')->will($this->onConsecutiveCalls(false, true));

        /** @var ListModel|MockObject $oListMock */
        $oListMock = $this->getMockBuilder(ListModel::class)
            ->setMethods(['offsetUnset'])
            ->getMock();
        $oListMock->expects($this->once())->method('offsetUnset');
        $oListMock->offsetSet('No1', $oManagerMock);
        $oListMock->offsetSet('No2', $oManagerMock);

        /** @var d3usermanagerlist|MockObject $oManagerListMock */
        $oManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods(['d3GetManuallyManagerJobsByFolder'])
            ->getMock();
        $oManagerListMock->expects($this->once())->method('d3GetManuallyManagerJobsByFolder')->willReturn($oListMock);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
            ->setMethods(['getArray'])
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
            ->setMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->never())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(false);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->getMock();
        $oManagerExecuteMock->expects($this->once())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(false);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
            ->setMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->never())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->getMock();
        $oManagerExecuteMock->expects($this->once())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
    public function usermanagerStartExecutionConditionCheckFailed()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->never())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->getMock();
        $oManagerExecuteMock->expects($this->never())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->never())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(false);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::d3ExecChangedUserManager
     * @test
     * @throws ReflectionException
     */
    public function changedUsermanagerStartExecutionNoConditionCheck()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->once())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(false);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->getMock();
        $oManagerExecuteMock->expects($this->once())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(false);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
            ->setMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->once())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->getMock();
        $oManagerExecuteMock->expects($this->once())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->once())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
    public function changedUsermanagerStartExecutionConditionCheckFailed()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'load',
                'setEditedValues',
                'getValue'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->once())->method('setEditedValues')->willReturn(true);
        $oManagerMock->method('getValue')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'exec4user',
                'finishJobExecution',
                'userMeetsConditions'
            ])
            ->getMock();
        $oManagerExecuteMock->expects($this->never())->method('exec4user')->willReturn(true);
        $oManagerExecuteMock->expects($this->never())->method('finishJobExecution')->willReturn(true);
        $oManagerExecuteMock->method('userMeetsConditions')->willReturn(false);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
            ->setMethods(['resetAssignment'])
            ->setConstructorArgs([d3GetModCfgDIC()->get(d3usermanager::class)])
            ->getMock();
        $oManagerAssignmentMock->expects($this->once())->method('resetAssignment')->willReturn(true);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
            ->setMethods(['d3getSelectableFolderList'])
            ->getMock();
        $oManagerMock->expects($this->once())->method('d3getSelectableFolderList')->willReturn($aFolderList);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods(['getManager'])
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
            ->setMethods([
                'load',
                'getEditableContent'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('load')->willReturn(true);
        $oManagerMock->expects($this->exactly(2))->method('getEditableContent')->with(
            $this->stringContains('testItemId')
        )->willReturn(['foo123' => 'bar']);

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods(['getManager'])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);

        $this->_oController = $oControllerMock;

        $this->callMethod(
            $this->_oController,
            'execChangedContents'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs::getUserMessages
     * @test
     * @throws ReflectionException
     */
    public function getUserMessagesHasRightType()
    {
        $this->assertInternalType(
            'array',
            $this->callMethod(
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
            ->setMethods(['splitFilename'])
            ->getMock();
        $oFileSystemMock->method('splitFilename')->willReturn(
            array('name' => 'filename', 'ext' => 'html')
        );

        d3GetModCfgDIC()->set(d3filesystem::class, $oFileSystemMock);

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->setMethods([
                'unprefixedslashit',
                'trailingslashit'
            ])
            ->getMock();
        $oD3StrMock->method('unprefixedslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));
        $oD3StrMock->expects($this->never())->method('trailingslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));

        d3GetModCfgDIC()->set(d3str::class, $oD3StrMock);

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->setMethods(['translateString'])
            ->getMock();
        $oLangMock->method('translateString')->willReturn('modulepath');

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getHelpURL'])
            ->getMock();
        $oModCfgMock->method('getHelpURL')->willReturn('https://faq.d3data.de/module/');

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
            ->setMethods(['splitFilename'])
            ->getMock();
        $oFileSystemMock->method('splitFilename')->willReturn(
            array('name' => 'filename', 'ext' => '')
        );

        d3GetModCfgDIC()->set(d3filesystem::class, $oFileSystemMock);

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->setMethods([
                'unprefixedslashit',
                'trailingslashit'
            ])
            ->getMock();
        $oD3StrMock->method('unprefixedslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));
        $oD3StrMock->expects($this->once())->method('trailingslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));

        d3GetModCfgDIC()->set(d3str::class, $oD3StrMock);

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->setMethods(['translateString'])
            ->getMock();
        $oLangMock->method('translateString')->willReturn('modulepath');

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getHelpURL'])
            ->getMock();
        $oModCfgMock->method('getHelpURL')->willReturn('https://faq.d3data.de/module/');

        /** @var d3_usermanager_jobs|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_usermanager_jobs::class)
            ->setMethods([
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
        $this->assertInternalType(
            'string',
            $this->callMethod(
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
}