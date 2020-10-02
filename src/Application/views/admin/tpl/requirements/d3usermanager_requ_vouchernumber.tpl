<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blVoucherNumber_status]" value="0">
        <input id="RequVoucherNumber" class="edittext ext_edittext" type="checkbox" name="value[blVoucherNumber_status]" value='1' [{if $edit->getValue('blVoucherNumber_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequVoucherNumber">[{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHERNUMBER"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sVoucherNumberValue]" value='[{$edit->getValue('sVoucherNumberValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{$edit->getValue('sVoucherNumberValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_VOUCHERNUMBER_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>