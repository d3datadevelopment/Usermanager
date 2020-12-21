[{block name="usermanager_admin_requ_registerfrom"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_registerfrom_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sRegisterUserFromValue]" value='[{$edit->getValue('sRegisterUserFromValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE"}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_registerfrom_viewer"}]
                    [{$edit->getValue('sRegisterUserFromValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_REGISTERUSERFROM_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]