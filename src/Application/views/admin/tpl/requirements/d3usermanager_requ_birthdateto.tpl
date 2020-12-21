[{block name="usermanager_admin_requ_birthdateto"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_birthdateto_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sBirthdateUserToValue]" value='[{$edit->getValue('sBirthdateUserToValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE"}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_birthdateto_viewer"}]
                    [{$edit->getValue('sBirthdateUserToValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_BIRTHDATEUSERTO_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]