<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blVoucherSerie_status]" value="0">
        <input id="RequVoucherSerie" class="edittext ext_edittext" type="checkbox" name="value[blVoucherSerie_status]" value='1' [{if $edit->getValue('blVoucherSerie_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequVoucherSerie">[{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHERSERIE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input class="edittext ext_edittext" type="text" size="36" maxlength="36" name="value[sVoucherSerieValue]" value='[{$edit->getValue('sVoucherSerieValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{$edit->getValue('sVoucherSerieValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_VOUCHERSERIE_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>