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

namespace D3\Usermanager\Application\Controller\Admin;

use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_list as setListController;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main as setMainController;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_;

class d3_cfg_usermanagerset extends d3_cfg_mod_
{
    /**
     * @return string
     */
    public function render()
    {
        $this->addTplParam('sListClass', setListController::class);
        $this->addTplParam('sMainClass', setMainController::class);

        $this->_hasListItems = false;

        return parent::render();
    }
}
