[{block name="usermanager_admin_requ_vouchernumber"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_vouchernumber_editor"}]
                    <input class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sVoucherNumberValue]" value='[{$edit->getValue('sVoucherNumberValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_vouchernumber_viewer"}]
                    [{$edit->getValue('sVoucherNumberValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_VOUCHERNUMBER_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]