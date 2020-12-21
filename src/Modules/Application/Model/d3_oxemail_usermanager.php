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

namespace D3\Usermanager\Modules\Application\Model;

use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3LogInterface;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use Doctrine\DBAL\DBALException;
use Exception;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3str;
use Html2Text\Html2Text;
use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Application\Model\Content as Content;
use OxidEsales\Eshop\Application\Model\Remark;
use OxidEsales\Eshop\Application\Model\Shop as Shop;
use OxidEsales\Eshop\Application\Model\User as Item;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\DatabaseException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Path\ModulePathResolver;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Path\ModulePathResolverInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateEngineInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class d3_oxemail_usermanager extends d3_oxemail_usermanager_parent
{
    private $_sModId = 'd3usermanager';
    protected $_sUserManagerInfoTemplate = 'd3usermanager_info_html.tpl';
    protected $_sUserManagerInfoPlainTemplate = 'd3usermanager_info_plain.tpl';
    /** @var  Manager */
    public $oUserManager;

    /**
     * d3_oxemail_usermanager constructor.
     * @throws Exception
     */
    public function __construct()
    {
        d3GetModCfgDIC()->setParameter('d3.usermanager.modcfgid', $this->_sModId);

        parent::__construct();
    }

    /**
     * @return TemplateEngineInterface
     */
    protected function _getTemplateEngine()
    {
        /** @var TemplateRendererInterface $renderer */
        $renderer = $this->d3getUserManagerDIContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer();
        return $renderer->getTemplateEngine();
    }

    /**
     * @param $aManagerNotes
     * @return bool
     * @throws Exception
     */
    public function d3sendUserManagerEmail($aManagerNotes)
    {
        startProfile(__METHOD__);

        $oShop = $this->_getShop();

        $templateEngine = $this->_getTemplateEngine();

        /** @var Config $config */
        $config = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);

        $this->_setMailParams($oShop);
        $this->setViewData("aNotes", $aManagerNotes);
        $this->setViewData("shopTemplateDir", $config->getTemplateDir(false));
        $this->setViewData("oShop", $oShop);

        $this->_processViewArray();

        $this->setBody($templateEngine->render($this->_sUserManagerInfoTemplate));
        $this->setAltBody($templateEngine->render($this->_sUserManagerInfoPlainTemplate));

        /** @var d3LogInterface $oLog */
        $oLog = d3GetModCfgDIC()->get('d3.usermanager.log');
        $oLog->notice(
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'send job execution info mail',
            $this->getBody()
        );

        /** @var Language $oLang */
        $oLang = d3GetModCfgDIC()->get('d3ox.usermanager.'.Language::class);
        $sSubject = $oLang->translateString('D3_USERMANAGER_MAIL_ORDERSUBJECT', 0);
        $this->setSubject($sSubject);

        $sFullName = $oShop->__get('oxshops__oxname')->getRawValue();
        $this->setRecipient($oShop->getFieldData('oxinfoemail'), $sFullName);
        $this->setReplyTo($oShop->getFieldData('oxinfoemail'), $oShop->__get('oxshops__oxname')->getRawValue());

        $blSuccess = $this->send();

        stopProfile(__METHOD__);

        return $blSuccess;
    }

    /**
     * @param $sOxId
     * @return Item
     * @throws Exception
     */
    public function d3GetUserManagerUser($sOxId)
    {
        if (strstr($sOxId, '@@')) {
            $aOxId = explode('@@', $sOxId);
            $sOxId = $aOxId[0];
        }

        /** @var $oItem Item */
        $oItem = d3GetModCfgDIC()->get('d3ox.usermanager.'.Item::class);

        $oItem->load($sOxId);
        return $oItem;
    }

    /**
     * @param $sOxId
     * @return Manager
     * @throws Exception
     */
    public function d3getUserManager($sOxId)
    {
        /** @var $oManager Manager */
        $oManager = d3GetModCfgDIC()->get(Manager::class);
        $oManager->load($sOxId);
        return $oManager;
    }

    /**
     * @param Manager $oManager
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DatabaseException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function sendUserManagerMail(Manager $oManager)
    {
        $this->oUserManager = $oManager;
        $aContent = $this->getUserManagerMailContent($oManager);

        $oShop = $this->_getShop();
        $this->setBody($aContent['html']);
        $this->setAltBody($aContent['plain']);
        $this->setSubject($aContent['subject']);

        $this->_d3SetUserManagerReplyAddress($oManager, $oShop);

        $oRemark = $this->_d3SetUserManagerMailRecipients($oShop);

        $blSuccess = $this->send();

        if ($blSuccess && $oRemark) {
            $oRemark->save();
        }

        return $blSuccess;
    }

    /**
     * @param Shop $oShop
     *
     * @return null|Remark
     * @throws d3ParameterNotFoundException
     */
    protected function _d3SetUserManagerMailRecipients(Shop $oShop)
    {
        $oRemark = null;
        if ($this->_d3hasUserManagerCustomerRecipient()) {
            $oRemark = $this->_d3sendUserManagerMailToCustomer($oShop);
        } elseif ($this->_d3hasUserManagerOwnerRecipient()) {
            $oRemark = $this->_d3sendUserManagerMailToOwner($oShop);
        } elseif ($this->_d3hasUserManagerCustomRecipient()) {
            $oRemark = $this->_d3sendUserManagerMailToCustom();
        }

        return $oRemark;
    }

    /**
     * @param               $sVarName
     *
     * @return mixed
     * @throws d3ParameterNotFoundException
     */
    protected function _d3getUserManagerMailOption($sVarName)
    {
        $aEditedValues = $this->oUserManager->getEditedValues();
        return $aEditedValues[$sVarName] === false || $aEditedValues[$sVarName] === null ?
            $this->oUserManager->getValue($sVarName) :
            $aEditedValues[$sVarName];
    }

    /**
     * @return mixed
     * @throws d3ParameterNotFoundException
     */
    protected function _d3hasUserManagerCustomerRecipient()
    {
        return $this->_d3getUserManagerMailOption('blSendMailToCustomer');
    }

    /**
     * @return mixed
     * @throws d3ParameterNotFoundException
     */
    protected function _d3hasUserManagerOwnerRecipient()
    {
        return $this->_d3getUserManagerMailOption('blSendMailToOwner');
    }

    /**
     * @return mixed
     * @throws d3ParameterNotFoundException
     */
    protected function _d3hasUserManagerCustomRecipient()
    {
        return $this->_d3getUserManagerMailOption('blSendMailToCustom');
    }

    /**
     * @return mixed
     * @throws d3ParameterNotFoundException
     */
    protected function _d3getUserManagerCustomRecipientList()
    {
        return $this->_d3getUserManagerMailOption('sSendMailToCustomAddress');
    }

    /**
     * @return d3_cfg_mod
     * @throws Exception
     */
    public function d3GetUserManagerSet()
    {
        /** @var d3_cfg_mod $modcfg */
        $modcfg = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        return $modcfg;
    }

    /**
     * @return Language
     * @throws Exception
     */
    public function d3GetUserManagerLanguageObject()
    {
        /** @var Language $language */
        $language = d3GetModCfgDIC()->get('d3ox.usermanager.'.Language::class);
        return $language;
    }

    /**
     * required for unit tests, can't mock getConfig method
     * @return Config
     * @throws Exception
     */
    public function d3GetUserManagerConfigObject()
    {
        /** @var Config $config */
        $config = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);
        return $config;
    }

    /**
     * @param Manager $oManager
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function getUserManagerMailContent(Manager $oManager)
    {
        $this->oUserManager = $oManager;
        $aContent = array();

        $blTplFromAdmin = $oManager->getValue('sSendMailFromTheme') == 'admin';

        $oConfig = $this->d3GetUserManagerConfigObject();
        $oConfig->setAdminMode($blTplFromAdmin);

        $oShop = $this->_getShop();
        $this->_setMailParams($oShop);

        /** @var TemplateRendererInterface $renderer */
        $renderer = $this->d3getUserManagerDIContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer();
        $templateEngine = $renderer->getTemplateEngine();

        $this->setViewData("oShop", $oShop);
        $this->setViewData("oViewConf", $this->getViewConfig());
        $this->setViewData("oUser", $oManager->getCurrentItem());
        $this->setViewData("shopTemplateDir", $this->d3GetUserManagerConfigObject()->getTemplateDir(false));
        $this->setViewData("charset", $this->d3GetUserManagerLanguageObject()->translateString("charset"));

        $this->setViewData("shop", $oShop);
        $this->setViewData("user", $oManager->getCurrentItem());

        // ToDo: check in TWIG and change to a generic solution (e.g. path names in template name)
        // Smarty only
        if (method_exists($templateEngine, '__set')) {
            $templateEngine->__set( 'template_dir', $this->getTemplateDir4UserManager( $oManager ) );
        }
        $this->_processViewArray();

        if (false == $this->d3GetUserManagerSet()->getLicenseConfigData('blUseMailSendOnly', 0)) {
            $templateEngine = $this->d3SendMailHook($templateEngine);
        }

        $aContent = $this->_d3GenerateUserManagerMailContent($aContent, $templateEngine);
        $oConfig->setAdminMode(true);

        return $aContent;
    }

    /**
     * @return d3str
     * @throws Exception
     */
    public function getD3UserManagerStrObject()
    {
        /** @var d3str $d3str */
        $d3str = d3GetModCfgDIC()->get(d3str::class);
        return $d3str;
    }

    /**
     * @param Manager $oManager
     *
     * @return string
     * @throws Exception
     */
    public function getTemplateDir4UserManager($oManager)
    {
        if ($oManager->getValue('sSendMailFromTheme') == 'module') {
            $sModuleId = $oManager->getValue('sSendMailFromModulePath');
            /** @var ModulePathResolver $pathResolver */
            $pathResolver = $this->d3getUserManagerDIContainer()->get(ModulePathResolverInterface::class);
            $sModulePath = $pathResolver->getFullModulePathFromConfiguration(
                $sModuleId,
                Registry::getConfig()->getShopId()
            );
            $sPath = $this->getD3UserManagerStrObject()->untrailingslashit($sModulePath);
        } else {
            $blAdmin = $oManager->getValue('sSendMailFromTheme') == 'admin';
            $sPath   = $this->d3GetUserManagerConfigObject()->getTemplateDir($blAdmin);
        }
        return $sPath;
    }

    /**
     * @param TemplateEngineInterface $templateEngine
     * @return TemplateEngineInterface
     */
    public function d3SendMailHook(TemplateEngineInterface $templateEngine)
    {
        // available objects:
        // oxEmail:                $this
        // Template Engine:        $templateEngine
        // Usermanager profile:    $this->oUserManager
        // oxuser:                 inside template engine

        return $templateEngine;
    }

    /**
     * @codeCoverageIgnore because visual CMS extension issue
     * @return UtilsView
     * @throws Exception
     */
    public function d3GetUserManagerUtilsView()
    {
        /** @var UtilsView $utilsView */
        $utilsView = d3GetModCfgDIC()->get('d3ox.usermanager.'.UtilsView::class);
        return $utilsView;
    }

    /**
     * @return Content
     * @throws Exception
     */
    public function d3GetUserManagerContentObject()
    {
        /** @var Content $content */
        $content = d3GetModCfgDIC()->get('d3ox.usermanager.'.Content::class);
        return $content;
    }

    /**
     * @param               $aContent
     * @param TemplateEngineInterface $templateEngine
     *
     * @return mixed
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    protected function _d3GenerateUserManagerMailContent($aContent, TemplateEngineInterface $templateEngine)
    {
        $aEditedValues = $this->oUserManager->getEditedValues();

        $oLang        = $this->d3GetUserManagerLanguageObject();
        $iUserLangId = $oLang->getTplLanguage();
        $iCurrentTplLang = $oLang->getTplLanguage();
        $iCurrentBaseLang = $oLang->getBaseLanguage();

        $oLang->setTplLanguage($iUserLangId);
        $oLang->setBaseLanguage($iUserLangId);

        if ($this->d3HasUserManagerEditorMailContent($aEditedValues)) {
            $aContent = $aEditedValues['mail'];

            if ($aContent['genplain']) {
                $aContent['plain'] = $this->d3generateUserManagerPlainContent($aContent['html']);
            }
        } elseif ($this->oUserManager->getValue('sSendMailFromSource') == 'cms') {
            $oUtilsView = $this->d3GetUserManagerUtilsView();
            $oContent = $this->d3GetUserManagerContentObject();
            $oContent->loadInLang($iUserLangId, $this->oUserManager->getValue('sSendMailFromContentname'));

            $oActView = oxNew(FrontendController::class);
            $oActView->addGlobalParams();

            $aContent['html']    = $oUtilsView->getRenderedContent(
                $oContent->getFieldData('oxcontent'),
                $oActView->getViewData(),
                $oContent->getId() . 'oxcontent'
            );

            $aContent['subject'] = $oContent->getFieldData('oxtitle');
            $oContent->loadInLang($iUserLangId, $this->oUserManager->getValue('sSendMailFromContentnamePlain'));
            $aContent['plain'] = $oUtilsView->getRenderedContent(
                $oContent->getFieldData('oxcontent'),
                $oActView->getViewData(),
                $oContent->getId() . 'oxcontent'
            );
        } elseif ($this->oUserManager->getValue('sSendMailFromSource') == 'template') {
            $aContent['html']    = $templateEngine->render($this->oUserManager->getValue('sSendMailFromTemplatename'));
            $aContent['plain']   = $templateEngine->render($this->oUserManager->getValue('sSendMailFromTemplatenamePlain'));
            $aContent['subject'] = $templateEngine->render($this->oUserManager->getValue('sSendMailFromSubject'));
        }

        $oLang->setTplLanguage($iCurrentTplLang);
        $oLang->setBaseLanguage($iCurrentBaseLang);

        return $aContent;
    }

    /**
     * @param $aEditedValues
     *
     * @return bool
     */
    public function d3HasUserManagerEditorMailContent($aEditedValues)
    {
        return $this->d3isUserManagerArrayEditorMailContent($aEditedValues) &&
               $aEditedValues['mail']['subject'] &&
               $aEditedValues['mail']['html'] &&
                (
                    $aEditedValues['mail']['genplain'] ||
                    $aEditedValues['mail']['plain']
                );
    }

    /**
     * @param $aEditedValues
     *
     * @return bool
     */
    public function d3isUserManagerArrayEditorMailContent($aEditedValues)
    {
        return is_array($aEditedValues) && is_array($aEditedValues['mail']);
    }

    /**
     * @param $html
     * @return string
     * @throws Exception
     */
    public function d3generateUserManagerPlainContent($html)
    {
        d3GetModCfgDIC()->setParameter(Html2Text::class.'.args.html', $html);

        /** @var Html2Text $html */
        $html = d3GetModCfgDIC()->get(Html2Text::class);
        return $html->getText();
    }

    /**
     * @return Remark
     * @throws Exception
     */
    public function d3GetUserManagerRemark()
    {
        /** @var Remark $remark */
        $remark = d3GetModCfgDIC()->get('d3ox.usermanager.'.Remark::class);
        return $remark;
    }

    /**
     * @param Shop $oShop
     *
     * @return Remark
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    protected function _d3sendUserManagerMailToCustomer(Shop $oShop)
    {
        $sFullName = $this->oUserManager->getCurrentItem()->__get('oxuser__oxfname')->getRawValue() . " " .
            $this->oUserManager->getCurrentItem()->__get('oxuser__oxlname')->getRawValue();
        $this->setRecipient($this->oUserManager->getCurrentItem()->getFieldData('oxusername'), $sFullName);

        if ($this->_d3hasUserManagerOwnerRecipient()) {
            $this->addBCC($oShop->getFieldData('oxinfoemail'), $oShop->__get('oxshops__oxname')->getRawValue());
        }

        if ($this->_d3HasUserManagerCustomMailAddresses()) {
            foreach ($this->_d3getUserManagerCustomMailAddressList() as $sMailAdr) {
                $this->addBCC(trim($sMailAdr), trim($sMailAdr));
            }
        }

        return $this->d3generateUserManagerRemark();
    }

    /**
     * @param Shop $oShop
     *
     * @return Remark
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    protected function _d3sendUserManagerMailToOwner(Shop $oShop)
    {
        $sFullName = $oShop->__get('oxshops__oxname')->getRawValue();
        $this->setRecipient($oShop->getFieldData('oxinfoemail'), $sFullName);

        if ($this->_d3HasUserManagerCustomMailAddresses()) {
            foreach ($this->_d3getUserManagerCustomMailAddressList() as $sMailAdr) {
                $this->addBCC(trim($sMailAdr), trim($sMailAdr));
            }
        }

        return $this->d3generateUserManagerRemark();
    }

    /**
     * @throws d3ParameterNotFoundException
     */
    protected function _d3sendUserManagerMailToCustom()
    {
        if ($this->_d3HasUserManagerCustomMailAddresses()) {
            foreach ($this->_d3getUserManagerCustomMailAddressList() as $sMailAdr) {
                $this->setRecipient(trim($sMailAdr), trim($sMailAdr));
            }
        }

        return $this->d3generateUserManagerRemark();
    }

    /**
     * @return array
     * @throws d3ParameterNotFoundException
     */
    protected function _d3getUserManagerCustomMailAddressList()
    {
        $aMailAddressList = array();

        foreach (explode(';', $this->_d3getUserManagerCustomRecipientList()) as $sAddress) {
            if (strlen(trim($sAddress))) {
                $aMailAddressList[] = trim($sAddress);
            }
        }

        return $aMailAddressList;
    }

    /**
     * @return bool
     * @throws d3ParameterNotFoundException
     */
    public function _d3HasUserManagerCustomMailAddresses()
    {
        return $this->_d3hasUserManagerCustomRecipient() && $this->_d3getUserManagerCustomRecipientList();
    }

    /**
     * @param Manager $oManager
     * @param Shop $oShop
     */
    protected function _d3SetUserManagerReplyAddress(Manager $oManager, Shop $oShop)
    {
        if (strlen(trim($oManager->getValue('sSendMailReplyAddress')))) {
            $this->setFrom(trim($oManager->getValue('sSendMailReplyAddress')));
            $this->setReplyTo(
                trim($oManager->getValue('sSendMailReplyAddress')),
                $oShop->__get('oxshops__oxname')->getRawValue()
            );
        } else {
            $this->setReplyTo($oShop->getFieldData('oxinfoemail'), $oShop->__get('oxshops__oxname')->getRawValue());
        }
    }

    /**
     * add user history
     * @return Remark
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    public function d3generateUserManagerRemark()
    {
        $oRemark        = $this->d3GetUserManagerRemark();
        $aRemarkContent = array(
            'oxtext'     => $this->d3GetUserManagerRemarkText(),
            'oxparentid' => $this->oUserManager->getCurrentItem()->getId(),
            'oxtype'     => 'd3um',
        );
        $oRemark->assign( $aRemarkContent );

        return $oRemark;
    }

    /**
     * @return string
     */
    public function d3GetUserManagerRemarkText()
    {
        return implode(
            PHP_EOL.'---'.PHP_EOL,
            [
                'Recipients:',
                implode(', ', array_keys($this->getAllRecipientAddresses())),
                'HTML:',
                $this->getBody(),
                'Plain',
                $this->getAltBody()
            ]
        );
    }

    /**
     * @return ContainerInterface
     */
    public function d3getUserManagerDIContainer()
    {
        return ContainerFactory::getInstance()->getContainer();
    }
}
