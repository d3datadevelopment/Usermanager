<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckMinOrderCount_status]" value="0">
        <input id="RequMinOrderCount" class="edittext ext_edittext" type="checkbox" name="value[blCheckMinOrderCount_status]" value='1' [{if $edit->getValue('blCheckMinOrderCount_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequMinOrderCount">[{oxmultilang ident="D3_USERMANAGER_REQU_MINORDERCOUNT"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sCheckMinOrderCountValue]" value='[{$edit->getValue('sCheckMinOrderCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{$edit->getValue('sCheckMinOrderCountValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_MINORDERCOUNT_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>