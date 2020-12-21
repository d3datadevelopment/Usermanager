[{block name="usermanager_admin_requ_hasvoucher"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_hasvoucher_editor"}]
                    <SELECT id="RequVoucherType" class="editinput" name="value[sCheckVoucherType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="exist" [{if $edit->getValue('sCheckVoucherType') == 'exist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER_USED"}]</option>
                        <option value="notexist" [{if $edit->getValue('sCheckVoucherType') == 'notexist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER_NOTUSED"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_hasvoucher_viewer"}]
                    [{if $edit->getValue('sCheckVoucherType') == 'exist'}][{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER_USED"}][{/if}]
                    [{if $edit->getValue('sCheckVoucherType') == 'notexist'}][{oxmultilang ident="D3_USERMANAGER_REQU_VOUCHER_NOTUSED"}][{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_VOUCHER_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]