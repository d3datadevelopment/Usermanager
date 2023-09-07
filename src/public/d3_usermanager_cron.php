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

namespace D3\Usermanager\publicDir;

use D3\ModCfg\Application\Model\d3cliutils;
use D3\ModCfg\Application\Model\Exception\d3PreventExitException;
use D3\Usermanager\Application\Controller\d3usermanager_response as ResponseController;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\Output\d3usermanager_debugoutput;
use Doctrine\DBAL\Exception as DoctrineException;
use Exception;
use OxidEsales\ComposerPlugin\Installer\Package\ShopPackageInstaller;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\ConfigFile;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Session;
use OxidEsales\Eshop\Core\ShopControl;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ShopConfigurationDaoBridgeInterface;
use ReflectionException;
use RuntimeException;
use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;

// @codeCoverageIgnoreStart

require_once(__DIR__.'/../../../../../vendor/autoload.php');

$bootstrapFileName = getenv('ESHOP_BOOTSTRAP_PATH');
if (!empty($bootstrapFileName)) {
    $bootstrapFileName = realpath(trim(getenv('ESHOP_BOOTSTRAP_PATH')));
} else {
    $count = 0;
    $bootstrapFileName = '../../../'. ShopPackageInstaller::SHOP_SOURCE_DIRECTORY .'/bootstrap.php';
    $currentDirectory = __DIR__ . '/';
    while ($count < 5) {
        $count++;
        if (file_exists($currentDirectory . $bootstrapFileName)) {
            $bootstrapFileName = $currentDirectory . $bootstrapFileName;
            break;
        }
        $bootstrapFileName = '../' . $bootstrapFileName;
    }
}

if (!(file_exists($bootstrapFileName) && !is_dir($bootstrapFileName))) {
    $items = [
        "Unable to find eShop bootstrap.php file.",
        "You can override the path by using ESHOP_BOOTSTRAP_PATH environment variable.",
        "\n"
    ];

    $message = implode(" ", $items);

    die($message);
}

if (false === defined('OXID_PHP_UNIT')) {
    require_once($bootstrapFileName);

    // required for recalculating order and generating pdf
    if (!defined('OX_IS_ADMIN')) {
        define('OX_IS_ADMIN', true);
    }
}

if (false == function_exists('isAdmin')) {
    /**
     * @return bool
     */
    function isAdmin(): bool
    {
        if (defined('OX_IS_ADMIN')) {
            return OX_IS_ADMIN;
        }

        return true;
    }
}

// set language
$language = Registry::getLang();
$options = getopt('l:', ["lang:"]);
$searchedValue = $options ? getopt('l:', ["lang:"])['lang'] : $language->getLanguageAbbr($language->getBaseLanguage());

Registry::getLang()->setTplLanguage(
    current(
        array_filter(
            Registry::getLang()->getLanguageArray(),
            function ($e) use (&$searchedValue) {
                return $e->abbr == $searchedValue;
            }
        )
    )->id
);

if(!defined('STDIN'))  define('STDIN',  fopen('php://stdin',  'rb'));
if(!defined('STDOUT')) define('STDOUT', fopen('php://stdout', 'wb'));
if(!defined('STDERR')) define('STDERR', fopen('php://stderr', 'wb'));

// @codeCoverageIgnoreEnd

// ToDo: extract to separate file because of circular reference in d3usermanager_execute class
class d3_usermanager_cron extends CLI
{
    const OPTION_VERSION = 'version';
    const OPTION_QUIET = 'quiet';
    const OPTION_LANG = 'lang';

    const COMMAND_RUN = 'run';
    const COMMAND_STATUS = 'status';

    const ARGUMENT_SHOPID = 'shop id';
    const ARGUMENT_CJID = 'cronjob id';
    const ARGUMENT_KEY = 'key';

    public function __construct()
    {
        // there are argv setting in CLI mode only
        if ($this->isCLI()) {
            parent::__construct();
        } else {
            try {
                parent::__construct();
                // @codeCoverageIgnoreStart
            } catch (\splitbrain\phpcli\Exception $e) {
                if ($e->getCode() !== \splitbrain\phpcli\Exception::E_ARG_READ) {
                    throw new \splitbrain\phpcli\Exception($e->getMessage(), $e->getCode());
                }
            }
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * @return bool
     */
    public function isCLI(): bool
    {
        return 'cli' == substr(php_sapi_name(), 0, 3);
    }

    /**
     * @param Options $options
     */
    protected function setup(Options $options)
    {
        $lang = Registry::getLang();

        /** @var Config $config */
        $config = d3GetModCfgDIC()->get( 'd3ox.usermanager.' . Config::class );
        $sShopIdList = implode(
            $lang->translateString('D3_USERMANAGER_CLI_ARGUMENT_ENCLOSER'),
            $config->getShopIds()
        );
        $sCJIDList = implode(
            $lang->translateString('D3_USERMANAGER_CLI_ARGUMENT_ENCLOSER'),
            array_map(
                function ($entry) {
                    return $entry['id'];
                },
                d3GetModCfgDIC()->get(Manager::class)->getAvailableCronjobIds()
            )
        );
        $sLangList = implode(
            $lang->translateString('D3_USERMANAGER_CLI_ARGUMENT_ENCLOSER'),
            array_map(
                function ($e) {
                    return $e->abbr;
                },
                Registry::getLang()->getLanguageArray()
            )
        );

        $options->setHelp($lang->translateString('D3_USERMANAGER_CLI_HELP'));
        $options->registerOption(self::OPTION_VERSION, $lang->translateString('D3_USERMANAGER_CLI_OPTION_VERSION'), 'v');
        $options->registerOption(self::OPTION_QUIET, $lang->translateString('D3_USERMANAGER_CLI_OPTION_QUIET'), 'q');
        $options->registerOption(self::OPTION_LANG, sprintf($lang->translateString('D3_USERMANAGER_CLI_OPTION_LANG'), $sLangList), null, 'language');

        $options->registerCommand(self::COMMAND_RUN, $lang->translateString('D3_USERMANAGER_CLI_COMMAND_RUN'));
        $options->registerCommand(self::COMMAND_STATUS, $lang->translateString('D3_USERMANAGER_CLI_COMMAND_STATUS'));

        $options->registerArgument(self::ARGUMENT_SHOPID, sprintf($lang->translateString('D3_USERMANAGER_CLI_ARGUMENT_SHOPID'), $sShopIdList), false);
        $options->registerArgument(self::ARGUMENT_CJID, sprintf($lang->translateString('D3_USERMANAGER_CLI_ARGUMENT_CJID'), $sCJIDList), false);
        $options->registerArgument(self::ARGUMENT_KEY, $lang->translateString('D3_USERMANAGER_CLI_ARGUMENT_KEY'), false);
    }

    /**
     * retranslate default messages
     */
    protected function parseOptions()
    {
        $lang = Registry::getLang();

        parent::parseOptions();

        $this->options->registerOption('help', $lang->translateString('D3_USERMANAGER_CLI_OPTION_HELP'), 'h');
        $this->options->registerOption('no-colors', $lang->translateString('D3_USERMANAGER_CLI_OPTION_NOCOLORS'));
        $this->options->registerOption('loglevel', $lang->translateString('D3_USERMANAGER_CLI_OPTION_LOGLEVELS'), null, 'level');
    }

    /**
     * @param Options $options
     */
    protected function main(Options $options)
    {
        if ( $options->getOpt( self::OPTION_VERSION ) ) {
            $container = ContainerFactory::getInstance()->getContainer();
            $shopConfiguration = $container->get(ShopConfigurationDaoBridgeInterface::class)->get();
            $moduleConfiguration = $shopConfiguration->getModuleConfiguration('d3usermanager');
            $this->info($moduleConfiguration->getVersion());

            return;
        }

        if ( $options->getOpt( self::OPTION_QUIET ) ) {
            d3GetModCfgDIC()->get('d3ox.usermanager.'.Session::class)->setVariable( 'd3usermanager_quiet', true );
        }

        $arguments = $options->getArgs();
        $aTranslation         = [];
        $aTranslation['shp']  = $arguments[0] ?? '';
        $aTranslation['cjid'] = $arguments[1] ?? '';
        $aTranslation['key']  = $arguments[2] ?? '';

        $_GET = array_merge( $_GET, $aTranslation );

        /** @var Config $config */
        $config = d3GetModCfgDIC()->get( 'd3ox.usermanager.' . Config::class );

        try {
            if ($aTranslation['shp']) {
                if (false === in_array($aTranslation['shp'], $config->getShopIds())) {
                    throw new RuntimeException(Registry::getLang()->translateString('D3_USERMANAGER_CLI_COMMON_UNVALIDSHOPID'));
                }

                $config->setShopId( (int) $aTranslation['shp'] );
            }

            /** @var $oResponse ResponseController */
            $oResponse = d3GetModCfgDIC()->get( ResponseController::class );

            switch ( $options->getCmd() ) {
                case self::COMMAND_RUN:
                    $oResponse->initCli();
                    if ( !$options->getOpt( self::OPTION_QUIET ) ) {
                        $this->success(
                            Registry::getLang()->translateString('D3_USERMANAGER_CLI_FINISHED_SUCCFESSFULLY')
                        );
                    }
                    break;
                case self::COMMAND_STATUS:
                    $this->info(implode(PHP_EOL, $oResponse->getLastExecDateInfo()));
                    break;
                default:
                    // old command without 'run' task
                    if (false === in_array($aTranslation['cjid'], ['', false, null], true)) {
                        if (false === in_array($aTranslation['cjid'], array_map(
                                function ($entry) {
                                    return $entry['id'];
                                },
                                d3GetModCfgDIC()->get(Manager::class)->getAvailableCronjobIds()
                            ))
                        ) {
                            throw new RuntimeException(Registry::getLang()->translateString('D3_USERMANAGER_CLI_COMMON_UNVALIDCJID'));
                        }
                        $oResponse->initCli();
                        if ( !$options->getOpt( self::OPTION_QUIET ) ) {
                            $this->success(
                                Registry::getLang()->translateString('D3_USERMANAGER_CLI_FINISHED_SUCCFESSFULLY')
                            );
                        }
                    } else {
                        echo $this->translateFixedStrings( $options->help() );
                    }
            }
        } catch ( Exception $oEx ) {
            if (!Registry::getSession()->getVariable('d3usermanager_quiet')) {
                $this->error( $oEx->getMessage() );
            }
        } finally {
            /** @var Config $config */
            $config = d3GetModCfgDIC()->get( 'd3ox.usermanager.' . Config::class );
            // @codeCoverageIgnoreStart
            if (false === defined('OXID_PHP_UNIT')) {
                $config->pageClose();
            }
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * prevent code exit while coverage check
     *
     * @throws ReflectionException
     * @throws DoctrineException
     * @codeCoverageIgnore
     */
    public function run()
    {
        $blDebug = (bool) Registry::get(ConfigFile::class)->getVar('iDebug');

        if ($blDebug) {
            $cliUtils = oxNew(d3cliutils::class);
            $shopControl = oxNew(ShopControl::class);
            $cliUtils->startMonitor($shopControl);
        }

        // run cron script from browser
        if (false === $this->isCLI()) {
            // browser call don't handle CLI options and arguments
            /** @var $oResponse ResponseController */
            $oResponse = d3GetModCfgDIC()->get( ResponseController::class );
            $oResponse->init();
        } else {
            try {
                parent::run();
            } catch (d3PreventExitException $e) {}
        }

        if ($blDebug) {
            $log = $cliUtils->profilingFormMonitorMessage($shopControl);
            oxNew(d3usermanager_debugoutput::class)->output($log);
        }
    }

    /**
     * @throws d3PreventExitException
     */
    protected function execute()
    {
        parent::execute();

        /** @var d3PreventExitException $e */
        $e = oxNew(d3PreventExitException::class);
        throw $e;
    }

    /**
     * @param $text
     * @return string
     */
    public function translateFixedStrings($text): string
    {
        $search = [
            'This tool accepts a command as first parameter as outlined below:'
        ];

        $replace = [
            Registry::getLang()->translateString('D3_USERMANAGER_CLI_COMMAND')
        ];

        return str_replace($search, $replace, $text);
    }
}

// @codeCoverageIgnoreStart
/** @var d3_usermanager_cron $cli */
$cli = d3GetModCfgDIC()->get(d3_usermanager_cron::class);
$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
if (false === defined('OXID_PHP_UNIT') && (!count($trace) || (bool) stristr($trace[0]['file'], 'bin/d3_usermanager_cron'))) {
    try {
        $cli->run();
    } catch ( Exception $e) {
        $cli->error($e->getMessage());
    }
}
// @codeCoverageIgnoreEnd
