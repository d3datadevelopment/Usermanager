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
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsView;

/**
 * Class d3_order_usermanager
 *
 * @package D3\Usermanager\Modules\Application\Model
 */
class d3_order_usermanager extends d3_order_usermanager_parent
{
    CONST PREVENTION_FINALIZEORDER = 'd3PreventUMFinalizeOrderTrigger';

    /**
     * @param Basket $oBasket
     * @param User $oUser
     * @param false  $blRecalculatingOrder
     *
     * @return int
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws Exception
     */
    public function finalizeOrder(Basket $oBasket, $oUser, $blRecalculatingOrder = false)//: int // function declaration must be compatible with parent function
    {
        $iRet = parent::finalizeOrder($oBasket, $oUser, $blRecalculatingOrder);

        /** @var d3_cfg_mod $oSet */
        $oSet = d3GetModCfgDIC()->get('d3.usermanager.modcfg');
        $currentAdminMode = $this->isAdmin();

        if ($oSet->isActive() && in_array(Registry::getSession()->getVariable(self::PREVENTION_FINALIZEORDER), [null, false], true)) {
            /** @var d3usermanagerlist $oUserManagerList */
            $oUserManagerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
            /** @var Manager $oManager */
            foreach ($oUserManagerList->d3GetOrderFinishTriggeredManagerTasks() as $oManager) {
                try {
                    $this->d3UserManagerCheckForConfigurationException($oManager);

                    $oManagerExecute = $this->d3UsermanagerGetManagerExecute($oManager);
                    if ($oManagerExecute->userMeetsConditions($oUser->getId())) {
                        // prevent infinit loop because of circular reference in recalculate::method
                        Registry::getSession()->setVariable(self::PREVENTION_FINALIZEORDER, true);
                        $oManagerExecute->exec4user($oUser->getId(), d3usermanager_conf::EXECTYPE_ORDERFINISHTRIGGERED);
                    }
                } catch (d3ActionRequirementAbstract | d3usermanager_templaterendererExceptionInterface $e) {
                    if (!defined('OXID_PHP_UNIT')) {
                        Registry::getLogger()->error($e->getMessage(), [$e]);
                    }
                    if (true === $currentAdminMode) {
                        /** @var UtilsView $utilsView */
                        $utilsView = d3GetModCfgDIC()->get('d3ox.usermanager.' . UtilsView::class);
                        $utilsView->addErrorToDisplay($e);
                    }
                } finally {
                    Registry::getSession()->setVariable(self::PREVENTION_FINALIZEORDER, false);
                    $oConfig = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);
                    $oConfig->setAdminMode($currentAdminMode);
                }
            }
        }

        return $iRet;
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
        d3GetModCfgDIC()->setParameter(
            d3usermanager_configurationcheck::class.'.args.checktypes',
            $oManager->getValue('sManuallyExecMeetCondition') ?
                d3usermanager_configurationcheck::REQUIREMENTS_AND_ACTIONS :
                d3usermanager_configurationcheck::ACTIONS_ONLY
        );
        /** @var d3usermanager_configurationcheck $confCheck */
        $confCheck = d3GetModCfgDIC()->get(d3usermanager_configurationcheck::class);
        $confCheck->checkThrowingExceptions();
    }
}
