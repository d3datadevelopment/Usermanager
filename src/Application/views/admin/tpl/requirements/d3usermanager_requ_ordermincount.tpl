[{block name="usermanager_admin_requ_ordermincount"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordermincount_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sCheckMinOrderCountValue]" value='[{$edit->getValue('sCheckMinOrderCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_ordermincount_viewer"}]
                    [{$edit->getValue('sCheckMinOrderCountValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_MINORDERCOUNT_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]