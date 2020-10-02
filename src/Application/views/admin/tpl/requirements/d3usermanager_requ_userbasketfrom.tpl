<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckUserBasketFrom_status]" value="0">
        <input id="RequUserBasketFrom" class="edittext ext_edittext" type="checkbox" name="value[blCheckUserBasketFrom_status]" value='1' [{if $edit->getValue('blCheckUserBasketFrom_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequUserBasketFrom">[{oxmultilang ident="D3_USERMANAGER_REQU_USERBASKETFROM"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sUserBasketFromValue]" value='[{$edit->getValue('sUserBasketFromValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_USERBASKET_DATE"}]
        [{else}]
            [{$edit->getValue('sUserBasketFromValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_USERBASKETTO_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>