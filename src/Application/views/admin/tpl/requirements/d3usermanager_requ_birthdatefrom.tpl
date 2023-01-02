[{block name="usermanager_admin_requ_birthdatefrom"}]
    [{oxscript include="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_birthdatefrom_editor"}]
                    <input id="sBirthdateUserFromValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sBirthdateUserFromValue]" value='[{$oRequ->getFormattedValue('sBirthdateUserFromValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERED_DATE" args=$oRequ->getFormattedDateFormatDescription()}]

                    [{capture name="d3JsFnc"}][{strip}]
                        new Cleave('#sBirthdateUserFromValue', {
                            date: true,
                            delimiter: '[{$oRequ->getDateDelimiter()}]',
                            datePattern: [[{$oRequ->getFormattedDateGroups()}]]
                        });
                    [{/strip}][{/capture}]
                    [{oxscript add=$smarty.capture.d3JsFnc}]
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
