[{block name="usermanager_admin_requ_custnrto"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_custnrto_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="8" maxlength="10" name="value[sToUserNrValue]" value='[{$edit->getValue('sToUserNrValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_custnrto_viewer"}]
                    [{$edit->getValue('sToUserNrValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_TOUSERNR_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]