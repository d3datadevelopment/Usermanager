<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckBirthdateUserFrom_status]" value="0">
        <input id="RequBirthdateUserFrom" class="edittext ext_edittext" type="checkbox" name="value[blCheckBirthdateUserFrom_status]" value='1' [{if $edit->getValue('blCheckBirthdateUserFrom_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequBirthdateUserFrom">[{oxmultilang ident="D3_USERMANAGER_REQU_BIRTHDATEUSERFROM"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sBirthdateUserFromValue]" value='[{$edit->getValue('sBirthdateUserFromValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE"}]
        [{else}]
            [{$edit->getValue('sBirthdateUserFromValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_BIRTHDATEUSERFROM_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>