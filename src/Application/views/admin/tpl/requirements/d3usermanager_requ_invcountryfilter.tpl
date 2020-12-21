[{block name="usermanager_admin_requ_invcountryfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_invcountryfilter_editor"}]
                    <input type="hidden" name="value[aInvCountryId]" value="">
                    <SELECT class="editinput" name="value[aInvCountryId][]" id="aInvCountryId" size="5" multiple [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getCountryList() item="oCountry"}]
                            <option value="[{$oCountry->getId()}]" [{if is_array($edit->getValue('aInvCountryId')) && in_array($oCountry->getId(), $edit->getValue('aInvCountryId'))}]selected[{/if}]>[{$oCountry->getFieldData('oxtitle')}]</option>
                        [{/foreach}]
                    </SELECT><br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
                    <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aInvCountryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aInvCountryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_invcountryfilter_viewer"}]
                    <ul>
                        [{foreach from=$oView->getCountryList() item="oCountry"}]
                            [{if is_array($edit->getValue('aInvCountryId')) && in_array($oCountry->getId(), $edit->getValue('aInvCountryId'))}]
                                <li>
                                    [{$oCountry->getFieldData('oxtitle')}]
                                </li>
                            [{/if}]
                        [{/foreach}]
                    </ul>
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_INVCOUNTRY_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]