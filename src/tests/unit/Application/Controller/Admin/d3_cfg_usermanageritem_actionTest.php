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
use D3\Usermanager\Application\Model\Actions\d3usermanager_actiongrouplist;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_conf;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Exception as ExceptionAlias;
use Exception;
use OxidEsales\Eshop\Application\Model\ContentList;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ShopConfigurationDaoBridgeInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\DataObject\ModuleConfiguration;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use D3\Usermanager\Application\Model\Actions as Actions;

class d3_cfg_usermanageritem_actionTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_cfg_usermanageritem_action */
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

        $this->_oController = d3GetModCfgDIC()->get(d3_cfg_usermanageritem_action::class);
    }

    public function tearDown() : void
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::save
     * @test
     * @throws ReflectionException
     */
    public function canSaveNoMissingValues()
    {
        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $getValueMap = [['blActionOrderStorno_status', true]];
        $oProfileMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getProfile'])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->callMethod($this->_oController, 'save');
        $this->assertNull($this->_oController->getViewDataElement('missingRequValuesActions'));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::save
     * @test
     * @throws ReflectionException
     */
    public function canSaveMissingValues()
    {
        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $getValueMap = [['blActionCust2Group_status', true]];
        $oProfileMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getProfile'])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->callMethod($this->_oController, 'save');
        $aMissing = $this->_oController->getViewDataElement('missingRequValuesActions');
        $this->assertIsArray($aMissing);
        $this->assertCount(1, $aMissing);
        $this->assertContains('add2Group', $aMissing);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getContentList
     * @test
     * @throws ReflectionException
     */
    public function getContentListReturnsItems()
    {
        $oContentList = $this->callMethod($this->_oController, 'getContentList', array());

        $this->assertInstanceOf(ContentList::class, $oContentList);
        $this->assertTrue($oContentList->count() > 0);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::d3GetConfig
     * @test
     * @throws ReflectionException
     */
    public function d3GetConfigReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Config::class,
            $this->callMethod(
                $this->_oController,
                'd3GetConfig'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getManagerTemplateDirs
     * @test
     * @throws ReflectionException
     */
    public function managerContentDirsFromAdminPass()
    {
        $sExpected = '/var/www/html/source/Application/views/admin/tpl/';

        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->onlyMethods(['getTemplateDir'])
            ->getMock();
        $oConfigMock->expects($this->any())->method('getTemplateDir')->with(
            $this->isTrue()
        )->willReturn($sExpected);

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['d3GetConfig'])
            ->getMock();
        $oControllerMock->method('d3GetConfig')->willReturn($oConfigMock);

        $this->_oController = $oControllerMock;

        $sDir = $this->callMethod($this->_oController, 'getManagerTemplateDirs', array(true));
        $this->assertSame(
            $sExpected,
            $sDir
        );
    }

    /**
     * in case of error, check if a active theme is defined
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getManagerTemplateDirs
     * @test
     * @throws ReflectionException
     */
    public function managerContentDirsFromFrontentPass()
    {
        $sExpected = '/var/www/html/source/Application/views/flow/tpl/';

        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->onlyMethods(['getTemplateDir'])
            ->getMock();
        $oConfigMock->expects($this->any())->method('getTemplateDir')->with(
            $this->isFalse()
        )->willReturn($sExpected);
        
        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['d3GetConfig'])
            ->getMock();
        $oControllerMock->method('d3GetConfig')->willReturn($oConfigMock);

        $this->_oController = $oControllerMock;
        
        $sDir = $this->callMethod($this->_oController, 'getManagerTemplateDirs', array(false));
        $this->assertSame(
            $sExpected,
            $sDir
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getItemFieldNames
     * @test
     * @throws ReflectionException
     */
    public function orderFieldNamesPass()
    {
        $aFieldNames = $this->callMethod($this->_oController, 'getItemFieldNames');
        $this->assertIsArray($aFieldNames);
        $this->assertGreaterThan(0, count($aFieldNames));
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getProfile
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function getProfileReturnsRightInstance()
    {
        $oProfile = d3GetModCfgDIC()->get(d3usermanager::class);
        $oProfile->setId('newProfileId');
        $oProfile->save();

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getEditObjectId'])
            ->getMock();
        $oControllerMock->method('getEditObjectId')->willReturn('newProfileId');

        $this->_oController = $oControllerMock;

        $oAssertProfile = $this->callMethod($this->_oController, 'getProfile');

        $this->assertInstanceOf(
            d3usermanager::class,
            $oAssertProfile
        );
        $this->assertSame('newProfileId', $oAssertProfile->getId());

        $oProfile->delete();
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getProfile
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function getProfileOtherLangReturnsRightInstance()
    {
        $oProfile = d3GetModCfgDIC()->get(d3usermanager::class);
        $oProfile->setId('newProfileId');
        $oProfile->save();

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getEditObjectId'])
            ->getMock();
        $oControllerMock->method('getEditObjectId')->willReturn('newProfileId');

        $this->_oController = $oControllerMock;

        $this->setValue($this->_oController, '_iEditLang', 'en');
        $oAssertProfile = $this->callMethod($this->_oController, 'getProfile');

        $this->assertInstanceOf(
            d3usermanager::class,
            $oAssertProfile
        );
        $this->assertSame('newProfileId', $oAssertProfile->getId());

        $oProfile->delete();
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getExportExamplePath
     * @test
     * @throws ReflectionException
     */
    public function exportExamplePathWillGenerated()
    {
        $_POST['oxid'] = 'foobar';

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'loadInLang',
                'getStartTime',
                'getListExportFilePath'
            ])
            ->getMock();
        $oProfileMock->expects($this->once())->method('loadInLang')->willReturn(true);
        $oProfileMock->method('getStartTime')->willReturn(1420716228);
        $oProfileMock->method('getListExportFilePath')->willReturn('/var/www/html/shop/source/export/d3usermananger_profileName_2015-01-08_12-23-48.csv');

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods([
                'getProfile',
                '_d3LoadInOtherLang'
            ])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);
        $oControllerMock->method('_d3LoadInOtherLang')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $sPath = $this->callMethod($this->_oController, 'getExportExamplePath');
        $this->assertRegExp('@/var/www/html/shop/source/export/d3usermananger_profileName_.*.csv@i', $sPath);
        $this->assertStringNotContainsStringIgnoringCase('2015-01-08_12-23-48', $sPath);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getLang
     * @test
     * @throws ReflectionException
     */
    public function langWillReturnRightInstance()
    {
        $this->assertInstanceOf(
            Language::class,
            $this->callMethod($this->_oController, 'getLang')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getFieldNameDescription
     * @test
     * @throws ReflectionException
     */
    public function fieldNameDescriptionCanTranslated()
    {
        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods(['translateString'])
            ->getMock();
        $oLangMock->expects($this->once())->method('translateString')->willReturn('%1$s (%2$s)');

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods([
                'getFieldNameTitle',
                'getLang'
            ])
            ->getMock();
        $oControllerMock->method('getFieldNameTitle')->willReturn('barfoo');
        $oControllerMock->method('getLang')->willReturn($oLangMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            'barfoo (foobar_5)',
            $this->callMethod($this->_oController, 'getFieldNameDescription', array('foobar_5'))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getFieldNameDescription
     * @test
     * @throws ReflectionException
     */
    public function fieldNameDescriptionCantTranslated()
    {
        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getFieldNameTitle'])
            ->getMock();
        $oControllerMock->method('getFieldNameTitle')->willReturn(null);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            'foobar_5',
            $this->callMethod($this->_oController, 'getFieldNameDescription', array('foobar_5'))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getFieldNameTitle
     * @test
     * @throws ReflectionException
     */
    public function canGetFieldNameTitleWithLangIdent()
    {
        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods(['translateString'])
            ->getMock();
        $oLangMock->expects($this->exactly(2))->method('translateString')->with(
            $this->logicalOr(
                $this->stringContains('D3_USERMANAGER'),
                $this->logicalAnd(
                    $this->stringContains('foobar'),
                    $this->logicalNot(
                        $this->stringContains('5')
                    )
                )
            )
        )->willReturn('Sprache %u ');

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getLang'])
            ->getMock();
        $oControllerMock->method('getLang')->willReturn($oLangMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            'Sprache %u Sprache 0 ',
            $this->callMethod($this->_oController, 'getFieldNameTitle', array('foobar_1'))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getFieldNameTitle
     * @test
     * @throws ReflectionException
     */
    public function canGetFieldNameTitleWithoutLangIdent()
    {
        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods(['translateString'])
            ->getMock();
        $oLangMock->expects($this->once())->method('translateString')->with(
            $this->stringContains('foobar')
        )->willReturn('Sprache %u ');

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getLang'])
            ->getMock();
        $oControllerMock->method('getLang')->willReturn($oLangMock);

        $this->_oController = $oControllerMock;

        $this->assertSame(
            'Sprache %u ',
            $this->callMethod($this->_oController, 'getFieldNameTitle', array('foobar'))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getFieldNameTitle
     * @test
     * @throws ReflectionException
     */
    public function canGetFieldNameTitleWithNotExistingTranslation()
    {
        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods(['translateString'])
            ->getMock();
        $oLangMock->expects($this->once())->method('translateString')->willReturn('FOOBAR');

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getLang'])
            ->getMock();
        $oControllerMock->method('getLang')->willReturn($oLangMock);

        $this->setValue($oControllerMock, '_sExportFieldTitleBaseMLIdent', '');

        $this->_oController = $oControllerMock;

        $this->assertNull(
            $this->callMethod($this->_oController, 'getFieldNameTitle', array('FOOBAR'))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getActionGroupList
     * @test
     * @throws ReflectionException
     * @throws ExceptionAlias
     */
    public function getActionListReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanager_actiongrouplist::class,
            $this->callMethod(
                $this->_oController,
                'getActionGroupList'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getActionListObject
     * @test
     * @throws ReflectionException
     */
    public function canGetActionListObject()
    {
        $this->assertInstanceOf(
            Actions\d3usermanager_actionlist::class,
            $this->callMethod($this->_oController, 'getActionListObject')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getActionList
     * @test
     * @throws ReflectionException
     */
    public function canGetActionList()
    {
        $aActionList = $this->callMethod($this->_oController, 'getActionList');
        $this->assertIsArray($aActionList
        );
        $this->assertTrue(count($aActionList) > 0);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getGroupedActionList
     * @test
     * @throws ReflectionException
     * @throws ExceptionAlias
     */
    public function canGetGroupList()
    {
        $groupedList = array(
            'D3_USERMANAGER_ACTION_ORDER'   => array(
                'moveOrderToFolder'     => Actions\d3usermanager_action_setactiveflag::class,
                'stornoOrder'           => Actions\d3usermanager_action_deletefromgroup::class
            ),
            'D3_USERMANAGER_ACTION_CUSTOMER'       => array(
                'custAddToGroup'        => Actions\d3usermanager_action_add2group::class,
            )
        );

        /** @var d3usermanager_actiongrouplist|MockObject $oActionGroupListMock */
        $oActionGroupListMock = $this->getMockBuilder(d3usermanager_actiongrouplist::class)
            ->onlyMethods([
                'setGroups',
                'getGroupList'
            ])
            ->setConstructorArgs([$this->_oController->getProfile(), d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class)])
            ->getMock();
        $oActionGroupListMock->method('setGroups')->willReturn(true);
        $oActionGroupListMock->method('getGroupList')->willReturn($groupedList);

        /** @var d3usermanager_conf|MockObject $oConfigurationMock */
        $oConfigurationMock = $this->getMockBuilder(d3usermanager_conf::class)
            ->onlyMethods(['getGroupedActionIdList'])
            ->getMock();
        $oConfigurationMock->method('getGroupedActionIdList')->willReturn($groupedList);

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getConfiguration'])
            ->getMock();
        $oProfileMock->method('getConfiguration')->willReturn($oConfigurationMock);

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods([
                'getProfile',
                'getActionList'
            ])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);
        $oControllerMock->method('getActionList')->willReturn($groupedList);

        $this->_oController = $oControllerMock;

        $aList = $this->callMethod($this->_oController, 'getGroupedActionList');

        $this->assertIsArray($aList);
        $this->assertCount(2, $aList);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::_d3LoadInOtherLang
     * @test
     * @throws ReflectionException
     */
    public function canLoadInOtherLanguages()
    {
        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getAvailableInLangs',
                'loadInLang'
            ])
            ->getMock();
        $oProfileMock->method('getAvailableInLangs')->willReturn(array('de' => 'deutsch'));
        $oProfileMock->expects($this->once())->method('loadInLang')->willReturn(true);

        $this->setValue($this->_oController, '_iEditLang', 'en');

        $this->assertSame(
            $oProfileMock,
            $this->callMethod(
                $this->_oController,
                '_d3LoadInOtherLang',
                array($oProfileMock, 'oxid')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::_d3LoadInOtherLang
     * @test
     * @throws ReflectionException
     */
    public function dontNeedLoadInOtherLanguages()
    {
        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getAvailableInLangs',
                'loadInLang'
            ])
            ->getMock();
        $oProfileMock->method('getAvailableInLangs')->willReturn(array('de' => 'deutsch'));
        $oProfileMock->expects($this->never())->method('loadInLang')->willReturn(true);

        $this->setValue($this->_oController, '_iEditLang', 'de');

        $this->assertSame(
            $oProfileMock,
            $this->callMethod(
                $this->_oController,
                '_d3LoadInOtherLang',
                array($oProfileMock, 'oxid')
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::getModulePathList
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetModulePathList()
    {
        $container = ContainerFactory::getInstance()->getContainer();
        $shopConfiguration = $container->get(ShopConfigurationDaoBridgeInterface::class)->get();

        $moduleA = new ModuleConfiguration();
        $moduleA
            ->setId('d3module1')
            ->setPath('d3module1Path')
            ->setTitle([
                'de' => 'TestModule A '.__METHOD__,
                'en' => 'TestModule A '.__METHOD__
            ]);

        $moduleB = new ModuleConfiguration();
        $moduleB
            ->setId('d3module2')
            ->setPath('d3module2Path')
            ->setTitle([
                'de' => 'TestModule B '.__METHOD__,
                'en' => 'TestModule B '.__METHOD__
            ]);

        $shopConfiguration->addModuleConfiguration($moduleB);
        $shopConfiguration->addModuleConfiguration($moduleA);

        $container->get(ShopConfigurationDaoBridgeInterface::class)->save($shopConfiguration);

        try {
            $aList = $this->callMethod( $this->_oController, 'getModulePathList' );

            $this->assertArrayHasKey( 'd3module1', $aList );
            $this->assertArrayHasKey( 'd3module2', $aList );
            $this->assertArrayNotHasKey( 'd3module3', $aList );
            $this->assertStringContainsStringIgnoringCase( 'source/modules/d3module1Path', implode('', $aList));
            $this->assertStringContainsStringIgnoringCase( 'source/modules/d3module2Path', implode('', $aList));
            $this->assertStringNotContainsStringIgnoringCase( 'source/modules/d3module3Path', implode('', $aList));
        } finally {
            $shopConfiguration->deleteModuleConfiguration($moduleA->getId());
            $shopConfiguration->deleteModuleConfiguration($moduleB->getId());

            $container->get(ShopConfigurationDaoBridgeInterface::class)->save($shopConfiguration);
        }
    }

    /**
     * @return string
     */
    public function shopCompatHandlerCallback(): string
    {
        $args = func_get_args();
        return '/module/path/'.$args[1][1];
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action::markAsFinished
     * @test
     * @throws ReflectionException
     */
    public function canMarkedAsFinished()
    {
        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['markConcernedItemsAsFinished'])
            ->getMock();
        $oProfileMock->expects($this->once())->method('markConcernedItemsAsFinished')->willReturn(25);

        /** @var d3_cfg_usermanageritem_action|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_action::class)
            ->onlyMethods(['getProfile'])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);

        $this->_oController = $oControllerMock;

        $this->callMethod($this->_oController, 'markAsFinished');
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
