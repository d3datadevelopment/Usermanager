[{block name="usermanager_admin_requ_hasvoucher"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_hasvoucher_editor"}]
                    <SELECT id="RequVoucherType" class="editinput" name="value[sCheckVoucherType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sCheckVoucherType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_hasvoucher_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sCheckVoucherType') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_VOUCHER_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]