<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckRegisterUserTo_status]" value="0">
        <input id="RequRegisterUserTo" class="edittext ext_edittext" type="checkbox" name="value[blCheckRegisterUserTo_status]" value='1' [{if $edit->getValue('blCheckRegisterUserTo_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequRegisterUserTo">[{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERUSERTO"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sRegisterUserToValue]" value='[{$edit->getValue('sRegisterUserToValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE"}]
        [{else}]
            [{$edit->getValue('sRegisterUserToValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_REGISTERUSERTO_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>