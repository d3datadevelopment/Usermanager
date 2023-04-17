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

use D3\Usermanager\Application\Controller\Admin as ModuleControllerAdmin;
use D3\Usermanager\Application\Controller\d3usermanager_response;
use D3\Usermanager\Modules\Application\Model\d3_order_usermanager;
use D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager as d3_oxemail_usermanager;
use D3\Usermanager\Modules\Application\Model\d3_user_usermanager as d3_user_usermanager;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Email;

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';
$sLogo = '<img src="https://logos.oxidmodule.com/d3logo.svg" alt="(D3)" style="height:1em;width:1em"> ';

/**
 * Module information
 */
$aModule = [
    'id'            => 'd3usermanager',
    'title'         => [
        'de'    => $sLogo . 'Kundenmanager',
        'en'    => $sLogo . 'User Manager'
    ],
    'description'  => [
        'de'    => 'Bearbeitet frei definierbare Auftr&auml;ge auf Basis von einstellbaren Kundenlisten.',
        'en'    => 'Processes freely definable tasks based on adjustable customer lists.',
    ],
    'thumbnail'     => 'picture.png',
    'version'       => '5.1.1.2',
    'author'        => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'         => 'support@shopmodule.com',
    'url'           => 'https://www.oxidmodule.com/',
    'extend'        => [
        Email::class                    => d3_oxemail_usermanager::class,
        User::class                     => d3_user_usermanager::class,
        Order::class                    => d3_order_usermanager::class
    ],
    'controllers'   => [
        'd3usermanager_response'           => d3usermanager_response::class,

        'd3_cfg_usermanagerset'            => ModuleControllerAdmin\d3_cfg_usermanagerset::class,
        'd3_cfg_usermanagerset_list'       => ModuleControllerAdmin\d3_cfg_usermanagerset_list::class,
        'd3_cfg_usermanagerset_main'       => ModuleControllerAdmin\d3_cfg_usermanagerset_main::class,
        'd3_cfg_usermanagerlog'            => ModuleControllerAdmin\d3_cfg_usermanagerlog::class,
        'd3_cfg_usermanagerlog_list'       => ModuleControllerAdmin\d3_cfg_usermanagerlog_list::class,
        'd3_cfg_usermanagerset_licence'    => ModuleControllerAdmin\d3_cfg_usermanagerset_licence::class,
        'd3_cfg_usermanageritem'           => ModuleControllerAdmin\d3_cfg_usermanageritem::class,
        'd3_cfg_usermanageritem_list'      => ModuleControllerAdmin\d3_cfg_usermanageritem_list::class,
        'd3_cfg_usermanageritem_main'      => ModuleControllerAdmin\d3_cfg_usermanageritem_main::class,
        'd3_cfg_usermanageritem_mall'      => ModuleControllerAdmin\d3_cfg_usermanageritem_mall::class,
        'd3_cfg_usermanageritem_trigger'   => ModuleControllerAdmin\d3_cfg_usermanageritem_trigger::class,
        'd3_cfg_usermanageritem_overview'  => ModuleControllerAdmin\d3_cfg_usermanageritem_overview::class,
        'd3_cfg_usermanageritem_settings'  => ModuleControllerAdmin\d3_cfg_usermanageritem_settings::class,
        'd3_cfg_usermanageritem_requ'      => ModuleControllerAdmin\d3_cfg_usermanageritem_requ::class,
        'd3_cfg_usermanageritem_action'    => ModuleControllerAdmin\d3_cfg_usermanageritem_action::class,
        'd3_usermanager_jobs'              => ModuleControllerAdmin\d3_usermanager_jobs::class,
    ],
    'templates'   => [
        'd3_cfg_usermanagerset_main.tpl'        => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanagerset_main.tpl',
        'd3_cfg_usermanageritem_list.tpl'       => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_list.tpl',
        'd3_cfg_usermanageritem_main.tpl'       => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_main.tpl',
        'd3_cfg_usermanageritem_mall.tpl'       => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_mall.tpl',
        'd3_cfg_usermanageritem_requ.tpl'       => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_requ.tpl',
        'd3_cfg_usermanageritem_action.tpl'     => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_action.tpl',
        'd3_cfg_usermanageritem_overview.tpl'   => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_overview.tpl',
        'd3_cfg_usermanageritem_trigger.tpl'    => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_trigger.tpl',
        'd3_usermanager_jobs.tpl'               => 'd3/usermanager/Application/views/admin/tpl/d3_usermanager_jobs.tpl',
        'd3usermanager_info_html.tpl'           => 'd3/usermanager/Application/views/admin/tpl/email/html/d3usermanager_info_html.tpl',
        'd3usermanager_info_plain.tpl'          => 'd3/usermanager/Application/views/admin/tpl/email/plain/d3usermanager_info_plain.tpl',
        'd3usermanager_activeswitch.tpl'        => 'd3/usermanager/Application/views/admin/tpl/inc/d3usermanager_activeswitch.tpl',

        'd3usermanager_requ_activefilter.tpl'           =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_activefilter.tpl',
        'd3usermanager_requ_birthdatefrom.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_birthdatefrom.tpl',
        'd3usermanager_requ_agecheck.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_agecheck.tpl',
        'd3usermanager_requ_birthdateto.tpl'            =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_birthdateto.tpl',
        'd3usermanager_requ_bonifilter.tpl'             =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_bonifilter.tpl',
        'd3usermanager_requ_custnrfrom.tpl'             =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_custnrfrom.tpl',
        'd3usermanager_requ_custnrto.tpl'               =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_custnrto.tpl',
        'd3usermanager_requ_deladdrfilter.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_deladdrfilter.tpl',
        'd3usermanager_requ_hasbirthday.tpl'            =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_hasbirthday.tpl',
        'd3usermanager_requ_ingroupfilter.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_ingroupfilter.tpl',
        'd3usermanager_requ_newsletterfilter.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_newsletterfilter.tpl',
        'd3usermanager_requ_notingroupfilter.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_notingroupfilter.tpl',
        'd3usermanager_requ_passwordfilter.tpl'         =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_passwordfilter.tpl',
        'd3usermanager_requ_registerfrom.tpl'           =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_registerfrom.tpl',
        'd3usermanager_requ_registertimespan.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_registertimespan.tpl',
        'd3usermanager_requ_registerto.tpl'             =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_registerto.tpl',
        'd3usermanager_requ_validnewslettermail.tpl'    =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_validnewslettermail.tpl',
        'd3usermanager_requ_executemethodfilter.tpl'    =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_executemethodfilter.tpl',
        'd3usermanager_requ_invcompanyfilter.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_invcompanyfilter.tpl',
        'd3usermanager_requ_invcountryfilter.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_invcountryfilter.tpl',
        'd3usermanager_requ_invfieldfilter.tpl'         =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_invfieldfilter.tpl',
        'd3usermanager_requ_invgenderfilter.tpl'        =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_invgenderfilter.tpl',
        'd3usermanager_requ_invustidfilter.tpl'         =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_invustidfilter.tpl',
        'd3usermanager_requ_invzipfilter.tpl'           =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_invzipfilter.tpl',
        'd3usermanager_requ_delcompanyfilter.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_delcompanyfilter.tpl',
        'd3usermanager_requ_delcountryfilter.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_delcountryfilter.tpl',
        'd3usermanager_requ_delfieldfilter.tpl'         =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_delfieldfilter.tpl',
        'd3usermanager_requ_delgenderfilter.tpl'        =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_delgenderfilter.tpl',
        'd3usermanager_requ_delzipfilter.tpl'           =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_delzipfilter.tpl',
        'd3usermanager_requ_orderdeltypefilter.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_orderdeltypefilter.tpl',
        'd3usermanager_requ_orderlanguagefilter.tpl'    =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_orderlanguagefilter.tpl',
        'd3usermanager_requ_ordermaxcount.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_ordermaxcount.tpl',
        'd3usermanager_requ_ordermaxsum.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_ordermaxsum.tpl',
        'd3usermanager_requ_ordermaxtimespan.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_ordermaxtimespan.tpl',
        'd3usermanager_requ_ordermincount.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_ordermincount.tpl',
        'd3usermanager_requ_orderminsum.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_orderminsum.tpl',
        'd3usermanager_requ_ordermintimespan.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_ordermintimespan.tpl',
        'd3usermanager_requ_ordernocount.tpl'           =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_ordernocount.tpl',
        'd3usermanager_requ_orderpaymentfilter.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_orderpaymentfilter.tpl',
        'd3usermanager_requ_orderfieldfilter.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_orderfieldfilter.tpl',
        'd3usermanager_requ_hasuserbasket.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_hasuserbasket.tpl',
        'd3usermanager_requ_userbasketfrom.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_userbasketfrom.tpl',
        'd3usermanager_requ_userbasketto.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_userbasketto.tpl',
        'd3usermanager_requ_userbaskettimespan.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_userbaskettimespan.tpl',
        'd3usermanager_requ_ordertimespan.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_ordertimespan.tpl',
        'd3usermanager_requ_hasnoticelist.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_hasnoticelist.tpl',
        'd3usermanager_requ_haswishlist.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_haswishlist.tpl',
        'd3usermanager_requ_noticelistcount.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_noticelistcount.tpl',
        'd3usermanager_requ_wishlistcount.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_wishlistcount.tpl',
        'd3usermanager_requ_hasvoucher.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_hasvoucher.tpl',
        'd3usermanager_requ_vouchernumber.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_vouchernumber.tpl',
        'd3usermanager_requ_voucherserie.tpl'     =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_voucherserie.tpl',
        'd3usermanager_requ_otherjob.tpl'            =>
            'd3/usermanager/Application/views/admin/tpl/requirements/d3usermanager_requ_otherjob.tpl',

        'd3_cfg_usermanageritem_restrictions.tpl'   =>
            'd3/usermanager/Application/views/admin/tpl/inc/d3_cfg_usermanageritem_restrictions.tpl',
        'd3usermanager_action_addtogroup.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_addtogroup.tpl',
        'd3usermanager_action_deletefromgroup.tpl'  =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_deletefromgroup.tpl',
        'd3usermanager_action_setactiveflag.tpl'    =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_setactiveflag.tpl',
        'd3usermanager_action_deleteuser.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_deleteuser.tpl',
        'd3usermanager_action_setfieldvalue.tpl'    =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_setfieldvalue.tpl',
        'd3usermanager_action_executemethod.tpl'    =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_executemethod.tpl',
        'd3usermanager_action_sendmail.tpl'         =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_sendmail.tpl',
        'd3usermanager_action_exportlist.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_exportlist.tpl',
        'd3usermanager_action_sendpushnotification.tpl'       =>
            'd3/usermanager/Application/views/admin/tpl/actions/d3usermanager_action_sendpushnotification.tpl',
    ],
    'events'      => [
        'onActivate'    => '\D3\Usermanager\Setup\Events::onActivate',
    ],
    'blocks'      => [
        [
            'template'  => 'user_remark.tpl',
            'block'     => 'admin_user_remark_type',
            'file'      => 'Application/views/admin/blocks/d3usermanager_user_remark_type.tpl',
        ]
    ]
];
