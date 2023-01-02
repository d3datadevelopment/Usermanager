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

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Model\d3usermanager_configurationcheck;
use D3\Usermanager\Application\Model\Exceptions\d3ActionRequirementAbstract;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanager_conf;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_actionException;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_requirementException;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_templaterendererExceptionInterface;
use Exception;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;
use Psr\Log\LoggerInterface;

class d3_user_usermanager extends d3_user_usermanager_parent
{
    CONST PREVENTION_SAVEUSER = 'd3PreventUMSaveUserTrigger';

    /**
     * @param string $sParamName
     *
     * @return mixed
     */
    public function __get($sParamName)
    {
        $mContent = parent::__get($sParamName);

        if (false == $mContent && $this->{$sParamName}) {
            return $this->{$sParamName};
        }

        return $mContent;
    }

    /**
     * required for test purposes only
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3usermanagerTestMethod()
    {
        $this->assign(['oxcity'   => 'TestCity']);
        $this->save();
    }

    /**
     * @return string|false
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws Exception
     */
    public function save()
    {
        $blSave = parent::save();

        /** @var d3_cfg_mod $oSet */
        $oSet = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        $currentAdminMode = $this->isAdmin();

        if ($oSet->isActive() && in_array(Registry::getSession()->getVariable(self::PREVENTION_SAVEUSER), [null, false], true)) {
            /** @var d3usermanagerlist $oManagerList */
            $oManagerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
            /** @var Manager $oManager */
            foreach ($oManagerList->d3GetUserSaveTriggeredManagerTasks() as $oManager) {
                try {
                    $this->d3UserManagerCheckForConfigurationException($oManager);

                    $oManagerExecute = $this->d3UsermanagerGetManagerExecute($oManager);
                    if ($oManagerExecute->userMeetsConditions($this->getId())) {
                        // prevent infinit loop because of circular reference in save::method
                        Registry::getSession()->setVariable(self::PREVENTION_SAVEUSER, true);
                        $oManagerExecute->exec4user($this->getId(), d3usermanager_conf::EXECTYPE_USERSAVETRIGGERED);
                    }
                } catch (d3ActionRequirementAbstract | d3usermanager_templaterendererExceptionInterface $e) {
                    /** @var LoggerInterface $logger */
                    $logger = d3GetModCfgDIC()->get('d3ox.usermanager.Logger');
                    $logger->error($e->getMessage(), [$e]);
                    if (true === $currentAdminMode) {
                        /** @var UtilsView $utilsView */
                        $utilsView = d3GetModCfgDIC()->get('d3ox.usermanager.' . UtilsView::class);
                        $utilsView->addErrorToDisplay($e);
                    }
                } finally {
                    Registry::getSession()->setVariable(self::PREVENTION_SAVEUSER, false);
                    $oConfig = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);
                    $oConfig->setAdminMode($currentAdminMode);
                }
            }
        }

        return $blSave;
    }

    /**
     * @param Manager $oManager
     * @return d3usermanager_execute
     * @throws Exception
     */
    public function d3UsermanagerGetManagerExecute(Manager $oManager): d3usermanager_execute
    {
        d3GetModCfgDIC()->set(
            d3usermanager_execute::class.'.args.usermanager',
            $oManager
        );

        /** @var d3usermanager_execute $execute */
        $execute = d3GetModCfgDIC()->get(d3usermanager_execute::class);

        return $execute;
    }

    /**
     * @param Manager $oManager
     * @throws d3usermanager_actionException
     * @throws d3usermanager_requirementException
     */
    protected function d3UserManagerCheckForConfigurationException(Manager $oManager): void
    {
        d3GetModCfgDIC()->set(d3usermanager_configurationcheck::class.'.args.usermanager', $oManager);
        /** @var d3usermanager_configurationcheck $confCheck */
        $confCheck = d3GetModCfgDIC()->get(d3usermanager_configurationcheck::class);
        $confCheck->checkThrowingExceptions($oManager->getValue('sManuallyExecMeetCondition') ?
            d3usermanager_configurationcheck::REQUIREMENTS_AND_ACTIONS :
            d3usermanager_configurationcheck::ACTIONS_ONLY);
    }
}
