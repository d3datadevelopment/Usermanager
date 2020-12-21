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

use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_settings;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Model\BaseModel;
use OxidEsales\Eshop\Core\Model\ListModel;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;

class d3_cfg_usermanageritem_settingsTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_cfg_usermanageritem_settings */
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

        $this->_oController = d3GetModCfgDIC()->get(d3_cfg_usermanageritem_settings::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_settings::__construct
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_settings::getGroupsList
     * @test
     * @throws ReflectionException
     */
    public function getGroupsListReturnsRightInstance()
    {
        /** @var d3_cfg_usermanageritem_settings|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_settings::class)
            ->setMethods(['_getObjectList'])
            ->getMock();
        $oControllerMock->method('_getObjectList')->will($this->returnCallback(function ($arg1) {
            return $arg1;
        }));

        $this->_oController = $oControllerMock;

        $this->assertInstanceOf(
            ListModel::class,
            $this->callMethod($this->_oController, 'getGroupsList')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_settings::_getObjectList
     * @test
     * @throws ReflectionException
     */
    public function getObjectListWillGetAllItemsFromDb()
    {
        /** @var BaseModel|MockObject $oBaseMock */
        $oBaseMock = $this->getMockBuilder(BaseModel::class)
            ->setMethods([
                'isMultilang',
                'setLanguage',
                'getSelectFields',
                'getViewName'])
            ->getMock();
        $oBaseMock->method('isMultilang')->willReturn(true);
        $oBaseMock->method('setLanguage')->willReturn(true);
        $oBaseMock->method('getSelectFields')->willReturn('oxid, oxtitle');
        $oBaseMock->method('getViewName')->willReturn('testViewTableName');

        /** @var ListModel|MockObject $oListMock */
        $oListMock = $this->getMockBuilder(ListModel::class)
            ->setMethods([
                'selectString',
                'getBaseObject'
            ])
            ->getMock();
        $oListMock->expects($this->once())->method('selectString')->with(
            $this->logicalAnd(
                $this->stringContains('oxid, oxtitle'),
                $this->stringContains('testViewTableName'),
                $this->stringContains('testWhere'),
                $this->stringContains('testOrderBy')
            )
        )->willReturn(true);
        $oListMock->method('getBaseObject')->willReturn($oBaseMock);

        $this->assertSame(
            $oListMock,
            $this->callMethod(
                $this->_oController,
                '_getObjectList',
                array($oListMock, 'testwhere', 'testorderby')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_settings::isEditMode
     * @test
     * @throws ReflectionException
     */
    public function editModeIsTrue()
    {
        $this->assertTrue(
            $this->callMethod($this->_oController, 'isEditMode')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_settings::getRestrictionMessage
     * @test
     * @throws ReflectionException
     */
    public function restrictionMessageCanGenerated()
    {
        $this->assertNotEmpty(
            $this->callMethod($this->_oController, 'getRestrictionMessage')
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