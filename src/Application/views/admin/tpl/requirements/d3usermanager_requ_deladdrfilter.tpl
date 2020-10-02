<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckDeliveryAddress_status]" value="0">
        <input id="RequDeliveryAddress" class="edittext ext_edittext" type="checkbox" name="value[blCheckDeliveryAddress_status]" value='1' [{if $edit->getValue('blCheckDeliveryAddress_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequDeliveryAddress">[{oxmultilang ident="D3_USERMANAGER_REQU_DELIVERYADDRESS"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequDeliveryAddressType" class="editinput" name="value[sCheckDeliveryAddressType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="set" [{if $edit->getValue('sCheckDeliveryAddressType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                <option value="notset" [{if $edit->getValue('sCheckDeliveryAddressType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckDeliveryAddressType') == 'set'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
            [{elseif $edit->getValue('sCheckDeliveryAddressType') == 'notset'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_DELIVERYADDRESS_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>