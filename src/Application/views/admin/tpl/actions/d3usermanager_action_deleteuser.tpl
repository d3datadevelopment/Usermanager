<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blActionCustDelete_status]" value="0">
        <input id="ActionCustDelete" class="edittext ext_edittext" type="checkbox" name="value[blActionCustDelete_status]" value='1' [{if $edit->getValue('blActionCustDelete_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="ActionCustDelete">[{oxmultilang ident="D3_USERMANAGER_ACTION_CUSTDELETE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
        [{else}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTDELETE_DESC"}]
    </dd>
    <div class="spacer"></div>
</dl>