<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckDelZipRange_status]" value="0">
        <input id="RequDelZipRange" class="edittext ext_edittext" type="checkbox" name="value[blCheckDelZipRange_status]" value='1' [{if $edit->getValue('blCheckDelZipRange_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequDelZipRange">[{oxmultilang ident="D3_USERMANAGER_REQU_DELZIPRANGE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGEFROM"}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sDelZipRangeFromValue]" value='[{$edit->getValue('sDelZipRangeFromValue')}]' [{$blActionRestriction}] [{$readonly}]>
            [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGETO"}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sDelZipRangeToValue]" value='[{$edit->getValue('sDelZipRangeToValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGEFROM"}]
            [{$edit->getValue('sDelZipRangeFromValue')}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_INVZIPRANGETO"}]
            [{$edit->getValue('sDelZipRangeToValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_DELZIP_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>
