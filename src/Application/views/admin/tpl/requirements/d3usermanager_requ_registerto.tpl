[{block name="usermanager_admin_requ_registerto"}]
    [{oxscript include="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_registerto_editor"}]
                    <input id="sRegisterUserToValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sRegisterUserToValue]" value='[{$oRequ->getFormattedValue('sRegisterUserToValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE" args=$oRequ->getFormattedDateFormatDescription()}]

                    [{capture name="d3JsFnc"}][{strip}]
                        new Cleave('#sRegisterUserToValue', {
                            date: true,
                            delimiter: '[{$oRequ->getDateDelimiter()}]',
                            datePattern: [[{$oRequ->getFormattedDateGroups()}]]
                        });
                    [{/strip}][{/capture}]
                    [{oxscript add=$smarty.capture.d3JsFnc}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_registerto_viewer"}]
                    [{$edit->getValue('sRegisterUserToValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_REGISTERUSERTO_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]
