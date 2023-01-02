[{block name="usermanager_admin_requ_delcountryfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_delcountryfilter_editor"}]
                    <input type="hidden" name="value[aDelCountryId]" value="">
                    <SELECT class="editinput" name="value[aDelCountryId][]" id="aDelCountryId" size="5" multiple [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getCountryList() item="oCountry"}]
                            <option value="[{$oCountry->getId()}]" [{if is_array($edit->getValue('aDelCountryId')) && in_array($oCountry->getId(), $edit->getValue('aDelCountryId'))}]selected[{/if}]>[{$oCountry->getFieldData('oxtitle')}]</option>
                        [{/foreach}]
                    </SELECT><br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
                    <input type="button" onclick="selectAllListElems(document.getElementById('aDelCountryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" onclick="selectNoListElems(document.getElementById('aDelCountryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_delcountryfilter_viewer"}]
                    <ul>
                        [{foreach from=$oView->getCountryList() item="oCountry"}]
                            [{if is_array($edit->getValue('aDelCountryId')) && in_array($oCountry->getId(), $edit->getValue('aDelCountryId'))}]
                                <li>
                                    [{$oCountry->getFieldData('oxtitle')}]
                                </li>
                            [{/if}]
                        [{/foreach}]
                    </ul>
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_DELCOUNTRY_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]