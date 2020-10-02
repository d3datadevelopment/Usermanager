<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckFromUserNr_status]" value="0">
        <input id="RequFromUserNr" class="edittext ext_edittext" type="checkbox" name="value[blCheckFromUserNr_status]" value='1' [{if $edit->getValue('blCheckFromUserNr_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequFromUserNr">[{oxmultilang ident="D3_USERMANAGER_REQU_FROMUSERNR"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="8" maxlength="10" name="value[sFromUserNrValue]" value='[{$edit->getValue('sFromUserNrValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{$edit->getValue('sFromUserNrValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_FROMUSERNR_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>