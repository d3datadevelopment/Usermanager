<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckBirthdateUserTo_status]" value="0">
        <input id="RequBirtthdateUserTo" class="edittext ext_edittext" type="checkbox" name="value[blCheckBirthdateUserTo_status]" value='1' [{if $edit->getValue('blCheckBirthdateUserTo_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequBirthdateUserTo">[{oxmultilang ident="D3_USERMANAGER_REQU_BIRTHDATEUSERTO"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sBirthdateUserToValue]" value='[{$edit->getValue('sBirthdateUserToValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE"}]
        [{else}]
            [{$edit->getValue('sBirthdateUserToValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_BIRTHDATEUSERTO_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>