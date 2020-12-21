[{block name="usermanager_admin_action_deletefromgroup"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_deletefromgroup_editor"}]
                    <input type="hidden" name="value[aCustRemoveGroup]" value="">
                    <label for="sCustRemoveGroup" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_ACTION_CUSTOMERREMOVEFROMGROUP"}]</label>
                    <SELECT class="editinput" name="value[aCustRemoveGroup][]" id="sCustRemoveGroup" size="7" multiple [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getGroupsList() item="oGroup"}]
                            <option value="[{$oGroup->getId()}]" [{if is_array($edit->getValue('aCustRemoveGroup')) && in_array($oGroup->getId(), $edit->getValue('aCustRemoveGroup'))}]selected[{/if}]>[{$oGroup->getFieldData('oxtitle')}]</option>
                        [{/foreach}]
                    </SELECT><br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
                    [{if !$blActionRestriction}]
                        <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aCustRemoveGroup')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aCustRemoveGroup')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
                    [{/if}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_deletefromgroup_viewer"}]
                    <ul>
                        [{foreach from=$oView->getGroupsList() item="oGroup"}]
                            [{if is_array($edit->getValue('aCustRemoveGroup')) && in_array($oGroup->getId(), $edit->getValue('aCustRemoveGroup'))}]
                                <li>
                                    [{$oGroup->getFieldData('oxtitle')}]
                                </li>
                            [{/if}]
                        [{/foreach}]
                    </ul>
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTOMERREMOVEFROMGROUP_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]