<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckPasswordUser_status]" value="0">
        <input id="RequPasswordUser" class="edittext ext_edittext" type="checkbox" name="value[blCheckPasswordUser_status]" value='1' [{if $edit->getValue('blCheckPasswordUser_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequPasswordUser">[{oxmultilang ident="D3_USERMANAGER_REQU_PASSWORDUSER"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequPasswordUserType" class="editinput" name="value[sCheckPasswordUserType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="set" [{if $edit->getValue('sCheckPasswordUserType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                <option value="notset" [{if $edit->getValue('sCheckPasswordUserType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckPasswordUserType') == 'set'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
            [{elseif $edit->getValue('sCheckPasswordUserType') == 'notset'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_PASSWORDUSER_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>