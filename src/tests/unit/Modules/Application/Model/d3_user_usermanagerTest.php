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
use D3\Usermanager\Modules\Application\Model\d3_user_usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Exception;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;

class d3_user_usermanagerTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_user_usermanager */
    protected $_oModel;

    /**
     * setup basic requirements
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->_oModel = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
    }


    public function tearDown() : void
    {
        parent::tearDown();

        unset($this->_oModel);
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_user_usermanager::__get
     * @test
     * @throws ReflectionException
     */
    public function __getPass()
    {
        $expected = 'testValue';

        $this->_oModel->testProperty = $expected;

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oModel,
                '__get',
                array('testProperty')
            )
        );

        $this->assertNull(
            $this->callMethod(
                $this->_oModel,
                '__get',
                array('testUnsetProperty')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_user_usermanager::save
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canSave()
    {
        /** @var d3usermanagerlist $managerList */
        $managerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
        $managerList->offsetSet('no1', oxNew(d3usermanager::class));
        $managerList->offsetSet('no2', oxNew(d3usermanager::class));

        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetUserSaveTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetUserSaveTriggeredManagerTasks')->willReturn($managerList);

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $oUserManagerListMock);

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'userMeetsConditions',
                'exec4user'
            ])
            ->setConstructorArgs([oxNew(d3usermanager::class)])
            ->getMock();
        $oManagerExecuteMock->expects($this->exactly(2))->method('userMeetsConditions')->willReturn(true);
        $oManagerExecuteMock->expects($this->exactly(2))->method('exec4user')->willReturn(true);

        /** @var d3_user_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['d3UsermanagerGetManagerExecute'])
            ->getMock();
        $oModelMock->method('d3UsermanagerGetManagerExecute')->willReturn($oManagerExecuteMock);
        $orderId = Registry::getUtilsObject()->generateUId();
        $oModelMock->setId($orderId);
        $oModelMock->assign([
            'oxbillcompany' => __METHOD__
        ]);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'save'
        );

        $oModelMock->delete($orderId);
    }

    /**
     * @covers       \D3\Usermanager\Modules\Application\Model\d3_user_usermanager::save
     * @test
     * @param $isAdmin
     * @throws ReflectionException
     * @throws Exception
     * @dataProvider cannotSaveDataProvider
     */
    public function cannotSaveBecauseUnvalidConfiguration($isAdmin)
    {
        /** @var d3usermanagerlist $managerList */
        $managerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
        $managerList->offsetSet('no1', oxNew(d3usermanager::class));
        $managerList->offsetSet('no2', oxNew(d3usermanager::class));

        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetUserSaveTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetUserSaveTriggeredManagerTasks')->willReturn($managerList);

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $oUserManagerListMock);

        /** @var d3usermanager_requirementException|MockObject $exception */
        $exception = $this->getMockBuilder(d3usermanager_requirementException::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'userMeetsConditions',
                'exec4user'
            ])
            ->setConstructorArgs([oxNew(d3usermanager::class)])
            ->getMock();
        $oManagerExecuteMock->expects($this->exactly(2))->method('userMeetsConditions')->willThrowException($exception);
        $oManagerExecuteMock->expects($this->never())->method('exec4user')->willReturn(true);

        /** @var UtilsView|MockObject $utilsViewMock */
        $utilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsViewMock->expects($isAdmin ? $this->exactly(2) : $this->never())
            ->method('addErrorToDisplay')->willReturn(true);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.UtilsView::class, $utilsViewMock);

        /** @var d3_user_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['d3UsermanagerGetManagerExecute', 'isAdmin'])
            ->getMock();
        $oModelMock->method('d3UsermanagerGetManagerExecute')->willReturn($oManagerExecuteMock);
        $oModelMock->method('isAdmin')->willReturn($isAdmin);
        $orderId = Registry::getUtilsObject()->generateUId();
        $oModelMock->setId($orderId);
        $oModelMock->assign([
            'oxlname' => __METHOD__
        ]);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'save'
        );

        $oModelMock->delete($orderId);
    }

    /**
     * @covers       \D3\Usermanager\Modules\Application\Model\d3_user_usermanager::save
     * @test
     * @param $isAdmin
     * @throws ReflectionException
     * @throws Exception
     * @dataProvider cannotSaveDataProvider
     */
    public function cannotSaveBecauseFetchingError($isAdmin)
    {
        /** @var d3usermanagerlist $managerList */
        $managerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
        $managerList->offsetSet('no1', oxNew(d3usermanager::class));
        $managerList->offsetSet('no2', oxNew(d3usermanager::class));

        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetUserSaveTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetUserSaveTriggeredManagerTasks')->willReturn($managerList);

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $oUserManagerListMock);

        /** @var d3usermanager_smartyException|MockObject $exception */
        $exception = $this->getMockBuilder(d3usermanager_smartyException::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var d3usermanager_execute|MockObject $oManagerExecuteMock */
        $oManagerExecuteMock = $this->getMockBuilder(d3usermanager_execute::class)
            ->onlyMethods([
                'userMeetsConditions',
                'exec4user'
            ])
            ->setConstructorArgs([oxNew(d3usermanager::class)])
            ->getMock();
        $oManagerExecuteMock->expects($this->exactly(2))->method('userMeetsConditions')->willReturn(true);
        $oManagerExecuteMock->expects($this->exactly(2))->method('exec4user')->willThrowException($exception);

        /** @var UtilsView|MockObject $utilsViewMock */
        $utilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsViewMock->expects($isAdmin ? $this->exactly(2) : $this->never())
            ->method('addErrorToDisplay')->willReturn(true);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.UtilsView::class, $utilsViewMock);

        /** @var d3_user_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['d3UsermanagerGetManagerExecute', 'isAdmin'])
            ->getMock();
        $oModelMock->method('d3UsermanagerGetManagerExecute')->willReturn($oManagerExecuteMock);
        $oModelMock->method('isAdmin')->willReturn($isAdmin);
        $orderId = Registry::getUtilsObject()->generateUId();
        $oModelMock->setId($orderId);
        $oModelMock->assign([
            'oxlname' => __METHOD__
        ]);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'save'
        );

        $oModelMock->delete($orderId);
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
     * @covers \D3\Usermanager\Modules\Application\Model\d3_user_usermanager::d3UsermanagerGetManagerExecute
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
     * @covers \D3\Usermanager\Modules\Application\Model\d3_user_usermanager::d3usermanagerTestMethod
     * @test
     * @throws ReflectionException
     */
    public function d3usermanagerTestMethodPass()
    {
        /** @var d3_user_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['assign', 'save'])
            ->getMock();
        $oModelMock->expects($this->once())->method('assign')->willReturn(true);
        $oModelMock->expects($this->once())->method('save')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'd3usermanagerTestMethod'
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_user_usermanager::d3UserManagerCheckForConfigurationException
     * @test
     * @param $manuallyCondition
     * @param $expectedCheck
     * @param $throwExc
     * @throws ReflectionException
     * @dataProvider d3UserManagerCheckForConfigurationExceptionDataProvider
     */
    public function d3UserManagerCheckForConfigurationExceptionPass($manuallyCondition, $expectedCheck, $throwExc)
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
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
            ->onlyMethods(['checkThrowingExceptions'])
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
