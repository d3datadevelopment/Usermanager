<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckInvCountry_status]" value="0">
        <input id="RequInvCountry" class="edittext ext_edittext" type="checkbox" name="value[blCheckInvCountry_status]" value='1' [{if $edit->getValue('blCheckInvCountry_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequInvCountry">[{oxmultilang ident="D3_USERMANAGER_REQU_INVCOUNTRY"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input type="hidden" name="value[aInvCountryId]" value="">
            <SELECT class="editinput" name="value[aInvCountryId][]" id="aInvCountryId" size="5" multiple [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getCountryList() item="oCountry"}]
                    <option value="[{$oCountry->getId()}]" [{if is_array($edit->getValue('aInvCountryId')) && in_array($oCountry->getId(), $edit->getValue('aInvCountryId'))}]selected[{/if}]>[{$oCountry->getFieldData('oxtitle')}]</option>
                [{/foreach}]
            </SELECT><br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
            <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aInvCountryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aInvCountryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            <ul>
                [{foreach from=$oView->getCountryList() item="oCountry"}]
                    [{if is_array($edit->getValue('aInvCountryId')) && in_array($oCountry->getId(), $edit->getValue('aInvCountryId'))}]
                        <li>
                            [{$oCountry->getFieldData('oxtitle')}]
                        </li>
                    [{/if}]
                [{/foreach}]
            </ul>
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_INVCOUNTRY_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>