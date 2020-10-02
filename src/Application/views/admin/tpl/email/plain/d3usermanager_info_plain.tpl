[{oxmultilang ident="D3_USERMANAGER_MAIL_UMJFROM"}] [{$smarty.now|date_format:"%d.%m.%Y %H:%I"}]
  
[{foreach from=$aNotes item="aManagerJobs" key="sUserId"}]
[{assign var="oUser" value=$oEmailView->d3getUser($sUserId)}]
[{if $oUser->getId()}][{oxmultilang ident="D3_USERMANAGER_MAIL_USER"}] [{$oUser->getFieldData('oxcustnr')}] [{oxmultilang ident="D3_USERMANAGER_MAIL_USERNAME"}] [{$oUser->getFieldData('oxlname')}], [{$oUser->getFieldData('oxfname')}][{else}][{oxmultilang ident="D3_USERMANAGER_MAIL_GENERAL"}][{/if}]:
[{foreach from=$aManagerJobs item="aJobActions" key="sManagerId"}]
[{assign var="oUserManager" value=$oEmailView->d3getUserManager($sManagerId)}]
    [{$oUserManager->getFieldData('oxtitle')}]
[{foreach from=$aJobActions item="sJobText"}]
        [{$sJobText}]
[{/foreach}]
[{/foreach}]
[{/foreach}]
