[{block name="usermanager_admin_requ_orderlanguagefilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_orderlanguagefilter_editor"}]
                    <input type="hidden" name="value[aOrderInLanguageId]" value="">
                    <SELECT class="editinput" name="value[aOrderInLanguageId][]" id="aOrderInLanguageId" multiple [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getLanguageList() item="oLang"}]
                            <option value="[{$oLang->id}]" [{if is_array($edit->getValue('aOrderInLanguageId')) && in_array($oLang->id, $edit->getValue('aOrderInLanguageId'))}]selected[{/if}]>[{$oLang->name}]</option>
                        [{/foreach}]
                    </SELECT><br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
                    <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aOrderInLanguageId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aOrderInLanguageId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_orderlanguagefilter_viewer"}]
                    <ul>
                        [{foreach from=$oView->getLanguageList() item="oLang"}]
                            [{if is_array($edit->getValue('aOrderInLanguageId')) && in_array($oLang->id, $edit->getValue('aOrderInLanguageId'))}]
                                <li>
                                    [{$oLang->name}]
                                </li>
                            [{/if}]
                        [{/foreach}]
                    </ul>
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_LANGUAGE_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]