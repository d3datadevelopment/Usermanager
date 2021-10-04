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

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Application\Model\Shopcompatibility\d3ShopCompatibilityAdapterHandler;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_templaterendererExceptionInterface;
use D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Doctrine\DBAL\Query\QueryBuilder;
use Exception;
use Html2Text\Html2Text;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Content;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\Remark;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Email;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Field;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ShopConfigurationDaoBridgeInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\DataObject\ModuleConfiguration;
use OxidEsales\EshopCommunity\Internal\Framework\Smarty\Bridge\SmartyEngineBridge;
use OxidEsales\EshopCommunity\Internal\Framework\Smarty\Legacy\LegacySmartyEngine;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateEngineInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererInterface;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;
use Smarty;
use stdClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

class d3_oxemail_usermanagerTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_oxemail_usermanager */
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

        $this->_oModel = d3GetModCfgDIC()->get('d3ox.usermanager.'.Email::class);
    }

    public function tearDown() : void
    {
        parent::tearDown();

        unset($this->_oModel);
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::__construct
     * @test
     */
    public function constructorPass()
    {
        $this->assertEquals(
            'd3usermanager',
            d3GetModCfgDIC()->getParameter('d3.usermanager.modcfgid')
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3GetUserManagerTemplateEngine
     * @test
     * @throws ReflectionException
     */
    public function templateEngineHasRightInstance()
    {
        $this->assertInstanceOf(
            TemplateEngineInterface::class,
            $this->callMethod(
                $this->_oModel,
                '_d3GetUserManagerTemplateEngine'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3sendUserManagerEmail
     * @test
     * @throws ReflectionException
     */
    public function canSendUserManagerEmail()
    {
        $viewData = [
            'item1' => 'value1',
            'item2' => 'value2',
        ];

        /** @var Shop|MockObject $oFieldMock */
        $oFieldMock = $this->getMockBuilder(Shop::class)
            ->addMethods(['getRawValue'])
            ->getMock();
        $oFieldMock->method('getRawValue')->willReturn('value');
        
        /** @var Shop|MockObject $oShopMock */
        $oShopMock = $this->getMockBuilder(Shop::class)
            ->onlyMethods([
                '__get',
                'getFieldData'
            ])
            ->getMock();
        $oShopMock->method('__get')->willReturn($oFieldMock);
        $oShopMock->method('getFieldData')->willReturn('value');

        /** @var d3log|MockObject $oD3LogMock */
        $oD3LogMock = $this->getMockBuilder(d3log::class)
            ->onlyMethods(['log'])
            ->getMock();
        $oD3LogMock->method('log')->willReturnSelf();
        
        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['d3getLog'])
            ->getMock();
        $oModCfgMock->method('d3getLog')->willReturn($oD3LogMock);

        $templateEngineClass = get_class(ContainerFactory::getInstance()->getContainer()->get(TemplateEngineInterface::class));

        /** @var TemplateEngineInterface|MockObject $templateEngineMock */
        $templateEngineMock = $this->getMockBuilder($templateEngineClass)
            ->onlyMethods(['render', 'addGlobal'])
            ->disableOriginalConstructor()
            ->getMock();
        $templateEngineMock->method('render')->willReturn('renderedTemplateContent');
        $templateEngineMock->expects($this->exactly(count($viewData)))->method('addGlobal')->willReturn(true);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                '_getShop',
                '_d3GetUserManagerTemplateEngine',
                '_setMailParams',
                'setViewData',
                '_processViewArray',
                'd3UMsetBody',
                'd3UMsetAltBody',
                'getBody',
                'd3GetUserManagerSet',
                'd3UMsetSubject',
                'setRecipient',
                'setReplyTo',
                'send',
                'getViewData'
            ])
            ->getMock();
        $oModelMock->method('_getShop')->willReturn($oShopMock);
        $oModelMock->method('_d3GetUserManagerTemplateEngine')->willReturn($templateEngineMock);
        $oModelMock->method('_setMailParams')->willReturn(true);
        $oModelMock->method('setViewData')->willReturn(true);
        $oModelMock->method('_processViewArray')->willReturn(true);
        $oModelMock->expects($this->once())->method('d3UMsetBody')->willReturn(true);
        $oModelMock->method('d3UMsetAltBody')->willReturn(true);
        $oModelMock->method('getBody')->willReturn('mailBody');
        $oModelMock->method('d3GetUserManagerSet')->willReturn($oModCfgMock);
        $oModelMock->method('d3UMsetSubject')->willReturn(true);
        $oModelMock->expects($this->once())->method('setRecipient')->willReturn(true);
        $oModelMock->method('setReplyTo')->willReturn(true);
        $oModelMock->method('getViewData')->willReturn($viewData);
        $oModelMock->expects($this->once())->method('send')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            true,
            $this->callMethod(
                $this->_oModel,
                'd3sendUserManagerEmail',
                [[]]
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3getUserManagerUser
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canLoadUserUniqueOxid()
    {
        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetUserSaveTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetUserSaveTriggeredManagerTasks')->willReturnSelf();

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $oUserManagerListMock);

        /** preparing */
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->delete('oxuser')
            ->where(
                $queryBuilder->expr()->or(
                    $queryBuilder->expr()->in('oxid', [
                        $queryBuilder->createNamedParameter('testOxId1'),
                        $queryBuilder->createNamedParameter('testOxId2'),
                    ]),
                    $queryBuilder->expr()->eq('oxusername', $queryBuilder->createNamedParameter(''))
                )
            );
        $queryBuilder->execute();

        /** @var User $oUser */
        $oUser = oxNew(User::class);
        $oUser->setId('testOxId1');
        $oUser->save();

        $oReturnUser = $this->callMethod(
            $this->_oModel,
            'd3getUserManagerUser',
            ['testOxId1']
        );

        $this->assertInstanceOf(
            User::class,
            $oReturnUser
        );
        $this->assertSame(
            'testOxId1',
            $oReturnUser->getId()
        );

        $oUser->delete('testOxId1');
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3getUserManagerUser
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canLoadUserOxidPartOfOtherData()
    {
        /** @var d3usermanagerlist|MockObject $oUserManagerListMock */
        $oUserManagerListMock = $this->getMockBuilder(d3usermanagerlist::class)
            ->onlyMethods(['d3GetUserSaveTriggeredManagerTasks'])
            ->getMock();
        $oUserManagerListMock->method('d3GetUserSaveTriggeredManagerTasks')->willReturn(oxNew(d3usermanagerlist::class));

        d3GetModCfgDIC()->set(d3usermanagerlist::class, $oUserManagerListMock);

        $oUser = new User();
        $oUser->setId('testOxId2');
        $oUser->save();

        $oReturnUser = $this->callMethod(
            $this->_oModel,
            'd3getUserManagerUser',
            ['testOxId2@@otherData']
        );

        $this->assertInstanceOf(
            User::class,
            $oReturnUser
        );
        $this->assertSame(
            'testOxId2',
            $oReturnUser->getId()
        );

        $oUser->delete('testOxId2');
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3getUserManager
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canLoadManager()
    {
        /** @var d3usermanager $oManager */
        $oManager = d3GetModCfgDIC()->get(d3usermanager::class);
        $oManager->setId('testOxId3');
        $oManager->save();

        $oReturnManager = $this->callMethod(
            $this->_oModel,
            'd3getUserManager',
            array('testOxId3')
        );

        $this->assertInstanceOf(
            d3usermanager::class,
            $oReturnManager
        );
        $this->assertSame(
            'testOxId3',
            $oReturnManager->getId()
        );

        $oManager->delete('testOxId3');
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::sendUserManagerMail
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canStartSendingUserManagerMail()
    {
        /** @var Remark|MockObject $oRemarkMock */
        $oRemarkMock = $this->getMockBuilder(Remark::class)
            ->onlyMethods(['save'])
            ->getMock();
        $oRemarkMock->expects($this->once())->method('save')->willReturn(true);
        
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'getUserManagerMailContent',
                '_getShop',
                'd3UMsetBody',
                'd3UMsetAltBody',
                'd3UMsetSubject',
                '_d3SetUserManagerReplyAddress',
                '_d3SetUserManagerMailRecipients',
                'send'
            ])
            ->getMock();
        $oModelMock->method('getUserManagerMailContent')->willReturn(array(
            'html'      => 'foo',
            'plain'     => 'bar',
            'subject'   => 'testSubject'
        ));
        $oModelMock->method('_getShop')->willReturn(d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class));
        $oModelMock->expects($this->once())->method('d3UMsetBody')->willReturn(true);
        $oModelMock->method('d3UMsetAltBody')->willReturn(true);
        $oModelMock->method('d3UMsetSubject')->willReturn(true);
        $oModelMock->method('_d3SetUserManagerReplyAddress')->willReturn(true);
        $oModelMock->method('_d3SetUserManagerMailRecipients')->willReturn($oRemarkMock);
        $oModelMock->expects($this->once())->method('send')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            true,
            $this->callMethod(
                $this->_oModel,
                'sendUserManagerMail',
                array(d3GetModCfgDIC()->get(d3usermanager::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3UMsetBody
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3UMsetAltBody
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3UMsetSubject
     * @test
     * @param $setMethod
     * @param $getMethod
     * @param $returnValue
     * @param $expectException
     *
     * @throws ReflectionException
     * @dataProvider canSetUserManagerMailContentDataProvider
     */
    public function canSetUserManagerMailContent($setMethod, $getMethod, $returnValue, $expectException)
    {
        /** @var Email|MockObject $mailMock */
        $mailMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([$setMethod, $getMethod, 'd3UserManagerThrowUnequalContentException'])
            ->getMock();
        $mailMock->expects($this->atLeastOnce())->method($setMethod)->willReturn(true);
        $mailMock->method($getMethod)->willReturn($returnValue);
        $mailMock->expects($this->exactly((int) $expectException))->method('d3UserManagerThrowUnequalContentException');

        $this->_oModel = $mailMock;

        $methodName = 'd3UM'.$setMethod;

        $this->callMethod(
            $this->_oModel,
            $methodName,
            ['content']
        );
    }

    /**
     * @return array[]
     */
    public function canSetUserManagerMailContentDataProvider(): array
    {
        return [
            'body return passed'    => ['setBody', 'getBody', 'content', false],
            'body return empty'     => ['setBody', 'getBody', '', true],
            'altbody return passed'    => ['setAltBody', 'getAltBody', 'content', false],
            'altbody return empty'     => ['setAltBody', 'getAltBody', '', true],
            'subject return passed'    => ['setSubject', 'getSubject', 'content', false],
            'subject return empty'     => ['setSubject', 'getSubject', '', true],
        ];
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3SetUserManagerMailRecipients
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canSetUserManagerMailRecipientsCustomer()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                '_d3hasUserManagerCustomerRecipient',
                '_d3sendUserManagerMailToCustomer',
                '_d3hasUserManagerOwnerRecipient',
                '_d3sendUserManagerMailToOwner',
                '_d3hasUserManagerCustomRecipient',
                '_d3sendUserManagerMailToCustom'
            ])
            ->getMock();
        $oModelMock->method('_d3hasUserManagerCustomerRecipient')->willReturn(true);
        $oModelMock->expects($this->once())->method('_d3sendUserManagerMailToCustomer')->willReturn(d3GetModCfgDIC()->get('d3ox.usermanager.'.Remark::class));
        $oModelMock->method('_d3hasUserManagerOwnerRecipient')->willReturn(false);
        $oModelMock->expects($this->never())->method('_d3sendUserManagerMailToOwner')->willReturn(oxNew(Remark::class));
        $oModelMock->method('_d3hasUserManagerCustomRecipient')->willReturn(false);
        $oModelMock->expects($this->never())->method('_d3sendUserManagerMailToCustom')->willReturn(oxNew(Remark::class));

        $this->_oModel = $oModelMock;

        $this->assertInstanceOf(
            Remark::class,
            $this->callMethod(
                $this->_oModel,
                '_d3SetUserManagerMailRecipients',
                array(d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3SetUserManagerMailRecipients
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canSetUserManagerMailRecipientsOwner()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                '_d3hasUserManagerCustomerRecipient',
                '_d3sendUserManagerMailToCustomer',
                '_d3hasUserManagerOwnerRecipient',
                '_d3sendUserManagerMailToOwner',
                '_d3hasUserManagerCustomRecipient',
                '_d3sendUserManagerMailToCustom'
            ])
            ->getMock();
        $oModelMock->method('_d3hasUserManagerCustomerRecipient')->willReturn(false);
        $oModelMock->expects($this->never())->method('_d3sendUserManagerMailToCustomer')->willReturn(d3GetModCfgDIC()->get('d3ox.usermanager.'.Remark::class));
        $oModelMock->method('_d3hasUserManagerOwnerRecipient')->willReturn(true);
        $oModelMock->expects($this->once())->method('_d3sendUserManagerMailToOwner')->willReturn(d3GetModCfgDIC()->get('d3ox.usermanager.'.Remark::class));
        $oModelMock->method('_d3hasUserManagerCustomRecipient')->willReturn(false);
        $oModelMock->expects($this->never())->method('_d3sendUserManagerMailToCustom')->willReturn(d3GetModCfgDIC()->get('d3ox.usermanager.'.Remark::class));

        $this->_oModel = $oModelMock;

        $this->assertInstanceOf(
            Remark::class,
            $this->callMethod(
                $this->_oModel,
                '_d3SetUserManagerMailRecipients',
                array(d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3SetUserManagerMailRecipients
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canSetUserManagerMailRecipientsCustom()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                '_d3hasUserManagerCustomerRecipient',
                '_d3sendUserManagerMailToCustomer',
                '_d3hasUserManagerOwnerRecipient',
                '_d3sendUserManagerMailToOwner',
                '_d3hasUserManagerCustomRecipient',
                '_d3sendUserManagerMailToCustom'
            ])
            ->getMock();
        $oModelMock->method('_d3hasUserManagerCustomerRecipient')->willReturn(false);
        $oModelMock->expects($this->never())->method('_d3sendUserManagerMailToCustomer')->willReturn(d3GetModCfgDIC()->get('d3ox.usermanager.'.Remark::class));
        $oModelMock->method('_d3hasUserManagerOwnerRecipient')->willReturn(false);
        $oModelMock->expects($this->never())->method('_d3sendUserManagerMailToOwner')->willReturn(d3GetModCfgDIC()->get('d3ox.usermanager.'.Remark::class));
        $oModelMock->method('_d3hasUserManagerCustomRecipient')->willReturn(true);
        $oModelMock->expects($this->once())->method('_d3sendUserManagerMailToCustom')->willReturn(d3GetModCfgDIC()->get('d3ox.usermanager.'.Remark::class));

        $this->_oModel = $oModelMock;

        $this->assertInstanceOf(
            Remark::class,
            $this->callMethod(
                $this->_oModel,
                '_d3SetUserManagerMailRecipients',
                array(d3GetModCfgDIC()->get('d3ox.usermanager.'.Shop::class))
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3getUserManagerMailOption
     * @test
     * @throws ReflectionException
     */
    public function canGgetUserManagerMailOptionEdited()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getValue',
                'getEditedValues'
            ])
            ->getMock();
        $oManagerMock->expects($this->never())->method('getValue')->willReturn('objectProperty');
        $oManagerMock->expects($this->once())->method('getEditedValues')->willReturn(array('editedVar' => 'editedProperty'));

        $this->setValue(
            $this->_oModel,
            'oUserManager',
            $oManagerMock
        );
        
        $this->callMethod(
            $this->_oModel,
            '_d3getUserManagerMailOption',
            array('editedVar')
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3getUserManagerMailOption
     * @test
     * @throws ReflectionException
     */
    public function canGgetUserManagerMailOptionObject()
    {
        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getValue',
                'getEditedValues'
            ])
            ->getMock();
        $oManagerMock->expects($this->once())->method('getValue')->willReturn('objectProperty');
        $oManagerMock->expects($this->once())->method('getEditedValues')->willReturn(array('editedVar' => 'editedProperty'));

        $this->setValue(
            $this->_oModel,
            'oUserManager',
            $oManagerMock
        );

        $this->callMethod(
            $this->_oModel,
            '_d3getUserManagerMailOption',
            array('objectVar')
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3hasUserManagerCustomerRecipient
     * @test
     * @throws ReflectionException
     */
    public function canHasUserManagerCustomerRecipient()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['_d3getUserManagerMailOption'])
            ->getMock();
        $oModelMock->expects($this->once())->method('_d3getUserManagerMailOption')->with(
            $this->stringContains('Customer')
        )->willReturn('returnValue');

        $this->_oModel = $oModelMock;
        
        $this->assertSame(
            'returnValue',
            $this->callMethod(
                $this->_oModel,
                '_d3hasUserManagerCustomerRecipient'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3hasUserManagerOwnerRecipient
     * @test
     * @throws ReflectionException
     */
    public function canHasUserManagerOwnerRecipient()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['_d3getUserManagerMailOption'])
            ->getMock();
        $oModelMock->expects($this->once())->method('_d3getUserManagerMailOption')->with(
            $this->stringContains('Owner')
        )->willReturn('returnValue');

        $this->_oModel = $oModelMock;

        $this->assertSame(
            'returnValue',
            $this->callMethod(
                $this->_oModel,
                '_d3hasUserManagerOwnerRecipient'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3hasUserManagerCustomRecipient
     * @test
     * @throws ReflectionException
     */
    public function canHasUserManagerCustomRecipient()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['_d3getUserManagerMailOption'])
            ->getMock();
        $oModelMock->expects($this->once())->method('_d3getUserManagerMailOption')->with(
            $this->stringContains('Custom')
        )->willReturn('returnValue');

        $this->_oModel = $oModelMock;

        $this->assertSame(
            'returnValue',
            $this->callMethod(
                $this->_oModel,
                '_d3hasUserManagerCustomRecipient'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3getUserManagerCustomRecipientList
     * @test
     * @throws ReflectionException
     */
    public function canGetUserManagerCustomRecipientList()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['_d3getUserManagerMailOption'])
            ->getMock();
        $oModelMock->expects($this->once())->method('_d3getUserManagerMailOption')->with(
            $this->stringContains('CustomAddress')
        )->willReturn('returnValue');

        $this->_oModel = $oModelMock;

        $this->assertSame(
            'returnValue',
            $this->callMethod(
                $this->_oModel,
                '_d3getUserManagerCustomRecipientList'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3GetUserManagerSet
     * @test
     * @throws ReflectionException
     */
    public function d3GetUserManagerSetReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3_cfg_mod::class,
            $this->callMethod(
                $this->_oModel,
                'd3GetUserManagerSet'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3GetUserManagerLanguageObject
     * @test
     * @throws ReflectionException
     */
    public function d3GetUserManagerLanguageObjectReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Language::class,
            $this->callMethod(
                $this->_oModel,
                'd3GetUserManagerLanguageObject'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3GetUserManagerConfigObject
     * @test
     * @throws ReflectionException
     */
    public function d3GetUserManagerConfigObjectReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Config::class,
            $this->callMethod(
                $this->_oModel,
                'd3GetUserManagerConfigObject'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::getUserManagerMailContent
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetUserManagerMailContentAdminTpl()
    {
        $expected = ['returnValue'];

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['getLicenseConfigData'])
            ->getMock();
        $oModCfgMock->method('getLicenseConfigData')->willReturn(false);
        
        /** @var Language|MockObject $oLanguageMock */
        $oLanguageMock = $this->getMockBuilder(Language::class)
            ->onlyMethods(['translateString'])
            ->getMock();
        $oLanguageMock->method('translateString')->willReturn(true);
        
        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->onlyMethods([
                'getTemplateDir',
                'setAdminMode'
            ])
            ->getMock();
        $oConfigMock->method('getTemplateDir')->willReturn(true);
        $oConfigMock->expects($this->exactly(2))->method('setAdminMode')->with(
            $this->isTrue()
        )->willReturn(true);

        /** @var Payment|MockObject $oPaymentMock */
        $oPaymentMock = $this->getMockBuilder(Payment::class)
            ->onlyMethods(['load'])
            ->getMock();
        $oPaymentMock->method('load')->willReturn(true);
        
        /** @var Basket|MockObject $oBasketMock */
        $oBasketMock = $this->getMockBuilder(Basket::class)
            ->onlyMethods(['getPaymentId'])
            ->getMock();
        $oBasketMock->method('getPaymentId')->willReturn(true);
        
        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->addMethods([
                'd3getOrderBasket4UserManager',
                'd3setBasket4UserManager',
                'd3setPayment4UserManager',
                'getOrderUser',
                'getDelSet',
                'getOrderCurrency'
            ])
            ->getMock();
        $oItemMock->method('d3getOrderBasket4UserManager')->willReturn($oBasketMock);
        $oItemMock->method('d3setBasket4UserManager')->willReturn(true);
        $oItemMock->method('d3setPayment4UserManager')->willReturn(true);
        $oItemMock->method('getOrderUser')->willReturn(true);
        $oItemMock->method('getDelSet')->willReturn(true);
        $oItemMock->method('getOrderCurrency')->willReturn(true);

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getValue',
                'getCurrentItem'
            ])
            ->getMock();
        $getValueMap = [['sSendMailFromTheme', 'admin']];
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);
        $oManagerMock->method('getCurrentItem')->willReturn($oItemMock);

        /** @var LegacySmartyEngine|MockObject $templateEngine */
        $templateEngine = $this->getMockBuilder(LegacySmartyEngine::class)
            ->setConstructorArgs([new Smarty(), new SmartyEngineBridge()])
            ->onlyMethods(['addGlobal'])
            ->getMock();
        $templateEngine->expects($this->exactly(2))->method('addGlobal')
            ->with(
               $this->logicalOr(
                   $this->stringContains('no1'),
                   $this->stringContains('no2')
               ),
               $this->logicalOr(
                   $this->stringContains('value1'),
                   $this->stringContains('value2')
               )
            )->willReturn(true);

        /** @var TemplateRendererInterface|MockObject $templateRendererMock */
        $templateRendererMock = $this->getMockBuilder(TemplateRendererInterface::class)
            ->onlyMethods(['getTemplateEngine', 'renderTemplate', 'renderFragment', 'exists'])
            ->getMock();
        $templateRendererMock->method('getTemplateEngine')->willReturn($templateEngine);
        $templateRendererMock->method('renderTemplate')->willReturn('content');
        $templateRendererMock->method('renderFragment')->willReturn('fragment');
        $templateRendererMock->method('exists')->willReturn(true);

        /** @var MockObject $templateRendererGetter */
        $templateRendererGetter = $this->getMockBuilder(stdClass::class)
            ->addMethods(['getTemplateRenderer'])
            ->getMock();
        $templateRendererGetter->method('getTemplateRenderer')->willReturn($templateRendererMock);

        /** @var ContainerInterface|MockObject $diContainerMock */
        $diContainerMock = $this->getMockBuilder(ContainerBuilder::class)
            ->onlyMethods(['get'])
            ->getMock();
        $diContainerMock->method('get')->willReturn($templateRendererGetter);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->addMethods([
                '_getTemplateRenderer',
                'd3GetUserManagerPaymentObject',
            ])
            ->onlyMethods([
                '_getShop',
                '_setMailParams',
                'setViewData',
                'getViewConfig',
                'd3GetUserManagerConfigObject',
                'd3GetUserManagerLanguageObject',
                'getTemplateDir4UserManager',
                '_processViewArray',
                'getViewData',
                'd3GetUserManagerSet',
                'd3SendMailHook',
                '_d3GenerateUserManagerMailContent',
                'd3getUserManagerDIContainer'
            ])
            ->getMock();
        $oModelMock->method('_getShop')->willReturn(true);
        $oModelMock->method('_setMailParams')->willReturn(true);
        $oModelMock->method('_getTemplateRenderer')->willReturn($templateEngine);
        $oModelMock->method('d3GetUserManagerPaymentObject')->willReturn($oPaymentMock);
        $oModelMock->method('setViewData')->willReturn(true);
        $oModelMock->method('getViewConfig')->willReturn(true);
        $oModelMock->method('d3GetUserManagerConfigObject')->willReturn($oConfigMock);
        $oModelMock->method('d3GetUserManagerLanguageObject')->willReturn($oLanguageMock);
        $oModelMock->method('getTemplateDir4UserManager')->willReturn('templateDir');
        $oModelMock->method('_processViewArray')->willReturn(true);
        $oModelMock->method('d3GetUserManagerSet')->willReturn($oModCfgMock);
        $oModelMock->method('d3SendMailHook')->willReturn($templateEngine);
        $oModelMock->method('_d3GenerateUserManagerMailContent')->willReturn($expected);
        $oModelMock->method('d3getUserManagerDIContainer')->willReturn($diContainerMock);
        $oModelMock->method('getViewData')->willReturn([
            'no1'   => 'value1',
            'no2'  => 'value2'
        ]);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oModel,
                'getUserManagerMailContent',
                array($oManagerMock)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::getUserManagerMailContent
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetUserManagerMailContentFrontendTpl()
    {
        $expected = ['returnValue'];

        /** @var stdClass|MockObject $oModCfgMock */
        $oModCfgMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['getLicenseConfigData'])
            ->getMock();
        $oModCfgMock->method('getLicenseConfigData')->willReturn(false);

        /** @var Language|MockObject $oLanguageMock */
        $oLanguageMock = $this->getMockBuilder(Language::class)
            ->onlyMethods(['translateString'])
            ->getMock();
        $oLanguageMock->method('translateString')->willReturn(true);

        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->onlyMethods([
                'getTemplateDir',
                'setAdminMode'
            ])
            ->getMock();
        $oConfigMock->method('getTemplateDir')->willReturn(true);
        $oConfigMock->expects($this->exactly(2))->method('setAdminMode')->withConsecutive(
            [$this->isFalse()],
            [$this->isTrue()]
        )->willReturn(true);

        /** @var Payment|MockObject $oPaymentMock */
        $oPaymentMock = $this->getMockBuilder(Payment::class)
            ->onlyMethods(['load'])
            ->getMock();
        $oPaymentMock->method('load')->willReturn(true);

        /** @var Basket|MockObject $oBasketMock */
        $oBasketMock = $this->getMockBuilder(Basket::class)
            ->onlyMethods(['getPaymentId'])
            ->getMock();
        $oBasketMock->method('getPaymentId')->willReturn(true);

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->addMethods([
                'd3getOrderBasket4UserManager',
                'd3setBasket4UserManager',
                'd3setPayment4UserManager',
                'getOrderUser',
                'getDelSet',
                'getOrderCurrency'
            ])
            ->getMock();
        $oItemMock->method('d3getOrderBasket4UserManager')->willReturn($oBasketMock);
        $oItemMock->method('d3setBasket4UserManager')->willReturn(true);
        $oItemMock->method('d3setPayment4UserManager')->willReturn(true);
        $oItemMock->method('getOrderUser')->willReturn(true);
        $oItemMock->method('getDelSet')->willReturn(true);
        $oItemMock->method('getOrderCurrency')->willReturn(true);

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getValue',
                'getCurrentItem'
            ])
            ->getMock();
        $getValueMap = [['sSendMailFromTheme', 'frontend']];
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);
        $oManagerMock->method('getCurrentItem')->willReturn($oItemMock);

        $templateEngine = ContainerFactory::getInstance()->getContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer()->getTemplateEngine();

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->addMethods([
                '_getTemplateRenderer',
                'd3GetUserManagerPaymentObject'
            ])
            ->onlyMethods([
                '_getShop',
                '_setMailParams',
                'setViewData',
                'getViewConfig',
                'd3GetUserManagerConfigObject',
                'd3GetUserManagerLanguageObject',
                'getTemplateDir4UserManager',
                '_processViewArray',
                'd3GetUserManagerSet',
                'd3SendMailHook',
                '_d3GenerateUserManagerMailContent'
            ])
            ->getMock();
        $oModelMock->method('_getShop')->willReturn(true);
        $oModelMock->method('_setMailParams')->willReturn(true);
        $oModelMock->method('_getTemplateRenderer')->willReturn($templateEngine);
        $oModelMock->method('d3GetUserManagerPaymentObject')->willReturn($oPaymentMock);
        $oModelMock->method('setViewData')->willReturn(true);
        $oModelMock->method('getViewConfig')->willReturn(true);
        $oModelMock->method('d3GetUserManagerConfigObject')->willReturn($oConfigMock);
        $oModelMock->method('d3GetUserManagerLanguageObject')->willReturn($oLanguageMock);
        $oModelMock->method('getTemplateDir4UserManager')->willReturn('tplDir');
        $oModelMock->method('_processViewArray')->willReturn(true);
        $oModelMock->method('d3GetUserManagerSet')->willReturn($oModCfgMock);
        $oModelMock->method('d3SendMailHook')->willReturn($templateEngine);
        $oModelMock->method('_d3GenerateUserManagerMailContent')->willReturn($expected);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            $expected,
            $this->callMethod(
                $this->_oModel,
                'getUserManagerMailContent',
                array($oManagerMock)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::getTemplateDir4UserManager
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetTemplateDir4UserManagerModule()
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
        $shopConfiguration->addModuleConfiguration($moduleA);

        $container->get(ShopConfigurationDaoBridgeInterface::class)->save($shopConfiguration);

        try {
            /** @var Config|MockObject $oConfigMock */
            $oConfigMock = $this->getMockBuilder(Config::class)
                ->onlyMethods(['getTemplateDir'])
                ->getMock();
            $oConfigMock->expects($this->never())->method('getTemplateDir')->willReturn('returnValue');

            /** @var d3str|MockObject $oD3StrMock */
            $oD3StrMock = $this->getMockBuilder(d3str::class)
                ->onlyMethods(['untrailingslashit'])
                ->getMock();
            $oD3StrMock->method('untrailingslashit')->willReturnArgument(0);

            /** @var d3usermanager|MockObject $oManagerMock */
            $oManagerMock = $this->getMockBuilder(d3usermanager::class)
                ->onlyMethods(['getValue'])
                ->getMock();
            $getValueMap = [
                ['sSendMailFromTheme', 'module'],
                ['sSendMailFromModulePath', 'd3module1'],
            ];
            $oManagerMock->method('getValue')->willReturnMap($getValueMap);

            /** @var d3_oxemail_usermanager|MockObject $oModelMock */
            $oModelMock = $this->getMockBuilder(Email::class)
                ->onlyMethods([
                    'getD3UserManagerStrObject',
                    'd3GetUserManagerConfigObject'
                ])
                ->getMock();
            $oModelMock->method('getD3UserManagerStrObject')->willReturn($oD3StrMock);
            $oModelMock->method('d3GetUserManagerConfigObject')->willReturn($oConfigMock);

            $this->_oModel = $oModelMock;

            $this->assertStringContainsStringIgnoringCase(
                'source/modules/d3module1Path',
                $this->callMethod(
                    $this->_oModel,
                    'getTemplateDir4UserManager',
                    array($oManagerMock)
                )
            );
        } finally {
            $shopConfiguration->deleteModuleConfiguration($moduleA->getId());

            $container->get(ShopConfigurationDaoBridgeInterface::class)->save($shopConfiguration);
        }
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::getTemplateDir4UserManager
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetTemplateDir4UserManagerAdmin()
    {
        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->onlyMethods(['getTemplateDir'])
            ->getMock();
        $oConfigMock->expects($this->once())->method('getTemplateDir')->with(
            $this->isTrue()
        )->willReturn('returnValue');

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->onlyMethods(['untrailingslashit'])
            ->getMock();
        $oD3StrMock->method('untrailingslashit')->willReturn('returnValue');

        /** @var d3ShopCompatibilityAdapterHandler|MockObject $oShopCompatHandlerMock */
        $oShopCompatHandlerMock = $this->getMockBuilder(d3ShopCompatibilityAdapterHandler::class)
            ->onlyMethods(['call'])
            ->getMock();
        $oShopCompatHandlerMock->expects($this->never())->method('call')->willReturn('fullPath');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $getValueMap = [
            ['sSendMailFromTheme', 'admin'],
            ['sSendMailFromModulePath', 'module'],
        ];
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->addMethods([
                'd3GetShopCompatibilityAdapterHandler'
            ])
            ->onlyMethods([
                'getD3UserManagerStrObject',
                'd3GetUserManagerConfigObject'
            ])
            ->getMock();
        $oModelMock->method('d3GetShopCompatibilityAdapterHandler')->willReturn($oShopCompatHandlerMock);
        $oModelMock->method('getD3UserManagerStrObject')->willReturn($oD3StrMock);
        $oModelMock->method('d3GetUserManagerConfigObject')->willReturn($oConfigMock);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            'returnValue',
            $this->callMethod(
                $this->_oModel,
                'getTemplateDir4UserManager',
                array($oManagerMock)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::getTemplateDir4UserManager
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function canGetTemplateDir4UserManagerFrontend()
    {
        /** @var Config|MockObject $oConfigMock */
        $oConfigMock = $this->getMockBuilder(Config::class)
            ->onlyMethods(['getTemplateDir'])
            ->getMock();
        $oConfigMock->expects($this->once())->method('getTemplateDir')->with(
            $this->isFalse()
        )->willReturn('returnValue');

        /** @var d3str|MockObject $oD3StrMock */
        $oD3StrMock = $this->getMockBuilder(d3str::class)
            ->onlyMethods(['untrailingslashit'])
            ->getMock();
        $oD3StrMock->method('untrailingslashit')->willReturn('returnValue');

        /** @var d3ShopCompatibilityAdapterHandler|MockObject $oShopCompatHandlerMock */
        $oShopCompatHandlerMock = $this->getMockBuilder(d3ShopCompatibilityAdapterHandler::class)
            ->onlyMethods(['call'])
            ->getMock();
        $oShopCompatHandlerMock->expects($this->never())->method('call')->willReturn('fullPath');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $getValueMap = [
            ['sSendMailFromTheme', 'frontend'],
            ['sSendMailFromModulePath', 'module'],
        ];
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->addMethods([
                'd3GetShopCompatibilityAdapterHandler'
            ])
            ->onlyMethods([
                'getD3UserManagerStrObject',
                'd3GetUserManagerConfigObject'
            ])
            ->getMock();
        $oModelMock->method('d3GetShopCompatibilityAdapterHandler')->willReturn($oShopCompatHandlerMock);
        $oModelMock->method('getD3UserManagerStrObject')->willReturn($oD3StrMock);
        $oModelMock->method('d3GetUserManagerConfigObject')->willReturn($oConfigMock);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            'returnValue',
            $this->callMethod(
                $this->_oModel,
                'getTemplateDir4UserManager',
                array($oManagerMock)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3SendMailHook
     * @test
     * @throws ReflectionException
     * @throws Exception
     */
    public function d3SendMailHookReturnsRightInstance()
    {
        $this->assertInstanceOf(
            TemplateEngineInterface::class,
            $this->callMethod(
                $this->_oModel,
                'd3SendMailHook',
                array(
                    ContainerFactory::getInstance()->getContainer()
                        ->get(TemplateRendererBridgeInterface::class)
                        ->getTemplateRenderer()->getTemplateEngine()
                )
            )
        );
    }

    /**
     * @test
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3GetUserManagerUtilsView
     */
    public function d3GetUserManagerUtilsViewReturnsRightInstance()
    {
        $this->markTestSkipped('skipped because visual CMS extension issue');

        /*
        $this->assertInstanceOf(
            UtilsView::class,
            $this->callMethod(
                $this->_oModel,
                'd3GetUserManagerUtilsView'
            )
        );
        */
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3GetUserManagerContentObject
     * @test
     * @throws ReflectionException
     */
    public function d3GetUserManagerContentObjectReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Content::class,
            $this->callMethod(
                $this->_oModel,
                'd3GetUserManagerContentObject'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::getD3UserManagerStrObject
     * @test
     * @throws ReflectionException
     */
    public function getD3UserManagerStrObjectReturnsRightInstance()
    {
        $this->assertInstanceOf(
            d3str::class,
            $this->callMethod(
                $this->_oModel,
                'getD3UserManagerStrObject'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3GenerateUserManagerMailContent
     * @test
     * @throws ReflectionException
     */
    public function _d3GenerateUserManagerMailContentFromEditor()
    {
        $currLangId = 2;

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getFieldData'])
            ->getMock();
        $getFieldDataMap = [
            ['oxlang', $currLangId],
        ];
        $oItemMock->method('getFieldData')->willReturnMap($getFieldDataMap);
        
        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods([
                'getTplLanguage',
                'setTplLanguage'
            ])
            ->getMock();

        $oLangMock->method('getTplLanguage')->willReturn($currLangId);
        $oLangMock->expects($this->exactly(2))->method('setTplLanguage')
            ->withConsecutive([$currLangId], [$currLangId])->willReturn(true);

        /** @var UtilsView|MockObject $oUtilsViewMock */
        $oUtilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['getRenderedContent'])
            ->getMock();
        $oUtilsViewMock->expects($this->never())->method('getRenderedContent')->willReturn('content');
        
        /** @var Content|MockObject $oContentMock */
        $oContentMock = $this->getMockBuilder(Content::class)
            ->onlyMethods([
                'setLanguage',
                'load',
                'getFieldData',
                'getId'
            ])
            ->getMock();
        $oContentMock->method('setLanguage')->willReturn(true);
        $oContentMock->expects($this->never())->method('load')->willReturn(true);
        $oContentMock->method('getFieldData')->willReturn(true);
        $oContentMock->method('getId')->willReturn(true);

        $templateEngineClass = get_class(ContainerFactory::getInstance()->getContainer()->get(TemplateEngineInterface::class));

        /** @var TemplateEngineInterface|MockObject $templateEngineMock */
        $templateEngineMock = $this->getMockBuilder($templateEngineClass)
            ->onlyMethods(['render'])
            ->disableOriginalConstructor()
            ->getMock();
        $templateEngineMock->expects($this->never())->method('render')->willReturn('renderedTemplateContent');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getEditedValues',
                'getValue',
                'getCurrentItem'
            ])
            ->getMock();
        $getValueMap = [
            ['sSendMailFromSource', 'cms'],
        ];
        $aEditedValues = array(
            'mail' => array(
                'subject' => 'subjectMailContent',
                'plain' => 'plainMailContent',
                'html' => 'htmlMailContent',
            )
        );
        $oManagerMock->method('getEditedValues')->willReturn($aEditedValues);
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);
        $oManagerMock->method('getCurrentItem')->willReturn($oItemMock);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'd3HasUserManagerEditorMailContent',
                'd3GetUserManagerLanguageObject',
                'd3GetUserManagerUtilsView',
                'd3GetUserManagerContentObject'
            ])
            ->getMock();
        $oModelMock->method('d3HasUserManagerEditorMailContent')->willReturn(true);
        $oModelMock->method('d3GetUserManagerLanguageObject')->willReturn($oLangMock);
        $oModelMock->method('d3GetUserManagerUtilsView')->willReturn($oUtilsViewMock);
        $oModelMock->method('d3GetUserManagerContentObject')->willReturn($oContentMock);

        $this->_oModel = $oModelMock;

        $this->setValue(
            $this->_oModel,
            'oUserManager',
            $oManagerMock
        );

        $this->assertSame(
            $aEditedValues['mail'],
            $this->callMethod(
                $this->_oModel,
                '_d3GenerateUserManagerMailContent',
                array(
                    array(
                        'mail' => array(
                            'subject' => 'subjectMailContent',
                            'plain' => 'plainMailContent',
                            'html' => 'htmlMailContent',
                        )
                    ),
                    $templateEngineMock
                )
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3GenerateUserManagerMailContent
     * @test
     * @throws ReflectionException
     */
    public function _d3GenerateUserManagerMailContentFromEditorGeneratedPlain()
    {
        $currLangId = 2;

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getFieldData'])
            ->getMock();

        $getFieldDataMap = [
            ['oxlang', $currLangId],
        ];
        $oItemMock->method('getFieldData')->willReturnMap($getFieldDataMap);

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods([
                'getTplLanguage',
                'setTplLanguage'
            ])
            ->getMock();

        $oLangMock->method('getTplLanguage')->willReturn($currLangId);
        $oLangMock->expects($this->exactly(2))->method('setTplLanguage')
            ->withConsecutive([$currLangId], [$currLangId])->willReturn(true);

        /** @var UtilsView|MockObject $oUtilsViewMock */
        $oUtilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['getRenderedContent'])
            ->getMock();
        $oUtilsViewMock->expects($this->never())->method('getRenderedContent')->willReturn('content');

        /** @var Content|MockObject $oContentMock */
        $oContentMock = $this->getMockBuilder(Content::class)
            ->onlyMethods([
                'setLanguage',
                'load',
                'getFieldData',
                'getId'
            ])
            ->getMock();
        $oContentMock->method('setLanguage')->willReturn(true);
        $oContentMock->expects($this->never())->method('load')->willReturn(true);
        $oContentMock->method('getFieldData')->willReturn(true);
        $oContentMock->method('getId')->willReturn(true);

        $templateEngineClass = get_class(ContainerFactory::getInstance()->getContainer()->get(TemplateEngineInterface::class));

        /** @var TemplateEngineInterface|MockObject $templateEngineMock */
        $templateEngineMock = $this->getMockBuilder($templateEngineClass)
            ->onlyMethods(['render'])
            ->disableOriginalConstructor()
            ->getMock();
        $templateEngineMock->expects($this->never())->method('render')->willReturn('renderedTemplateContent');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getEditedValues',
                'getValue',
                'getCurrentItem'
            ])
            ->getMock();
        $getValueMap = [
            ['sSendMailFromSource', 'cms'],
        ];
        $aEditedValues = array(
            'mail' => array(
                'subject' => 'subjectMailContent',
                'genplain' => '1',
                'plain' => 'html'.PHP_EOL.'MailCont'.PHP_EOL.'ent',
                'html' => 'html<div>Mail</div>Cont<br>ent',
            )
        );
        $oManagerMock->method('getEditedValues')->willReturn($aEditedValues);
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);
        $oManagerMock->method('getCurrentItem')->willReturn($oItemMock);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'd3HasUserManagerEditorMailContent',
                'd3GetUserManagerLanguageObject',
                'd3GetUserManagerUtilsView',
                'd3GetUserManagerContentObject'
            ])
            ->getMock();
        $oModelMock->method('d3HasUserManagerEditorMailContent')->willReturn(true);
        $oModelMock->method('d3GetUserManagerLanguageObject')->willReturn($oLangMock);
        $oModelMock->method('d3GetUserManagerUtilsView')->willReturn($oUtilsViewMock);
        $oModelMock->method('d3GetUserManagerContentObject')->willReturn($oContentMock);

        $this->_oModel = $oModelMock;

        $this->setValue(
            $this->_oModel,
            'oUserManager',
            $oManagerMock
        );

        $this->assertSame(
            $aEditedValues['mail'],
            $this->callMethod(
                $this->_oModel,
                '_d3GenerateUserManagerMailContent',
                array(
                    array(
                        'mail' => array(
                            'subject' => 'subjectMailContent',
                            'genplain' => '1',
                            'html' => 'html<div>Mail</div>Cont<br>ent',
                        )
                    ),
                    $templateEngineMock
                )
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3GenerateUserManagerMailContent
     * @test
     * @throws ReflectionException
     */
    public function _d3GenerateUserManagerMailContentFromCms()
    {
        $currLangId = 2;

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getFieldData'])
            ->getMock();

        $getFieldDataMap = [
            ['oxlang', $currLangId],
        ];
        $oItemMock->method('getFieldData')->willReturnMap($getFieldDataMap);

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods([
                'getTplLanguage',
                'setTplLanguage'
            ])
            ->getMock();

        $oLangMock->method('getTplLanguage')->willReturn($currLangId);
        $oLangMock->expects($this->exactly(2))->method('setTplLanguage')
            ->withConsecutive([$currLangId], [$currLangId])->willReturn(true);

        /** @var UtilsView|MockObject $oUtilsViewMock */
        $oUtilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['getRenderedContent'])
            ->getMock();
        $oUtilsViewMock->expects($this->exactly(2))->method('getRenderedContent')->willReturn('renderedTemplateContent');

        /** @var Content|MockObject $oContentMock */
        $oContentMock = $this->getMockBuilder(Content::class)
            ->onlyMethods([
                'setLanguage',
                'load',
                'getFieldData',
                'getId'
            ])
            ->getMock();
        $oContentMock->method('setLanguage')->willReturn(true);
        $oContentMock->expects($this->exactly(2))->method('load')->willReturn(true);
        $oContentMock->method('getFieldData')->willReturn('fieldData');
        $oContentMock->method('getId')->willReturn(true);

        $templateEngineClass = get_class(ContainerFactory::getInstance()->getContainer()->get(TemplateEngineInterface::class));

        /** @var TemplateEngineInterface|MockObject $templateEngineMock */
        $templateEngineMock = $this->getMockBuilder($templateEngineClass)
            ->onlyMethods(['render'])
            ->disableOriginalConstructor()
            ->getMock();
        $templateEngineMock->expects($this->never())->method('render')->willReturn('renderedTemplateContent');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getEditedValues',
                'getValue',
                'getCurrentItem'
            ])
            ->getMock();
        $getValueMap = [
            ['sSendMailFromSource', 'cms'],
        ];
        $aEditedValues = array(
            'mail' => array(
                'subject' => 'subjectMailContent',
                'plain' => 'plainMailContent',
                'html' => 'htmlMailContent',
            )
        );
        $oManagerMock->method('getEditedValues')->willReturn($aEditedValues);
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);
        $oManagerMock->method('getCurrentItem')->willReturn($oItemMock);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'd3HasUserManagerEditorMailContent',
                'd3GetUserManagerLanguageObject',
                'd3GetUserManagerUtilsView',
                'd3GetUserManagerContentObject'
            ])
            ->getMock();
        $oModelMock->method('d3HasUserManagerEditorMailContent')->willReturn(false);
        $oModelMock->method('d3GetUserManagerLanguageObject')->willReturn($oLangMock);
        $oModelMock->method('d3GetUserManagerUtilsView')->willReturn($oUtilsViewMock);
        $oModelMock->method('d3GetUserManagerContentObject')->willReturn($oContentMock);

        $this->_oModel = $oModelMock;

        $this->setValue(
            $this->_oModel,
            'oUserManager',
            $oManagerMock
        );

        $this->assertEquals(
            array(
                'subject'   => 'fieldData',
                'plain'     => 'renderedTemplateContent',
                'html'      => 'renderedTemplateContent',
            ),
            $this->callMethod(
                $this->_oModel,
                '_d3GenerateUserManagerMailContent',
                array(
                    array(),
                    $templateEngineMock
                )
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3GenerateUserManagerMailContent
     * @test
     * @throws ReflectionException
     */
    public function _d3GenerateUserManagerMailContentFromTpl()
    {
        $currLangId = 2;

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getFieldData'])
            ->getMock();

        $getFieldDataMap = [
            ['oxlang', $currLangId],
        ];
        $oItemMock->method('getFieldData')->willReturnMap($getFieldDataMap);

        /** @var Language|MockObject $oLangMock */
        $oLangMock = $this->getMockBuilder(Language::class)
            ->onlyMethods([
                'getTplLanguage',
                'setTplLanguage'
            ])
            ->getMock();

        $oLangMock->method('getTplLanguage')->willReturn($currLangId);
        $oLangMock->expects($this->exactly(2))->method('setTplLanguage')
            ->withConsecutive([$currLangId], [$currLangId])->willReturn(true);

        /** @var UtilsView|MockObject $oUtilsViewMock */
        $oUtilsViewMock = $this->getMockBuilder(UtilsView::class)
            ->onlyMethods(['getRenderedContent'])
            ->getMock();
        $oUtilsViewMock->expects($this->never())->method('getRenderedContent')->willReturn('renderedTemplateContent');

        /** @var Content|MockObject $oContentMock */
        $oContentMock = $this->getMockBuilder(Content::class)
            ->onlyMethods([
                'setLanguage',
                'load',
                'getFieldData',
                'getId'
            ])
            ->getMock();
        $oContentMock->method('setLanguage')->willReturn(true);
        $oContentMock->expects($this->never())->method('load')->willReturn(true);
        $oContentMock->method('getFieldData')->willReturn('fieldData');
        $oContentMock->method('getId')->willReturn(true);

        $templateEngineClass = get_class(ContainerFactory::getInstance()->getContainer()->get(TemplateEngineInterface::class));

        /** @var TemplateEngineInterface|MockObject $templateEngineMock */
        $templateEngineMock = $this->getMockBuilder($templateEngineClass)
            ->onlyMethods(['render'])
            ->disableOriginalConstructor()
            ->getMock();
        $templateEngineMock->expects($this->exactly(3))->method('render')->willReturn('renderedTemplateContent');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods([
                'getEditedValues',
                'getValue',
                'getCurrentItem'
            ])
            ->getMock();
        $getValueMap = [
            ['sSendMailFromSource', 'template'],
            ['sSendMailFromTemplatename', 'HtmlTpl'],
            ['sSendMailFromTemplatenamePlain', 'PlainTpl'],
            ['sSendMailFromSubject', 'SubjectTpl']
        ];
        $aEditedValues = array(
            'mail' => array(
                'subject' => 'subjectMailContent',
                'plain' => 'plainMailContent',
                'html' => 'htmlMailContent',
            )
        );
        $oManagerMock->method('getEditedValues')->willReturn($aEditedValues);
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);
        $oManagerMock->method('getCurrentItem')->willReturn($oItemMock);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'd3HasUserManagerEditorMailContent',
                'd3GetUserManagerLanguageObject',
                'd3GetUserManagerUtilsView',
                'd3GetUserManagerContentObject'
            ])
            ->getMock();
        $oModelMock->method('d3HasUserManagerEditorMailContent')->willReturn(false);
        $oModelMock->method('d3GetUserManagerLanguageObject')->willReturn($oLangMock);
        $oModelMock->method('d3GetUserManagerUtilsView')->willReturn($oUtilsViewMock);
        $oModelMock->method('d3GetUserManagerContentObject')->willReturn($oContentMock);

        $this->_oModel = $oModelMock;

        $this->setValue(
            $this->_oModel,
            'oUserManager',
            $oManagerMock
        );

        $this->assertEquals(
            array(
                'subject'   => 'renderedTemplateContent',
                'plain'     => 'renderedTemplateContent',
                'html'      => 'renderedTemplateContent',
            ),
            $this->callMethod(
                $this->_oModel,
                '_d3GenerateUserManagerMailContent',
                array(
                    array(),
                    $templateEngineMock
                )
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3HasUserManagerEditorMailContent
     * @test
     * @throws ReflectionException
     */
    public function d3HasUserManagerEditorMailContentPass()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['d3isUserManagerArrayEditorMailContent'])
            ->getMock();
        $oModelMock->method('d3isUserManagerArrayEditorMailContent')->willReturn(true);

        $this->_oModel = $oModelMock;

        $aEditedValues = array(
            'mail'  => array(
                'subject'   => 'subjectContent',
                'html'      => 'htmlContent',
                'plain'     => 'plainContent'
            )
        );

        $this->assertTrue(
            $this->callMethod(
                $this->_oModel,
                'd3HasUserManagerEditorMailContent',
                array($aEditedValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3HasUserManagerEditorMailContent
     * @test
     * @throws ReflectionException
     */
    public function d3HasUserManagerEditorMailContentIsNoArray()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['d3isUserManagerArrayEditorMailContent'])
            ->getMock();
        $oModelMock->method('d3isUserManagerArrayEditorMailContent')->willReturn(false);

        $this->_oModel = $oModelMock;

        $aEditedValues = array(
            'mail'  => array(
                'subject'   => 'subjectContent',
                'html'      => 'htmlContent',
                'plain'     => 'plainContent'
            )
        );

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'd3HasUserManagerEditorMailContent',
                array($aEditedValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3HasUserManagerEditorMailContent
     * @test
     * @throws ReflectionException
     */
    public function d3HasUserManagerEditorMailContentIsNoSubject()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['d3isUserManagerArrayEditorMailContent'])
            ->getMock();
        $oModelMock->method('d3isUserManagerArrayEditorMailContent')->willReturn(true);

        $this->_oModel = $oModelMock;

        $aEditedValues = array(
            'mail'  => array(
                'subject'   => false,
                'html'      => 'htmlContent',
                'plain'     => 'plainContent'
            )
        );

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'd3HasUserManagerEditorMailContent',
                array($aEditedValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3HasUserManagerEditorMailContent
     * @test
     * @throws ReflectionException
     */
    public function d3HasUserManagerEditorMailContentIsNoHtml()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['d3isUserManagerArrayEditorMailContent'])
            ->getMock();
        $oModelMock->method('d3isUserManagerArrayEditorMailContent')->willReturn(true);

        $this->_oModel = $oModelMock;

        $aEditedValues = array(
            'mail'  => array(
                'subject'   => 'subjectContent',
                'html'      => false,
                'plain'     => 'plainContent'
            )
        );

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'd3HasUserManagerEditorMailContent',
                array($aEditedValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3HasUserManagerEditorMailContent
     * @test
     * @throws ReflectionException
     */
    public function d3HasUserManagerEditorMailContentIsNoPlain()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['d3isUserManagerArrayEditorMailContent'])
            ->getMock();
        $oModelMock->method('d3isUserManagerArrayEditorMailContent')->willReturn(true);

        $this->_oModel = $oModelMock;

        $aEditedValues = array(
            'mail'  => array(
                'subject'   => 'subjectContent',
                'html'      => 'htmlContent',
                'plain'     => false
            )
        );

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'd3HasUserManagerEditorMailContent',
                array($aEditedValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3isUserManagerArrayEditorMailContent
     * @test
     * @throws ReflectionException
     */
    public function d3isUserManagerArrayEditorMailContentPass()
    {
        $aEditedValues = array(
            'mail'  => array()
        );

        $this->assertTrue(
            $this->callMethod(
                $this->_oModel,
                'd3isUserManagerArrayEditorMailContent',
                array($aEditedValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3isUserManagerArrayEditorMailContent
     * @test
     * @throws ReflectionException
     */
    public function d3isUserManagerArrayEditorMailContentNoMailArray()
    {
        $aEditedValues = array();

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'd3isUserManagerArrayEditorMailContent',
                array($aEditedValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3isUserManagerArrayEditorMailContent
     * @test
     * @throws ReflectionException
     */
    public function d3isUserManagerArrayEditorMailContentNoValuesArray()
    {
        $aEditedValues = null;

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                'd3isUserManagerArrayEditorMailContent',
                array($aEditedValues)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3generateUserManagerPlainContent
     * @test
     * @throws ReflectionException
     */
    public function canGeneratePlainContent()
    {
        /** @var Html2Text|MockObject $oHtml2TextMock */
        $oHtml2TextMock = $this->getMockBuilder(Html2Text::class)
            ->onlyMethods(['getText'])
            ->getMock();
        $oHtml2TextMock->expects($this->once())->method('getText')->willReturn('plainContent');

        d3GetModCfgDIC()->set(Html2Text::class, $oHtml2TextMock);

        $this->assertSame(
            'plainContent',
            $this->callMethod(
                $this->_oModel,
                'd3generateUserManagerPlainContent',
                array(
                    'HtmlContent'
                )
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3sendUserManagerMailToOwner
     * @test
     * @throws ReflectionException
     */
    public function canSendUserManagerMailToOwner()
    {
        /** @var Shop|MockObject $oFieldMock */
        $oFieldMock = $this->getMockBuilder(Shop::class)
            ->addMethods(['getRawValue'])
            ->getMock();
        $oFieldMock->method('getRawValue')->willReturn('shopName');
        
        /** @var Shop|MockObject $oShopMock */
        $oShopMock = $this->getMockBuilder(Shop::class)
            ->onlyMethods([
                '__get',
                'getFieldData'
            ])
            ->getMock();
        $oShopMock->method('__get')->willReturn($oFieldMock);
        $oShopMock->method('getFieldData')->willReturn('info@mail.com');

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'setRecipient',
                '_d3HasUserManagerCustomMailAddresses',
                '_d3getUserManagerCustomMailAddressList',
                'AddBcc',
                'd3generateUserManagerRemark'
            ])
            ->getMock();

        $oModelMock->expects($this->once())->method('setRecipient')->willReturn(true);
        $oModelMock->method('_d3HasUserManagerCustomMailAddresses')->willReturn(true);
        $oModelMock->expects($this->exactly(2))->method('AddBcc')->willReturn(true);
        $oModelMock->method('_d3getUserManagerCustomMailAddressList')->willReturn(
            array(
                'mail1',
                'mail2'
            )
        );
        $returnValue = oxNew(Remark::class);
        $oModelMock->method('d3generateUserManagerRemark')->willReturn($returnValue);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            $returnValue,
            $this->callMethod(
                $this->_oModel,
                '_d3sendUserManagerMailToOwner',
                array($oShopMock)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3sendUserManagerMailToCustom
     * @test
     * @throws ReflectionException
     */
    public function canSendUserManagerMailToCustom()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                '_d3hasUserManagerCustomMailAddresses',
                '_d3getUserManagerCustomMailAddressList',
                'setRecipient',
                'd3generateUserManagerRemark'
            ])
            ->getMock();

        $oModelMock->expects($this->once())->method('_d3hasUserManagerCustomMailAddresses')->willReturn(true);
        $oModelMock->expects($this->exactly(2))->method('setRecipient')->willReturn(true);
        $oModelMock->method('_d3getUserManagerCustomMailAddressList')->willReturn(
            array(
                'mail1',
                'mail2'
            )
        );
        $returnValue = oxNew(Remark::class);
        $oModelMock->method('d3generateUserManagerRemark')->willReturn($returnValue);

        $this->_oModel = $oModelMock;

        $this->assertSame(
            $returnValue,
            $this->callMethod(
                $this->_oModel,
                '_d3sendUserManagerMailToCustom'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3getUserManagerCustomMailAddressList
     * @test
     * @throws ReflectionException
     */
    public function canExtractCustomMailAddressList()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods(['_d3getUserManagerCustomRecipientList'])
            ->getMock();
        $oModelMock->expects($this->once())->method('_d3getUserManagerCustomRecipientList')->willReturn(
            'mailNo1; mailNo2; '
        );

        $this->_oModel = $oModelMock;

        $this->assertSame(
            array(
                'mailNo1',
                'mailNo2'
            ),
            $this->callMethod(
                $this->_oModel,
                '_d3getUserManagerCustomMailAddressList'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3HasUserManagerCustomMailAddresses
     * @test
     * @throws ReflectionException
     */
    public function hasUserManagerCustomMailAddressesPass()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                '_d3hasUserManagerCustomRecipient',
                '_d3getUserManagerCustomRecipientList'
            ])
            ->getMock();
        $oModelMock->method('_d3hasUserManagerCustomRecipient')->willReturn(true);
        $oModelMock->method('_d3getUserManagerCustomRecipientList')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->assertTrue(
            $this->callMethod(
                $this->_oModel,
                '_d3HasUserManagerCustomMailAddresses'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3HasUserManagerCustomMailAddresses
     * @test
     * @throws ReflectionException
     */
    public function hasUserManagerCustomMailAddressesNoCustRecipient()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                '_d3hasUserManagerCustomRecipient',
                '_d3getUserManagerCustomRecipientList'
            ])
            ->getMock();
        $oModelMock->method('_d3hasUserManagerCustomRecipient')->willReturn(false);
        $oModelMock->method('_d3getUserManagerCustomRecipientList')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                '_d3HasUserManagerCustomMailAddresses'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3HasUserManagerCustomMailAddresses
     * @test
     * @throws ReflectionException
     */
    public function hasUserManagerCustomMailAddressesNoCustRecipientList()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                '_d3hasUserManagerCustomRecipient',
                '_d3getUserManagerCustomRecipientList'
            ])
            ->getMock();
        $oModelMock->method('_d3hasUserManagerCustomRecipient')->willReturn(true);
        $oModelMock->method('_d3getUserManagerCustomRecipientList')->willReturn(false);

        $this->_oModel = $oModelMock;

        $this->assertFalse(
            $this->callMethod(
                $this->_oModel,
                '_d3HasUserManagerCustomMailAddresses'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3GetUserManagerRemark
     * @test
     * @throws ReflectionException
     */
    public function d3GetRemarkReturnsRightInstance()
    {
        $this->assertInstanceOf(
            Remark::class,
            $this->callMethod(
                $this->_oModel,
                'd3GetUserManagerRemark'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3sendUserManagerMailToCustomer
     * @test
     * @throws ReflectionException
     */
    public function canD3sendUserManagerMailToCustomerNoOrderUser()
    {
        /** @var Field|MockObject $oFieldMock */
        $oFieldMock = $this->getMockBuilder(Field::class)
            ->onlyMethods(['getRawValue'])
            ->getMock();
        $oFieldMock->method('getRawValue')->willReturn('rawValue');

        /** @var Shop|MockObject $oShopMock */
        $oShopMock = $this->getMockBuilder(Shop::class)
            ->onlyMethods([
                'getFieldData',
                '__get'
            ])
            ->getMock();
        $oShopMock->method('getFieldData')->willReturn('fieldData');
        $oShopMock->method('__get')->willReturn($oFieldMock);

        /** @var User|MockObject $oOrderUserMock */
        $oOrderUserMock = $this->getMockBuilder(User::class)
            ->onlyMethods([
                'getId',
                '__get',
                'getFieldData'
            ])
            ->getMock();
        $oOrderUserMock->method('getId')->willReturn(false);
        $oOrderUserMock->expects($this->never())->method('__get')->willReturn($oFieldMock);
        $oOrderUserMock->method('getFieldData')->willReturn('fieldData');

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->addMethods([
                'getOrderUser'
            ])
            ->onlyMethods([
                '__get',
                'getFieldData'
            ])
            ->getMock();
        $oItemMock->method('getOrderUser')->willReturn($oOrderUserMock);
        $oItemMock->expects($this->exactly(2))->method('__get')->willReturn($oFieldMock);
        $oItemMock->method('getFieldData')->willReturn('fieldData');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getCurrentItem'])
            ->getMock();
        $oManagerMock->method('getCurrentItem')->willReturn($oItemMock);

        /** @var Remark|MockObject $oRemarkMock */
        $oRemarkMock = $this->getMockBuilder(Remark::class)
            ->onlyMethods(['assign'])
            ->getMock();
        $oRemarkMock->expects($this->once())->method('assign')->willReturn(true);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'setRecipient',
                '_d3hasUserManagerOwnerRecipient',
                'AddBcc',
                '_d3HasUserManagerCustomMailAddresses',
                '_d3getUserManagerCustomMailAddressList',
                'd3GetUserManagerRemark'
            ])
            ->getMock();
        $oModelMock->method('setRecipient')->willReturn(true);
        $oModelMock->method('_d3hasUserManagerOwnerRecipient')->willReturn(true);
        $oModelMock->expects($this->exactly(3))->method('AddBcc')->willReturn(true);
        $oModelMock->method('_d3HasUserManagerCustomMailAddresses')->willReturn(true);
        $oModelMock->method('_d3getUserManagerCustomMailAddressList')->willReturn(array('addrNo1', 'addrNo2'));
        $oModelMock->method('d3GetUserManagerRemark')->willReturn($oRemarkMock);

        $this->_oModel = $oModelMock;

        $this->setValue(
            $this->_oModel,
            'oUserManager',
            $oManagerMock
        );

        $this->assertInstanceOf(
            Remark::class,
            $this->callMethod(
                $this->_oModel,
                '_d3sendUserManagerMailToCustomer',
                array($oShopMock)
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3SetUserManagerReplyAddress
     * @test
     * @throws ReflectionException
     */
    public function canSetUserManagerReplyAddressWithReply()
    {
        /** @var Field|MockObject $oFieldMock */
        $oFieldMock = $this->getMockBuilder(Field::class)
            ->onlyMethods(['getRawValue'])
            ->getMock();
        $oFieldMock->method('getRawValue')->willReturn('rawValue');
        
        /** @var Shop|MockObject $oShopMock */
        $oShopMock = $this->getMockBuilder(Shop::class)
            ->onlyMethods([
                '__get',
                'getFieldData'
            ])
            ->getMock();
        $oShopMock->method('__get')->willReturn($oFieldMock);
        $oShopMock->method('getFieldData')->willReturn('fieldData');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $getValueMap = [
            ['sSendMailReplyAddress', 'reply@test.com'],
        ];
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'setFrom',
                'setReplyTo'
            ])
            ->getMock();
        $oModelMock->expects($this->once())->method('setFrom')->willReturn(true);
        $oModelMock->expects($this->once())->method('setReplyTo')->willReturn(true);

        $this->_oModel = $oModelMock;
        
        $this->callMethod(
            $this->_oModel,
            '_d3SetUserManagerReplyAddress',
            array($oManagerMock, $oShopMock)
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::_d3SetUserManagerReplyAddress
     * @test
     * @throws ReflectionException
     */
    public function canSetUserManagerReplyAddressWithoutReply()
    {
        /** @var Field|MockObject $oFieldMock */
        $oFieldMock = $this->getMockBuilder(Field::class)
            ->onlyMethods(['getRawValue'])
            ->getMock();
        $oFieldMock->method('getRawValue')->willReturn('rawValue');

        /** @var Shop|MockObject $oShopMock */
        $oShopMock = $this->getMockBuilder(Shop::class)
            ->onlyMethods([
                '__get',
                'getFieldData'
            ])
            ->getMock();
        $oShopMock->method('__get')->willReturn($oFieldMock);
        $oShopMock->method('getFieldData')->willReturn('fieldData');

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getValue'])
            ->getMock();
        $getValueMap = [
            ['sSendMailReplyAddress', null],
        ];
        $oManagerMock->method('getValue')->willReturnMap($getValueMap);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'setFrom',
                'setReplyTo'
            ])
            ->getMock();
        $oModelMock->expects($this->never())->method('setFrom')->willReturn(true);
        $oModelMock->expects($this->once())->method('setReplyTo')->willReturn(true);

        $this->_oModel = $oModelMock;

        $this->callMethod(
            $this->_oModel,
            '_d3SetUserManagerReplyAddress',
            array($oManagerMock, $oShopMock)
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3generateUserManagerRemark
     * @test
     * @throws ReflectionException
     */
    public function canGenerateRemark()
    {
        /** @var Remark|MockObject $remarkMock */
        $remarkMock = $this->getMockBuilder(Remark::class)
            ->onlyMethods(['assign'])
            ->getMock();
        $remarkMock->method('assign')->with($this->isType('array'))->willReturn(true);

        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'd3GetUserManagerRemark',
                'getAllRecipientAddresses',
                'getBody',
                'getAltBody'
            ])
            ->getMock();
        $oModelMock->expects($this->once())->method('d3GetUserManagerRemark')->willReturn($remarkMock);
        $oModelMock->expects($this->any())->method('getAllRecipientAddresses')->willReturn(
            [
                'key1'  => 'value1',
                'key2'  => 'value2',
            ]
        );
        $oModelMock->expects($this->any())->method('getBody')->willReturn('testBody');
        $oModelMock->expects($this->any())->method('getAltBody')->willReturn('testAltBody');

        $this->_oModel = $oModelMock;

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getId'])
            ->getMock();
        $oItemMock->method('getId')->willReturn('userId');

        /** @var User|MockObject $oItemMock */
        $oItemMock = $this->getMockBuilder(User::class)
            ->addMethods(['getOrderUser'])
            ->getMock();
        $oItemMock->method('getOrderUser')->willReturn($oItemMock);

        /** @var d3usermanager|MockObject $oManagerMock */
        $oManagerMock = $this->getMockBuilder(d3usermanager::class)
            ->onlyMethods(['getCurrentItem'])
            ->getMock();
        $oManagerMock->expects($this->any())->method('getCurrentItem')->willReturn($oItemMock);

        $this->setValue(
            $this->_oModel,
            'oUserManager',
            $oManagerMock
        );

        $this->assertSame(
            $remarkMock,
            $this->callMethod(
                $this->_oModel,
                'd3generateUserManagerRemark'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3getUserManagerRemarkText
     * @test
     * @throws ReflectionException
     */
    public function canGetRemarkText()
    {
        /** @var d3_oxemail_usermanager|MockObject $oModelMock */
        $oModelMock = $this->getMockBuilder(Email::class)
            ->onlyMethods([
                'getAllRecipientAddresses',
                'getBody',
                'getAltBody'
            ])
            ->getMock();
        $oModelMock->expects($this->any())->method('getAllRecipientAddresses')->willReturn(
            [
                'key1'  => 'value1',
                'key2'  => 'value2',
            ]
        );
        $oModelMock->expects($this->any())->method('getBody')->willReturn('testBody');
        $oModelMock->expects($this->any())->method('getAltBody')->willReturn('testAltBody');

        $this->_oModel = $oModelMock;

        $this->assertEquals(
            'Recipients:'.
            PHP_EOL.'---'.PHP_EOL.
            'key1, key2'.
            PHP_EOL.'---'.PHP_EOL.
            'HTML:'.
            PHP_EOL.'---'.PHP_EOL.
            'testBody'.
            PHP_EOL.'---'.PHP_EOL.
            'Plain'.
            PHP_EOL.'---'.PHP_EOL.
            'testAltBody',
            $this->callMethod(
                $this->_oModel,
                'd3getUserManagerRemarkText'
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

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3getUserManagerDIContainer
     * @test
     * @throws ReflectionException
     */
    public function getDIContainerHasRightInstance()
    {
        $this->assertInstanceOf(
            ContainerInterface::class,
            $this->callMethod(
                $this->_oModel,
                'd3getUserManagerDIContainer'
            )
        );
    }

    /**
     * @covers \D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager::d3UserManagerThrowUnequalContentException
     * @test
     * @throws ReflectionException
     */
    public function throwUnequalContentExceptionHasRightInstance()
    {
        $this->expectException(d3usermanager_templaterendererExceptionInterface::class);

        $this->callMethod(
            $this->_oModel,
            'd3UserManagerThrowUnequalContentException'
        );
    }
}
