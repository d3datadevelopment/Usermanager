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

namespace D3\Usermanager\tests\unit\Modules\Application\Model;

use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use D3\Usermanager\Modules\Application\Model\d3_order_usermanager;
use D3\Usermanager\Modules\Application\Model\d3_user_usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Registry;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;

class d3_user_usermanagerTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_user_usermanager */
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

        $this->_oModel = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
    }


    public function tearDown()
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
     */
    public function canSave()
    {
        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods(['d3GetUserSaveTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetUserSaveTriggeredManagerTasks')->willReturn(
            [
                oxNew(d3usermanager::class),
                oxNew(d3usermanager::class)
            ]
        );

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

        /** @var d3_user_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(User::class)
            ->setMethods(['d3UsermanagerGetManagerExecute'])
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
            ->setMethods(['assign', 'save'])
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
     * @param $sLicenseKey
     * @param d3usermanager $oManager
     * @return null
     */
    protected function _setModuleLicenseKey($sLicenseKey, $oManager = null)
    {
        return null;
    }
}
