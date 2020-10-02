<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckUserBasketTo_status]" value="0">
        <input id="RequUserBasketTo" class="edittext ext_edittext" type="checkbox" name="value[blCheckUserBasketTo_status]" value='1' [{if $edit->getValue('blCheckUserBasketTo_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequUserBasketTo">[{oxmultilang ident="D3_USERMANAGER_REQU_USERBASKETTO"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sUserBasketToValue]" value='[{$edit->getValue('sUserBasketToValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_USERBASKET_DATE"}]
        [{else}]
            [{$edit->getValue('sUserBasketToValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_USERBASKETTO_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>