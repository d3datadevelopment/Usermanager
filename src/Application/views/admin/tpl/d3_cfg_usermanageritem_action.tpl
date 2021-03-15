[{include file="headitem.tpl" title="D3_USERMANAGER_ACTION"|oxmultilangassign}]

<style type="text/css">
    .ext_edittext {
        padding: 2px;
    }
</style>

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

    function selectAllListElems(el)
    {
        let aSelectLen = el.length;
        for(let i = 0; i < aSelectLen; i++)
        {
            el.options[i].selected = true;
        }
    }

    function selectNoListElems(el)
    {
        let aSelectLen = el.length;
        for(let i = 0; i < aSelectLen; i++)
        {
            el.options[i].selected = false;
        }
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

    .groupExp dl dt{
        font-weight: normal;
        width: 40%;
        padding-left: 10px;
    }

    .groupExp dl dd {
        margin-left: 42%;
        padding-top: 5px;
    }

    .groupExp.disabled dl dt,
    .groupExp.disabled dl dd,
    .groupExp.disabled dl dd a,
    .groupExp.disabled .exp a.rc b,
    .groupExp.disabled a.rc b,
    .groupExp dl.disabled dt,
    .groupExp dl.disabled dd,
    .groupExp dl.disabled dd a {
        color: darkgrey;
    }

    .groupExp dl.disabled {
        border-top: none;

        background: #ffffe0; /* Old browsers */
        background: -moz-linear-gradient(top, #ffffe0 0%, #f0f0f0 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffe0), color-stop(100%,#f0f0f0)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #ffffe0 0%,#f0f0f0 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #ffffe0 0%,#f0f0f0 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #ffffe0 0%,#f0f0f0 100%); /* IE10+ */
        background: linear-gradient(to bottom, #ffffe0 0%,#f0f0f0 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffe0', endColorstr='#f0f0f0',GradientType=0 ); /* IE6-9 */

    }

    .edittext select.editinput {
        width: auto;
    }
    details, .restrictioninfo {
        margin: 0 0 15px;
        padding: 6px 9px 2px 18px;
        border: 1px solid silver;
        color: silver;
        border-radius: .25rem;
        border-left: .25rem #028fe8 solid;
    }
    details summary {
        margin: 0 0 3px -12px;
        cursor: pointer;
    }
    .restrictioninfo {
        color: black;
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
    <input type="hidden" name="actshop" value="[{$shop->getId()}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="save">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="editval[[{$edit->d3getFieldLongName('oxid')}]]" value="[{$oxid}]">

    <table style="border: none; width: 98%">
        [{if $edit->getId() && !$edit->getLicenseActive()}]
            <tr>
                <td style="vertical-align: top;" class="edittext" colspan="2">
                    <div class="extension_warning">[{oxmultilang ident="D3_USERMANAGER_ERROR_IEXECJOBSLIMIT"}]</div>
                </td>
            </tr>
        [{/if}]

        [{if $missingRequValuesActions}]
            <tr>
                <td style="vertical-align: top;" class="edittext" colspan="2">
                    <div class="extension_error">[{oxmultilang ident="D3_USERMANAGER_ERROR_MISSINGREQUACTIONVALUES"}]</div>
                </td>
            </tr>
        [{/if}]

        <tr>
            <td style="vertical-align: top" class="edittext">

                <details>
                    <summary>[{oxmultilang ident="D3_GENERAL_USERMANAGER_DESCRIPTION"}]</summary>
                    [{oxmultilang ident="d3tbclusermanager_items_action_desc"}]
                </details>

                [{if $edit->getBasicRestrictionSettings()}]
                    <div class="restrictioninfo">
                        [{oxmultilang ident="D3_GENERAL_USERMANAGER_BASICRESTRICTIONS"}]
                    </div>
                [{/if}]

                [{assign var="blRestricted" value=false}]
                [{foreach from=$oView->getGroupedActionList() key="sGroupId" item="oActionList"}]
                    <div class="groupExp">
                        <div class="">
                            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                <b>
                                    [{oxmultilang ident=$sGroupId}]
                                </b>
                            </a>

                            [{foreach from=$oActionList->getActionList() key="sActionId" item="oAction"}]
                                [{if $oAction->isAllowed()}]
                                    [{assign var="blActionRestriction" value=""}]
                                [{else}]
                                    [{assign var="blActionRestriction" value="readonly disabled"}]
                                    [{assign var="blRestricted" value=true}]
                                [{/if}]

                                <div style="[{if $missingRequValuesActions && $sActionId|in_array:$missingRequValuesActions}]border: 1px solid red; [{/if}]">
                                    [{include file=$oAction->getTplName() oAction=$oAction}]
                                </div>
                            [{/foreach}]
                        </div>
                    </div>
                [{/foreach}]

                [{if $blRestricted}]
                    [{include file="d3_cfg_usermanageritem_restrictions.tpl"}]
                [{/if}]

                <table style="width: 100%">
                    <tr>
                        <td class="edittext ext_edittext" style="text-align: left"><br>
                            <span class="d3modcfg_btn icon d3color-green">
                                <button type="submit" name="save" [{$readonly}]>
                                    <i class="fa fa-check-circle fa-inverse"></i>
                                    [{oxmultilang ident="D3_GENERAL_MODPROFILE_SAVE"}]
                                </button>
                            </span>
                            <span class="d3modcfg_btn icon d3color-blue" style="margin-left: 10px; max-width: none;">
                                <button type="submit" name="save" onClick="document.myedit.fnc.value='markasfinished'" [{$readonly}]>
                                    <i class="fa fa-tag fa-inverse"></i>
                                    [{oxmultilang ident="D3_USERMANAGER_ACTION_MARKASFINISHED"}]
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
