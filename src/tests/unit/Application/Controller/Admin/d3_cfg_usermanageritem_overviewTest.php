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

use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ;
use D3\Usermanager\Application\Model\Actions\d3usermanager_actionlist;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_conf;
use D3\Usermanager\Application\Model\d3usermanager_configurationcheck;
use D3\Usermanager\Application\Model\d3usermanager_listgenerator;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_requirementException;
use D3\Usermanager\Application\Model\Requirements\d3usermanager_requirementlist;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\UtilsView;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use stdClass;

class d3_cfg_usermanageritem_overviewTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_cfg_usermanageritem_overview */
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

        $this->_oController = d3GetModCfgDIC()->get(d3_cfg_usermanageritem_overview::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::render
     * @test
     * @throws ReflectionException
     */
    public function renderThrowsException()
    {
        /** @var d3usermanager_requirementException|MockObject $excMock */
        $excMock = $this->getMockBuilder(d3usermanager_requirementException::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var d3usermanager_configurationcheck|MockObject $confCheckMock */
        $confCheckMock = $this->getMockBuilder(d3usermanager_configurationcheck::class)
            ->setMethods(['checkThrowingExceptions'])
            ->disableOriginalConstructor()
            ->getMock();
        $confCheckMock->method('checkThrowingExceptions')->willThrowException($excMock);

        d3GetModCfgDIC()->set(d3usermanager_configurationcheck::class, $confCheckMock);

        /** @var UtilsView|MockObject $utilsViewMock */
        $utilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->setMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsViewMock->expects($this->atLeastOnce())->method('addErrorToDisplay')->willReturn(true);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.UtilsView::class, $utilsViewMock);

        $this->callMethod(
            $this->_oController,
            'render'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::render
     * @test
     * @throws ReflectionException
     */
    public function renderDontThrowsException()
    {
        /** @var d3usermanager_configurationcheck|MockObject $confCheckMock */
        $confCheckMock = $this->getMockBuilder(d3usermanager_configurationcheck::class)
            ->setMethods(['checkThrowingExceptions'])
            ->disableOriginalConstructor()
            ->getMock();
        $confCheckMock->method('checkThrowingExceptions')->willReturn(true);

        d3GetModCfgDIC()->set(d3usermanager_configurationcheck::class, $confCheckMock);

        /** @var UtilsView|MockObject $utilsViewMock */
        $utilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->setMethods(['addErrorToDisplay'])
            ->getMock();
        $utilsViewMock->expects($this->never())->method('addErrorToDisplay')->willReturn(true);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.UtilsView::class, $utilsViewMock);

        $this->callMethod(
            $this->_oController,
            'render'
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getActionAdminController
     * @test
     * @throws ReflectionException
     */
    public function actionAdminControllerIsRightInstance()
    {
        $this->assertInstanceOf(
            d3_cfg_usermanageritem_action::class,
            $this->callMethod(
                $this->_oController,
                'getActionAdminController'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getRequirementAdminController
     * @test
     * @throws ReflectionException
     */
    public function requirementAdminControllerIsRightInstance()
    {
        $this->assertInstanceOf(
            d3_cfg_usermanageritem_requ::class,
            $this->callMethod(
                $this->_oController,
                'getRequirementAdminController'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::__call
     * @test
     * @throws ReflectionException
     */
    public function callFromActionItemClassPass()
    {
        $sMethodName = 'methodeName';
        $sOtherMethodName = 'otherMethodName';
        $mExpectedAction = 'returnValueAction';
        $mExpectedRequ = 'returnValueRequ';
        $mExpectedController = 'returnValueController';

        /** @var d3_cfg_usermanageritem_action|MockObject $oActionAdminControllerMock */
        $oActionAdminControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->setMethods([$sMethodName])
            ->getMock();
        $oActionAdminControllerMock
            ->expects($this->once())
            ->method($sMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedAction);

        /** @var d3_cfg_usermanageritem_requ|MockObject $oRequirementAdminControllerMock */
        $oRequirementAdminControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->setMethods([$sOtherMethodName])
            ->getMock();
        $oRequirementAdminControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedRequ);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getActionAdminController',
                'getRequirementAdminController',
                $sOtherMethodName
            ])
            ->getMock();
        $oControllerMock->method('getActionAdminController')->willReturn($oActionAdminControllerMock);
        $oControllerMock->method('getRequirementAdminController')->willReturn($oRequirementAdminControllerMock);
        $oControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedController);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpectedAction,
            $this->callMethod(
                $this->_oController,
                '__call',
                array($sMethodName, array('sArg1'))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::__call
     * @test
     * @throws ReflectionException
     */
    public function callFromRequItemClassPass()
    {
        $sMethodName = 'methodeName';
        $sOtherMethodName = 'otherMethodName';
        $mExpectedAction = 'returnValueAction';
        $mExpectedRequ = 'returnValueRequ';
        $mExpectedController = 'returnValueController';

        /** @var d3_cfg_usermanageritem_action|MockObject $oActionAdminControllerMock */
        $oActionAdminControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->setMethods([$sOtherMethodName])
            ->getMock();
        $oActionAdminControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedAction);

        /** @var d3_cfg_usermanageritem_requ|MockObject $oRequirementAdminControllerMock */
        $oRequirementAdminControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_requ::class)
            ->setMethods([$sMethodName])
            ->getMock();
        $oRequirementAdminControllerMock
            ->expects($this->once())
            ->method($sMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedRequ);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getActionAdminController',
                'getRequirementAdminController',
                $sOtherMethodName
            ])
            ->getMock();
        $oControllerMock->method('getActionAdminController')->willReturn($oActionAdminControllerMock);
        $oControllerMock->method('getRequirementAdminController')->willReturn($oRequirementAdminControllerMock);
        $oControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedController);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpectedRequ,
            $this->callMethod(
                $this->_oController,
                '__call',
                array($sMethodName, array('sArg1'))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::__call
     * @test
     * @throws ReflectionException
     */
    public function callFromControllerClassPass()
    {
        $sMethodName = 'methodeName';
        $sOtherMethodName = 'otherMethodName';
        $mExpectedAction = 'returnValueAction';
        $mExpectedRequ = 'returnValueRequ';
        $mExpectedController = 'returnValueController';

        /** @var d3_cfg_usermanageritem_action|MockObject $oActionAdminControllerMock */
        $oActionAdminControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->setMethods([$sOtherMethodName])
            ->getMock();
        $oActionAdminControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedAction);

        /** @var d3_cfg_usermanageritem_requ|MockObject $oRequirementAdminControllerMock */
        $oRequirementAdminControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_requ::class)
            ->setMethods([$sOtherMethodName])
            ->getMock();
        $oRequirementAdminControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedRequ);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getActionAdminController',
                'getRequirementAdminController',
                $sMethodName
            ])
            ->getMock();
        $oControllerMock->method('getActionAdminController')->willReturn($oActionAdminControllerMock);
        $oControllerMock->method('getRequirementAdminController')->willReturn($oRequirementAdminControllerMock);
        $oControllerMock
            ->expects($this->once())
            ->method($sMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedController);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpectedController,
            $this->callMethod(
                $this->_oController,
                '__call',
                array($sMethodName, array('sArg1'))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::__call
     * @test
     * @throws ReflectionException
     */
    public function callDontPass()
    {
        $sMethodName = 'methodeName';
        $sOtherMethodName = 'otherMethodName';
        $mExpectedAction = 'returnValueAction';
        $mExpectedRequ = 'returnValueRequ';
        $mExpectedController = 'returnValueController';

        /** @var d3_cfg_usermanageritem_action|MockObject $oActionAdminControllerMock */
        $oActionAdminControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->setMethods([$sOtherMethodName])
            ->getMock();
        $oActionAdminControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedAction);

        /** @var d3_cfg_usermanageritem_requ|MockObject $oRequirementAdminControllerMock */
        $oRequirementAdminControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_requ::class)
            ->setMethods([$sOtherMethodName])
            ->getMock();
        $oRequirementAdminControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedRequ);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getActionAdminController',
                'getRequirementAdminController',
                $sOtherMethodName
            ])
            ->getMock();
        $oControllerMock->method('getActionAdminController')->willReturn($oActionAdminControllerMock);
        $oControllerMock->method('getRequirementAdminController')->willReturn($oRequirementAdminControllerMock);
        $oControllerMock
            ->expects($this->never())
            ->method($sOtherMethodName)
            ->with(
                $this->stringContains('sArg1')
            )
            ->willReturn($mExpectedController);

        $this->_oController = $oControllerMock;

        $this->expectException(SystemComponentException::class);

        $this->assertSame(
            $mExpectedController,
            $this->callMethod(
                $this->_oController,
                '__call',
                array($sMethodName, array('sArg1'))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getRequirementListObject
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function requirementListObjectIsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanager_requirementlist::class,
            $this->callMethod(
                $this->_oController,
                "getRequirementListObject",
                array(d3GetModCfgDIC()->get(d3usermanager::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getRequirementList
     * @test
     * @throws ReflectionException
     */
    public function canGetRequirementList()
    {
        $expected = [
            'test'  => 'item'
        ];

        /** @var d3usermanager_conf|MockObject $oManagerConfMock */
        $oManagerConfMock = $this->getMockBuilder(d3usermanager_conf::class)
            ->setMethods(['getRequirementIdList'])
            ->getMock();
        $oManagerConfMock->method('getRequirementIdList')->willReturn([]);

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getConfiguration'])
            ->getMock();
        $oProfileMock->method('getConfiguration')->willReturn($oManagerConfMock);

        /** @var d3usermanager_requirementlist|MockObject $oRequListMock */
        $oRequListMock = $this->getMockBuilder(d3usermanager_requirementlist::class)
            ->setMethods([
                'setRequirements',
                'getRequirementList'
            ])
            ->setConstructorArgs([$oProfileMock])
            ->getMock();
        $oRequListMock->method('setRequirements')->willReturn(true);
        $oRequListMock->expects($this->once())->method('getRequirementList')->willReturn($expected);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getProfile',
                'getRequirementListObject'
            ])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);
        $oControllerMock->method('getRequirementListObject')->willReturn($oRequListMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oController,
                "getRequirementList"
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getActionListObject
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function actionListObjectIsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanager_actionlist::class,
            $this->callMethod(
                $this->_oController,
                "getActionListObject",
                array(d3GetModCfgDIC()->get(d3usermanager::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getActionList
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetActionList()
    {
        $expected = [
            'test'  => 'item'
        ];

        /** @var d3usermanager_conf|MockObject $oManagerConfMock */
        $oManagerConfMock = $this->getMockBuilder(d3usermanager_conf::class)
            ->setMethods(['getActionIdList'])
            ->getMock();
        $oManagerConfMock->method('getActionIdList')->willReturn([]);

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getConfiguration'])
            ->getMock();
        $oProfileMock->method('getConfiguration')->willReturn($oManagerConfMock);

        /** @var d3usermanager_actionlist|MockObject $oActionListMock */
        $oActionListMock = $this->getMockBuilder(d3usermanager_actionlist::class)
            ->setMethods([
                'setActions',
                'getActionList'
            ])
            ->setConstructorArgs([$oProfileMock, d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class)])
            ->getMock();
        $oActionListMock->method('setActions')->willReturn(true);
        $oActionListMock->expects($this->once())->method('getActionList')->willReturn($expected);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getProfile',
                'getActionListObject'
            ])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);
        $oControllerMock->method('getActionListObject')->willReturn($oActionListMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oController,
                "getActionList"
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::isEditMode
     * @test
     * @throws ReflectionException
     */
    public function editModeIsBoolean()
    {
        $this->assertInternalType(
            'bool',
            $this->callMethod(
                $this->_oController,
                'isEditMode'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::setRequestData
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::_getRequestData
     * @test
     * @throws ReflectionException
     */
    public function canSetAndGetRequestData()
    {
        $sExpected = 'testData';
        $_POST['sRequestData'] = $sExpected;

        $this->callMethod($this->_oController, 'setRequestData');
        $this->assertSame($sExpected, $this->callMethod($this->_oController, '_getRequestData'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getToFinishedCount
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetToFinishedCountCanRequestData()
    {
        $mExpected = 255;

        /** @var d3usermanager_listgenerator|MockObject $oListGeneratorMock */
        $oListGeneratorMock = $this->getMockBuilder(d3usermanager_listgenerator::class)
            ->setMethods(['getConcernedItemCount'])
            ->setConstructorArgs([d3GetModCfgDIC()->get(d3usermanager::class)])
            ->getMock();
        $oListGeneratorMock->method('getConcernedItemCount')->willReturn($mExpected);

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getListGenerator'])
            ->getMock();
        $oProfileMock->method('getListGenerator')->willReturn($oListGeneratorMock);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'getProfile'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(true);
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getToFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getToFinishedCount
     * @test
     * @throws ReflectionException
     */
    public function canGetToFinishedCountHasRequestData()
    {
        $mExpected = 256;
        $_POST['toFinishedCount'] = $mExpected;

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'canUseRequestData'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(false);
        $oControllerMock->method('canUseRequestData')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getToFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getToFinishedCount
     * @test
     * @throws ReflectionException
     */
    public function canNotGetToFinishedCount()
    {
        /** @var Request|MockObject $requestMock */
        $requestMock = $this->getMockBuilder(Request::class)
            ->setMethods(['getRequestEscapedParameter'])
            ->getMock();
        $requestMock->method('getRequestEscapedParameter')
                    ->with($this->matches('toFinishedCount'))
                    ->willReturn(20);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.Request::class, $requestMock);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'canUseRequestData'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(false);
        $oControllerMock->method('canUseRequestData')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertEmpty(
            $this->callMethod(
                $this->_oController,
                'getToFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getFinishedCount
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetFinishedCountCanRequestData()
    {
        $mExpected = 257;

        /** @var d3usermanager_listgenerator|MockObject $oListGeneratorMock */
        $oListGeneratorMock = $this->getMockBuilder(d3usermanager_listgenerator::class)
            ->setMethods(['getFinishedItemCount'])
            ->setConstructorArgs([d3GetModCfgDIC()->get(d3usermanager::class)])
            ->getMock();
        $oListGeneratorMock->method('getFinishedItemCount')->willReturn($mExpected);

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getListGenerator'])
            ->getMock();
        $oProfileMock->method('getListGenerator')->willReturn($oListGeneratorMock);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'getProfile'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(true);
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getFinishedCount
     * @test
     * @throws ReflectionException
     */
    public function canGetFinishedCountHasRequestData()
    {
        $mExpected = 258;
        $_POST['finishedCount'] = $mExpected;

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'canUseRequestData'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(false);
        $oControllerMock->method('canUseRequestData')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getFinishedCount
     * @test
     * @throws ReflectionException
     */
    public function canNotGetFinishedCount()
    {
        /** @var Request|MockObject $requestMock */
        $requestMock = $this->getMockBuilder(Request::class)
                            ->setMethods(['getRequestEscapedParameter'])
                            ->getMock();
        $requestMock->method('getRequestEscapedParameter')
                    ->with($this->matches('finishedCount'))
                    ->willReturn(20);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.Request::class, $requestMock);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'canUseRequestData'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(false);
        $oControllerMock->method('canUseRequestData')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertEmpty(
            $this->callMethod(
                $this->_oController,
                'getFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getFinishedMonthCount
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetFinishedMonthCountCanRequestData()
    {
        $mExpected = 259;

        /** @var d3usermanager_listgenerator|MockObject $oListGeneratorMock */
        $oListGeneratorMock = $this->getMockBuilder(d3usermanager_listgenerator::class)
            ->setMethods(['getFinishedMonthItemCount'])
            ->setConstructorArgs([d3GetModCfgDIC()->get(d3usermanager::class)])
            ->getMock();
        $oListGeneratorMock->method('getFinishedMonthItemCount')->willReturn($mExpected);

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getListGenerator'])
            ->getMock();
        $oProfileMock->method('getListGenerator')->willReturn($oListGeneratorMock);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'getProfile'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(true);
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getFinishedMonthCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getFinishedMonthCount
     * @test
     * @throws ReflectionException
     */
    public function canGetFinishedMonthCountHasRequestData()
    {
        $mExpected = 260;
        $_POST['finishedMonthCount'] = $mExpected;

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'canUseRequestData'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(false);
        $oControllerMock->method('canUseRequestData')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getFinishedMonthCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getFinishedMonthCount
     * @test
     * @throws ReflectionException
     */
    public function canNotGetFinishedMonthCount()
    {
        /** @var Request|MockObject $requestMock */
        $requestMock = $this->getMockBuilder(Request::class)
                            ->setMethods(['getRequestEscapedParameter'])
                            ->getMock();
        $requestMock->method('getRequestEscapedParameter')
                    ->with($this->matches('finishedMonthCount'))
                    ->willReturn(20);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.Request::class, $requestMock);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'canUseRequestData'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(false);
        $oControllerMock->method('canUseRequestData')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertEmpty(
            $this->callMethod(
                $this->_oController,
                'getFinishedMonthCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getNotFinishedCount
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetNotFinishedCountCanRequestData()
    {
        $mExpected = 261;

        /** @var d3usermanager_listgenerator|MockObject $oListGeneratorMock */
        $oListGeneratorMock = $this->getMockBuilder(d3usermanager_listgenerator::class)
            ->setMethods(['getNotFinishedItemCount'])
            ->setConstructorArgs([d3GetModCfgDIC()->get(d3usermanager::class)])
            ->getMock();
        $oListGeneratorMock->method('getNotFinishedItemCount')->willReturn($mExpected);

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['getListGenerator'])
            ->getMock();
        $oProfileMock->method('getListGenerator')->willReturn($oListGeneratorMock);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'getProfile'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(true);
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getNotFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getNotFinishedCount
     * @test
     * @throws ReflectionException
     */
    public function canGetNotFinishedCountHasRequestData()
    {
        $mExpected = 262;
        $_POST['notFinishedCount'] = $mExpected;

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'canUseRequestData'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(false);
        $oControllerMock->method('canUseRequestData')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getNotFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getNotFinishedCount
     * @test
     * @throws ReflectionException
     */
    public function canNotGetNotFinishedMonthCount()
    {
        /** @var Request|MockObject $requestMock */
        $requestMock = $this->getMockBuilder(Request::class)
                            ->setMethods(['getRequestEscapedParameter'])
                            ->getMock();
        $requestMock->method('getRequestEscapedParameter')
                    ->with($this->matches('notFinishedCount'))
                    ->willReturn(20);

        d3GetModCfgDIC()->set('d3ox.usermanager.'.Request::class, $requestMock);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'canRequestData',
                'canUseRequestData'
            ])
            ->getMock();
        $oControllerMock->method('canRequestData')->willReturn(false);
        $oControllerMock->method('canUseRequestData')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertEmpty(
            $this->callMethod(
                $this->_oController,
                'getNotFinishedCount'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::canRequestData
     * @test
     * @throws ReflectionException
     */
    public function canRequestDataNoDemand()
    {
        $sFncName = 'fncName';

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['getDataOnDemand'])
            ->getMock();
        $oControllerMock->method('getDataOnDemand')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'canRequestData',
                array($sFncName)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::canRequestData
     * @test
     * @throws ReflectionException
     */
    public function canRequestDataOnDemandHasRequestData()
    {
        $sFncName = 'fncName';

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getDataOnDemand',
                '_getRequestData'
            ])
            ->getMock();
        $oControllerMock->method('getDataOnDemand')->willReturn(true);
        $oControllerMock->method('_getRequestData')->willReturn($sFncName);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'canRequestData',
                array($sFncName)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::canRequestData
     * @test
     * @throws ReflectionException
     */
    public function canRequestDataOnDemandHasNoRequestData()
    {
        $sFncName = 'fncName';

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getDataOnDemand',
                '_getRequestData'
            ])
            ->getMock();
        $oControllerMock->method('getDataOnDemand')->willReturn(true);
        $oControllerMock->method('_getRequestData')->willReturn('otherFncName');

        $this->_oController = $oControllerMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oController,
                'canRequestData',
                array($sFncName)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::canUseRequestData
     * @test
     * @throws ReflectionException
     */
    public function checkUsableRequestDataNoDemand()
    {
        $iRequestCount = '300';

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['getDataOnDemand'])
            ->getMock();
        $oControllerMock->method('getDataOnDemand')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oController,
                'canUseRequestData',
                array($iRequestCount)
            )
        );
    }

    /**
     * @covers       \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::canUseRequestData
     * @test
     *
     * @param $dataOnDemand
     * @param $requestData
     * @param $expected
     *
     * @throws ReflectionException
     * @dataProvider checkUsableRequestDataOnDemandDataProvider
     */
    public function checkUsableRequestDataOnDemandPass($dataOnDemand, $requestData, $expected)
    {
        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['getDataOnDemand'])
            ->getMock();
        $oControllerMock->method('getDataOnDemand')->willReturn($dataOnDemand);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oController,
                'canUseRequestData',
                [ $requestData ]
            )
        );
    }

    /**
     * @return array[]
     */
    public function checkUsableRequestDataOnDemandDataProvider(): array
    {
        return [
            'noDOD' =>  [false, '10', false],
            'intRequest' =>  [true, 10, true],
            'stringRequest' =>  [true, '10', true],
            'falseRequest' =>  [true, false, false],
            'nullRequest' =>  [true, null, false],
        ];
    }

    /**
     * @covers       \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getDataOnDemand
     * @test
     *
     * @param $onDemandSetting
     * @param $expected
     *
     * @throws ReflectionException
     * @dataProvider dataOnDemandOptionPassDataProvider
     */
    public function dataOnDemandOptionPass($onDemandSetting, $expected)
    {
        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getValue'])
            ->getMock();
        $oModCfgMock->method('getValue')->willReturn($onDemandSetting);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['d3GetSet'])
            ->getMock();
        $oControllerMock->method('d3GetSet')->willReturn($oModCfgMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oController,
                'getDataOnDemand'
            )
        );
    }

    /**
     * @return array[]
     */
    public function dataOnDemandOptionPassDataProvider(): array
    {
        return [
            'onDemand unset'  => [null, false],
            'onDemand not set'  => ['0', false],
            'onDemand set'  => ['1', true],
        ];
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::hasRequestedData
     * @test
     * @throws ReflectionException
     */
    public function hasRequestedDataHasData()
    {
        $_POST['sRequestName'] = 400;
        $sFncName = 'fncName';

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['_getRequestData'])
            ->getMock();
        $oControllerMock->method('_getRequestData')->willReturn($sFncName);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'hasRequestedData',
                array('sRequestName', $sFncName)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::hasRequestedData
     * @test
     * @throws ReflectionException
     */
    public function hasRequestedDataHasNoData()
    {
        $_POST['sRequestName'] = null;
        $sFncName = 'fncName';

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['_getRequestData'])
            ->getMock();
        $oControllerMock->method('_getRequestData')->willReturn($sFncName);

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'hasRequestedData',
                array('sRequestName', $sFncName)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::hasRequestedData
     * @test
     * @throws ReflectionException
     */
    public function hasRequestedDataHasOtherFunctionName()
    {
        $_POST['sRequestName'] = 401;
        $sFncName = 'fncName';

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['_getRequestData'])
            ->getMock();
        $oControllerMock->method('_getRequestData')->willReturn('otherFncName');

        $this->_oController = $oControllerMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oController,
                'hasRequestedData',
                array('sRequestName', $sFncName)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::hasRequestedData
     * @test
     * @throws ReflectionException
     */
    public function hasRequestedDataHasNoDataAndOtherFunctionName()
    {
        $_POST['sRequestName'] = null;
        $sFncName = 'fncName';

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['_getRequestData'])
            ->getMock();
        $oControllerMock->method('_getRequestData')->willReturn('otherFncName');

        $this->_oController = $oControllerMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oController,
                'hasRequestedData',
                array('sRequestName', $sFncName)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getManager
     * @test
     * @throws ReflectionException
     */
    public function getManagerReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanager::class,
            $this->callMethod(
                $this->_oController,
                'getManager'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getLang
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getManagerTitle
     * @test
     * @throws ReflectionException
     */
    public function getManagerTitleFromObjectPass()
    {
        $mExpected = 'managerTitleFromObject';

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'load',
                'getFieldData'
            ])
            ->getMock();
        $oManagerMock->method('load')->willReturn(true);
        $oManagerMock->method('getFieldData')->willReturn($mExpected);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods(['getManager'])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            $mExpected,
            $this->callMethod(
                $this->_oController,
                'getManagerTitle',
                array('sManagerId')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview::getManagerTitle
     * @test
     * @throws ReflectionException
     */
    public function getManagerTitleFromTranslationPass()
    {
        $mExpected = 'managerTitleFromTranslation';

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->setMethods(['translateString'])
            ->getMock();
        $oLangMock->method('translateString')->willReturn($mExpected);

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'load',
                'getFieldData'
            ])
            ->getMock();
        $oManagerMock->method('load')->willReturn(false);
        $oManagerMock->method('getFieldData')->willReturn($mExpected);

        /** @var d3_cfg_usermanageritem_overview|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_overview::class)
            ->setMethods([
                'getManager',
                'getLang'
            ])
            ->getMock();
        $oControllerMock->method('getManager')->willReturn($oManagerMock);
        $oControllerMock->method('getLang')->willReturn($oLangMock);

        $this->_oController = $oControllerMock;

        $sTitle = $this->callMethod(
            $this->_oController,
            'getManagerTitle',
            array('sManagerId')
        );

        $this->assertRegExp('@'.$mExpected.'@i', $sTitle);
        $this->assertRegExp('@sManagerId@i', $sTitle);
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
