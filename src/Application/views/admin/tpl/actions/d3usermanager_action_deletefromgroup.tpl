<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blActionCustFromGroup_status]" value="0">
        <input id="ActionCustRemoveFromGroup" class="edittext ext_edittext" type="checkbox" name="value[blActionCustFromGroup_status]" value='1' [{if $edit->getValue('blActionCustFromGroup_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="ActionCustRemoveFromGroup">[{oxmultilang ident="D3_USERMANAGER_ACTION_CUSTOMERREMOVEFROMGROUP"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input type="hidden" name="value[aCustRemoveGroup]" value="">
            <SELECT class="editinput" name="value[aCustRemoveGroup][]" id="aCustRemoveGroup" size="7" multiple [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getGroupsList() item="oGroup"}]
                    <option value="[{$oGroup->getId()}]" [{if is_array($edit->getValue('aCustRemoveGroup')) && in_array($oGroup->getId(), $edit->getValue('aCustRemoveGroup'))}]selected[{/if}]>[{$oGroup->getFieldData('oxtitle')}]</option>
                [{/foreach}]
            </SELECT><br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
            <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aCustRemoveGroup')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aCustRemoveGroup')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            <ul>
                [{foreach from=$oView->getGroupsList() item="oGroup"}]
                    [{if is_array($edit->getValue('aCustRemoveGroup')) && in_array($oGroup->getId(), $edit->getValue('aCustRemoveGroup'))}]
                        <li>
                            [{$oGroup->getFieldData('oxtitle')}]
                        </li>
                    [{/if}]
                [{/foreach}]
            </ul>
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTOMERREMOVEFROMGROUP_DESC"}]
    </dd>
    <div class="spacer"></div>
</dl>