[{block name="usermanager_admin_action_setfieldvalue"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_setfieldvalue_editor"}]
                    <label for="ActionUserSetFieldField">[{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_FIELD"}]</label>
                    <input id="ActionUserSetFieldField" type="text" name="value[sActionAddField_field]" size="30" maxlength="50" value="[{$edit->getValue('sActionAddField_field')}]" [{$blActionRestriction}] [{$readonly}]>
                    [{oxinputhelp ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_FIELD_DESC"}]<br>
                    <label for="ActionUserSetFieldValue">[{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_VALUE"}]</label>
                    <input id="ActionUserSetFieldValue" type="text" name="value[sActionAddField_value]" size="30" maxlength="50" value="[{$edit->getValue('sActionAddField_value')}]" [{$blActionRestriction}] [{$readonly}]>
                    [{oxinputhelp ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_DESC"}]<br>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_setfieldvalue_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_FIELD"}] [{$edit->getValue('sActionAddField_field')}]<br>
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_VALUE"}] [{$edit->getValue('sActionAddField_value')}]<br>
                [{/block}]
            [{/if}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]