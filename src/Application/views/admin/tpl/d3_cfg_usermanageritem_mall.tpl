[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<style type="text/css">
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

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="oxidCopy" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

[{if $edit->getId() && !$edit->getLicenseActive()}]
    <table style="width:98%; padding: 0: border: none;">
        <tr>
            <td style="vertical-align: top;" class="edittext" colspan="2">
                <div class="extension_warning">[{oxmultilang ident="D3_USERMANAGER_ERROR_IEXECJOBSLIMIT"}]</div>
            </td>
        </tr>
    </table>
[{/if}]

<details>
    <summary>[{oxmultilang ident="D3_GENERAL_USERMANAGER_DESCRIPTION"}]</summary>
    [{oxmultilang ident="d3tbclusermanager_items_mall_desc"}]
</details>

[{oxmultilang ident="D3_USERMANAGER_ERROR_NOMALL"}]

[{include file="d3_cfg_mod_inc.tpl"}]