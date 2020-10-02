<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckDelCompany_status]" value="0">
        <input id="RequDelCompany" class="edittext ext_edittext" type="checkbox" name="value[blCheckDelCompany_status]" value='1' [{if $edit->getValue('blCheckDelCompany_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequDelCompany">[{oxmultilang ident="D3_USERMANAGER_REQU_DELCOMPANY"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequDelCompanyType" class="editinput" name="value[sCheckDelCompanyType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="set" [{if $edit->getValue('sCheckDelCompanyType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                <option value="notset" [{if $edit->getValue('sCheckDelCompanyType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckDelCompanyType') == 'set'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
            [{elseif $edit->getValue('sCheckDelCompanyType') == 'notset'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_DELCOMPANY_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>