<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckHasBirthday_status]" value="0">
        <input id="RequHasBirthday" class="edittext ext_edittext" type="checkbox" name="value[blCheckHasBirthday_status]" value='1' [{if $edit->getValue('blCheckHasBirthday_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequHasBirthday">[{oxmultilang ident="D3_USERMANAGER_REQU_HASBIRTHDAY"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
        [{else}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_HASBIRTHDAY_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>