[{block name="d3usermanager_infomail_main"}]
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
    <title>[{oxmultilang ident="D3_USERMANAGER_MAIL_USERSUBJECT"}]</title>
    <meta http-equiv="Content-Type" content="text/html; charset=[{$oEmailView->getCharset()}]">
  </head>
  <body bgcolor="#FFFFFF" link="#355222" alink="#355222" vlink="#355222" style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;">
    [{oxmultilang ident="D3_USERMANAGER_MAIL_UMJFROM"}] [{$smarty.now|date_format:"%d.%m.%Y %H:%I"}]
  
  [{strip}]
    [{foreach from=$aNotes item="aManagerJobs" key="sUserId"}]
        [{block name="d3usermanager_infomail_order"}]
            [{assign var="oUser" value=$oEmailView->d3getUser($sUserId)}]
            [{if $oUser->getId()}]
                [{oxmultilang ident="D3_USERMANAGER_MAIL_USER"}] [{$oUser->getFieldData('oxcustnr')}] [{oxmultilang ident="D3_USERMANAGER_MAIL_USERNAME"}] [{$oUser->getFieldData('oxlname')}], [{$oUser->getFieldData('oxfname')}]:<br>
            [{else}]
                [{oxmultilang ident="D3_USERMANAGER_MAIL_GENERAL"}]:<br>
            [{/if}]
            <ul>
                [{block name="d3usermanager_infomail_manager"}]
                    [{foreach from=$aManagerJobs item="aJobActions" key="sManagerId"}]
                        [{assign var="oUserManager" value=$oEmailView->d3getUserManager($sManagerId)}]
                        <li>
                            [{$oUserManager->getFieldData('oxtitle')}]
                            <ul>
                                [{block name="d3usermanager_infomail_job"}]
                                    [{foreach from=$aJobActions item="sJobText"}]
                                        <li>
                                            [{$sJobText}]
                                        </li>
                                    [{/foreach}]
                                [{/block}]
                            </ul>
                        </li>
                    [{/foreach}]
                [{/block}]
            </ul>
        [{/block}]
    [{/foreach}]
  [{/strip}]

  </body>
</html>
[{/block}]