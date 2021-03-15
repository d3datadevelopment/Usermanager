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

namespace D3\Usermanager\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_list;

class d3_cfg_usermanagerset_list extends d3_cfg_mod_list
{
    // enables language depended configuration
    protected $_blD3ShowLangSwitch = false;
    protected $_sMenuItemTitle = 'd3mxusermanager';
    protected $_sMenuSubItemTitle = 'd3mxusermanager_settings';

    /**
     * constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_blD3ShowLangSwitch = false;
    }

    /**
     * @return null
     */
    public function render()
    {
        $sRet = parent::render();

        // default page number 1
        $this->addTplParam('oxid', 1);
        $this->addTplParam("default_edit", "d3_cfg_usermanagerset_main");
        $this->addTplParam("updatemain", $this->_blUpdateMain);

        return $sRet;
    }
}
