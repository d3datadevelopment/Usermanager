[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<script type="text/javascript">
<!--
    [{if $updatelist == 1}]
        UpdateList('[{$oxid}]');
    [{/if}]

    function UpdateList( sID)
    {
        let oSearch = parent.list.document.getElementById("search");
        oSearch.oxid.value=sID;
        oSearch.fnc.value='';
        oSearch.submit();
    }

    function EditThis( sID)
    {
        let oTransfer = document.getElementById("transfer");
        oTransfer.oxid.value=sID;
        oTransfer.cl.value='[{$oViewConf->getActiveClassName()}]';
        oTransfer.submit();

        let oSearch = parent.list.document.getElementById("search");
        oSearch.actedit.value = 0;
        oSearch.oxid.value=sID;
        oSearch.submit();
    }

    function ChangeLstrt()
    {
        let oSearch = document.getElementById("search");
        if (document.search != null && document.search.lstrt != null)
            oSearch.lstrt.value=0;
    }
//-->
</script>

<style type="text/css">
    fieldset legend {
        color: #A0A0A0;
    }
    fieldset table {
        width: 100%;
    }
    fieldset table td:nth-child(1) {
        width: 80%;
        white-space: normal;
    }
    fieldset table td #debugnote {
        font-size: 9px;
    }
    fieldset table td:nth-child(2) {
        width: 20%;
        text-align: right;
    }

    details {
        margin: 0 0 15px;
        padding: 6px 9px 2px 18px;
        border: 1px solid silver;
        color: silver;
    }
    details summary {
        margin: 0 0 3px -12px;
        cursor: pointer;
    }
</style>

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="oxidCopy" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post" style="padding: 0;margin: 0;height:0;">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="voxid" value="[{$oxid}]">
    <input type="hidden" name="editval[[{$edit->d3GetFieldLongName('oxid')}]]" value="[{$oxid}]">

    <table style="width:98%; padding: 0; border: none">
        [{if $edit->getId() && !$edit->getLicenseActive()}]
            <tr>
                <td style="vertical-align:top;" colspan="2">
                    <div class="extension_warning">[{oxmultilang ident="D3_USERMANAGER_ERROR_IEXECJOBSLIMIT"}]</div>
                </td>
            </tr>
        [{/if}]

        <tr>
            <td class="edittext" colspan="2">
                <details>
                    <summary>[{oxmultilang ident="D3_GENERAL_USERMANAGER_DESCRIPTION"}]</summary>
                    [{oxmultilang ident="d3tbclusermanager_items_main_desc"}]
                </details>
            </td>
        </tr>

        <tr>
            <td class="edittext" style="text-align:left; vertical-align:top; height:99%;padding-left:5px;padding-bottom:30px;padding-top:10px;">

                <table style="border: none; padding: 0;">
                    <tr>
                        <td class="edittext">
                            <label for="MainTitle">[{oxmultilang ident="D3_MODPROFILE_MAIN_TITLE"}]</label>&nbsp;
                        </td>
                        <td class="edittext">
                            <input id="MainTitle" type="text" class="editinput" size="50" maxlength="[{$edit->d3getFieldMaxLength('oxtitle')}]" name="editval[[{$edit->d3GetFieldLongName('oxtitle')}]]" value="[{$edit->getFieldData('oxtitle')}]" [{$readonly}]>
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            <label for="MainShortDesc">[{oxmultilang ident="D3_MODPROFILE_MAIN_SHORTDESC"}]</label>&nbsp;
                        </td>
                        <td class="edittext">
                            <textarea id="MainShortDesc"  name="editval[[{$edit->d3GetFieldLongName('oxshortdesc')}]]" class="editinput" maxlength="[{$edit->d3getFieldMaxLength('oxshortdesc')}]" cols="50" rows="5" [{$readonly}]>[{$edit->getFieldData('oxshortdesc')}]</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            <label for="MainSort">[{oxmultilang ident="D3_MODPROFILE_MAIN_SORT"}]</label>&nbsp;
                        </td>
                        <td class="edittext">
                            <input id="MainSort" type="text" class="editinput" size="32" maxlength="[{$edit->d3getFieldMaxLength('oxsort')}]" name="editval[[{$edit->d3GetFieldLongName('oxsort')}]]" value="[{$edit->getFieldData('oxsort')}]" [{$readonly}]>
                            [{oxinputhelp ident="D3_USERMANAGER_MAIN_SORT_DESC"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            <label for="MainFolder">[{oxmultilang ident="D3_MODPROFILE_MAIN_FOLDER"}]</label>&nbsp;
                        </td>
                        <td class="edittext">
                            <select id="MainFolder" class="editinput" size="1" name="editval[[{$edit->d3GetFieldLongName('oxfolder')}]]" [{$readonly}]>
                                <option value="" [{if '' == $edit->getFieldData('oxfolder')}] selected[{/if}]>[{oxmultilang ident="D3_MODPROFILE_MAIN_NOFOLDER"}]</option>
                                [{foreach from=$oView->getFolderList() key="sMLItem" item="sTranslation"}]
                                    <option value="[{$sMLItem}]" [{if $sMLItem == $edit->getFieldData('oxfolder')}] selected[{/if}]>[{$sTranslation}]</option>
                                [{/foreach}]
                            </select>
                            [{oxinputhelp ident="D3_USERMANAGER_MAIN_FOLDER_DESC"}]
                        </td>
                    </tr>

                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="D3_USERMANAGER_MAIN_LASTEXEC"}]&nbsp;
                        </td>
                        <td class="edittext">
                            [{$edit->getValue('iLastExecDate')|date_format:"%Y-%m-%d %H:%M:%S"}]
                        </td>
                    </tr>
                    [{if $blShowLangSwitch}]
                        <tr>
                            <td class="edittext" colspan="2"><br>
                                [{include file="language_edit.tpl"}]<br>
                            </td>
                        </tr>
                    [{/if}]
                </table>

                <table style="border: none; padding: 0;">
                    [{include file="d3_modprofile_actionbuttons.tpl"}]
                </table>
            </td>

            <!-- Anfang rechte Seite -->
            <td style="vertical-align: top; padding-top:10px;padding-left:10px;">
                <fieldset>
                    <legend>[{oxmultilang ident="D3_USERMANAGER_MAIN_FIELDSET_EXECUTION"}]</legend>
                    <table style="border: none; padding: 0;">
                        <tr>
                            <td class="edittext" style="
                                    [{if ($edit->getFieldData('oxactive') == 1 OR
                            ($blUseTimeCheck && ($edit->getFieldData('oxactivefrom') != '0000-00-00 00:00:00' AND $edit->getFieldData('oxactiveto') != '0000-00-00 00:00:00')))
                            AND !$edit->getValue('blItemExecute') AND !$edit->getValue('blItemMailSend')}]
                                    font-weight: bold; background-color: darkred; color: white;
                                    [{/if}]">
                                <label for="MainExecute">[{oxmultilang ident="D3_USERMANAGER_MAIN_EXECUTE2"}][{if $oSet->hasDebugMode()}]<br><span id="debugnote">[{oxmultilang ident="D3_USERMANAGER_MAIN_EXECUTE_DEBUG"}]</span>[{/if}]</label>
                            </td>
                            <td class="edittext">
                                <input type="hidden" name="value[blItemExecute]" value="1">
                                <input id="MainExecute" type="checkbox" [{if $oSet->hasDebugMode()}]disabled[{/if}] class="edittext ext_edittext" name="value[blItemExecute]" value="0" [{if false == $edit->getValue('blItemExecute')}]checked[{/if}] [{$readonly}]>
                                [{oxinputhelp ident="D3_USERMANAGER_MAIN_EXECUTE_DESC"}]
                            </td>
                        </tr>
                        <tr>
                            <td class="edittext" style="
                                    [{if ($edit->getFieldData('oxactive') == 1 OR
                            ($blUseTimeCheck && ($edit->getFieldData('oxactivefrom') != '0000-00-00 00:00:00' AND $edit->getFieldData('oxactiveto') != '0000-00-00 00:00:00')))
                            AND !$edit->getValue('blItemExecute') AND !$edit->getValue('blItemMailSend')}]
                                    font-weight: bold; background-color: darkred; color: white;
                                    [{/if}]">
                                <label for="MainMailsend">[{oxmultilang ident="D3_USERMANAGER_MAIN_MAILSEND"}]</label>&nbsp;
                            </td>
                            <td class="edittext">
                                <input type="hidden" name="value[blItemMailSend]" value="0">
                                <input id="MainMailsend" type="checkbox" class="edittext ext_edittext" name="value[blItemMailSend]" value="1" [{if $edit->getValue('blItemMailSend')}]checked[{/if}] [{$readonly}]>
                                [{oxinputhelp ident="D3_USERMANAGER_MAIN_MAILSEND_DESC"}]
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
<!-- Ende rechte Seite -->
        </tr>
    </table>
</form>

[{include file="d3_cfg_mod_inc.tpl"}]