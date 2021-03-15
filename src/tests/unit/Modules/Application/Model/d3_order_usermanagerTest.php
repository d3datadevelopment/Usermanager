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
 
declare(strict_types = 1);

namespace D3\Usermanager\tests\unit\Modules\Application\Model;

use D3\Usermanager\Application\Model\Actions\d3usermanager_action_setactiveflag;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_configurationcheck;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_actionException;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_requirementException;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_smartyException;
use D3\Usermanager\Modules\Application\Model\d3_order_usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\UtilsView;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;

class d3_order_usermanagerTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_order_usermanager */
    protected $_oModel;

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

        $this->_oModel = d3GetModCfgDIC()->get('d3ox.usermanager.'.Order::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->_oModel);
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_order_usermanager::finalizeOrder
     * @test
     * @throws ReflectionException
     */
    public function canFinalizeOrder()
    {
        /** @var d3usermanagerlist $managerList */
        $managerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
        $managerList->offsetSet('no1', oxNew(d3usermanager::class));
        $managerList->offsetSet('no2', oxNew(d3usermanager::class));

        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods(['d3GetOrderFinishTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetOrderFinishTriggeredManagerTasks')->willReturn($managerList);

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $oUserManagerListMock);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->setMethods([
                'userMeetsConditions',
                'exec4user'
            ])
            ->setConstructorArgs([oxNew(d3usermanager::class)])
            ->getMock();
        $oManagerExecuteMock->expects($this->exactly(2))->method('userMeetsConditions')->willReturn(true);
        $oManagerExecuteMock->expects($this->exactly(2))->method('exec4user')->willReturn(true);

        /** @var d3_order_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Order::class)
            ->setMethods(['d3UsermanagerGetManagerExecute'])
            ->getMock();
        $oModelMock->method('d3UsermanagerGetManagerExecute')->willReturn($oManagerExecuteMock);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'finalizeOrder',
            array(
                oxNew(Basket::class),
                oxNew(User::class)
            )
        );
    }

    /**
     * @covers       \D3\Usermanager\Modules\Application\Model\d3_order_usermanager::finalizeOrder
     * @test
     * @param $isAdmin
     * @throws ReflectionException
     * @dataProvider cannotSaveDataProvider
     */
    public function finalizeOrderCantExecuteUnvalidConfiguration($isAdmin)
    {
        /** @var d3usermanagerlist $managerList */
        $managerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
        $managerList->offsetSet('no1', oxNew(d3usermanager::class));
        $managerList->offsetSet('no2', oxNew(d3usermanager::class));

        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods(['d3GetOrderFinishTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetOrderFinishTriggeredManagerTasks')->willReturn($managerList);

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $oUserManagerListMock);

        /** @var d3usermanager_requirementException|MockObject $exception */
        $exception = $this->getMockBuilder(d3usermanager_requirementException::class)
            ->disableOriginalConstructor()
            ->setMethods(['debugOut'])
            ->getMock();
        $exception->expects($this->exactly(2))->method('debugOut')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->setMethods([
                'userMeetsConditions',
                'exec4user'
            ])
            ->setConstructorArgs([oxNew(d3usermanager::class)])
            ->getMock();
        $oManagerExecuteMock->expects($this->exactly(2))->method('userMeetsConditions')->willThrowException($exception);
        $oManagerExecuteMock->expects($this->never())->method('exec4user')->willReturn(true);

        /** @var UtilsView|MockObject $utilsViewMock */
        $utilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->setMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsViewMock->expects($isAdmin ? $this->exactly(2) : $this->never())
            ->method('addErrorToDisplay')->willReturn(true);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.UtilsView::class, $utilsViewMock);

        /** @var d3_order_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Order::class)
            ->setMethods(['d3UsermanagerGetManagerExecute', 'isAdmin'])
            ->getMock();
        $oModelMock->method('d3UsermanagerGetManagerExecute')->willReturn($oManagerExecuteMock);
        $oModelMock->method('isAdmin')->willReturn($isAdmin);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'finalizeOrder',
            array(
                oxNew(Basket::class),
                oxNew(User::class)
            )
        );
    }

    /**
     * @covers       \D3\Usermanager\Modules\Application\Model\d3_order_usermanager::finalizeOrder
     * @test
     * @param $isAdmin
     * @throws ReflectionException
     * @dataProvider cannotSaveDataProvider
     */
    public function finalizeOrderCantExecuteFetchingError($isAdmin)
    {
        /** @var d3usermanagerlist $managerList */
        $managerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
        $managerList->offsetSet('no1', oxNew(d3usermanager::class));
        $managerList->offsetSet('no2', oxNew(d3usermanager::class));

        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods(['d3GetOrderFinishTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetOrderFinishTriggeredManagerTasks')->willReturn($managerList);

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $oUserManagerListMock);

        /** @var d3usermanager_smartyException|MockObject $exception */
        $exception = $this->getMockBuilder(d3usermanager_smartyException::class)
            ->disableOriginalConstructor()
            ->setMethods(['debugOut'])
            ->getMock();
        $exception->expects($this->exactly(2))->method('debugOut')->willReturn(true);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->setMethods([
                'userMeetsConditions',
                'exec4user'
            ])
            ->setConstructorArgs([oxNew(d3usermanager::class)])
            ->getMock();
        $oManagerExecuteMock->expects($this->exactly(2))->method('userMeetsConditions')->willThrowException($exception);
        $oManagerExecuteMock->expects($this->never())->method('exec4user')->willReturn(true);

        /** @var UtilsView|MockObject $utilsViewMock */
        $utilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->setMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsViewMock->expects($isAdmin ? $this->exactly(2) : $this->never())
            ->method('addErrorToDisplay')->willReturn(true);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.UtilsView::class, $utilsViewMock);

        /** @var d3_order_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Order::class)
            ->setMethods(['d3UsermanagerGetManagerExecute', 'isAdmin'])
            ->getMock();
        $oModelMock->method('d3UsermanagerGetManagerExecute')->willReturn($oManagerExecuteMock);
        $oModelMock->method('isAdmin')->willReturn($isAdmin);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'finalizeOrder',
            array(
                oxNew(Basket::class),
                oxNew(User::class)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_order_usermanager::d3UsermanagerGetManagerExecute
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetManagerExecute()
    {
        $oManager = d3GetModCfgDIC()->get(d3usermanager::class);

        $this->assertInstanceOf(
            d3usermanager_execute::class,
            $this->callMethod(
                $this->_oModel,
                'd3UsermanagerGetManagerExecute',
                array(
                    $oManager
                )
            )
        );
    }

    /**
     * @return array
     */
    public function cannotSaveDataProvider(): array
    {
        return [
            'is admin'  => [true],
            'is frontend'  => [false],
        ];
    }

    /**
     * @covers       \D3\Usermanager\Modules\Application\Model\d3_order_usermanager::d3UserManagerCheckForConfigurationException
     * @test
     * @param $manuallyCondition
     * @param $expectedCheck
     * @param $throwExc
     * @throws ReflectionException
     * @throws Exception
     * @dataProvider d3UserManagerCheckForConfigurationExceptionDataProvider
     */
    public function d3UserManagerCheckForConfigurationExceptionPass($manuallyCondition, $expectedCheck, $throwExc)
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getValue'])
            ->getMock();
        $getValueMap = [
            ['blGetStornoArticles', false],
            ['sManuallyExecMeetCondition', $manuallyCondition]
        ];
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3usermanager_actionException $expectedExc */
        d3GetModCfgDIC()->set(d3usermanager_action_setactiveflag::class.'.args.usermanager', $oManagerMock);
        d3GetModCfgDIC()->set(d3usermanager_action_setactiveflag::class.'.args.user', d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class));
        d3GetModCfgDIC()->set(d3usermanager_actionException::class.'.args.actionobject', d3GetModCfgDIC()->get(d3usermanager_action_setactiveflag::class));
        $expectedExc = d3GetModCfgDIC()->get(d3usermanager_actionException::class);

        /** @var d3usermanager_configurationcheck|MockObject $confCheckMock */
        $confCheckMock = $this->getMockBuilder(d3usermanager_configurationcheck::class)
            ->disableOriginalConstructor()
            ->setMethods(['checkThrowingExceptions'])
            ->getMock();
        $throwExc ?
            $confCheckMock->expects($this->once())->method('checkThrowingExceptions')->willThrowException($expectedExc) :
            $confCheckMock->expects($this->once())->method('checkThrowingExceptions')->willReturn(true);

        d3GetModCfgDIC()->set(d3usermanager_configurationcheck::class, $confCheckMock);

        if ($throwExc) {
            $this->expectException(get_class($expectedExc));
        }

        $this->callMethod(
            $this->_oModel,
            'd3UserManagerCheckForConfigurationException',
            [$oManagerMock]
        );

        $this->assertSame(
            $expectedCheck,
            d3GetModCfgDIC()->getParameter(d3usermanager_configurationcheck::class.'.args.checktypes')
        );
    }

    /**
     * @return array[]
     */
    public function d3UserManagerCheckForConfigurationExceptionDataProvider(): array
    {
        return [
            'requirements and actions throw exception' => [true, d3usermanager_configurationcheck::REQUIREMENTS_AND_ACTIONS, true],
            'requirements and actions don\'t throw exception' => [true, d3usermanager_configurationcheck::REQUIREMENTS_AND_ACTIONS, false],
            'actions only throw exception' => [false, d3usermanager_configurationcheck::ACTIONS_ONLY, true],
            'actions only don\'t throw exception' => [false, d3usermanager_configurationcheck::ACTIONS_ONLY, false],
        ];
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
