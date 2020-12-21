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

// Include usermanager test config
namespace D3\Usermanager\tests;

use D3\ModCfg\Tests\additional_abstract;
use Exception;
use OxidEsales\Eshop\Core\Exception\StandardException;

include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'd3usermanager_config.php');

class additional extends additional_abstract
{
    /**
     * additional constructor.
     * @throws StandardException
     */
    public function __construct()
    {
        if (D3USERMANAGER_REQUIRE_MODCFG) {
            $this->reactivateModCfg();
        }
    }
}

try {
    d3GetModCfgDIC()->get(additional::class);
} catch (Exception $e) {}
