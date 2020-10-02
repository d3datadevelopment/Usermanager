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

namespace D3\Usermanager\Application\Controller;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3LogInterface;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\Usermanager\Application\Model\d3usermanager_vars as VariablesTrait;
use D3\Usermanager\Application\Model\d3usermanagerlist as ManagerList;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanager_execute as ManagerExecuteModel;
use D3\Usermanager\Application\Model\Exceptions\d3usermanager_cronUnavailableException as cronUnavailableException;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\DatabaseException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\Session;

class d3usermanager_response extends Base
{
    use VariablesTrait;
    private $_sModId = 'd3usermanager';

    /**
     * constructor.
     */
    public function __construct()
    {
        d3GetModCfgDIC()->setParameter($this->_DIC_Instance_Id.'modcfgid', $this->_sModId);

        parent::__construct();
    }

    /**
     * @throws DBALException
     * @throws Exception
     */
    public function init()
    {
        startProfile(__METHOD__);

        $blExceptionThrown = $this->_startExecution();

        if ($this->isBrowserCall() && false == $blExceptionThrown) {
            echo "script successfully finished".PHP_EOL;
        }

        /** @var Session $session */
        $session =  d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Session::class);
        $session->freeze();

        stopProfile(__METHOD__);

        /** @var d3log $oLog */
        $oLog = d3GetModCfgDIC()->get($this->_DIC_Instance_Id.'log');
        $oLog->d3GetProfiling();
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws Exception
     */
    protected function _startExecution()
    {
        startProfile(__METHOD__);

        $blExc = false;

        try {
            $iStartTime = microtime(true);

            /** @var d3LogInterface $oLog */
            $oLog = d3GetModCfgDIC()->get($this->_DIC_Instance_Id.'log');
            $oLog->info(__CLASS__, __FUNCTION__, __LINE__, "start cron", "");

            $this->_checkUnavailableCronjob();
            $this->_getSet()->setValue($this->_getCronTimestampVarName(), date('Y-m-d H:i:s'));
            $this->_getSet()->saveNoLicenseRefresh();

            $this->_startJobs();

            $iExecTime = microtime(true) - $iStartTime;
            $oLog->info(
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "end cron",
                'execution time: '.$iExecTime." sec"
            );

        } catch (cronUnavailableException $oEx) {
            /** @var cronUnavailableException $oEx */
            $oEx->d3showMessage();
            $blExc = true;
        } catch (StandardException $oEx) {
            /** @var StandardException $oEx */
            $oEx->debugOut();
            $blExc = true;
        }

        stopProfile(__METHOD__);

        return $blExc;
    }

    /**
     * @return ManagerList
     * @throws Exception
     */
    public function getManagerList()
    {
        return d3GetModCfgDIC()->get(ManagerList::class);
    }

    /**
     * @param Manager $oManager
     * @return ManagerExecuteModel
     * @throws Exception
     */
    public function getManagerExecute(Manager $oManager)
    {
        d3GetModCfgDIC()->set(
            ManagerExecuteModel::class.'.args.usermanager',
            $oManager
        );

        return d3GetModCfgDIC()->get(ManagerExecuteModel::class);
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DatabaseException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    protected function _startJobs()
    {
        startProfile(__METHOD__);

        $oManagerList = $this->getManagerList();
        $oManagerList->setCronJobId($this->_getCronJobIdParameter());
        $oManagerList->setCustomSorting('oxsort ASC');
        $oManagerList->getList();

        $oHandleManager = $this->getManager();
        $oHandleManagerExec = $this->getManagerExecute($oHandleManager);

        // disable admin mode for using active check
        $blOldAdminMode = self::$_blIsAdmin;
        self::$_blIsAdmin = false;

        /** @var d3LogInterface $oLog */
        $oLog = d3GetModCfgDIC()->get($this->_DIC_Instance_Id.'log');
        $oLog->info(
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'manager count',
            $oManagerList->count()
        );

        /** @var $oManager Manager */
        foreach ($oManagerList->getList() as $oManager) {
            $oHandleManager = $this->getManager();
            $oHandleManager->load($oManager->getId());
            $oHandleManagerExec->setManager($oHandleManager);

            self::$_blIsAdmin = $blOldAdminMode;
            $oHandleManagerExec->startJobExecution();
            self::$_blIsAdmin = false;
        }

        self::$_blIsAdmin = $blOldAdminMode;
        $oHandleManagerExec->finishJobExecution();

        stopProfile(__METHOD__);
    }

    /**
     * @return Manager
     * @throws Exception
     */
    public function getManager()
    {
        return d3GetModCfgDIC()->get(Manager::class);
    }

    /**
     * @return bool
     * @throws Exception
     */
    protected function _checkAccessKey()
    {
        $sSetCronPassword = $this->_getSet()->getValue('sCronPassword');

        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $sGetAccessKey  = $request->getRequestEscapedParameter("key");
        $sRegisteredAccessKey = $sSetCronPassword ? $sSetCronPassword : $this->getManager()->getBaseCronPW();

        return $this->hasValidAccessKey($sRegisteredAccessKey, $sGetAccessKey);
    }

    /**
     * @return d3_cfg_mod
     * @throws Exception
     */
    protected function _getSet()
    {
        return d3_cfg_mod::get('d3usermanager');

        /** @var d3_cfg_mod $modcfg */
        $modcfg = d3GetModCfgDIC()->get($this->_DIC_Instance_Id.'modcfg');

        return $modcfg;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function showDisabledMessage()
    {
        return false == $this->_getSet()->getValue('blCronActive') &&
        ($this->_getSet()->hasDebugMode() || $this->isBrowserCall());
    }

    /**
     * @return bool
     */
    public function isBrowserCall()
    {
        return $_SERVER['REMOTE_ADDR'] || $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * @param $sRegisteredAccessKey
     * @param $sGetAccessKey
     *
     * @return bool
     */
    protected function hasValidAccessKey($sRegisteredAccessKey, $sGetAccessKey)
    {
        return (
            false == $this->isBrowserCall()
            || (
                $sRegisteredAccessKey == $sGetAccessKey
            )
        );
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws cronUnavailableException
     * @throws Exception
     */
    protected function _checkUnavailableCronjob()
    {
        if (false == $this->_getSet()->isActive()) {
            $oEx = $this->getCronUnavailableException('user manager module is disabled');
            $oEx->d3enableScreenMessage();
            $oEx->debugOut();
            throw $oEx;
        } elseif (false == $this->_checkAccessKey()) {
            $oEx = $this->getCronUnavailableException('cron via browser: missing or wrong identification');
            $oEx->d3enableScreenMessage();
            $oEx->debugOut();
            throw $oEx;
        } else {
            $this->_checkDisabledCronjob();
        }
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws cronUnavailableException
     * @throws Exception
     */
    public function _checkDisabledCronjob()
    {
        if ($this->showDisabledMessage()) {
            $oEx = $this->getCronUnavailableException('cronjob script is disabled');
            $oEx->d3enableScreenMessage();
            $oEx->debugOut();
            throw $oEx;
        } elseif (false == $this->_getSet()->getValue('blCronActive')) {
            $oEx = $this->getCronUnavailableException('cron via browser: missing or wrong identification');
            $oEx->d3disableScreenMessage();
            $oEx->debugOut();
            throw $oEx;
        }
    }

    /**
     * @param $sMessage
     * @return cronUnavailableException
     * @throws Exception
     */
    public function getCronUnavailableException($sMessage)
    {
        d3GetModCfgDIC()->setParameter(
            cronUnavailableException::class.'.args.message',
            $sMessage
        );

        return d3GetModCfgDIC()->get(cronUnavailableException::class);
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function _getCronJobIdParameter()
    {
        /** @var Request $request */
        $request = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Request::class);
        $iCjId = $request->getRequestEscapedParameter('cjid');

        if (false === $iCjId || null === $iCjId || $iCjId === '') {
            $iCjId = 0;
        }

        return $iCjId;
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function _getCronTimestampVarName()
    {
        $sVarName = "sCronExecTimestamp";

        if ($this->_getCronJobIdParameter() !== false) {
            $sVarName .= $this->_getCronJobIdParameter();
        }

        return $sVarName;
    }

    /**
     * @throws Exception
     */
    public function getLastExecDate()
    {
        return $this->_getSet()->getValue($this->_getCronTimestampVarName());
    }

    /**
     * @throws Exception
     */
    public function getLastExecDateInfo()
    {
        $sCronJobId = $this->_getCronJobIdParameter();
        $taskCount = current(
            array_filter(
                $this->getManager()->getAvailableCronjobIds(),
                function($entry) use ($sCronJobId) {
                    return ($entry['id'] == $sCronJobId) ? true : false;
                }
            )
        )['count'];

        return [
            sprintf(
                $this->getLang()->translateString('D3_GENERAL_USERMANAGER_TASKCOUNT_CRONID'),
                $sCronJobId,
                $taskCount
            ),
            sprintf(
                $this->getLang()->translateString('D3_GENERAL_USERMANAGER_LASTEXEC_CRONID'),
                $sCronJobId,
                $this->getLastExecDate()
            )
        ];
    }

    /**
     * @return Language
     */
    public function getLang()
    {
        /** @var Language $lang */
        $lang = d3GetModCfgDIC()->get($this->_DIC_OxInstance_Id.Language::class);

        return $lang;
    }
}
