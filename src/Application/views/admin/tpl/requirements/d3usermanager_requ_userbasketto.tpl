[{block name="usermanager_admin_requ_userbasketto"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_userbasketto_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sUserBasketToValue]" value='[{$edit->getValue('sUserBasketToValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_USERBASKET_DATE"}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_userbasketto_viewer"}]
                    [{$edit->getValue('sUserBasketToValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_USERBASKETTO_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]