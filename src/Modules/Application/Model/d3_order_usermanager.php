<?php


namespace D3\Usermanager\Modules\Application\Model;

use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_conf;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

// @codeCoverageIgnoreStart
if (false) {
    class_alias(
        Order::class,
        d3_order_usermanager_parent::class
    );
}
// @codeCoverageIgnoreEnd

/**
 * Class d3_order_usermanager
 *
 * @package D3\Usermanager\Modules\Application\Model
 */
class d3_order_usermanager extends d3_order_usermanager_parent
{
    /**
     * @param Basket $oBasket
     * @param object $oUser
     * @param false  $blRecalculatingOrder
     *
     * @return bool|int|null
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws Exception
     */
    public function finalizeOrder(Basket $oBasket, $oUser, $blRecalculatingOrder = false)
    {
        $iRet = parent::finalizeOrder($oBasket, $oUser, $blRecalculatingOrder);

        /** @var d3usermanagerlist $oUserManagerList */
        $oUserManagerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
        /** @var d3usermanager $oManager */
        foreach ($oUserManagerList->d3GetOrderFinishTriggeredManagerTasks() as $oManager) {
            $oManagerExecute = $this->d3UsermanagerGetManagerExecute($oManager);
            if ($oManagerExecute->userMeetsConditions($this->getUser()->getId())) {
                $oManagerExecute->exec4user($this->getUser()->getId(), d3usermanager_conf::EXECTYPE_ORDERFINISHTRIGGERED);
            }
        }

        return $iRet;
    }

    /**
     * @param d3usermanager $oManager
     * @return d3usermanager_execute
     * @throws Exception
     */
    public function d3UsermanagerGetManagerExecute(d3usermanager $oManager)
    {
        d3GetModCfgDIC()->set(
            d3usermanager_execute::class.'.args.usermanager',
            $oManager
        );

        /** @var d3usermanager_execute $execute */
        $execute = d3GetModCfgDIC()->get(d3usermanager_execute::class);

        return $execute;
    }
}