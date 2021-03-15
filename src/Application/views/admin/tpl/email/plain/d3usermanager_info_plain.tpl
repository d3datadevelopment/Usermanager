[{oxmultilang ident="D3_USERMANAGER_MAIL_UMJFROM"}] [{$smarty.now|date_format:"%d.%m.%Y %H:%I"}]
  
[{foreach from=$aNotes item="aManagerJobs" key="sUserId"}]
[{assign var="oItem" value=$oEmailView->d3getUserManagerUser($sUserId)}]
[{if $oItem->getId()}][{oxmultilang ident="D3_USERMANAGER_MAIL_USER"}] [{$oItem->getFieldData('oxcustnr')}] [{oxmultilang ident="D3_USERMANAGER_MAIL_USERNAME"}] [{$oItem->getFieldData('oxlname')}], [{$oItem->getFieldData('oxfname')}][{else}][{oxmultilang ident="D3_USERMANAGER_MAIL_GENERAL"}][{/if}]:
[{foreach from=$aManagerJobs item="aJobActions" key="sManagerId"}]
[{assign var="oManager" value=$oEmailView->d3getUserManager($sManagerId)}]
    [{$oManager->getFieldData('oxtitle')}]
[{foreach from=$aJobActions item="sJobText"}]
    [{$sJobText}]
[{/foreach}]
[{/foreach}]
[{/foreach}]
