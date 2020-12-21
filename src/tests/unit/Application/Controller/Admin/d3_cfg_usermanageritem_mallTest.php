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
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Language;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use stdClass;

class d3_cfg_usermanageritem_mallTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_cfg_usermanageritem_mall */
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

        $this->_oController = d3GetModCfgDIC()->get(d3_cfg_usermanageritem_mall::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::__construct
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::getProfile
     * @test
     * @throws ReflectionException
     */
    public function profileObjectHasRightInstance()
    {
        $this->assertInstanceOf(
            d3usermanager::class,
            $this->callMethod($this->_oController, 'getProfile')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::render
     * @test
     * @throws ReflectionException
     */
    public function renderWithOxidPass()
    {
        $_POST['oxid'] = 'foobar';

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['loadInLang'])
            ->getMock();
        $oProfileMock->expects($this->once())->method('loadInLang')->willReturn(true);

        /** @var d3_cfg_usermanageritem_mall|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_mall::class)
            ->setMethods([
                'getProfile',
                '_d3LoadInOtherLang',
                '_isSetOxid'
            ])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);
        $oControllerMock->method('_d3LoadInOtherLang')->willReturn($oProfileMock);
        $oControllerMock->method('_isSetOxid')->willReturn(true);

        $this->_oController = $oControllerMock;

        $this->assertRegExp(
            '@.+\.tpl@i',
            $this->callMethod($this->_oController, 'render')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::render
     * @test
     * @throws ReflectionException
     */
    public function renderWithoutOxidPass()
    {
        $_POST['oxid'] = null;

        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['loadInLang'])
            ->getMock();
        $oProfileMock->expects($this->never())->method('loadInLang')->willReturn(true);

        /** @var d3_cfg_usermanageritem_mall|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_mall::class)
            ->setMethods([
                'getProfile',
                '_d3LoadInOtherLang',
                '_isSetOxid'
            ])
            ->getMock();
        $oControllerMock->method('getProfile')->willReturn($oProfileMock);
        $oControllerMock->method('_d3LoadInOtherLang')->willReturn($oProfileMock);
        $oControllerMock->method('_isSetOxid')->willReturn(false);

        $this->_oController = $oControllerMock;

        $this->assertRegExp(
            '@.+\.tpl@i',
            $this->callMethod($this->_oController, 'render')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::getUserMessages
     * @test
     * @throws ReflectionException
     */
    public function canGetUserMessages()
    {
        $this->assertInternalType(
            'array',
            $this->callMethod($this->_oController, 'getUserMessages')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::getLang
     * @test
     * @throws ReflectionException
     */
    public function languageObjectIsRightInstance()
    {
        $this->assertInstanceOf(
            Language::class,
            $this->callMethod($this->_oController, 'getLang')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::getHelpURL
     * @test
     * @throws ReflectionException
     */
    public function canGetHelpUrlWithExtension()
    {
        /** @var d3filesystem|MockObject $oFileSystemMock */
        $oFileSystemMock = $this->getMockBuilder(d3filesystem::class)
            ->setMethods([
                'unprefixedslashit',
                'splitFilename'
            ])
            ->getMock();
        $oFileSystemMock->method('unprefixedslashit')->willReturnCallback(array($this, 'firstArgumentReturnCallback'));
        $oFileSystemMock->method('splitFilename')->willReturn(
            array('name' => 'filename', 'ext' => 'html')
        );
        d3GetModCfgDIC()->set(d3filesystem::class, $oFileSystemMock);

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->setMethods(['TranslateString'])
            ->getMock();
        $oLangMock->method('TranslateString')->willReturn('modulepath');

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getHelpURL'])
            ->getMock();
        $oModCfgMock->method('getHelpURL')->willReturn('https://faq.d3data.de/module/');

        /** @var d3_cfg_usermanageritem_mall|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_mall::class)
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::getHelpURL
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
            ->setMethods(['TranslateString'])
            ->getMock();
        $oLangMock->method('TranslateString')->willReturn('modulepath');

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['getHelpURL'])
            ->getMock();
        $oModCfgMock->method('getHelpURL')->willReturn('https://faq.d3data.de/module/');

        /** @var d3_cfg_usermanageritem_mall|MockObject $oControllerMock */
        $oControllerMock = $this->getMockBuilder(d3_cfg_usermanageritem_mall::class)
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
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::d3GetSet
     * @test
     * @throws ReflectionException
     */
    public function modcfgObjectIsRightInstance()
    {
        $this->assertInstanceOf(
            d3_cfg_mod::class,
            $this->callMethod($this->_oController, 'd3GetSet')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::getNaviItems
     * @test
     * @throws ReflectionException
     */
    public function naviItemshasRightType()
    {
        $this->assertInternalType(
            'array',
            $this->callMethod($this->_oController, 'getNaviItems')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::d3GetMenuItemTitle
     * @test
     * @throws ReflectionException
     */
    public function menuItemTitleHasRightType()
    {
        $this->assertInternalType(
            'string',
            $this->callMethod($this->_oController, 'd3GetMenuItemTitle')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::d3GetMenuSubItemTitle
     * @test
     * @throws ReflectionException
     */
    public function menuSubItemTitleHasRightType()
    {
        $this->assertInternalType(
            'string',
            $this->callMethod($this->_oController, 'd3GetMenuSubItemTitle')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::_isSetOxid
     * @test
     * @throws ReflectionException
     */
    public function checkSetOxidPass()
    {
        $this->assertTrue(
            $this->callMethod($this->_oController, '_isSetOxid', array('foobar'))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::_isSetOxid
     * @test
     * @throws ReflectionException
     */
    public function checkUnsetOxidPass()
    {
        $this->assertFalse(
            $this->callMethod($this->_oController, '_isSetOxid', array(-1))
        );
        $this->assertFalse(
            $this->callMethod($this->_oController, '_isSetOxid', array(null))
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall::_d3LoadInOtherLang
     * @test
     * @throws ReflectionException
     */
    public function canLoadInOtherLang()
    {
        /** @var d3usermanager|MockObject $oProfileMock */
        $oProfileMock = $this->getMockBuilder(d3usermanager::class)
            ->setMethods([
                'getAvailableInLangs',
                'loadInLang'
            ])
            ->getMock();
        $oProfileMock->method('getAvailableInLangs')->willReturn(array('en' => 'english'));
        $oProfileMock->expects($this->once())->method('loadInLang')->willReturn(true);

        $this->setValue($this->_oController, '_iEditLang', 'de');

        $this->assertSame(
            $oProfileMock,
            $this->callMethod($this->_oController, '_d3LoadInOtherLang', array($oProfileMock, 'foobar'))
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