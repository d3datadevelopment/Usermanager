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

use D3\Usermanager\Application\Controller\d3usermanager_response;
use OxidEsales\Eshop\Core\Config;

/**
 * Returns shop base path.
 *
 * @return string
 */
if (!function_exists('getShopBasePath')) {
    function getShopBasePath()
    {
        return dirname(__FILE__) . '/../../../../';
    }
}

require_once getShopBasePath() . "/bootstrap.php";

// required for recalculating order and generating pdf
define('OX_IS_ADMIN', true);

if (false == function_exists('isAdmin')) {
    /**
     * @return bool
     */
    function isAdmin()
    {
        if (defined('OX_IS_ADMIN')) {
            return OX_IS_ADMIN;
        }

        return true;
    }
}

ob_start();

$aTranslation['shp'] = '';
$aTranslation['cjid'] = '';
$aTranslation['key'] = '';

if (isset($argv) && is_array($argv) && count($argv)) {
    $aTranslation['shp'] = $argv[1];
    $aTranslation['cjid'] = $argv[2];
    $aTranslation['key'] = $argv[3];
    foreach ($aTranslation as $sKey => $mValue) {
        $aParams[$sKey] = $mValue;
    }
    $_GET = $aParams;
}

/** @var $oResponse d3usermanager_response */
$oResponse = d3GetModCfgDIC()->get(d3usermanager_response::class);
try {
    $oResponse->init();
} catch (Exception $oEx) {
    ob_end_flush();
}
ob_end_flush();

/** @var Config $config */
$config = d3GetModCfgDIC()->get('d3ox.usermanager.'.Config::class);

$config->pageClose();
