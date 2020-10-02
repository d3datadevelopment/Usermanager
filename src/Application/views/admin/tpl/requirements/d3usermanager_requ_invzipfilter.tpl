<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckInvZipRange_status]" value="0">
        <input id="RequInvZipRange" class="edittext ext_edittext" type="checkbox" name="value[blCheckInvZipRange_status]" value='1' [{if $edit->getValue('blCheckInvZipRange_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequInvZipRange">[{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGEFROM"}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sInvZipRangeFromValue]" value='[{$edit->getValue('sInvZipRangeFromValue')}]' [{$blActionRestriction}] [{$readonly}]>
            [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGETO"}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sInvZipRangeToValue]" value='[{$edit->getValue('sInvZipRangeToValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGEFROM"}]
            [{$edit->getValue('sInvZipRangeFromValue')}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGETO"}]
            [{$edit->getValue('sInvZipRangeToValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_INVZIP_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>