<dl class="[{$blActionRestriction}]">
    <dt style="width: 20%;">
        <input type="hidden" name="value[blActionExport_status]" value="0">
        <input id="ActionExport" class="edittext ext_edittext" type="checkbox" name="value[blActionExport_status]" value='1' [{if $edit->getValue('blActionExport_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="ActionExport">[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORT"}]</label>
    </dt>
    <dd style="margin-left: 30%;">
        [{if $oView->isEditMode()}]
            [{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTCONTAINS"}]
            <input type="hidden" name="value[aExportFieldList]" value="">
            <SELECT class="editinput" name="value[aExportFieldList][]" id="aExportFieldList" size="7" multiple [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getItemFieldNames() item="sFieldName"}]
                    <option value="[{$sFieldName}]" [{if is_array($edit->getValue('aExportFieldList')) && in_array($sFieldName, $edit->getValue('aExportFieldList'))}]selected[{/if}]>[{$oView->getFieldNameDescription($sFieldName)}]</option>
                [{/foreach}]
            </SELECT><br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
            <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aExportFieldList')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aExportFieldList')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>

            <br><br>
            <label for="ExportTpl">[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTTEMPLATE"}]</label><input id="ExportTpl" type="text" name="value[sExportTemplatename]" size="50" maxlength="250" value="[{$edit->getValue('sExportTemplatename')}]" [{$blActionRestriction}] [{$readonly}]> [{oxinputhelp ident="D3_USERMANAGER_ACTION_EXPORTTEMPLATE_DESC"}]<br>
            [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_ADMIN"}] ([{$oView->getManagerTemplateDirs(1)}])

            <br><br>
            <label for="ExportExtension">[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTEXTENSION"}]</label><input id="ExportExtension" type="text" name="value[sExportExtension]" size="50" maxlength="250" value="[{$edit->getValue('sExportExtension')}]" [{$blActionRestriction}] [{$readonly}]> [{oxinputhelp ident="D3_USERMANAGER_ACTION_EXPORTEXTENSION_DESC"}]<br>

            <br><br>[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTLOCATION"}]<br><b>[{$oView->getExportExamplePath()}]</b>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTCONTAINS"}]<br>
            <ul>
                [{foreach from=$oView->getItemFieldNames() item="sFieldName"}]
                    [{if is_array($edit->getValue('aExportFieldList')) && in_array($sFieldName, $edit->getValue('aExportFieldList'))}]
                        <li>
                            [{$oView->getFieldNameDescription($sFieldName)}]
                        </li>
                    [{/if}]
                [{/foreach}]
            </ul>

            <br>
            [{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTTEMPLATE"}] [{$edit->getValue('sExportTemplatename')}]<br>
            [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_ADMIN"}] ([{$oView->getManagerTemplateDirs(1)}])

            <br><br>
            [{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTEXTENSION"}] [{$edit->getValue('sExportExtension')}] [{oxinputhelp ident="D3_USERMANAGER_ACTION_EXPORTEXTENSION_DESC"}]

            <br><br>
            [{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTLOCATION"}]<br><b>[{$oView->getExportExamplePath()}]</b>
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_ACTION_EXPORT_DESC"}]
    </dd>
    <div class="spacer"></div>
</dl>