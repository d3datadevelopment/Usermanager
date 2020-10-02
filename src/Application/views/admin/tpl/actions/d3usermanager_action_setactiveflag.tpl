<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blActionCustActivate_status]" value="0">
        <input id="ActionCustActivate" class="edittext ext_edittext" type="checkbox" name="value[blActionCustActivate_status]" value='1' [{if $edit->getValue('blActionCustActivate_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="ActionCustActivate">[{oxmultilang ident="D3_USERMANAGER_ACTION_CUSTACTIVATE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="ActionCustActivateType" class="editinput" name="value[sActionCustActivateType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="set" [{if $edit->getValue('sActionCustActivateType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_ACTION_GENERAL_SET"}]</option>
                <option value="notset" [{if $edit->getValue('sActionCustActivateType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_ACTION_GENERAL_NOTSET"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sActionCustActivateType') == 'set'}]
                [{oxmultilang ident="D3_USERMANAGER_ACTION_GENERAL_SET"}]
            [{elseif $edit->getValue('sActionCustActivateType') == 'notset'}]
                [{oxmultilang ident="D3_USERMANAGER_ACTION_GENERAL_NOTSET"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTACTIVATE_DESC"}]
    </dd>
    <div class="spacer"></div>
</dl>