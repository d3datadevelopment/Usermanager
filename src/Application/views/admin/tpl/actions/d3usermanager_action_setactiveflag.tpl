[{block name="usermanager_admin_action_setactiveflag"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_setactiveflag_editor"}]
                    <label for="ActionCustActivateType" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_ACTION_SETACTIVEFLAG"}]</label>
                    <SELECT id="ActionCustActivateType" class="editinput" name="value[sActionCustActivateType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oAction->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sActionCustActivateType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_addtogroup_viewer"}]
                    [{foreach from=$oAction->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sActionCustActivateType') == $type}]
                            [{oxmultilang ident=$translation}]
                        [{/if}]
                    [{/foreach}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTACTIVATE_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]