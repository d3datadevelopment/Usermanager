[{block name="usermanager_admin_action_setactiveflag"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_setactiveflag_editor"}]
                    <label for="ActionCustActivateType" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_ACTION_SETACTIVEFLAG"}]</label>
                    <SELECT id="ActionCustActivateType" class="editinput" name="value[sActionCustActivateType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="set" [{if $edit->getValue('sActionCustActivateType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_ACTION_GENERAL_SET"}]</option>
                        <option value="notset" [{if $edit->getValue('sActionCustActivateType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_ACTION_GENERAL_NOTSET"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_addtogroup_viewer"}]
                    [{if $edit->getValue('sActionCustActivateType') == 'set'}]
                        [{oxmultilang ident="D3_USERMANAGER_ACTION_GENERAL_SET"}]
                    [{elseif $edit->getValue('sActionCustActivateType') == 'notset'}]
                        [{oxmultilang ident="D3_USERMANAGER_ACTION_GENERAL_NOTSET"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTACTIVATE_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]