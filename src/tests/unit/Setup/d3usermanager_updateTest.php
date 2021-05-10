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

namespace D3\Usermanager\tests\unit\Setup;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3bitmask;
use D3\ModCfg\Application\Model\d3database;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Installwizzard\d3installdbrecord;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Setup\d3usermanager_update;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Driver\PDOStatement;
use Doctrine\DBAL\Query\QueryBuilder;
use Exception;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Application\Model\ShopList;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Database\Adapter\DatabaseInterface;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use stdClass;

class d3usermanager_updateTest extends d3UsermanagerUnitTestCase
{
    /** @var d3usermanager_update */
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

        $this->_oModel = d3GetModCfgDIC()->get(d3usermanager_update::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->_oModel);
    }

    public function dbInterfaceExecuteThrowException()
    {
        $oPDOException = oxNew(\PDOException::class);
        $oPDOException->errorInfo = array(
            1   => 'errorInfoNo1',
            2   => 'errorInfoNo1',
        );

        throw oxNew(PDOException::class, $oPDOException);
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::doesUser2UserManagerTableNotExist
     * @test
     * @throws ReflectionException
     */
    public function canCheckUser2UserManagerTableNotExist()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods(['_checkTableNotExist'])
            ->getMock();
        $oModelMock->expects($this->once())->method('_checkTableNotExist')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'doesUser2UserManagerTableNotExist'
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addUser2UserManagerTable
     * @test
     * @throws ReflectionException
     */
    public function canAddUser2UserManagerTable()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'doesUser2UserManagerTableNotExist',
                '_addTable2'
            ])
            ->getMock();
        $oModelMock->method('doesUser2UserManagerTableNotExist')->willReturn(true);
        $oModelMock->expects($this->once())->method('_addTable2')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'addUser2UserManagerTable'
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addUser2UserManagerTable
     * @test
     * @throws ReflectionException
     */
    public function canNotAddExistingUser2UserManagerTable()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'doesUser2UserManagerTableNotExist',
                '_addTable2'
            ])
            ->getMock();
        $oModelMock->method('doesUser2UserManagerTableNotExist')->willReturn(false);
        $oModelMock->expects($this->never())->method('_addTable2')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'addUser2UserManagerTable'
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::d3GetInstallDbRecord
     * @test
     * @throws ReflectionException
     */
    public function d3GetInstallDbRecordReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3installdbrecord::class,
            $this->callMethod(
                $this->_oModel,
                'd3GetInstallDbRecord'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::d3GetConfig
     * @test
     * @throws ReflectionException
     */
    public function d3GetConfigReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Config::class,
            $this->callMethod(
                $this->_oModel,
                'd3GetConfig'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::doesModCfgItemNotExist
     * @test
     * @throws ReflectionException
     */
    public function canCheckDoesModCfgItemNotExistPositive()
    {
        /** @var d3installdbrecord|MockObject $oInstallDbRecordMock */
        $oInstallDbRecordMock = $this->getMockBuilder(d3installdbrecord::class)
            ->setMethods(['checkTableRecordNotExist'])
            ->setConstructorArgs([$this->_oModel])
            ->getMock();
        $oInstallDbRecordMock->expects($this->once())->method('checkTableRecordNotExist')->willReturn(true);
        
        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->setMethods(['getShopIds'])
            ->getMock();
        $oConfigMock->method('getShopIds')->willReturn(array(1, 2));
        
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'd3GetConfig',
                'd3GetInstallDbRecord'
            ])
            ->getMock();
        $oModelMock->method('d3GetConfig')->willReturn($oConfigMock);
        $oModelMock->method('d3GetInstallDbRecord')->willReturn($oInstallDbRecordMock);

        $this->_oModel = $oModelMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oModel,
                'doesModCfgItemNotExist'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::doesModCfgItemNotExist
     * @test
     * @throws ReflectionException
     */
    public function canCheckDoesModCfgItemNotExistNegative()
    {
        /** @var d3installdbrecord|MockObject $oInstallDbRecordMock */
        $oInstallDbRecordMock = $this->getMockBuilder(d3installdbrecord::class)
            ->setMethods(['checkTableRecordNotExist'])
            ->setConstructorArgs([$this->_oModel])
            ->getMock();
        $oInstallDbRecordMock->expects($this->exactly(2))->method('checkTableRecordNotExist')->willReturn(false);

        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->setMethods(['getShopIds'])
            ->getMock();
        $oConfigMock->method('getShopIds')->willReturn(array(1, 2));

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'd3GetConfig',
                'd3GetInstallDbRecord'
            ])
            ->getMock();
        $oModelMock->method('d3GetConfig')->willReturn($oConfigMock);
        $oModelMock->method('d3GetInstallDbRecord')->willReturn($oInstallDbRecordMock);

        $this->_oModel = $oModelMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'doesModCfgItemNotExist'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addModCfgItem
     * @test
     * @throws ReflectionException
     */
    public function canAddModCfgItemNoStepByStep()
    {
        /** @var d3installdbrecord|MockObject $oInstallDbRecordMock */
        $oInstallDbRecordMock = $this->getMockBuilder(d3installdbrecord::class)
            ->setMethods(['checkTableRecordNotExist'])
            ->setConstructorArgs([$this->_oModel])
            ->getMock();
        $oInstallDbRecordMock->expects($this->exactly(2))->method('checkTableRecordNotExist')->willReturn(true);

        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->setMethods(['getShopIds'])
            ->getMock();
        $oConfigMock->method('getShopIds')->willReturn(array(1, 2));

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'doesModCfgItemNotExist',
                'd3GetConfig',
                'd3GetInstallDbRecord',
                'setInitialExecMethod',
            '_updateTableItem2',
            'getStepByStepMode'])
            ->getMock();
        $oModelMock->method('doesModCfgItemNotExist')->willReturn(true);
        $oModelMock->method('d3GetConfig')->willReturn($oConfigMock);
        $oModelMock->method('d3GetInstallDbRecord')->willReturn($oInstallDbRecordMock);
        $oModelMock->method('setInitialExecMethod')->willReturn(true);
        $oModelMock->expects($this->exactly(2))->method('_updateTableItem2')->willReturn(true);
        $oModelMock->method('getStepByStepMode')->willReturn(false);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'addModCfgItem'
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addModCfgItem
     * @test
     * @throws ReflectionException
     */
    public function canAddModCfgItemStepByStep()
    {
        /** @var d3installdbrecord|MockObject $oInstallDbRecordMock */
        $oInstallDbRecordMock = $this->getMockBuilder(d3installdbrecord::class)
            ->setMethods(['checkTableRecordNotExist'])
            ->setConstructorArgs([$this->_oModel])
            ->getMock();
        $oInstallDbRecordMock->expects($this->exactly(1))->method('checkTableRecordNotExist')->willReturn(true);

        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->setMethods(['getShopIds'])
            ->getMock();
        $oConfigMock->method('getShopIds')->willReturn(array(1, 2));

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'doesModCfgItemNotExist',
                'd3GetConfig',
                'd3GetInstallDbRecord',
                'setInitialExecMethod',
            '_updateTableItem2',
            'getStepByStepMode'])
            ->getMock();
        $oModelMock->method('doesModCfgItemNotExist')->willReturn(true);
        $oModelMock->method('d3GetConfig')->willReturn($oConfigMock);
        $oModelMock->method('d3GetInstallDbRecord')->willReturn($oInstallDbRecordMock);
        $oModelMock->method('setInitialExecMethod')->willReturn(true);
        $oModelMock->expects($this->exactly(1))->method('_updateTableItem2')->willReturn(true);
        $oModelMock->method('getStepByStepMode')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'addModCfgItem'
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addModCfgItem
     * @test
     * @throws ReflectionException
     */
    public function canNotAddExistingModCfgItem()
    {
        /** @var d3installdbrecord|MockObject $oInstallDbRecordMock */
        $oInstallDbRecordMock = $this->getMockBuilder(d3installdbrecord::class)
            ->setMethods(['checkTableRecordNotExist'])
            ->setConstructorArgs([$this->_oModel])
            ->getMock();
        $oInstallDbRecordMock->expects($this->never())->method('checkTableRecordNotExist')->willReturn(true);

        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->setMethods(['getShopIds'])
            ->getMock();
        $oConfigMock->method('getShopIds')->willReturn(array(1, 2));

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'doesModCfgItemNotExist',
                'd3GetConfig',
                'd3GetInstallDbRecord',
                'setInitialExecMethod',
            '_updateTableItem2',
            'getStepByStepMode'])
            ->getMock();
        $oModelMock->method('doesModCfgItemNotExist')->willReturn(false);
        $oModelMock->method('d3GetConfig')->willReturn($oConfigMock);
        $oModelMock->method('d3GetInstallDbRecord')->willReturn($oInstallDbRecordMock);
        $oModelMock->method('setInitialExecMethod')->willReturn(true);
        $oModelMock->expects($this->never())->method('_updateTableItem2')->willReturn(true);
        $oModelMock->method('getStepByStepMode')->willReturn(false);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'addModCfgItem'
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::checkCronPasswordSet
     * @test
     * @param $testPW
     * @param $expected
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws ReflectionException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws StandardException
     * @dataProvider passwordTestDataProvider
     */
    public function canCheckCronPasswordSet($testPW, $expected)
    {
        /** @var d3_cfg_mod $set */
        $set = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        $currPassword = $set->getValue('sCronPassword');
        $set->setValue('sCronPassword', $testPW);
        $set->saveNoLicenseRefresh();

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oModel,
                'checkCronPasswordSet'
            )
        );

        $set->setValue('sCronPassword', $currPassword);
        $set->saveNoLicenseRefresh();
    }

    /**
     * @return array[]
     */
    public function passwordTestDataProvider()
    {
        return [
            [false, true],
            [null, true],
            ['', true],
            ['abc', false],
            ['123', false],
            ['%_(', false],
        ];
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::createCronPassword
     * @test
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws ReflectionException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function canCreateCronPasswordExecute()
    {
        $expectedPW = 'testRandom';

        /** @var d3_cfg_mod $set */
        $set = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        $currPassword = $set->getValue('sCronPassword');
        $set->setValue('sCronPassword', 'otherContent');
        $set->saveNoLicenseRefresh();

        $oStrMock = $this->getMockBuilder(d3str::class)
            ->setMethods(['random_str'])
            ->getMock();
        $oStrMock->expects($this->atLeastOnce())->method('random_str')->willReturn($expectedPW);
        d3GetModCfgDIC()->set(d3str::class, $oStrMock);

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'hasExecute',
                'setActionLog'
            ])
            ->getMock();
        $oModelMock->method('hasExecute')->willReturn(true);
        $oModelMock->expects($this->exactly(1))->method('setActionLog')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'createCronPassword'
        );

        /** @var d3_cfg_mod $set */
        $fixtureSet = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        $fixturePw = $fixtureSet->getValue('sCronPassword');

        $this->assertSame($expectedPW, $fixturePw);

        $set->setValue('sCronPassword', $currPassword);
        $set->saveNoLicenseRefresh();
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::createCronPassword
     * @test
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws ReflectionException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function canCreateCronPasswordNoExecute()
    {
        $expectedPW = 'testRandom';

        /** @var d3_cfg_mod $set */
        $set = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        $currPassword = $set->getValue('sCronPassword');
        $set->setValue('sCronPassword', 'otherContent');
        $set->saveNoLicenseRefresh();

        $oStrMock = $this->getMockBuilder(d3str::class)
            ->setMethods(['random_str'])
            ->getMock();
        $oStrMock->expects($this->never())->method('random_str')->willReturn($expectedPW);
        d3GetModCfgDIC()->set(d3str::class, $oStrMock);

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'hasExecute',
                'setActionLog'
            ])
            ->getMock();
        $oModelMock->method('hasExecute')->willReturn(false);
        $oModelMock->expects($this->exactly(1))->method('setActionLog')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'createCronPassword'
        );

        /** @var d3_cfg_mod $set */
        $fixtureSet = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        $fixturePw = $fixtureSet->getValue('sCronPassword');

        $this->assertSame('otherContent', $fixturePw);

        $set->setValue('sCronPassword', $currPassword);
        $set->saveNoLicenseRefresh();
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::needExampleJobList
     * @test
     * @throws DBALException
     * @throws ReflectionException
     */
    public function needExampleJobListPass()
    {
        /** @var PDOStatement|MockObject $oStmtMock */
        $oStmtMock = $this->getMockBuilder(PDOStatement::class)
            ->setMethods(['fetchColumn'])
            ->disableOriginalConstructor()
            ->getMock();
        $oStmtMock->expects($this->once())->method('fetchColumn')->willReturn(0);

        /** @var QueryBuilder|MockObject $oQBMock */
        $oQBMock = $this->getMockBuilder(QueryBuilder::class)
            ->setMethods(['execute'])
            ->setConstructorArgs([d3database::getInstance()->getConnection()])
            ->getMock();
        $oQBMock->method('execute')->willReturn($oStmtMock);

        /** @var d3database|MockObject $od3databaseMock */
        $od3databaseMock = $this->getMockBuilder(d3database::class)
            ->setMethods(['getQueryBuilder'])
            ->getMock();
        $od3databaseMock->expects($this->once())->method('getQueryBuilder')->willReturn($oQBMock);

        d3GetModCfgDIC()->set('d3.usermanager.database', $od3databaseMock);

        $this->assertTrue(
            $this->callMethod(
                $this->_oModel,
                'needExampleJobList'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::needExampleJobList
     * @test
     * @throws DBALException
     * @throws ReflectionException
     */
    public function needExampleJobListDontPass()
    {
        /** @var PDOStatement|MockObject $oStmtMock */
        $oStmtMock = $this->getMockBuilder(PDOStatement::class)
            ->setMethods(['fetchColumn'])
            ->disableOriginalConstructor()
            ->getMock();
        $oStmtMock->expects($this->once())->method('fetchColumn')->willReturn(true);

        /** @var QueryBuilder|MockObject $oQBMock */
        $oQBMock = $this->getMockBuilder(QueryBuilder::class)
            ->setMethods(['execute'])
            ->setConstructorArgs([d3database::getInstance()->getConnection()])
            ->getMock();
        $oQBMock->method('execute')->willReturn($oStmtMock);

        /** @var d3database|MockObject $od3databaseMock */
        $od3databaseMock = $this->getMockBuilder(d3database::class)
            ->setMethods(['getQueryBuilder'])
            ->getMock();
        $od3databaseMock->expects($this->once())->method('getQueryBuilder')->willReturn($oQBMock);

        d3GetModCfgDIC()->set('d3.usermanager.database', $od3databaseMock);

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'needExampleJobList'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addExampleJobList
     * @test
     * @throws ReflectionException
     */
    public function canAddExampleJobList()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getExampleJobInsertList',
                '_addExampleJobItem',
                'setUpdateBreak'
            ])
            ->getMock();
        $oModelMock->method('getExampleJobInsertList')->willReturn(
            array(
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                ),
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                ),
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                )
            )
        );
        $oModelMock->expects($this->exactly(2))->method('_addExampleJobItem')->will($this->onConsecutiveCalls(true, false, true));
        $oModelMock->method('setUpdateBreak')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'addExampleJobList'
        );
    }

    /**
     * @covers       \D3\Usermanager\Setup\d3usermanager_update::isExampleContentMissingInDatabase
     * @test
     * @param $fetchReturn
     * @param $expected
     * @throws DBALException
     * @throws ReflectionException
     * @dataProvider checkisExampleContentMissingInDatabaseDataProvider
     */
    public function checkisExampleContentMissingInDatabasePositive($fetchReturn, $expected)
    {
        /** @var PDOStatement|MockObject $oStmtMock */
        $oStmtMock = $this->getMockBuilder(PDOStatement::class)
            ->setMethods(['fetchColumn'])
            ->disableOriginalConstructor()
            ->getMock();
        $oStmtMock->expects($this->once())->method('fetchColumn')->willReturn($fetchReturn);

        /** @var QueryBuilder|MockObject $oQBMock */
        $oQBMock = $this->getMockBuilder(QueryBuilder::class)
            ->setMethods(['execute'])
            ->setConstructorArgs([d3database::getInstance()->getConnection()])
            ->getMock();
        $oQBMock->method('execute')->willReturn($oStmtMock);

        /** @var d3database|MockObject $od3databaseMock */
        $od3databaseMock = $this->getMockBuilder(d3database::class)
            ->setMethods(['getQueryBuilder'])
            ->getMock();
        $od3databaseMock->expects($this->once())->method('getQueryBuilder')->willReturn($oQBMock);

        $definitions = d3GetModCfgDIC()->getDefinitions();

        d3GetModCfgDIC()->set('d3.usermanager.database', $od3databaseMock);

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getExampleContentInsertList',
                'getExampleJobItem1InsertFields'
            ])
            ->getMock();
        $oModelMock->method('getExampleContentInsertList')->willReturn(
            [
                [
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                ]
            ]
        );
        $oModelMock->method('getExampleJobItem1InsertFields')->willReturn(
            [
                [
                    'fieldname'     => 'OXID',
                    'content'       => "foobar",
                    'force_update'  => false,
                    'use_quote'     => false,
                    'use_multilang' => false,
                ],
                [
                    'fieldname'     => 'OXLOADID',
                    'content'       => "d3unknownContentId",
                    'force_update'  => false,
                    'use_quote'     => true,
                    'use_multilang' => false,
                ]
            ]
        );

        $this->_oModel = $oModelMock;

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oModel,
                'isExampleContentMissingInDatabase'
            )
        );

        d3GetModCfgDIC()->reset();
        d3GetModCfgDIC()->setDefinitions($definitions);
    }

    /**
     * @return array[]
     */
    public function checkisExampleContentMissingInDatabaseDataProvider(): array
    {
        return [
            'positive'  => [1, true],
            'negative'  => [0, false],
        ];
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::isExampleContentMissingInDatabase
     * @test
     * @throws ReflectionException
     */
    public function checkisExampleContentMissingInDatabaseNegativeNoLoadId()
    {
        /** @var DatabaseInterface|MockObject $oDBInterfaceMock */
        $oDBInterfaceMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getOne'])
            ->getMock();
        $oDBInterfaceMock->expects($this->never())->method('getOne')->willReturn(0);

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getExampleContentInsertList',
                'getDb',
                'getExampleJobItem1InsertFields'
            ])
            ->getMock();
        $oModelMock->method('getExampleContentInsertList')->willReturn(
            array(
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                )
            )
        );
        $oModelMock->method('getDb')->willReturn($oDBInterfaceMock);
        $oModelMock->method('getExampleJobItem1InsertFields')->willReturn(
            array(
                array (
                    'fieldname'     => 'OXID',
                    'content'       => "foobar",
                    'force_update'  => false,
                    'use_quote'     => false,
                    'use_multilang' => false,
                ),
            )
        );

        $this->_oModel = $oModelMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'isExampleContentMissingInDatabase'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addExampleContentList
     * @test
     * @throws ReflectionException
     */
    public function canAddExampleContentList()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getExampleContentInsertList',
                '_addExampleJobItem',
                'setUpdateBreak'
            ])
            ->getMock();
        $oModelMock->method('getExampleContentInsertList')->willReturn(
            array(
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                ),
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                ),
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                )
            )
        );
        $oModelMock->expects($this->exactly(2))->method('_addExampleJobItem')->will($this->onConsecutiveCalls(true, false, true));
        $oModelMock->method('setUpdateBreak')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'addExampleContentList'
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::requireExample2ShopRelation
     * @test
     * @throws ReflectionException
     */
    public function checkRequireExample2ShopRelationTrue()
    {
        /** @var ShopList $shopList */
        $shopList = oxNew(ShopList::class);
        $shopList->offsetSet('foobar', oxNew(Shop::class));

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'setInitialExecMethod',
                'getExampleJobInsertList',
                'getExampleJobItem1InsertFields',
                '_require2ShopRelation',
                'getShopListByActiveModule'
            ])
            ->getMock();
        $oModelMock->method('setInitialExecMethod')->willReturn(true);
        $oModelMock->method('getExampleJobInsertList')->willReturn(
            array(
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                )
            )
        );
        $oModelMock->expects($this->once())->method('getExampleJobItem1InsertFields')->willReturn(['fields']);
        $oModelMock->expects($this->once())->method('_require2ShopRelation')->willReturn(true);
        $oModelMock->expects($this->once())->method('getShopListByActiveModule')->willReturn($shopList);

        $this->_oModel = $oModelMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oModel,
                'requireExample2ShopRelation'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::requireExample2ShopRelation
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function checkRequireExample2ShopRelationFalse()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'setInitialExecMethod',
                'getExampleJobInsertList',
                'getExampleJobItem1InsertFields',
                '_require2ShopRelation',
                'getShopListByActiveModule'
            ])
            ->getMock();
        $oModelMock->method('setInitialExecMethod')->willReturn(true);
        $oModelMock->method('getExampleJobInsertList')->willReturn(
            array(
                array(
                    'content'   => 'getExampleJobItem1InsertFields',
                    'table'     => 'd3modprofile'
                )
            )
        );
        $oModelMock->expects($this->exactly(3))->method('getExampleJobItem1InsertFields')->willReturn(['fields']);
        $oModelMock->expects($this->exactly(3))->method('_require2ShopRelation')->willReturn(false);
        $oModelMock->expects($this->atLeastOnce())->method('getShopListByActiveModule')->willReturn(
            array(
                1 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
                2 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
                3 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
            ));

        $this->_oModel = $oModelMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'requireExample2ShopRelation'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addExample2ShopRelation
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canAddExample2ShopRelationPass()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getExampleJobInsertList',
                'getExampleJobItem1PassInsertFields',
                'getExampleJobItem2PassInsertFields',
                'getExampleJobItem3PassInsertFields',
                '_add2ShopRelation',
                'getShopListByActiveModule'
            ])
            ->getMock();
        $oModelMock->method('getExampleJobInsertList')->willReturn(
            array(
                array(
                    'content'   => 'getExampleJobItem1PassInsertFields',
                    'table'     => 'd3modprofile'
                ),
                array(
                    'content'   => 'getExampleJobItem2PassInsertFields',
                    'table'     => 'd3modprofile'
                ),
                array(
                    'content'   => 'getExampleJobItem3PassInsertFields',
                    'table'     => 'd3modprofile'
                )
            )
        );
        $oModelMock->expects($this->exactly(3))->method('getExampleJobItem1PassInsertFields')->willReturn(true);
        $oModelMock->expects($this->exactly(3))->method('getExampleJobItem2PassInsertFields')->willReturn(true);
        $oModelMock->expects($this->exactly(3))->method('getExampleJobItem3PassInsertFields')->willReturn(true);
        $oModelMock->expects($this->exactly(9))->method('_add2ShopRelation')->willReturn(true);
        $oModelMock->expects($this->atLeastOnce())->method('getShopListByActiveModule')->willReturn(
            array(
                1 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
                2 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
                3 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
            ));

        $this->_oModel = $oModelMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oModel,
                'addExample2ShopRelation'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::addExample2ShopRelation
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canAddExample2ShopRelationFails()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getExampleJobInsertList',
                'getExampleJobItem1FailedInsertFields',
                'getExampleJobItem2FailedInsertFields',
                'getExampleJobItem3FailedInsertFields',
                '_add2ShopRelation',
                'getShopListByActiveModule'
            ])
            ->getMock();
        $oModelMock->method('getExampleJobInsertList')->willReturn(
            array(
                array(
                    'content'   => 'getExampleJobItem1FailedInsertFields',
                    'table'     => 'd3modprofile'
                ),
                array(
                    'content'   => 'getExampleJobItem2FailedInsertFields',
                    'table'     => 'd3modprofile'
                ),
                array(
                    'content'   => 'getExampleJobItem3FailedInsertFields',
                    'table'     => 'd3modprofile'
                )
            )
        );
        $oModelMock->expects($this->exactly(3))->method('getExampleJobItem1FailedInsertFields')->willReturn(true);
        $oModelMock->expects($this->exactly(3))->method('getExampleJobItem2FailedInsertFields')->willReturn(true);
        $oModelMock->expects($this->never())->method('getExampleJobItem3FailedInsertFields')->willReturn(true);
        $oModelMock->expects($this->exactly(6))->method('_add2ShopRelation')->will(
            $this->onConsecutiveCalls(
                true, true, true,
                true, false, false,
                true, true, true)
        );
        $oModelMock->expects($this->atLeastOnce())->method('getShopListByActiveModule')->willReturn(
            array(
                1 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
                2 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
                3 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
            ));

        $this->_oModel = $oModelMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'addExample2ShopRelation'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleJobInsertList
     * @test
     * @throws ReflectionException
     */
    public function canGetExampleJobInsertList()
    {
        $aList = $this->callMethod(
            $this->_oModel,
            'getExampleJobInsertList'
        );

        $this->assertInternalType('array', $aList);
        $this->assertTrue((bool) count($aList));
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleContentInsertList
     * @test
     * @throws ReflectionException
     */
    public function canGetExampleContentInsertList()
    {
        $aList = $this->callMethod(
            $this->_oModel,
            'getExampleContentInsertList'
        );

        $this->assertInternalType('array', $aList);
        $this->assertTrue((bool) count($aList));
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleJobItem1InsertFields
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleJobItem2InsertFields
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleJobItem3InsertFields
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleJobItem4InsertFields
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleJobItem5InsertFields
     * @test
     * @throws ReflectionException
     */
    public function canGetExampleJobItemXInsertFields()
    {
        /** @var Shop|MockObject $oShopMock */
        $oShopMock = $this->getMockBuilder(Shop::class)
            ->setMethods(['getId'])
            ->getMock();
        $oShopMock->method('getId')->willReturn('shopId');
        
        /** @var d3bitmask|MockObject $oD3BitMock */
        $oD3BitMock = $this->getMockBuilder(d3bitmask::class)
            ->setMethods(['getIntByBitPosition'])
            ->getMock();
        $oD3BitMock->method('getIntByBitPosition')->willReturn(1);

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getD3BitMask',
                '_getLangAbbrFieldName'
            ])
            ->getMock();
        $oModelMock->method('getD3BitMask')->willReturn($oD3BitMock);
        $oModelMock->method('_getLangAbbrFieldName')->willReturn('fieldName');

        $this->_oModel = $oModelMock;
        
        foreach ($this->_oModel->getExampleJobInsertList() as $aJobContentInfos) {
            $aFieldList = $this->callMethod(
                $this->_oModel,
                $aJobContentInfos['content'],
                array($oShopMock)
            );

            $this->assertInternalType('array', $aFieldList);
            $this->assertTrue((bool) count($aFieldList));
        }
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleContent1InsertFields
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getExampleContent2InsertFields
     * @test
     * @throws ReflectionException
     */
    public function canGetExampleContentXInsertFields()
    {
        /** @var Shop|MockObject $oShopMock */
        $oShopMock = $this->getMockBuilder(Shop::class)
            ->setMethods(['getId'])
            ->getMock();
        $oShopMock->method('getId')->willReturn('shopId');

        /** @var d3bitmask|MockObject $oD3BitMock */
        $oD3BitMock = $this->getMockBuilder(d3bitmask::class)
            ->setMethods(['getIntByBitPosition'])
            ->getMock();
        $oD3BitMock->method('getIntByBitPosition')->willReturn(1);

        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getD3BitMask',
                '_getLangAbbrFieldName'
            ])
            ->getMock();
        $oModelMock->method('getD3BitMask')->willReturn($oD3BitMock);
        $oModelMock->method('_getLangAbbrFieldName')->willReturn('fieldName');

        $this->_oModel = $oModelMock;

        foreach ($this->_oModel->getExampleContentInsertList() as $aContentInfos) {
            $aFieldList = $this->callMethod(
                $this->_oModel,
                $aContentInfos['content'],
                array($oShopMock)
            );

            $this->assertInternalType('array', $aFieldList);
            $this->assertTrue((bool) count($aFieldList));
        }
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::_addExampleJobItem
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canAddExampleJobItemNoStepByStep()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getShopListByActiveModule',
                'jobFieldMethodName',
                'setInitialExecMethod',
            '_updateTableItem2',
            'getStepByStepMode'])
            ->getMock();

        $oModelMock->method('getShopListByActiveModule')->willReturn(
            array(
                1 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
                2 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
            ));

        $oModelMock->method('jobFieldMethodName')->willReturn(true);
        $oModelMock->method('setInitialExecMethod')->willReturn(true);
        $oModelMock->expects($this->exactly(2))->method('_updateTableItem2')->willReturn(true);
        $oModelMock->method('getStepByStepMode')->willReturn(false);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            true,
            $this->callMethod(
                $this->_oModel,
                '_addExampleJobItem',
                array('tableName', 'jobFieldMethodName')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::getD3BitMask
     * @test
     * @throws ReflectionException
     */
    public function getD3BitReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3bitmask::class,
            $this->callMethod(
                $this->_oModel,
                'getD3BitMask'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::_addExampleJobItem
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canAddExampleJobItemStepByStep()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods([
                'getShopListByActiveModule',
                'jobFieldMethodName',
                'setInitialExecMethod',
            '_updateTableItem2',
            'getStepByStepMode'])
            ->getMock();

        $oModelMock->method('getShopListByActiveModule')->willReturn(

            array(
                1 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
                2 => d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class),
            ));

        $oModelMock->method('jobFieldMethodName')->willReturn(true);
        $oModelMock->method('setInitialExecMethod')->willReturn(true);
        $oModelMock->expects($this->once())->method('_updateTableItem2')->willReturn(true);
        $oModelMock->method('getStepByStepMode')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            true,
            $this->callMethod(
                $this->_oModel,
                '_addExampleJobItem',
                array('tableName', 'jobFieldMethodName')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::hasUnregisteredFiles
     * @test
     * @throws ReflectionException
     */
    public function canCheckHasUnregisteredFiles()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods(['_hasUnregisteredFiles'])
            ->getMock();
        $oModelMock->expects($this->once())->method('_hasUnregisteredFiles')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'hasUnregisteredFiles'
        );
    }

    /**
     * @covers \D3\Usermanager\Setup\d3usermanager_update::showUnregisteredFiles
     * @test
     * @throws ReflectionException
     */
    public function canShowUnregisteredFiles()
    {
        /** @var d3usermanager_update|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(d3usermanager_update::class)
            ->setMethods(['_showUnregisteredFiles'])
            ->getMock();
        $oModelMock->expects($this->once())->method('_showUnregisteredFiles')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            'showUnregisteredFiles'
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
