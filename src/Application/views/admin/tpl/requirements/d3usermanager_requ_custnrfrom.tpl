[{block name="usermanager_admin_requ_custnrfrom"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_custnrfrom_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="8" maxlength="10" name="value[sFromUserNrValue]" value='[{$edit->getValue('sFromUserNrValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_custnrfrom_viewer"}]
                    [{$edit->getValue('sFromUserNrValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_FROMUSERNR_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]