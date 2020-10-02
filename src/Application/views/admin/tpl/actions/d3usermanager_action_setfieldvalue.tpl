<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blActionUserAddFieldValue_status]" value="0">
        <input id="ActionUserSetField" class="edittext ext_edittext" type="checkbox" name="value[blActionUserAddFieldValue_status]" value='1' [{if $edit->getValue('blActionUserAddFieldValue_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="ActionUserSetField">[{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <label for="ActionUserSetFieldField">[{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_FIELD"}]</label> <input id="ActionUserSetFieldField" type="text" name="value[sActionAddField_field]" size="30" maxlength="50" value="[{$edit->getValue('sActionAddField_field')}]" [{$blActionRestriction}] [{$readonly}]>
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_FIELD_DESC"}]<br>
            <label for="ActionUserSetFieldValue">[{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_VALUE"}]</label> <input id="ActionUserSetFieldValue" type="text" name="value[sActionAddField_value]" size="30" maxlength="50" value="[{$edit->getValue('sActionAddField_value')}]" [{$blActionRestriction}] [{$readonly}]>
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_DESC"}]<br>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_FIELD"}] [{$edit->getValue('sActionAddField_field')}]<br>
            [{oxmultilang ident="D3_USERMANAGER_ACTION_USERADDFIELDVALUE_VALUE"}] [{$edit->getValue('sActionAddField_value')}]
        [{/if}]
    </dd>
    <div class="spacer"></div>
</dl>