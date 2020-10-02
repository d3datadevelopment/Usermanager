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
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_conf;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanagerlist;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;

// @codeCoverageIgnoreStart
if (false) {
    class_alias(
        User::class,
        d3_user_usermanager_parent::class
    );
}
// @codeCoverageIgnoreEnd

class d3_user_usermanager extends d3_user_usermanager_parent
{
    /**
     * @param string $sName
     *
     * @return mixed
     */
    public function __get($sName)
    {
        $mContent = parent::__get($sName);

        if (false == $mContent && $this->{$sName}) {
            return $this->{$sName};
        }

        return $mContent;
    }

    /**
     * required for test purposes only
     * @throws DBALException
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
     * @return bool
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws Exception
     */
    public function save()
    {
        $blSave = parent::save();

        $oManagerList = d3GetModCfgDIC()->get(d3usermanagerlist::class);
        /** @var d3usermanager $oManager */
        foreach ($oManagerList->d3GetUserSaveTriggeredManagerTasks() as $oManager) {
            $oManagerExecute = $this->d3UsermanagerGetManagerExecute($oManager);
            if ($oManagerExecute->userMeetsConditions($this->getId())) {
                $oManagerExecute->exec4user($this->getId(), d3usermanager_conf::EXECTYPE_USERSAVETRIGGERED);
            }
        }

        return $blSave;
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
