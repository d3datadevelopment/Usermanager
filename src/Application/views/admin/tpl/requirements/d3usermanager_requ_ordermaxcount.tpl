<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckMaxOrderCount_status]" value="0">
        <input id="RequMaxOrderCount" class="edittext ext_edittext" type="checkbox" name="value[blCheckMaxOrderCount_status]" value='1' [{if $edit->getValue('blCheckMaxOrderCount_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequMaxOrderCount">[{oxmultilang ident="D3_USERMANAGER_REQU_MAXORDERCOUNT"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sCheckMaxOrderCountValue]" value='[{$edit->getValue('sCheckMaxOrderCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{$edit->getValue('sCheckMaxOrderCountValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_MAXORDERCOUNT_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>