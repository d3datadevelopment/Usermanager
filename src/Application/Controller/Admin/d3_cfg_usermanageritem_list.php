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

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_list;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanagerlist as ManagerList;

class d3_cfg_usermanageritem_list extends d3_cfg_mod_list
{
    protected $_sListClass = Manager::class;
    protected $_sListType = ManagerList::class;
    protected $_blShowListItems = true;
    protected $_sThisTemplate = 'd3_cfg_usermanageritem_list.tpl';
    protected $_sMenuItemTitle = 'd3mxusermanager';
    protected $_sMenuSubItemTitle = 'd3mxusermanager_items';

    public function buildWhere()
    {
        $aWhere = parent::buildWhere();

        $baseObject = $this->getItemListBaseObject();
        foreach ($aWhere as $key => $value) {
            $aWhere[str_replace(
                getViewName($baseObject->getCoreTableName()),
                $baseObject->getViewName(),
                $key
            )] = $value;
            unset($aWhere[$key]);
        }

        return $aWhere;
    }
}
