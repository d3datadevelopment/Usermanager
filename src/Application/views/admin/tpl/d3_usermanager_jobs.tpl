[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<style type="text/css">
    .box td.listitem,
    .box td.listitem2 {
        padding-left: 5px;
        padding-right: 5px;
        height: 50px;
    }
    .box tr:nth-child(odd) td {
        background-color: #f0f0f0;
    }
    .box tr:nth-child(even) td {
        background-color: #fafafa;
    }
    textarea {
        width: 95%;
        height: 180px;
        padding: 5px;
    }
    body #ddoew .note-editor.note-frame {
        width: 96%;
        float: left;
        margin-bottom: 0;
    }
    body #ddoew .note-editor.note-frame .note-editable.panel-body {
        min-height: 180px !important;
    }
</style>

[{capture name="d3script"}]
function d3TogglePlain(checkelement) {
    if (checkelement.checked) {
        document.getElementById('mailplaintr').style.display = 'none';
    } else {
        document.getElementById('mailplaintr').style.display = 'table-row';
    }
}
[{/capture}]
[{oxscript add=$smarty.capture.d3script}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
</form>

<table style="border: none; padding: 0; width: 100%">
    <tr>
        [{d3modcfgcheck modid="d3usermanager"}]
            [{if $sAction == "execChangedContents"}]
                <td>
                    <form name="d3execusermanager" id="d3execusermanager" action="[{$oViewConf->getSelfLink()}]" method="post">
                        [{$oViewConf->getHiddenSid()}]
                        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                        <input type="hidden" name="fnc" value="">
                        <input type="hidden" name="oxid" value="[{$oxid}]">
                        <input type="hidden" name="editval[oxuser__oxid]" value="[{$oxid}]">
                        <input type="hidden" name="usermanagerid" value="-1">
                        <table  style="border: none; padding: 0; width: 100%;">
                            <tr>
                                <td class="listitem" style="padding: 5px; height: auto;">
                                    [{oxmultilang ident="D3_USERMANAGER_GENERAL_TASK"}]
                                </td>
                                <td class="listitem" style="padding: 5px; height: auto;">
                                    [{$oUserManager->getFieldData('oxtitle')}] &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="listitem2" style="padding: 5px; height: auto;"></td>
                                <td class="listitem2" style="padding: 5px; height: auto;">
                                    <span class="d3modcfg_btn icon d3color-green" style="margin-right: 10px;">
                                        <button onclick="document.getElementById('d3execusermanager').usermanagerid.value = '[{$oUserManager->getId()}]'; document.getElementById('d3execusermanager').fnc.value = 'd3ExecChangedUserManager'; document.getElementById('d3execusermanager').submit();">
                                            <i class="fa fa-check-circle fa-inverse"></i>
                                            [{oxmultilang ident="D3_USERMANAGER_USERMAIN_SAVEEXEC"}]
                                        </button>
                                    </span>
                                    <span class="d3modcfg_btn icon d3color-red" style="margin-right: 10px;">
                                        <button onclick="document.getElementById('d3execusermanager').submit();">
                                            <i class="fa fa-times-circle fa-inverse"></i>
                                            [{oxmultilang ident="D3_USERMANAGER_USERMAIN_CANCELEXEC"}]
                                        </button>
                                    </span>
                                    [{oxmultilang ident="D3_USERMANAGER_USERMAIN_EXECINCLALLACTIONS"}]
                                </td>
                            </tr>
                            <tr>
                                <td class="listitem" style="padding: 5px; height: auto;">
                                    [{oxmultilang ident="D3_USERMANAGER_USERMAIN_RECIPIENT"}]
                                </td>
                                <td class="listitem" style="padding: 5px; height: auto;">
                                    <input type="hidden" name="aContent[blSendMailToCustomer]" value="0">
                                    <input id="ToCustomer" class="edittext ext_edittext" type="checkbox" name="aContent[blSendMailToCustomer]" value='1' [{if $oUserManager->getValue('blSendMailToCustomer') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
                                    <label for="ToCustomer">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOCUSTOMER"}]</label>
                                    [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOCUSTOMER_DESC"}]<br>
                                    <input type="hidden" name="aContent[blSendMailToOwner]" value="0">
                                    <input id="ToOwner" class="edittext ext_edittext" type="checkbox" name="aContent[blSendMailToOwner]" value='1' [{if $oUserManager->getValue('blSendMailToOwner') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
                                    <label for="ToOwner">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOOWNER"}]</label>
                                    [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOOWNER_DESC"}]<br>
                                    <input type="hidden" name="aContent[blSendMailToCustom]" value="0">
                                    <input id="ToMail" class="edittext ext_edittext" type="checkbox" name="aContent[blSendMailToCustom]" value='1' [{if $oUserManager->getValue('blSendMailToCustom') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
                                    <label for="ToMail">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOMAIL"}]</label>
                                    <input id="ToMailInput" type="text" name="aContent[sSendMailToCustomAddress]" size="30" maxlength="60" value="[{$oUserManager->getValue('sSendMailToCustomAddress')}]" [{$blActionRestriction}] [{$readonly}]>
                                    <label for="ToMailInput" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOMAIL"}]</label>
                                    [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOMAIL_DESC"}]
                                </td>
                            </tr>
                            <tr>
                                <td class="listitem2" style="padding: 5px; height: auto;">
                                    <label for="mailsubject">[{oxmultilang ident="D3_USERMANAGER_USERMAIN_SUBJECT"}]</label>
                                </td>
                                <td class="listitem2" style="padding: 5px; height: auto;">
                                    <input id="mailsubject" type="text" name="aContent[mail][subject]" value="[{$aMailContent.subject}]" style="width: 95%;">
                                </td>
                            </tr>
                            <tr>
                                <td class="listitem" style="padding: 5px; height: auto;">
                                    <label for="mailhtml">[{oxmultilang ident="D3_USERMANAGER_USERMAIN_HTML"}]</label>
                                </td>
                                <td class="listitem" style="padding: 5px; height: auto;">
                                    [{$htmleditor}]
                                </td>
                            </tr>
                            <tr>
                                <td class="listitem2" style="padding: 5px; height: auto;">
                                </td>
                                <td class="listitem2" style="padding: 5px; height: auto;">
                                    <input type="hidden" name="aContent[mail][genplain]" value="0">
                                    <input id="mailgenplain" type="checkbox" name="aContent[mail][genplain]" value="1" [{if !$aMailContent.plain}]checked="checked"[{/if}] onclick="d3TogglePlain(this);">&nbsp;
                                    <label for="mailgenplain">[{oxmultilang ident="D3_USERMANAGER_USERMAIN_GENPLAIN"}]</label> [{oxinputhelp ident="D3_USERMANAGER_USERMAIN_GENPLAIN_DESC"}]
                                </td>
                            </tr>
                            <tr id="mailplaintr" style="display: [{if $aMailContent.plain}]table-row[{else}]none[{/if}];">
                                <td class="listitem2" style="padding: 5px; height: auto;">
                                    <label for="mailplain">[{oxmultilang ident="D3_USERMANAGER_USERMAIN_PLAIN"}]</label>
                                </td>
                                <td class="listitem2" style="padding: 5px; height: auto;">
                                    <textarea id="mailplain" name="aContent[mail][plain]">[{$aMailContent.plain}]</textarea>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            [{else}]
                <td style="vertical-align: top;" class="edittext">
                    <fieldset>
                        <form name="d3folderselector" id="d3folderselector" action="[{$oViewConf->getSelfLink()}]" method="post">
                            <legend>
                                [{$oViewConf->getHiddenSid()}]
                                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                <input type="hidden" name="oxid" value="[{$oxid}]">
                                <input type="hidden" name="editval[oxuser__oxid]" value="[{$oxid}]">
                                <input type="hidden" name="usermanagerid" value="-1">
                                <input type="hidden" name="fnc" value="changeFolder">
                                <label for="folderselector" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_FIELDTITLE_OXFOLDER"}]</label>
                                <select id="folderselector" size="1" class="editinput" name="jobfolder" onchange="document.getElementById('d3folderselector').submit();">
                                    [{foreach from=$oView->getFolderList() key="sMLItem" item="sTranslation"}]
                                        <option value="[{$sMLItem}]" [{if $sMLItem == $jobfolder}] selected[{/if}]>[{$sTranslation}]</option>
                                    [{/foreach}]
                                </select>
                            </legend>
                        </form>
                        [{if $oView->d3GetJobList()}]
                            <form name="d3execusermanager" id="d3execusermanager" action="[{$oViewConf->getSelfLink()}]" method="post">
                                [{$oViewConf->getHiddenSid()}]
                                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                <input type="hidden" name="fnc" value="d3execusermanager">
                                <input type="hidden" name="oxid" value="[{$oxid}]">
                                <input type="hidden" name="editval[oxuser__oxid]" value="[{$oxid}]">
                                <input type="hidden" name="usermanagerid" value="-1">
                                <table  style="border: none; padding: 0; width: 100%;">
                                    [{assign var="listclass" value="listitem"}]
                                    [{foreach from=$oView->d3GetJobList() item="oUserManager"}]
                                        <tr>
                                            [{assign var="sExecTime" value=$oUserManager->getLastExecutedTime($oxid)}]
                                            [{assign var="sExecStatus" value=$oUserManager->getExecutedStatus($oxid)}]
                                            <td class="[{$listclass}]">[{$oUserManager->getFieldData('oxtitle')}]</td>
                                            <td class="[{$listclass}]">
                                                [{if $sExecStatus == 'finished'}]
                                                    <span class="d3modcfg_btn icon d3color-blue">
                                                        <button style="width: 300px;" onclick="if (confirm('[{oxmultilang ident="D3_USERMANAGER_USERMAIN_EXECRESETCONFIRM"}]')) {document.getElementById('d3execusermanager').fnc.value = 'd3resetUserManagerAssignment'; document.getElementById('d3execusermanager').usermanagerid.value = '[{$oUserManager->getId()}]'; document.getElementById('d3execusermanager').submit();} else {return false;}">
                                                            <i class="fa fa-trash-o"></i>
                                                            [{oxmultilang ident="D3_USERMANAGER_USERMAIN_EXECRESET"}]
                                                        </button>
                                                    </span>
                                                [{elseif $sExecStatus == 'reexecute'}]
                                                    <span class="d3modcfg_btn icon d3color-blue">
                                                        <button style="width: 300px;" onclick="document.getElementById('d3execusermanager').usermanagerid.value = '[{$oUserManager->getId()}]'; document.getElementById('d3execusermanager').submit();">
                                                            <i class="fa fa-circle"></i>
                                                            [{oxmultilang ident="D3_USERMANAGER_USERMAIN_REEXECSTART"}][{if false == $oUserManager->getValue('sManuallyExecMeetCondition')}]*[{/if}]
                                                        </button>
                                                    </span>
                                                    [{assign var="blExecNote" value=true}]
                                                [{else}]
                                                    <span class="d3modcfg_btn icon d3color-blue">
                                                        <button style="width: 300px;" name="requestData" onclick="document.getElementById('d3execusermanager').usermanagerid.value = '[{$oUserManager->getId()}]'; document.getElementById('d3execusermanager').submit();">
                                                            <i class="fa fa-circle-o"></i>
                                                            [{oxmultilang ident="D3_USERMANAGER_USERMAIN_EXECSTART"}][{if false == $oUserManager->getValue('sManuallyExecMeetCondition')}]*[{/if}]
                                                        </button>
                                                    </span>
                                                    [{assign var="blExecNote" value=true}]
                                                [{/if}]
                                                [{if $sExecTime}]
                                                    <div style="float:none; clear: both;">([{oxmultilang ident="D3_USERMANAGER_USERMAIN_EXECON"}] [{$sExecTime|oxformdate}])</div>
                                                [{/if}]
                                            </td>
                                            <td class="[{$listclass}]">
                                                [{if $sExecStatus == 'finished'}]
                                                [{elseif $oUserManager->getValue('blActionMailsend_status')}]
                                                    <span class="d3modcfg_btn icon d3color-orange">
                                                        <button style="width: 300px;" onclick="document.getElementById('d3execusermanager').usermanagerid.value = '[{$oUserManager->getId()}]'; document.getElementById('d3execusermanager').fnc.value = 'execChangedContents'; document.getElementById('d3execusermanager').submit();">
                                                            <i class="fa fa-pencil fa-inverse"></i>
                                                            [{oxmultilang ident="D3_USERMANAGER_USERMAIN_CHANGEEXEC"}][{if false == $oUserManager->getValue('sManuallyExecMeetCondition')}]*[{/if}]
                                                        </button>
                                                    </span>
                                                [{else}]
                                                    <span class="d3modcfg_btn icon d3color-orange">
                                                        <button style="width: 300px;" onclick="document.getElementById('d3execusermanager').usermanagerid.value = '[{$oUserManager->getId()}]'; document.getElementById('d3execusermanager').fnc.value = 'execChangedContents'; document.getElementById('d3execusermanager').submit();" disabled>
                                                            <i class="fa fa-pencil fa-inverse"></i>
                                                            [{oxmultilang ident="D3_USERMANAGER_USERMAIN_NOCHANGEEXEC"}]
                                                        </button>
                                                    </span>
                                                [{/if}]
                                            </td>
                                        </tr>
                                        [{if $listclass == "listitem"}]
                                            [{assign var="listclass" value="listitem2"}]
                                        [{else}]
                                            [{assign var="listclass" value="listitem"}]
                                        [{/if}]
                                    [{/foreach}]
                                    [{if $blExecNote}]
                                        <tr><td colspan="2" style="text-align: right;"><sub>[{oxmultilang ident="D3_USERMANAGER_USERMAIN_EXECSTART_DESC"}]</sub></td></tr>
                                    [{/if}]
                                </table>
                            </form>
                        [{else}]
                            [{oxmultilang ident="D3_USERMANAGER_USERMAIN_NOUMJOBS"}]
                        [{/if}]
                    </fieldset>
                </td>
            [{/if}]
        [{/d3modcfgcheck}]
        [{if !$mod_d3usermanager}]
            <td>
                <div class="extension_error">
                    [{oxmultilang ident="D3_CFG_MOD_NOTACTIVE"}]
                </div>
            </td>
        [{/if}]
    </tr>
</table>

[{include file="d3_cfg_mod_inc.tpl"}]