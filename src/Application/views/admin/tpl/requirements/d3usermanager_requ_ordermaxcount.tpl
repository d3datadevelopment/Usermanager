[{block name="usermanager_admin_requ_ordermaxcount"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordermaxcount_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sCheckMaxOrderCountValue]" value='[{$edit->getValue('sCheckMaxOrderCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_ordermaxcount_viewer"}]
                    [{$edit->getValue('sCheckMaxOrderCountValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_MAXORDERCOUNT_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]