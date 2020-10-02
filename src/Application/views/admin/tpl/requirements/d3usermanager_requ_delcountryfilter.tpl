<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckDelCountry_status]" value="0">
        <input id="RequDelCountry" class="edittext ext_edittext" type="checkbox" name="value[blCheckDelCountry_status]" value='1' [{if $edit->getValue('blCheckDelCountry_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequDelCountry">[{oxmultilang ident="D3_USERMANAGER_REQU_DELCOUNTRY"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input type="hidden" name="value[aDelCountryId]" value="">
            <SELECT class="editinput" name="value[aDelCountryId][]" id="aDelCountryId" size="5" multiple [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getCountryList() item="oCountry"}]
                    <option value="[{$oCountry->getId()}]" [{if is_array($edit->getValue('aDelCountryId')) && in_array($oCountry->getId(), $edit->getValue('aDelCountryId'))}]selected[{/if}]>[{$oCountry->getFieldData('oxtitle')}]</option>
                [{/foreach}]
            </SELECT><br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
            <input type="button" onclick="selectAllListElems(document.getElementById('aDelCountryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" onclick="selectNoListElems(document.getElementById('aDelCountryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            <ul>
                [{foreach from=$oView->getCountryList() item="oCountry"}]
                    [{if is_array($edit->getValue('aDelCountryId')) && in_array($oCountry->getId(), $edit->getValue('aDelCountryId'))}]
                        <li>
                            [{$oCountry->getFieldData('oxtitle')}]
                        </li>
                    [{/if}]
                [{/foreach}]
            </ul>
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_DELCOUNTRY_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>