<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckInvUstId_status]" value="0">
        <input id="RequInvUstId" class="edittext ext_edittext" type="checkbox" name="value[blCheckInvUstId_status]" value='1' [{if $edit->getValue('blCheckInvUstId_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequInvUstId">[{oxmultilang ident="D3_USERMANAGER_REQU_INVUSTID"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequInvUstIdType" class="editinput" name="value[sCheckInvUstIdType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="set" [{if $edit->getValue('sCheckInvUstIdType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                <option value="notset" [{if $edit->getValue('sCheckInvUstIdType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckInvUstIdType') == 'set'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
            [{elseif $edit->getValue('sCheckInvUstIdType') == 'notset'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_INVUSTID_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>