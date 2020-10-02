<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckInvCompany_status]" value="0">
        <input id="RequInvCompany" class="edittext ext_edittext" type="checkbox" name="value[blCheckInvCompany_status]" value='1' [{if $edit->getValue('blCheckInvCompany_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequInvCompany">[{oxmultilang ident="D3_USERMANAGER_REQU_INVCOMPANY"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequInvCompanyType" class="editinput" name="value[sCheckInvCompanyType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="set" [{if $edit->getValue('sCheckInvCompanyType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                <option value="notset" [{if $edit->getValue('sCheckInvCompanyType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckInvCompanyType') == 'set'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
            [{elseif $edit->getValue('sCheckInvCompanyType') == 'notset'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_INVCOMPANY_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>