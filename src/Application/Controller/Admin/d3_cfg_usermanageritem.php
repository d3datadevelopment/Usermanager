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

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_list as itemList;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_main as itemMain;

class d3_cfg_usermanageritem extends d3_cfg_mod_
{
    /**
     * @return string
     */
    public function render(): string
    {
        $this->addTplParam('sListClass', itemList::class);
        $this->addTplParam('sMainClass', itemMain::class);

        $this->_hasListItems = true;

        return parent::render();
    }
}
