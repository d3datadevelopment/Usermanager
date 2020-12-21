[{block name="usermanager_admin_requ_notingroup"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_notingroup_editor_editor"}]
                    <input type="hidden" name="value[aCustNotInGroupId]" value="">
                    <label for="aCustNotInGroupId" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_REQU_NOTINGROUP"}]</label>
                    <SELECT class="editinput" name="value[aCustNotInGroupId][]" id="aCustNotInGroupId" size="5" multiple [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getGroupsList() item="oGroup"}]
                            <option value="[{$oGroup->getId()}]" [{if is_array($edit->getValue('aCustNotInGroupId')) && in_array($oGroup->getId(), $edit->getValue('aCustNotInGroupId'))}]selected[{/if}]>[{$oGroup->getFieldData('oxtitle')}]</option>
                        [{/foreach}]
                    </SELECT><br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
                    <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aCustNotInGroupId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aCustNotInGroupId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_notingroup_viewer"}]
                    <ul>
                        [{foreach from=$oView->getGroupsList() item="oGroup"}]
                            [{if is_array($edit->getValue('aCustNotInGroupId')) && in_array($oGroup->getId(), $edit->getValue('aCustNotInGroupId'))}]
                                <li>
                                    [{$oGroup->getFieldData('oxtitle')}]
                                </li>
                            [{/if}]
                        [{/foreach}]
                    </ul>
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_REGISTERUSERTO_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]