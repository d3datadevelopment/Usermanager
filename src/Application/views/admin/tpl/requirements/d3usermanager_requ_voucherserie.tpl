[{block name="usermanager_admin_requ_voucherserie"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_voucherserie_editor"}]
                    <input class="edittext ext_edittext" type="text" size="36" maxlength="36" name="value[sVoucherSerieValue]" value='[{$edit->getValue('sVoucherSerieValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_voucherserie_viewer"}]
                    [{$edit->getValue('sVoucherSerieValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_VOUCHERSERIE_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]