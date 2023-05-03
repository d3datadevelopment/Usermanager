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

namespace D3\Usermanager\Modules\Application\Model;

use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Exception\wrongModIdException;
use D3\ModCfg\Application\Model\Log\d3LogInterface;
use D3\OxidServiceBridges\Internal\Framework\Module\Path\ModulePathResolverBridgeInterface;
use D3\Usermanager\Application\Model\Context\Html2TextContext;
use D3\Usermanager\Application\Model\Context\Html2TextContextInterface;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanager_renderererrorhandler;
use D3\Usermanager\Application\Model\d3usermanager_vars;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_smartyException;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_templaterendererExceptionInterface;
use D3\Usermanager\Application\Model\Exceptions\emptyMessageException;
use D3\Usermanager\Application\Model\MessageContentGenerator;
use Exception;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3str;
use Html2Text\Html2Text;
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
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateEngineInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class d3_oxemail_usermanager extends d3_oxemail_usermanager_parent
{
    use d3usermanager_vars;

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
        if (d3GetModCfgDIC()->getParameter($this->_DIC_Instance_Id . 'modcfgid') !== $this->_sModId) {
            throw oxNew(wrongModIdException::class, $this->_sModId);
        }

        parent::__construct();
    }

    /**
     * @return TemplateEngineInterface
     */
    protected function _d3GetUserManagerTemplateEngine(): TemplateEngineInterface
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
     * @throws d3usermanager_smartyException
     */
    public function d3sendUserManagerEmail($aManagerNotes): bool
    {
        startProfile(__METHOD__);

        $oShop = $this->getShop();

        /** @var Config $config */
        $config = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);

        $this->_setMailParams($oShop);
        $this->setViewData("aNotes", $aManagerNotes);
        $this->setViewData("shopTemplateDir", $config->getTemplateDir(false));
        $this->setViewData("oShop", $oShop);

        $this->_processViewArray();

        $templateEngine = $this->_d3GetUserManagerTemplateEngine();
        foreach ($this->getViewData() as $key => $value) {
            $templateEngine->addGlobal($key, $value);
        }

        set_error_handler(
            [d3GetModCfgDIC()->get(d3usermanager_renderererrorhandler::class), 'd3HandleTemplateEngineErrors']
        );

        $this->d3UMsetBody($templateEngine->render($this->_sUserManagerInfoTemplate));
        $this->d3UMsetAltBody($templateEngine->render($this->_sUserManagerInfoPlainTemplate));

        restore_error_handler();

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
        $sSubject = $oLang->translateString('D3_USERMANAGER_MAIL_USERSUBJECT', 0);
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
    public function d3GetUserManagerUser($sOxId): Item
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
    public function d3getUserManager($sOxId): Manager
    {
        /** @var $oManager Manager */
        $oManager = d3GetModCfgDIC()->get(Manager::class);
        $oManager->load($sOxId);
        return $oManager;
    }

    /**
     * @param Manager $oManager
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DatabaseException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function sendUserManagerMail(Manager $oManager): bool
    {
        $blSuccess = false;

        try {
            $this->oUserManager = $oManager;
            $aContent            = $this->getUserManagerMailContent( $oManager );

            $oShop = $this->_getShop();
            $this->d3UMsetBody( $aContent['html'] );
            $this->d3UMsetAltBody( $aContent['plain'] );
            $this->d3UMsetSubject( $aContent['subject'] );

            $this->_d3SetUserManagerReplyAddress( $oManager, $oShop );

            $oRemark = $this->_d3SetUserManagerMailRecipients( $oShop );

            $blSuccess = $this->send();

            if ( $blSuccess && $oRemark ) {
                $oRemark->save();
            }
        } catch (emptyMessageException $e) {}

        return $blSuccess;
    }

    /**
     * @param $content
     *
     * @throws d3usermanager_smartyException
     */
    protected function d3UMsetBody($content)
    {
        $this->setBody($content);

        if (strlen($content) && false === (bool) strlen($this->getBody())) {
            $this->d3UserManagerThrowUnequalContentException();
        }
    }

    /**
     * @param $content
     *
     * @throws d3usermanager_smartyException
     */
    protected function d3UMsetAltBody($content)
    {
        $this->setAltBody($content);

        if (strlen($content) && false === (bool) strlen($this->getAltBody())) {
            $this->d3UserManagerThrowUnequalContentException();
        }
    }

    /**
     * @param $content
     *
     * @throws d3usermanager_smartyException
     */
    protected function d3UMsetSubject($content)
    {
        $this->setSubject($content);

        if (strlen($content) && false === (bool) strlen($this->getSubject())) {
            $this->d3UserManagerThrowUnequalContentException();
        }
    }

    /**
     * @param Shop $oShop
     *
     * @return null|Remark
     * @throws d3ParameterNotFoundException
     */
    protected function _d3SetUserManagerMailRecipients(Shop $oShop): ?Remark
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
        return false === isset($aEditedValues[$sVarName]) || $aEditedValues[$sVarName] === false || $aEditedValues[$sVarName] === null ?
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
     * @param Manager $oManager
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     * @throws d3usermanager_templaterendererExceptionInterface
     */
    public function getUserManagerMailContent(Manager $oManager, bool $checkForEmptyContents = true): array
    {
        $aContent = [];

        $aEditedValues = $oManager->getEditedValues();

        if ($this->d3HasUserManagerEditorMailContent($aEditedValues)) {
            $aContent = $aEditedValues['mail'];

            if ( $aContent['genplain'] ) {
                $aContent['plain'] = $this->d3generateUserManagerPlainContent( $aContent['html'] );
            }
            unset($aContent['genplain']);
        } elseif ($oManager->getValue('sSendMailFromSource') == 'cms') {
            $generator = $this->getMessageContentGeneratorUserManager( $oManager );
            $generator->setAllowEmptyMessageContent(true);
            $oContent = $this->d3GetUserManagerContentObject();
            $oContent->load($oManager->getValue('sSendMailFromContentname'));
            $aContent['html'] = $generator->generateFromCms($oManager->getValue('sSendMailFromContentname'));
            $aContent['subject'] = $oContent->getFieldData('oxtitle');
            $aContent['plain'] = $generator->generateFromCms($oManager->getValue('sSendMailFromContentnamePlain'));
        } elseif ($oManager->getValue('sSendMailFromSource') == 'template') {
            $generator = $this->getMessageContentGeneratorUserManager( $oManager );
            $generator->setAllowEmptyMessageContent(true);
            $fromTheme = $oManager->getValue('sSendMailFromTheme');
            $generator->setTemplateFrom(
                $fromTheme === 'admin' ? MessageContentGenerator::TEMPLATE_FROM_ADMIN :
                    ($fromTheme === 'module' ? MessageContentGenerator::TEMPLATE_FROM_MODULE :
                        MessageContentGenerator::TEMPLATE_FROM_FRONTEND),
                $oManager->getValue('sSendMailFromModulePath')
            );
            $aContent['html']  = $generator->generateFromTpl($oManager->getValue('sSendMailFromTemplatename'));
            $aContent['subject']  = $generator->generateFromTpl($oManager->getValue('sSendMailFromSubject'));
            $aContent['plain']  = $generator->generateFromTpl($oManager->getValue('sSendMailFromTemplatenamePlain'));
        }

        if ($checkForEmptyContents && (
                (false === is_string($aContent['html']) || false === (bool) strlen($aContent['html'])) &&
                (false === is_string($aContent['html']) || false === (bool) strlen($aContent['plain'])) &&
                (false === is_string($aContent['html']) || false === (bool) strlen($aContent['subject'])))
        ) {
            /** @var emptyMessageException $exc */
            $exc = oxNew(emptyMessageException::class, 'message content is empty, '.$oManager->getFieldData('oxtitle'));
            throw $exc;
        }

        return $aContent;
    }

    /**
     * @return d3str
     * @throws Exception
     */
    public function getD3UserManagerStrObject(): d3str
    {
        /** @var d3str $d3str */
        $d3str = d3GetModCfgDIC()->get(d3str::class);
        return $d3str;
    }

    /**
     * @return Content
     * @throws Exception
     */
    public function d3GetUserManagerContentObject(): Content
    {
        /** @var Content $content */
        $content = d3GetModCfgDIC()->get('d3ox.usermanager.'.Content::class);
        return $content;
    }

    /**
     * @param $aEditedValues
     *
     * @return bool
     */
    public function d3HasUserManagerEditorMailContent($aEditedValues): bool
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
    public function d3isUserManagerArrayEditorMailContent($aEditedValues): bool
    {
        return is_array($aEditedValues) && isset($aEditedValues['mail'])  && is_array($aEditedValues['mail']);
    }

    /**
     * @param $html
     * @return string
     * @throws Exception
     */
    public function d3generateUserManagerPlainContent($html): string
    {
        /** @var Html2TextContext $context */
        $context = d3GetModCfgDIC()->get(Html2TextContextInterface::class);
        $context->setMessage($html);

        /** @var Html2Text $html */
        $html = d3GetModCfgDIC()->get(Html2Text::class);
        return $html->getText();
    }

    /**
     * @return Remark
     * @throws Exception
     */
    public function d3GetUserManagerRemark(): Remark
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
    protected function _d3sendUserManagerMailToCustomer(Shop $oShop): Remark
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
    protected function _d3sendUserManagerMailToOwner(Shop $oShop): Remark
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
    protected function _d3sendUserManagerMailToCustom(): Remark
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
    protected function _d3getUserManagerCustomMailAddressList(): array
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
    public function _d3HasUserManagerCustomMailAddresses(): bool
    {
        return $this->_d3hasUserManagerCustomRecipient() && $this->_d3getUserManagerCustomRecipientList();
    }

    /**
     * @param Manager $oManager
     * @param Shop $oShop
     */
    protected function _d3SetUserManagerReplyAddress(Manager $oManager, Shop $oShop)
    {
        if (strlen(trim((string) $oManager->getValue('sSendMailReplyAddress')))) {
            $this->setFrom(trim($oManager->getValue('sSendMailReplyAddress')));
            $this->setReplyTo(
                trim((string) $oManager->getValue('sSendMailReplyAddress')),
                $oShop->__get('oxshops__oxname')->getRawValue()
            );
        } else {
            $this->setFrom($oShop->getFieldData('oxinfoemail'), $oShop->__get('oxshops__oxname')->getRawValue());
            $this->setReplyTo($oShop->getFieldData('oxinfoemail'), $oShop->__get('oxshops__oxname')->getRawValue());
        }
    }

    /**
     * add user history
     * @return Remark
     * @throws d3ParameterNotFoundException
     * @throws Exception
     */
    public function d3generateUserManagerRemark(): Remark
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
    public function d3GetUserManagerRemarkText(): string
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
    public function d3getUserManagerDIContainer(): ContainerInterface
    {
        return ContainerFactory::getInstance()->getContainer();
    }

    /**
     * @throws d3usermanager_smartyException
     */
    protected function d3UserManagerThrowUnequalContentException() : void
    {
        throw oxNew(d3usermanager_smartyException::class, 'empty mail content, possible file encoding error');
    }

    /**
     * @param Manager $oManager
     *
     * @return MessageContentGenerator|mixed
     * @throws d3ParameterNotFoundException
     */
    protected function getMessageContentGeneratorUserManager( Manager $oManager )
    {
        return oxNew( MessageContentGenerator::class, $oManager, $oManager->getCurrentItem() );
    }
}
