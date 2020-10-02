<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckBoni_status]" value="0">
        <input id="RequBoni" class="edittext ext_edittext" type="checkbox" name="value[blCheckBoni_status]" value='1' [{if $edit->getValue('blCheckBoni_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequBoni">[{oxmultilang ident="D3_USERMANAGER_REQU_BONI"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequBoniType" class="editinput" name="value[sBoniType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="less" [{if $edit->getValue('sBoniType') == 'less'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}]</option>
                <option value="higher" [{if $edit->getValue('sBoniType') == 'higher'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}]</option>
            </SELECT>
            <input id="RequBoniValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sBoniValue]" value='[{$edit->getValue('sBoniValue')}]' [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{if $edit->getValue('sBoniType') == 'less'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}][{/if}]
            [{if $edit->getValue('sBoniType') == 'higher'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}][{/if}]
            [{$edit->getValue('sBoniValue')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_BONI_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>