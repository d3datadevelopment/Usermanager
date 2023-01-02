[{block name="usermanager_admin_requ_delzipfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_delzipfilter_editor"}]
                    <label for="sDelZipRangeFromValue">[{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGEFROM"}]</label>
                    <input id="sDelZipRangeFromValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sDelZipRangeFromValue]" value='[{$edit->getValue('sDelZipRangeFromValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <label for="sDelZipRangeToValue">[{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGETO"}]</label>
                    <input id="sDelZipRangeToValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sDelZipRangeToValue]" value='[{$edit->getValue('sDelZipRangeToValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_delzipfilter_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGEFROM"}]
                    [{$edit->getValue('sDelZipRangeFromValue')}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGETO"}]
                    [{$edit->getValue('sDelZipRangeToValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_DELZIP_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]
