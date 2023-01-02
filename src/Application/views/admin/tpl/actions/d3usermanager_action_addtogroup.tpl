[{block name="usermanager_admin_action_addtogroup"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_addtogroup_editor"}]
                    <input type="hidden" name="value[aCustAddGroup]" value="">
                    <label for="sCustAddGroup" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_ACTION_CUSTOMERADD2GROUP"}]</label>
                    <SELECT class="editinput" name="value[aCustAddGroup][]" id="sCustAddGroup" size="7" multiple [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getGroupsList() item="oGroup"}]
                            <option value="[{$oGroup->getId()}]" [{if is_array($edit->getValue('aCustAddGroup')) && in_array($oGroup->getId(), $edit->getValue('aCustAddGroup'))}]selected[{/if}]>[{$oGroup->getFieldData('oxtitle')}]</option>
                        [{/foreach}]
                    </SELECT><br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
                    [{if !$blActionRestriction}]
                        <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aCustAddGroup')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aCustAddGroup')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$readonly}]>
                    [{/if}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_addtogroup_viewer"}]
                    <ul>
                        [{foreach from=$oView->getGroupsList() item="oGroup"}]
                            [{if is_array($edit->getValue('aCustAddGroup')) && in_array($oGroup->getId(), $edit->getValue('aCustAddGroup'))}]
                                <li>
                                    [{$oGroup->getFieldData('oxtitle')}]
                                </li>
                            [{/if}]
                        [{/foreach}]
                    </ul>
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTOMERADD2GROUP_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]