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
use D3\ModCfg\Application\Model\Configuration\d3modprofile;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanagerlist as ManagerList;
use OxidEsales\Eshop\Core\TableViewNameGenerator;

class d3_cfg_usermanageritem_list extends d3_cfg_mod_list
{
    protected $_sListClass = Manager::class;
    protected $_sListType = ManagerList::class;
    protected $_blShowListItems = true;
    protected $_sThisTemplate = 'd3_cfg_usermanageritem_list.tpl';
    protected $_sMenuItemTitle = 'd3mxusermanager';
    protected $_sMenuSubItemTitle = 'd3mxusermanager_items';

    /**
     * @return array|null
     */
    public function buildWhere(): ?array
    {
        $aWhere = parent::buildWhere();

        $baseObject = oxNew(d3modprofile::class);
        foreach ($aWhere as $key => $value) {
            unset($aWhere[$key]);
            $aWhere[str_replace(
                oxNew(TableViewNameGenerator::class)->getViewName($baseObject->getCoreTableName()),
                oxNew(TableViewNameGenerator::class)->getViewName($baseObject->getCoreTableName(), -1),
                $key
            )] = $value;
        }

        return $aWhere;
    }
}
