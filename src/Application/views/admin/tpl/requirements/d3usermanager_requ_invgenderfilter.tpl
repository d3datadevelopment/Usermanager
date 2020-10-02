<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckInvGender_status]" value="0">
        <input id="RequInvGender" class="edittext ext_edittext" type="checkbox" name="value[blCheckInvGender_status]" value='1' [{if $edit->getValue('blCheckInvGender_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequInvGender">[{oxmultilang ident="D3_USERMANAGER_REQU_INV_GENDER"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequInvGenderType" class="editinput" name="value[sCheckInvGenderType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="mr" [{if $edit->getValue('sCheckInvGenderType') == 'mr'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MR"}]</option>
                <option value="mrs" [{if $edit->getValue('sCheckInvGenderType') == 'mrs'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MRS"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckInvGenderType') == 'mr'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MR"}]
            [{elseif $edit->getValue('sCheckInvGenderType') == 'mrs'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MRS"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_INVADR_GENERALDESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>