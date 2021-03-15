[{include file="headitem.tpl" title="d3mxcfgmod"|oxmultilangassign box="list"}]
[{assign var="where" value=$oView->getListFilter()}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<script type="text/javascript">
    <!--
    function EditThis( sID)
    {
        let oTransfer = parent.edit.document.getElementById("transfer");
        oTransfer.oxid.value=sID;
        oTransfer.cl.value='[{if $actlocation}][{$actlocation}][{else}][{$default_edit}][{/if}]';

        //forcing edit frame to reload after submit
        top.forceReloadingEditFrame();

        let oSearch = document.getElementById("search");
        oSearch.oxid.value=sID;
        oSearch.submit();
    }

    function DeleteThis( sID)
    {
        let blCheck = confirm("[{oxmultilang ident="GENERAL_YOUWANTTODELETE"}]");
        if( blCheck === true)
        {
            let oSearch = document.getElementById("search");
            oSearch.oxid.value=sID;
            oSearch.fnc.value='deleteentry';
            oSearch.actedit.value=0;
            oSearch.submit();

            let oTransfer = parent.edit.document.getElementById("transfer");
            oTransfer.oxid.value='-1';
            oTransfer.cl.value='[{$default_edit}]';

            //forcing edit frame to reload after submit
            top.forceReloadingEditFrame();
        }
    }

    function ChangeEditBar( sLocation, sPos)
    {
        let oSearch = document.getElementById("search");
        oSearch.actedit.value=sPos;
        oSearch.submit();

        let oTransfer = parent.edit.document.getElementById("transfer");
        oTransfer.cl.value=sLocation;

        //forcing edit frame to reload after submit
        top.forceReloadingEditFrame();
    }

    function ChangeLanguage()
    {
        let oSearch = document.getElementById("search");
        oSearch.language.value=oSearch.changelang.value;
        oSearch.editlanguage.value=oSearch.changelang.value;
        oSearch.submit();

        let oTransfer = parent.edit.document.getElementById("transfer");
        oTransfer.innerHTML += '<input type="hidden" name="language" value="'+oSearch.changelang.value+'">';
        oTransfer.innerHTML += '<input type="hidden" name="editlanguage" value="'+oSearch.changelang.value+'">';

        //forcing edit frame to reload after submit
        top.forceReloadingEditFrame();
    }

    window.onLoad = top.reloadEditFrame();
    //-->
</script>

<style type="text/css">
    <!--
    .d3notallowed,
    .d3notallowed a {
        color: silver;
    }
    -->
</style>

[{if $oView->d3getShowListItems()}]

    [{assign var="baseObject" value=$mylist->getBaseObject()}]
    [{assign var="coreTableName" value=$baseObject->getCoreTableName()}]

    <div id="liste">
        <form name="search" id="search" action="[{$oViewConf->getSelfLink()}]" method="post">
            [{include file="_formparams.tpl" cl=$oViewConf->getActiveClassName() lstrt=$lstrt actedit=$actedit oxid=$oxid fnc="" language=$actlang editlanguage=$actlang}]

            <table style="border: none; padding: 0; width:100%;">
                <colgroup>
                    [{block name="admin_d3usermanager_list_colgroup"}]
                        <col style="width: 3%">
                        <col style="width: 3%">
                        <col style="width: 14%">
                        <col style="width: 50%">
                        <col style="width: 20%">
                        <col style="width: 10%">
                    [{/block}]
                </colgroup>
                <tr class="listitem">
                    [{block name="admin_d3usermanager_list_filter"}]
                        <td style="vertical-align: middle; height; 20px;" class="listfilter first" nowrap>
                            <div class="r1"><div class="b1">&nbsp;</div></div>
                        </td>
                        <td style="vertical-align: middle; height; 20px;" class="listfilter" nowrap>
                            <div class="r1"><div class="b1">&nbsp;</div></div>
                        </td>
                        <td style="vertical-align: middle; height; 20px;" class="listfilter" nowrap>
                            <div class="r1">
                                <div class="b1">
                                    <label for="filtersorting" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_FILTER_SORTING"}]</label>
                                    <input id="filtersorting" title="[{oxmultilang ident="D3_USERMANAGER_FILTER_SORTING"}]" class="listedit" type="text" size="10" maxlength="128" name="where[[{$coreTableName}]][oxsort]" value="[{$where.$coreTableName.oxsort}]">
                                </div>
                            </div>
                        </td>
                        <td style="vertical-align: top;" class="listfilter" nowrap>
                            <div class="r1">
                                <div class="b1">
                                    <label for="filtertitle" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_FILTER_TITLE"}]</label>
                                    <input id="filtertitle" class="listedit" title="[{oxmultilang ident="D3_USERMANAGER_FILTER_TITLE"}]" type="text" size="25" maxlength="128" name="where[[{$coreTableName}]][oxtitle]" value="[{$where.$coreTableName.oxtitle}]"
                                </div>
                            </div>
                        </td>
                        <td style="vertical-align: middle; height; 20px;" colspan="2" class="listfilter" nowrap>
                            <div class="r1">
                                <div class="b1">
                                    <div class="find">
                                        [{if $blShowLangSwitch}]
                                            <label for="langswitch" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_FILTER_LANGUAGE"}]</label>
                                            <select id="langswitch" title="[{oxmultilang ident="D3_USERMANAGER_FILTER_LANGUAGE"}]" name="changelang" class="editinput" onChange="ChangeLanguage();">
                                                [{foreach from=$languages item="lang"}]
                                                    <option value="[{$lang->id}]" [{if $lang->selected}]SELECTED[{/if}]>[{$lang->name}]</option>
                                                [{/foreach}]
                                            </select>
                                        [{/if}]
                                        <input class="listedit" type="submit" name="submitit" value="[{oxmultilang ident="GENERAL_SEARCH"}]" onClick="document.search.lstrt.value=0;">
                                    </div>

                                    <label for="filterfolder" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_FILTER_FOLDER"}]</label>
                                    <select id="filterfolder" name="folder" title="[{oxmultilang ident="D3_USERMANAGER_FILTER_FOLDER"}]" class="folderselect" onChange="document.search.submit();" [{include file="help.tpl" helpid=searchfieldoxdynamic}]>
                                        [{foreach from=$oView->getSelectableFolderList() key="sMLIdent" item="sTranslation"}]
                                            <option value="[{$sMLIdent}]" [{if $sMLIdent == $folder}]SELECTED[{/if}]>[{$sTranslation}]</option>
                                        [{/foreach}]
                                    </select>
                                </div>
                            </div>
                        </td>
                    [{/block}]
                </tr>
                <tr>
                    [{block name="admin_d3usermanager_list_sorting"}]
                        <td class="listheader first" height="15">&nbsp;
                            <a href="Javascript:top.oxid.admin.setSorting( document.search, '[{$coreTableName}]', 'oxactive', '[{$nextSortDir|default:"asc"}]');document.search.submit();" class="listheader" title="[{oxmultilang ident="D3_USERMANAGER_GENERAL_ACTIVTITLE_DESC"}]">
                                [{oxmultilang ident="D3_USERMANAGER_GENERAL_ACTIVTITLE"}]
                            </a>
                        </td>
                        <td class="listheader first" height="15">&nbsp;
                            <a href="Javascript:top.oxid.admin.setSorting( document.search, '[{$coreTableName}]', 'd3_um_execmanually', '[{$nextSortDir|default:"asc"}]');document.search.submit();" class="listheader" title="[{oxmultilang ident="D3_USERMANAGER_GENERAL_ACTIVMANTITLE_DESC"}]">
                                [{oxmultilang ident="D3_USERMANAGER_GENERAL_ACTIVMANTITLE"}]
                            </a>
                        </td>
                        <td class="listheader" height="15">&nbsp;
                            <a href="Javascript:top.oxid.admin.setSorting( document.search, '[{$coreTableName}]', 'oxsort', '[{$nextSortDir|default:"asc"}]');document.search.submit();" class="listheader">
                                [{oxmultilang ident="D3_GENERAL_USERMANAGER_SORT"}]
                            </a>
                        </td>
                        <td class="listheader">
                            <a href="Javascript:top.oxid.admin.setSorting( document.search, '[{$coreTableName}]', 'oxtitle', '[{$nextSortDir|default:"asc"}]');document.search.submit();" class="listheader">
                                [{oxmultilang ident="D3_GENERAL_MODPROFILE_TITLE"}]
                            </a>
                        </td>
                        <td class="listheader">
                            <a href="Javascript:top.oxid.admin.setSorting( document.search, '[{$coreTableName}]', 'oxfolder', '[{$nextSortDir|default:"asc"}]');document.search.submit();" class="listheader">
                                [{oxmultilang ident="D3_GENERAL_MODPROFILE_FOLDER"}]
                            </a>
                        </td>
                        <td class="listheader">
                            <a href="Javascript:top.oxid.admin.setSorting( document.search, '[{$coreTableName}]', 'd3_cronjobid', '[{$nextSortDir|default:"asc"}]');document.search.submit();" class="listheader">
                                [{oxmultilang ident="D3_GENERAL_USERMANAGER_CRONID"}]
                            </a>
                        </td>
                    [{/block}]
                </tr>

                [{assign var="blWhite" value=""}]
                [{assign var="_cnt" value=0}]
                [{foreach from=$mylist item="listitem"}]
                    [{assign var="_cnt" value=$_cnt+1}]
                    [{if $listitem->getLicenseActive()}]
                        [{assign var="formatclass" value=""}]
                    [{else}]
                        [{assign var="formatclass" value="d3notallowed"}]
                    [{/if}]
                    <tr id="row.[{$_cnt}]">
                        [{block name="admin_d3usermanager_list_item"}]
                            [{if $listitem->blacklist == 1}]
                                [{assign var="listclass" value="listitem3"}]
                            [{else}]
                                [{assign var="listclass" value="listitem"|cat:$blWhite}]
                            [{/if}]
                            [{if $listitem->getId() == $oxid}]
                                [{assign var="listclass" value="listitem4"}]
                            [{/if}]
                            <td style="vertical-align: top;" class="[{$listclass}] [{$formatclass}] [{if $listitem->getFieldData('oxactive') == 1}] active[{/if}]" height="15">
                                <div class="listitemfloating">
                                    &nbsp;
                                </div>
                            </td>
                            <td style="vertical-align: top;" class="[{$listclass}] [{$formatclass}] [{if $listitem->getFieldData('D3_UM_EXECMANUALLY')}] active[{/if}]" height="15">
                                <div class="listitemfloating">
                                    &nbsp;
                                </div>
                            </td>
                            <td style="vertical-align: top;" class="[{$listclass}] [{$formatclass}] " height="15">
                                <div class="listitemfloating">&nbsp;
                                    <a href="Javascript:EditThis('[{$listitem->getId()}]');" class="[{$listclass}]">
                                        [{$listitem->getFieldData('oxsort')}]
                                    </a>
                                </div>
                            </td>
                            <td style="vertical-align: top;" class="[{$listclass}] [{$formatclass}] " height="15">
                                <div class="listitemfloating">&nbsp;
                                    <a href="Javascript:EditThis('[{$listitem->getId()}]');" class="[{$listclass}]">
                                        [{$listitem->getFieldData('oxtitle')|truncate:200:"..":false}]
                                    </a>
                                </div>
                            </td>
                            <td style="vertical-align: top;" class="[{$listclass}] [{$formatclass}] " height="15">
                                <div class="listitemfloating">&nbsp;
                                    <a href="Javascript:EditThis('[{$listitem->getId()}]');" class="[{$listclass}]">
                                        [{if $listitem->getFieldData('oxfolder')}][{oxmultilang ident=$listitem->getFieldData('oxfolder') noerror=true}][{/if}]
                                    </a>
                                </div>
                            </td>
                            <td class="[{$listclass}] [{$formatclass}] ">
                                <div class="listitemfloating" style="float: left;">&nbsp;
                                    <a href="Javascript:EditThis('[{$listitem->getId()}]');" class="[{$listclass}]">
                                        [{$listitem->getFieldData('d3_cronjobid')}]
                                    </a>
                                </div>
                                [{if !$readonly}]
                                    <a href="Javascript:DeleteThis('[{$listitem->getId()}]');" class="delete" id="del.[{$_cnt}]" title="" [{include file="help.tpl" helpid=item_delete}]></a>
                                [{/if}]
                            </td>
                        [{/block}]
                    </tr>
                    [{if $blWhite == "2"}]
                        [{assign var="blWhite" value=""}]
                    [{else}]
                        [{assign var="blWhite" value="2"}]
                    [{/if}]
                [{/foreach}]
                [{include file="pagenavisnippet.tpl" colspan="6"}]
            </table>
        </form>
    </div>

[{else}]
    <form name="search" id="search" action="[{$oViewConf->getSelfLink()}]" method="post">
        [{include file="_formparams.tpl" cl=$oViewConf->getActiveClassName() lstrt=$lstrt actedit=$actedit oxid=$oxid fnc="" language=$actlang editlanguage=$actlang}]

        [{if $blShowLangSwitch}]
            <label for="changelang">[{oxmultilang ident="D3_CFG_MOD_LIST_SETTLANG"}]</label>
            <select id="changelang" name="changelang" class="editinput" onChange="top.oxid.admin.changeLanguage();">
                [{foreach from=$languages item="lang"}]
                    <option value="[{$lang->id}]" [{if $lang->selected}]SELECTED[{/if}]>[{$lang->name}]</option>
                [{/foreach}]
            </select>
        [{/if}]
    </form>
[{/if}]

[{include file="pagetabsnippet.tpl"}]

<script type="text/javascript">

    [{assign var="rawMenuItemTitle" value=$oView->d3GetMenuItemTitle()}]
    [{assign var="rawMenuSubItemTitle" value=$oView->d3GetMenuSubItemTitle()}]
    if (parent.parent) {
        parent.parent.sShopTitle   = "[{$actshopobj->oxshops__oxname->getRawValue()|oxaddslashes}]";
        parent.parent.sMenuItem    = "[{$rawMenuItemTitle|oxmultilangassign|strip_tags}]";
        parent.parent.sMenuSubItem = "[{$rawMenuSubItemTitle|oxmultilangassign|strip_tags}]";
        parent.parent.sWorkArea    = "[{if isset($_act)}][{$_act}][{/if}]";
        parent.parent.setTitle();
    }
</script>
</body>
</html>
