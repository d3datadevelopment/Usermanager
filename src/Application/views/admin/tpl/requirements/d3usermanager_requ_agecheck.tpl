<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckAgeCheck_status]" value="0">
        <input id="RequAgeCheck" class="edittext ext_edittext" type="checkbox" name="value[blCheckAgeCheck_status]" value='1' [{if $edit->getValue('blCheckAgeCheck_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequAgeCheck">[{oxmultilang ident="D3_USERMANAGER_REQU_AGECHECK"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequAgeCheckType" class="editinput" name="value[sAgeCheckType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="less" [{if $edit->getValue('sAgeCheckType') == 'less'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}]</option>
                <option value="higher" [{if $edit->getValue('sAgeCheckType') == 'higher'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}]</option>
            </SELECT>
            <input id="RequAgeCheckValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sAgeCheckValue]" value='[{$edit->getValue('sAgeCheckValue')}]' [{$blActionRestriction}] [{$readonly}]>
            [{oxmultilang ident="D3_USERMANAGER_REQU_AGECHECK_YEARS"}]
        [{else}]
            [{if $edit->getValue('sAgeCheckType') == 'less'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}][{/if}]
            [{if $edit->getValue('sAgeCheckType') == 'higher'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}][{/if}]
            [{$edit->getValue('sAgeCheckValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_AGECHECK_YEARS"}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_AGECHECK_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>