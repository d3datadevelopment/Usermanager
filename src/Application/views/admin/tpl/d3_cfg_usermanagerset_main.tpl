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
    oTransfer.cl.value='';
    oTransfer.submit();

    let oSearch = parent.list.document.getElementById("search");
    oSearch.actedit.value = 0;
    oSearch.oxid.value=sID;
    oSearch.submit();
}

function _groupExp(el) {
    let _cur = el.parentNode;

    if (_cur.className === "exp") _cur.className = "";
      else _cur.className = "exp";
}

let sOldSettingElem = '';

function showFormatSettings(sElemId, visible, blUseOldElem)
{
    if (blUseOldElem && sOldSettingElem) {
        document.getElementById(sOldSettingElem).style.display = 'none';
        sOldSettingElem = sElemId;
    } else if (blUseOldElem) {
        document.getElementById('settings_global').style.display = 'none';
        document.getElementById('settingstxt_global').style.display = 'none';
        sOldSettingElem = sElemId;
    }

    if (visible === true)
        document.getElementById(sElemId).style.display = 'block';
    else
        document.getElementById(sElemId).style.display = 'none';

}

-->
</script>

<style type="text/css">
<!--
    fieldset{
        border: 1px inset black;
        background-color: #F0F0F0;
    }

    legend{
        font-weight: bold;
    }

    dl dt{
        font-weight: normal;
        width: 49%;
    }

    .groupExp dl dd{
        padding-left: 50%;
    }

    .ext_edittext {
        padding: 2px;
    }

    td.edittext {
        white-space: normal;
    }
-->
</style>

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="actshop" value="[{$shop->id}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="save">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cronid" value="">
    <input type="hidden" name="crontype" value="">
    <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{$oxid}]">

    <table style="border: none; width: 98%">
        <tr>
            <td style="vertical-align: top;" class="edittext">

                [{include file="d3_cfg_mod_active.tpl"}]

                <div class="groupExp">
                    <div class="">
                        <a class="rc" onclick="_groupExp(this); return false;" href="#">
                            <b>
                                [{oxmultilang ident="D3_USERMANAGER_SET_JOBSETTINGS"}]
                            </b>
                        </a>
                        <dl>
                            <dt>
                                <label for="SetCronActive">[{oxmultilang ident="D3_USERMANAGER_SET_CALCULATESTATONDEMAND"}]</label>
                            </dt>
                            <dd>
                                <input type="hidden" name="value[blCalcStatOnDemand]" value="0">
                                <input id="SetCronActive" class="edittext ext_edittext" type="checkbox" name="value[blCalcStatOnDemand]" value='1' [{if $edit->getValue('blCalcStatOnDemand') == 1}]checked[{/if}]>
                                [{oxinputhelp ident="D3_USERMANAGER_SET_CALCULATESTATONDEMAND_DESC"}]
                            </dd>
                            <div class="spacer"></div>
                        </dl>
                        <dl>
                            <dt>
                                <label for="SetFolder">[{oxmultilang ident="D3_USERMANAGER_SET_FOLDERLIST"}]</label>
                            </dt>
                            <dd>
                                <textarea id="SetFolder" class="edittext ext_edittext" name="valuearr[aFolderList]" style="height: 70px; width: 300px;">[{$edit->getEditValue('aFolderList')}]</textarea>
                                [{oxinputhelp ident="D3_USERMANAGER_SET_FOLDERLIST_DESC"}]
                            </dd>
                            <div class="spacer"></div>
                        </dl>
                    </div>
                </div>

                <div class="groupExp">
                    <div class="">
                        <a class="rc" onclick="_groupExp(this); return false;" href="#">
                            <b>
                                [{oxmultilang ident="D3_USERMANAGER_SET_CRON"}]
                            </b>
                        </a>
                        <dl>
                            <dt>
                                <label for="SetCronActive">[{oxmultilang ident="D3_USERMANAGER_SET_CRON_ACTIVE"}]</label>
                            </dt>
                            <dd>
                                <input type="hidden" name="value[blCronActive]" value="0">
                                <input id="SetCronActive" class="edittext ext_edittext" type="checkbox" name="value[blCronActive]" value='1' [{if $edit->getValue('blCronActive') == 1}]checked[{/if}]>
                                [{oxinputhelp ident="D3_USERMANAGER_SET_CRON_ACTIVE_DESC"}]
                            </dd>
                            <div class="spacer"></div>
                        </dl>
                        <dl>
                            <dt>
                                <label for="SetCronMaxUserCnt">[{oxmultilang ident="D3_USERMANAGER_SET_CRON_MAXUSERCNT"}]</label>
                            </dt>
                            <dd>
                                <input type="hidden" name="value[iMaxUserCnt]" value="0">
                                <input id="SetCronMaxUserCnt" class="edittext ext_edittext" type="text" size="4" maxlength="7" name="value[iMaxUserCnt]" value="[{if $edit->getValue('iMaxUserCnt')}][{$edit->getValue('iMaxUserCnt') == 1}][{else}]50[{/if}]">
                                [{oxinputhelp ident="D3_USERMANAGER_SET_CRON_MAXUSERCNT_DESC"}]
                            </dd>
                            <div class="spacer"></div>
                        </dl>
                        <dl>
                            <dt>
                                <label for="SetCronPW">[{oxmultilang ident="D3_USERMANAGER_SET_CRON_PASSWORD"}]</label>
                            </dt>
                            <dd>
                                <input id="SetCronPW" class="edittext ext_edittext" type="test" size="20" maxlength="50" name="value[sCronPassword]" value="[{if $edit->getValue('sCronPassword')}][{$edit->getValue('sCronPassword')}][{else}][{$oView->getBaseCronPW()}][{/if}]">
                                [{oxinputhelp ident="D3_USERMANAGER_SET_CRON_PASSWORD_DESC"}]
                            </dd>
                            <div class="spacer"></div>
                        </dl>
                    </div>
                </div>

                [{foreach from=$oView->getAvailableCronjobIds() item="aCronJobIds"}]
                    <div class="groupExp">
                        <div class="">
                            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                <b>
                                    [{$oView->getCJIDDesc($aCronJobIds)}] [{oxinputhelp ident="D3_USERMANAGER_SET_CRON_JOB_DESC"}]
                                </b>
                            </a>
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_USERMANAGER_SET_CRON_PATH"}]
                                </dt>
                                <dd>
                                    [{$oView->getCronPath($aCronJobIds.id)}]
                                    [{oxinputhelp ident="D3_USERMANAGER_SET_CRON_PATH_DESC"}]
                                </dd>
                                <div class="spacer"></div>
                            </dl>
                            <dl>
                                <dt>
                                    <label for="shcrontype_[{$aCronJobIds.id}]">[{oxmultilang ident="D3_SHGENERATOR_CRON_SHGENERATOR"}]</label>
                                </dt>
                                <dd>
                                    <select style="float: left; margin-right: 10px;" id="shcrontype_[{$aCronJobIds.id}]">
                                        [{foreach from=$oView->getCronProviderList() item="sProviderName" key="sProviderId"}]
                                            <option value="[{$sProviderId}]">
                                                [{$sProviderName}]
                                            </option>
                                        [{/foreach}]
                                    </select>
                                    <span class="d3modcfg_btn icon d3color-blue">
                                        <button name="save" onclick="oForm = document.getElementById('myedit'); oForm.crontype.value = document.getElementById('shcrontype_[{$aCronJobIds.id}]').value; oForm.cronid.value='[{$aCronJobIds.id}]'; oForm.fnc.value='generateCronShFile'; oForm.submit();">
                                            <i class="fa fa-download fa-inverse"></i>
                                            [{oxmultilang ident="D3_SHGENERATOR_CRON_SHGENERATOR_GENERATE"}]
                                        </button>
                                    </span>
                                    [{oxinputhelp ident="D3_SHGENERATOR_CRON_SHGENERATOR_DESC"}]
                                </dd>
                                <div class="spacer"></div>
                            </dl>
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_USERMANAGER_SET_CRON_EXTLINK"}]
                                </dt>
                                <dd>
                                    <a href="[{$oView->getCronLink(true, $aCronJobIds.id)}]" target="_new" class="d3modcfg_btn icon d3color-blue" style="margin-right: 3px; padding-right: 0; background-image: none; width: 25px;">
                                        <i class="fa fa-mouse-pointer fa-inverse" style="padding: 5px 9px;"></i>
                                    </a>
                                    [{$oView->getCronLink(true, $aCronJobIds.id)}]
                                    [{oxinputhelp ident="D3_USERMANAGER_SET_CRON_EXTLINK_DESC"}]
                                </dd>
                                <div class="spacer"></div>
                            </dl>
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_USERMANAGER_SET_CRON_LASTEXEC"}]
                                </dt>
                                <dd>
                                    [{$edit->getValue($oView->getCronTimestampVarName($aCronJobIds.id))|oxformdate}]
                                    [{oxinputhelp ident="D3_USERMANAGER_SET_CRON_LASTEXEC_DESC"}]
                                </dd>
                                <div class="spacer"></div>
                            </dl>
                        </div>
                    </div>
                [{/foreach}]

                <table style="width: 100%">
                    <tr>
                        <td class="edittext ext_edittext" style="text-align: left">
                            <span class="d3modcfg_btn icon d3color-green">
                                <button type="submit" name="save" onclick="oForm = document.getElementById('myedit'); oForm.crontype.value = ''; oForm.cronid.value=''; oForm.fnc.value='save'; oForm.submit();">
                                    <i class="fa fa-check-circle fa-inverse"></i>
                                    [{oxmultilang ident="D3_CFG_MOD_GENERAL_SAVE"}]
                                </button>
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</form>

[{include file="d3_cfg_mod_inc.tpl"}]
