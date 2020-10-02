<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckDelGender_status]" value="0">
        <input id="RequDelGender" class="edittext ext_edittext" type="checkbox" name="value[blCheckDelGender_status]" value='1' [{if $edit->getValue('blCheckDelGender_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequDelGender">[{oxmultilang ident="D3_USERMANAGER_REQU_DEL_GENDER"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequDelGenderType" class="editinput" name="value[sCheckDelGenderType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="mr" [{if $edit->getValue('sCheckDelGenderType') == 'mr'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MR"}]</option>
                <option value="mrs" [{if $edit->getValue('sCheckDelGenderType') == 'mrs'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MRS"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckDelGenderType') == 'mr'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MR"}]
            [{elseif $edit->getValue('sCheckDelGenderType') == 'mrs'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MRS"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_DELADR_GENERALDESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>
