<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckRegisterUserFrom_status]" value="0">
        <input id="RequRegisterUserFrom" class="edittext ext_edittext" type="checkbox" name="value[blCheckRegisterUserFrom_status]" value='1' [{if $edit->getValue('blCheckRegisterUserFrom_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequRegisterUserFrom">[{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERUSERFROM"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sRegisterUserFromValue]" value='[{$edit->getValue('sRegisterUserFromValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE"}]
        [{else}]
            [{$edit->getValue('sRegisterUserFromValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_REGISTERUSERFROM_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>