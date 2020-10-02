<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckVoucher_status]" value="0">
        <input id="RequVoucher" class="edittext ext_edittext" type="checkbox" name="value[blCheckVoucher_status]" value='1' [{if $edit->getValue('blCheckVoucher_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequVoucher">[{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequVoucherType" class="editinput" name="value[sCheckVoucherType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="exist" [{if $edit->getValue('sCheckVoucherType') == 'exist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER_USED"}]</option>
                <option value="notexist" [{if $edit->getValue('sCheckVoucherType') == 'notexist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER_NOTUSED"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckVoucherType') == 'exist'}][{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER_USED"}][{/if}]
            [{if $edit->getValue('sCheckVoucherType') == 'notexist'}][{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER_NOTUSED"}][{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_VOUCHER_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>