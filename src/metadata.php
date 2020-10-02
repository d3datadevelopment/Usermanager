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
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          https://www.oxidmodule.com
 */

use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_action;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_list;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_main;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_mall;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_overview;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_requ;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_settings;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanageritem_trigger;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerlog;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerlog_list;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_licence;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_list;
use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerset_main;
use D3\Usermanager\Application\Controller\Admin\d3_usermanager_jobs;
use D3\Usermanager\Application\Controller\d3usermanager_response;
use D3\Usermanager\Modules\Application\Model\d3_order_usermanager;
use D3\Usermanager\Modules\Application\Model\d3_oxemail_usermanager as d3_oxemail_usermanager;
use D3\Usermanager\Modules\Application\Model\d3_user_usermanager as d3_user_usermanager;
use D3\Usermanager\Setup\d3usermanager_update as d3usermanager_update;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Email;

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = array(
    'id'          => 'd3usermanager',
    'title'       => 
        '<img src="https://logos.oxidmodule.com/d3logo.svg" alt="(D3)" style="height:1em;width:1em"> '.
        'Kundenmanager',
    'description' => array(
        'de' => 'Bearbeitet frei definierbare Auftr&auml;ge auf Basis von einstellbaren Kundenlisten.',
        'en' => '',
    ),
    'controllers' => [
        'd3usermanager_response'           => d3usermanager_response::class,

        'd3_cfg_usermanagerset'            => d3_cfg_usermanagerset::class,
        'd3_cfg_usermanagerset_list'       => d3_cfg_usermanagerset_list::class,
        'd3_cfg_usermanagerset_main'       => d3_cfg_usermanagerset_main::class,
        'd3_cfg_usermanagerlog'            => d3_cfg_usermanagerlog::class,
        'd3_cfg_usermanagerlog_list'       => d3_cfg_usermanagerlog_list::class,
        'd3_cfg_usermanagerset_licence'    => d3_cfg_usermanagerset_licence::class,
        'd3_cfg_usermanageritem'           => d3_cfg_usermanageritem::class,
        'd3_cfg_usermanageritem_list'      => d3_cfg_usermanageritem_list::class,
        'd3_cfg_usermanageritem_main'      => d3_cfg_usermanageritem_main::class,
        'd3_cfg_usermanageritem_mall'      => d3_cfg_usermanageritem_mall::class,
        'd3_cfg_usermanageritem_trigger'   => d3_cfg_usermanageritem_trigger::class,
        'd3_cfg_usermanageritem_overview'  => d3_cfg_usermanageritem_overview::class,
        'd3_cfg_usermanageritem_settings'  => d3_cfg_usermanageritem_settings::class,
        'd3_cfg_usermanageritem_requ'      => d3_cfg_usermanageritem_requ::class,
        'd3_cfg_usermanageritem_action'    => d3_cfg_usermanageritem_action::class,
        'd3_usermanager_jobs'             => d3_usermanager_jobs::class,
    ],
    'thumbnail'   => 'picture.png',
    'version'     => '3.3.0.0',
    'author'      => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'       => 'support@shopmodule.com',
    'url'         => 'https://www.oxidmodule.com/',
    'extend'      => array(
        Email::class => d3_oxemail_usermanager::class,
        User::class  => d3_user_usermanager::class,
        Order::class => d3_order_usermanager::class
    ),
    'templates'   => array(
        'd3_cfg_usermanagerset_main.tpl'        => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanagerset_main.tpl',
        'd3_cfg_usermanageritem_list.tpl'       => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_list.tpl',
        'd3_cfg_usermanageritem_main.tpl'       => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_main.tpl',
        'd3_cfg_usermanageritem_mall.tpl'       => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_mall.tpl',
        'd3_cfg_usermanageritem_requ.tpl'       => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_requ.tpl',
        'd3_cfg_usermanageritem_action.tpl'     => 'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_action.tpl',
        'd3_cfg_usermanageritem_overview.tpl'   =>
            'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_overview.tpl',
        'd3_cfg_usermanageritem_trigger.tpl'   =>
            'd3/usermanager/Application/views/admin/tpl/d3_cfg_usermanageritem_trigger.tpl',
        'd3_usermanager_jobs.tpl'               => 'd3/usermanager/Application/views/admin/tpl/d3_usermanager_jobs.tpl',
        'd3usermanager_info_html.tpl'           =>
            'd3/usermanager/Application/views/admin/tpl/email/html/d3usermanager_info_html.tpl',
        'd3usermanager_info_plain.tpl'          =>
            'd3/usermanager/Application/views/admin/tpl/email/plain/d3usermanager_info_plain.tpl',

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
    ),
    'events'         => array(
        'onActivate' => '\D3\Usermanager\Setup\Events::onActivate',
    ),
    'blocks'      => array(
        array(
            'template'  => 'user_remark.tpl',
            'block'     => 'admin_user_remark_type',
            'file'      => 'Application/views/admin/blocks/d3usermanager_user_remark_type.tpl',
        )
    ),
    'd3FileRegister'    => array(
        'd3/usermanager/IntelliSenseHelper.php',
        'd3/usermanager/metadata.php',
        'd3/usermanager/Application/views/admin/blocks/d3usermanager_user_remark_type.tpl',
        'd3/usermanager/Application/views/admin/de/d3_usermanager_lang.php',
        'd3/usermanager/Application/views/admin/tpl/d3_usermanager_bottomnaviitem.tpl',
        'd3/usermanager/Application/views/admin/tpl/email/html/d3orderbreak.tpl',
        'd3/usermanager/Application/views/admin/tpl/email/plain/d3orderbreak.tpl',
        'd3/usermanager/modules/Application/Model/d3_user_usermanager.php',
        'd3/usermanager/modules/Application/Model/d3_oxemail_usermanager.php',

        'd3/usermanager/public/d3_usermanager_cron.php',
        'd3/usermanager/Application/Controller/Admin/d3_cfg_usermanageritem_trigger.php',
        'd3/usermanager/Application/Model/d3usermanager_vars.php',
        'd3/usermanager/Setup/d3usermanager_update.php',
        'd3/usermanager/Application/Model/d3usermanager_remark.php',
        'd3/usermanager/Application/Model/d3usermanager_export.php',
        'd3/usermanager/Application/Model/d3usermanager_partgrouplist_abstract.php',
        'd3/usermanager/Application/Model/Exceptions/d3usermanager_requirementexception.php',
        'd3/usermanager/Application/Model/Exceptions/d3usermanager_cronunavailableexception.php',
        'd3/usermanager/Application/Model/d3usermanager.php',
        'd3/usermanager/Application/Model/Exceptions/d3usermanager_cronUnavailableException.php',
        'd3/usermanager/Application/Model/d3usermanager_partgrouplist_interface.php',
        'd3/usermanager/Application/Model/d3usermanager_conf.php',
        'd3/usermanager/Application/Model/d3usermanager_listgenerator.php',
        'd3/usermanager/Application/Model/d3usermanager_execute.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_custnrto.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_executemethodfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_orderdeltypefilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_ordermaxcount.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_ordermincount.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_validnewslettermail.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_ingroupfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_ordermaxtimespan.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_deladdrfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_birthdatefrom.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_newsletterfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_invcountryfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_delcountryfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_custnrfrom.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_invgenderfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_voucherserie.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_otherjob.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_ordermintimespan.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_delzipfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_hasbirthday.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_invfieldfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_userbasketto.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_activefilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_birthdateto.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_agecheck.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirementlist.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_abstract.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_userbaskettimespan.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_invustidfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_orderminsum.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_haswishlist.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_interface.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_invzipfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_hasvoucher.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_orderfieldfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_delfieldfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_wishlistcount.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_hasuserbasket.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_registertimespan.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_bonifilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_invcompanyfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_delcompanyfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_vouchernumber.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_orderpaymentfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_ordermaxsum.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_ordertimespan.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_noticelistcount.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirementgrouplist.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_userbasketfrom.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_ordernocount.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_orderlanguagefilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_registerto.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_notingroupfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_hasnoticelist.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_delgenderfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_passwordfilter.php',
        'd3/usermanager/Application/Model/Requirements/d3usermanager_requirement_registerfrom.php',
        'd3/usermanager/Application/Model/d3usermanagerlist.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_actiongrouplist.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_sendmail.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_exportlist.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_setfieldvalue.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_setactiveflag.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_deleteuser.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_deletefromgroup.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_interface.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_actionlist.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_add2group.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_abstract.php',
        'd3/usermanager/Application/Model/Actions/d3usermanager_action_executemethod.php',
        'd3/usermanager/Application/Model/d3usermanager_touserassignment.php',
        'd3/usermanager/Config/services.php',

        'd3/usermanager/Application/views/admin/tpl/export-templates/XML-Vorlage.tpl',
        'd3/usermanager/Application/views/admin/tpl/export-templates/CSV-Vorlage.tpl',

        'd3/usermanager/Setup/Events.php',

        'd3/usermanager/tests/d3usermanager_config.php',
        'd3/usermanager/tests/additional.inc.php',
        'd3/usermanager/tests/integration/d3IntegrationTestCase.php',
        'd3/usermanager/tests/integration/Actions/actionDeleteFromGroupTest.php',
        'd3/usermanager/tests/integration/Actions/actionAdd2GroupTest.php',
        'd3/usermanager/tests/integration/Actions/actionDeleteUserTest.php',
        'd3/usermanager/tests/integration/Actions/actionSetActiveFlagTest.php',
        'd3/usermanager/tests/integration/Actions/actionSetFieldValueTest.php',
        'd3/usermanager/tests/integration/Actions/d3ActionIntegrationTestCase.php',
        'd3/usermanager/tests/integration/Actions/actionExecuteMethodTest.php',
        'd3/usermanager/tests/integration/executeCronTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementActiveFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementBoniFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOtherJobTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementHasBirthdayTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementAgeCheckTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementExecuteMethodFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/d3RequirementIntegrationTestCase.php',
        'd3/usermanager/tests/integration/Requirements/requirementInGroupFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementNotInGroupFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementCustNrFromTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementBirthdateFromTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementBirthdateToTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementCustNrToTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementInvCompanyFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementVoucherserieTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementHasWishlistTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementDelFieldFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementRegisterTimespanTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementDelCountryFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderMinSumTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderMaxTimespanTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementUserbasketTimespanTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderMinCountTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementInvUstIdFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementNewsletterFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderFieldTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderMinTimespanTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderLanguageFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderMaxSumTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementUserbasketToTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementWishlistCountTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementInvZipFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementRegisterFromTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementInvFieldFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementRegisterToTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderDeltypeFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementInvCountryFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementPasswordFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementInvGenderFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementVouchernumberTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementHasUserbasketTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderMaxCountTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementDelCompanyFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementUserbasketFromTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementNoticelistCountTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementValidNewsletterMailTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementHasVoucherTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementDelAddrFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderPaymentFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementDelGenderFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementDelZipFilterTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementHasNoticelistTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderNoCountTest.php',
        'd3/usermanager/tests/integration/Requirements/requirementOrderTimespanTest.php'
    ),
    'd3SetupClasses'    => array(
        d3usermanager_update::class
    ),
    'd3DICDefinitionFiles'  => [
        'd3/usermanager/Config/services.yaml',
    ]
);
