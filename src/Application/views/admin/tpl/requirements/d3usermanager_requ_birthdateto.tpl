[{block name="usermanager_admin_requ_birthdateto"}]
    [{oxscript include="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_birthdateto_editor"}]
                    <input id="sBirthdateUserToValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sBirthdateUserToValue]" value='[{$oRequ->getFormattedValue('sBirthdateUserToValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE" args=$oRequ->getFormattedDateFormatDescription()}]

                    [{capture name="d3JsFnc"}][{strip}]
                        new Cleave('#sBirthdateUserToValue', {
                            date: true,
                            delimiter: '[{$oRequ->getDateDelimiter()}]',
                            datePattern: [[{$oRequ->getFormattedDateGroups()}]]
                        });
                    [{/strip}][{/capture}]
                    [{oxscript add=$smarty.capture.d3JsFnc}]
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
