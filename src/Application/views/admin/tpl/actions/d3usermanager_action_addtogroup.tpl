<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blActionCust2Group_status]" value="0">
        <input id="ActionCustAdd2Group" class="edittext ext_edittext" type="checkbox" name="value[blActionCust2Group_status]" value='1' [{if $edit->getValue('blActionCust2Group_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="ActionCustAdd2Group">[{oxmultilang ident="D3_USERMANAGER_ACTION_CUSTOMERADD2GROUP"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input type="hidden" name="value[aCustAddGroup]" value="">
            <SELECT class="editinput" name="value[aCustAddGroup][]" id="aCustAddGroup" size="7" multiple [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getGroupsList() item="oGroup"}]
                    <option value="[{$oGroup->getId()}]" [{if is_array($edit->getValue('aCustAddGroup')) && in_array($oGroup->getId(), $edit->getValue('aCustAddGroup'))}]selected[{/if}]>[{$oGroup->getFieldData('oxtitle')}]</option>
                [{/foreach}]
            </SELECT><br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
            <input type="button" onclick="selectAllListElems(document.getElementById('aCustAddGroup')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aCustAddGroup')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            <ul>
                [{foreach from=$oView->getGroupsList() item="oGroup"}]
                    [{if is_array($edit->getValue('aCustAddGroup')) && in_array($oGroup->getId(), $edit->getValue('aCustAddGroup'))}]
                        <li>
                            [{$oGroup->getFieldData('oxtitle')}]
                        </li>
                    [{/if}]
                [{/foreach}]
            </ul>
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTOMERADD2GROUP_DESC"}]
    </dd>
    <div class="spacer"></div>
</dl>