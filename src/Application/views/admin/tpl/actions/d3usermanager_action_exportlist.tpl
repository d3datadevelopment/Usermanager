[{block name="usermanager_admin_action_exportlist"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd style="margin-left: 30%;">
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_exportlist_editor"}]
                    <label for="fieldList">[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTCONTAINS"}]</label>
                    <input type="hidden" name="value[aExportFieldList]" value="">
                    <SELECT id="fieldlist" class="editinput" name="value[aExportFieldList][]" id="aExportFieldList" size="7" multiple [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getItemFieldNames() item="sFieldName"}]
                            <option value="[{$sFieldName}]" [{if is_array($edit->getValue('aExportFieldList')) && in_array($sFieldName, $edit->getValue('aExportFieldList'))}]selected[{/if}]>[{$oView->getFieldNameDescription($sFieldName)}]</option>
                        [{/foreach}]
                    </SELECT><br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
                    [{if !$blActionRestriction}]
                        <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aExportFieldList')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aExportFieldList')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$readonly}]>
                    [{/if}]

                    <br><br>
                    <label for="ExportTpl">[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTTEMPLATE"}]</label>
                    <input id="ExportTpl" type="text" name="value[sExportTemplatename]" size="50" maxlength="250" value="[{$edit->getValue('sExportTemplatename')}]" [{$blActionRestriction}] [{$readonly}]>
                    [{oxinputhelp ident="D3_USERMANAGER_ACTION_EXPORTTEMPLATE_DESC"}]<br>

                    <br><br>
                    <input style="margin-left: 20px;" id="FromThemeAdmin" type="radio" name="value[sExportListFromTheme]" value="admin" [{if $edit->getValue('sExportListFromTheme') == 'admin'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]> <label for="FromThemeAdmin">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_ADMIN"}] ([{$oView->getManagerTemplateDirs(1)}])</label><br>
                    <input style="margin-left: 20px;" id="FromThemeFrontend" type="radio" name="value[sExportListFromTheme]" value="frontend" [{if $edit->getValue('sExportListFromTheme') == 'frontend'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]> <label for="FromThemeFrontend">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_FRONTEND"}] ([{$oView->getManagerTemplateDirs(0)}])</label><br>
                    <input style="margin-left: 20px;" id="FromModule" type="radio" name="value[sExportListFromTheme]" value="module" [{if $edit->getValue('sExportListFromTheme') == 'module'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
                    <label for="FromModule">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_MODULE"}]</label>
                    <label for="FromModuleId" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORT"}]</label>
                    <select id="FromModuleId" class="editinput" name="value[sExportListFromModulePath]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getModulePathList() key="sId" item="sModulePath"}]
                            <option value="[{$sId}]" [{if $edit->getValue('sExportListFromModulePath') == $sId}]selected[{/if}]>[{$sModulePath}]</option>
                        [{/foreach}]
                    </select> [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_DESC"}]<br>

                    <br><br>
                    <label for="ExportExtension">[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTEXTENSION"}]</label>
                    <input id="ExportExtension" type="text" name="value[sExportExtension]" size="50" maxlength="250" value="[{$edit->getValue('sExportExtension')}]" [{$blActionRestriction}] [{$readonly}]> [{oxinputhelp ident="D3_USERMANAGER_ACTION_EXPORTEXTENSION_DESC"}]<br>

                    <br><br>[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTLOCATION"}]<br><b>[{$oView->getExportExamplePath()}]</b>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_exportlist_viewer"}]
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
                    <br><br>
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTTEMPLATE"}] [{$edit->getValue('sExportTemplatename')}]<br>
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_ADMIN"}] ([{$oView->getManagerTemplateDirs(1)}]
                    <br><br>
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTEXTENSION"}] [{$edit->getValue('sExportExtension')}] [{oxinputhelp ident="D3_USERMANAGER_ACTION_EXPORTEXTENSION_DESC"}]
                    <br>[{oxmultilang ident="D3_USERMANAGER_ACTION_EXPORTLOCATION"}]<br><b>[{$oView->getExportExamplePath()}]</b>
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_EXPORT_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]