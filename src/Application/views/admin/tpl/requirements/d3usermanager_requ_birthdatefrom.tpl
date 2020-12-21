[{block name="usermanager_admin_requ_birthdatefrom"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_birthdatefrom_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sBirthdateUserFromValue]" value='[{$edit->getValue('sBirthdateUserFromValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE"}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_birthdatefrom_viewer"}]
                    [{$edit->getValue('sBirthdateUserFromValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_BIRTHDATEUSERFROM_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]