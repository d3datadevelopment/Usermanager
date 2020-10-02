<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckActiveUser_status]" value="0">
        <input id="RequActiveUser" class="edittext ext_edittext" type="checkbox" name="value[blCheckActiveUser_status]" value='1' [{if $edit->getValue('blCheckActiveUser_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequActiveUser">[{oxmultilang ident="D3_USERMANAGER_REQU_ACTIVEUSER"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequActiveUserType" class="editinput" name="value[sCheckActiveUserType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="set" [{if $edit->getValue('sCheckActiveUserType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                <option value="notset" [{if $edit->getValue('sCheckActiveUserType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckActiveUserType') == 'set'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}][{/if}]
            [{if $edit->getValue('sCheckActiveUserType') == 'notset'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}][{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_ACTIVEUSER_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>