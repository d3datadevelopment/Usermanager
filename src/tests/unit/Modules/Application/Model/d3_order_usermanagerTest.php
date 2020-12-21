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
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
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
        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->setMethods(['d3GetOrderFinishTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetOrderFinishTriggeredManagerTasks')->willReturn(
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
     * @param $sLicenseKey
     * @param d3usermanager $oManager
     * @return null
     */
    protected function _setModuleLicenseKey($sLicenseKey, $oManager = null)
    {
        return null;
    }
}
