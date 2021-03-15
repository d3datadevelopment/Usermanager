[{block name="usermanager_admin_requ_invzipfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_invzipfilter_editor"}]
                    <label for="sInvZipRangeFromValue">[{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGEFROM"}]</label>
                    <input id="sInvZipRangeFromValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sInvZipRangeFromValue]" value='[{$edit->getValue('sInvZipRangeFromValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <label for="sInvZipRangeToValue">[{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGETO"}]</label>
                    <input id="sInvZipRangeToValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sInvZipRangeToValue]" value='[{$edit->getValue('sInvZipRangeToValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_invzipfilter_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGEFROM"}]
                    [{$edit->getValue('sInvZipRangeFromValue')}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGETO"}]
                    [{$edit->getValue('sInvZipRangeToValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_INVZIP_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]
