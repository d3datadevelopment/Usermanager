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

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Application\Model\Shopcompatibility\d3ShopCompatibilityAdapterHandler;
use D3\Usermanager\Application\Model\d3usermanager;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Content as Content;
use OxidEsales\Eshop\Application\Model\Remark;
use OxidEsales\Eshop\Application\Model\Shop as Shop;
use OxidEsales\Eshop\Application\Model\User as User;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Email;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Module\Module as Module;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use Smarty;

// @codeCoverageIgnoreStart
if (false) {
    class_alias(
        Email::class,
        d3_email_usermanager_parent::class
    );
}
// @codeCoverageIgnoreEnd

class d3_oxemail_usermanager extends d3_oxemail_usermanager_parent
{
    protected $_sUserManagerInfoTemplate = 'd3usermanager_info_html.tpl';
    protected $_sUserManagerInfoPlainTemplate = 'd3usermanager_info_plain.tpl';
    private $_sModId = 'd3usermanager';
    /** @var  d3usermanager */
    public $oUserManager;

    /**
     * constructor
     */
    public function __construct()
    {
        d3GetModCfgDIC()->setParameter('d3.usermanager.modcfgid', $this->_sModId);

        /** @var Config _oConfig */
        $this->_oConfig = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);

        parent::__construct();
    }

    /**
     * @param array $aUserManagerNotes
     * @return bool
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function d3sendUserManagerEmail($aUserManagerNotes)
    {
        startProfile(__METHOD__);

        $oShop = $this->_getShop();
        /** @var Smarty $oSmarty */
        $oSmarty = $this->_getSmarty();

        $this->_setMailParams($oShop);
        $this->setViewData("aNotes", $aUserManagerNotes);
        $this->setViewData("shopTemplateDir", Registry::getConfig()->getTemplateDir(false));
        $this->setViewData("oShop", $oShop);
        $oSmarty->template_dir = Registry::getConfig()->getTemplateDir(false);

        $this->_processViewArray();

        $this->setBody($oSmarty->fetch($this->_sUserManagerInfoTemplate));
        $this->setAltBody($oSmarty->fetch($this->_sUserManagerInfoPlainTemplate));

        d3_cfg_mod::get($this->_sModId)->d3getLog()->log(
            d3log::NOTICE,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'send job execution info mail',
            $this->getBody()
        );

        $sSubject = Registry::getLang()->translateString('D3_USERMANAGER_MAIL_USERSUBJECT', 0);
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
     * @return User
     */
    public function d3getUser($sOxId)
    {
        if (strstr($sOxId, '@@')) {
            $aOxId = explode('@@', $sOxId);
            $sOxId = $aOxId[0];
        }

        /** @var $oUser User */
        $oUser = oxNew(User::class);
        $oUser->load($sOxId);
        return $oUser;
    }

    /**
     * @param $sOxId
     * @return d3usermanager
     */
    public function d3getUserManager($sOxId)
    {
        /** @var $oUser d3usermanager */
        $oUserManager = d3GetModCfgDIC()->get(d3usermanager::class);
        $oUserManager->load($sOxId);
        return $oUser;
    }

    /**
     * @param d3usermanager $oUserManager
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function sendUserManagerMail(d3usermanager $oUserManager)
    {
        $this->oUserManager = $oUserManager;
        $aContent = $this->getUserManagerMailContent($oUserManager);

        $oShop = $this->_getShop();
        $this->setBody($aContent['html']);
        $this->setAltBody($aContent['plain']);
        $this->setSubject($aContent['subject']);

        $this->_d3SetUserManagerReplyAddress($oUserManager, $oShop);

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
            $this->_d3sendUserManagerMailToOwner($oShop);
        } elseif ($this->_d3hasUserManagerCustomRecipient()) {
            $this->_d3sendUserManagerMailToCustom();
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
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetSet()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * required for unit tests, can't mock getConfig method
     * @return Config
     * @throws Exception
     */
    public function d3GetConfig()
    {
        /** @var Config $config */
        $config = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);
        return $config;
    }

    /**
     * @param d3usermanager $oUserManager
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getUserManagerMailContent(d3usermanager $oUserManager)
    {
        $this->oUserManager = $oUserManager;
        $aContent = array();

        $blTplFromAdmin = $oUserManager->getValue('sSendMailFromTheme') == 'admin';
        Registry::getConfig()->setAdminMode($blTplFromAdmin);

        $oShop = $this->_getShop();
        $this->_setMailParams($oShop);

        /** @var Smarty $oSmarty */
        $oSmarty = $this->_getSmarty();

        $this->setViewData("oShop", $oShop);
        $this->setViewData("oViewConf", $this->getViewConfig());
        $this->setViewData("oUser", $oUserManager->getCurrentItem());
        $this->setViewData("shopTemplateDir", Registry::getConfig()->getTemplateDir(false));
        $this->setViewData("charset", Registry::getLang()->translateString("charset"));

        $this->setViewData("shop", $oShop);
        $this->setViewData("user", $oUserManager->getCurrentItem());

        $oSmarty->template_dir = $this->getTemplateDir4UserManager($oUserManager);
        $this->_processViewArray();

        if (false == $this->d3GetSet()->getLicenseConfigData('blUseMailSendOnly', 0)) {
            $oSmarty = $this->d3SendMailHook($oSmarty);
        }

        $aContent = $this->_d3GenerateUserManagerMailContent($aContent, $oSmarty);

        Registry::getConfig()->setAdminMode(true);

        return $aContent;
    }

    /**
     * @return Module
     * @throws Exception
     */
    public function d3GetModule()
    {
        /** @var Module $module */
        $module = d3GetModCfgDIC()->get('d3ox.usermanager.'.Module::class);
        return $module;
    }

    /**
     * @return d3str
     * @throws Exception
     */
    public function getD3Str()
    {
        return d3GetModCfgDIC()->get(d3str::class);
    }

    /**
     * @return d3ShopCompatibilityAdapterHandler
     * @throws Exception
     */
    public function d3GetShopCompatibilityAdapterHandler()
    {
        return d3GetModCfgDIC()->get(d3ShopCompatibilityAdapterHandler::class);
    }

    /**
     * @param d3usermanager $oUserManager
     * @return string
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws Exception
     */
    public function getTemplateDir4UserManager($oUserManager)
    {
        if ($oUserManager->getValue('sSendMailFromTheme') == 'module') {
            $sModuleId = $oUserManager->getValue('sSendMailFromModulePath');

            $sModulePath = $this->d3GetShopCompatibilityAdapterHandler()->call(
                'oxmodule__getModuleFullPath',
                array($this->d3GetModule(), $sModuleId)
            );

            $sPath = $this->getD3Str()->untrailingslashit($sModulePath);
        } else {
            $blAdmin = $oUserManager->getValue('sSendMailFromTheme') == 'admin';
            $sPath   = $this->d3GetConfig()->getTemplateDir($blAdmin);
        }
        return $sPath;
    }

    /**
     * @param Smarty $oSmarty
     * @return Smarty
     */
    public function d3SendMailHook(Smarty $oSmarty)
    {
        // available objects:
        // oxEmail:                $this
        // Smarty:                 $oSmarty
        // Usermanager profile:    $this->oUserManager
        // oxuser:                 inside smarty

        return $oSmarty;
    }

    /**
     * @return Content
     * @throws Exception
     */
    public function d3GetContent()
    {
        /** @var Content $content */
        $content = d3GetModCfgDIC()->get('d3ox.usermanager.'.Content::class);
        return $content;
    }

    /**
     * @param               $aContent
     * @param Smarty $oSmarty
     *
     * @return mixed
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    protected function _d3GenerateUserManagerMailContent($aContent, Smarty $oSmarty)
    {
        $aEditedValues = $this->oUserManager->getEditedValues();

        $oLang        = Registry::getLang();
        $iUserLangId = $oLang->getTplLanguage();
        $iCurrentBaseLang = $oLang->getBaseLanguage();
        $oLang->setTplLanguage($iUserLangId);
        $oLang->setBaseLanguage($iUserLangId);

        if ($this->d3HasUserManagerEditorMailContent($aEditedValues)) {
            $aContent = $aEditedValues['mail'];
        } elseif ($this->oUserManager->getValue('sSendMailFromSource') == 'cms') {
            /** @var UtilsView $oUtilsView */
            $oUtilsView = Registry::get(UtilsView::class);
            $oContent = $this->d3GetContent();
            $oContent->setLanguage($iUserLangId);
            $oContent->load($this->oUserManager->getValue('sSendMailFromContentname'));

            $aContent['html']    = $oUtilsView->parseThroughSmarty(
                $oContent->getFieldData('oxcontent'),
                $oContent->getId() . 'oxcontent'
            );

            $aContent['subject'] = $oContent->getFieldData('oxtitle');
            $oContent->load($this->oUserManager->getValue('sSendMailFromContentnamePlain'));
            $aContent['plain'] = $oUtilsView->parseThroughSmarty(
                $oContent->getFieldData('oxcontent'),
                $oContent->getId() . 'oxcontent'
            );
        } elseif ($this->oUserManager->getValue('sSendMailFromSource') == 'template') {
            $aContent['html']    = $oSmarty->fetch($this->oUserManager->getValue('sSendMailFromTemplatename'));
            $aContent['plain']   = $oSmarty->fetch($this->oUserManager->getValue('sSendMailFromTemplatenamePlain'));
            $aContent['subject'] = $oSmarty->fetch($this->oUserManager->getValue('sSendMailFromSubject'));
        }

        $oLang->setTplLanguage($iUserLangId);
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
        return $this->isArrayEditorMailContent($aEditedValues) &&
               $aEditedValues['mail']['subject'] &&
               $aEditedValues['mail']['html'] &&
               $aEditedValues['mail']['plain'];
    }

    /**
     * @param $aEditedValues
     *
     * @return bool
     */
    public function isArrayEditorMailContent($aEditedValues)
    {
        return is_array($aEditedValues) && is_array($aEditedValues['mail']);
    }

    /**
     * @return Remark
     * @throws Exception
     */
    public function d3GetRemark()
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

        // add user history
        $oRemark                       = $this->d3GetRemark();
        $aRemarkContent = array(
            'oxtext'        => $this->getAltBody(),
            'oxparentid'    => $this->oUserManager->getCurrentItem()->getId(),
            'oxtype'        => 'o',
        );
        $oRemark->assign($aRemarkContent);
        return $oRemark;
    }

    /**
     * @param Shop $oShop
     * @throws d3ParameterNotFoundException
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
                $aMailAddressList[] = $sAddress;
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
     * @param d3usermanager $oUserManager
     * @param Shop $oShop
     */
    protected function _d3SetUserManagerReplyAddress(d3usermanager $oUserManager, $oShop)
    {
        if (strlen(trim($oUserManager->getValue('sSendMailReplyAddress')))) {
            $this->setFrom(trim($oUserManager->getValue('sSendMailReplyAddress')));
            $this->setReplyTo(
                trim($oUserManager->getValue('sSendMailReplyAddress')),
                $oShop->__get('oxshops__oxname')->getRawValue()
            );
        } else {
            $this->setReplyTo($oShop->getFieldData('oxinfoemail'), $oShop->__get('oxshops__oxname')->getRawValue());
        }
    }
}
