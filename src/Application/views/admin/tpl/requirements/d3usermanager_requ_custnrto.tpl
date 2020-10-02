<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckToUserNr_status]" value="0">
        <input id="RequToUserNr" class="edittext ext_edittext" type="checkbox" name="value[blCheckToUserNr_status]" value='1' [{if $edit->getValue('blCheckToUserNr_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequToUserNr">[{oxmultilang ident="D3_USERMANAGER_REQU_TOUSERNR"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="8" maxlength="10" name="value[sToUserNrValue]" value='[{$edit->getValue('sToUserNrValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{$edit->getValue('sToUserNrValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_TOUSERNR_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>