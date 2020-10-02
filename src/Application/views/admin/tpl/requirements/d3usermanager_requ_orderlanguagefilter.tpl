<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckOrderLanguage_status]" value="0">
        <input id="RequOrderLanguage" class="edittext ext_edittext" type="checkbox" name="value[blCheckOrderLanguage_status]" value='1' [{if $edit->getValue('blCheckOrderLanguage_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequOrderLanguage">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERLANGUAGE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input type="hidden" name="value[aOrderInLanguageId]" value="">
            <SELECT class="editinput" name="value[aOrderInLanguageId][]" id="aOrderInLanguageId" multiple [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getLanguageList() item="oLang"}]
                    <option value="[{$oLang->id}]" [{if is_array($edit->getValue('aOrderInLanguageId')) && in_array($oLang->id, $edit->getValue('aOrderInLanguageId'))}]selected[{/if}]>[{$oLang->name}]</option>
                [{/foreach}]
            </SELECT><br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
            <input type="button" href="#" onclick="selectAllListElems(document.getElementById('aOrderInLanguageId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" href="#" onclick="selectNoListElems(document.getElementById('aOrderInLanguageId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            <ul>
                [{foreach from=$oView->getLanguageList() item="oLang"}]
                    [{if is_array($edit->getValue('aOrderInLanguageId')) && in_array($oLang->id, $edit->getValue('aOrderInLanguageId'))}]
                        <li>
                            [{$oLang->name}]
                        </li>
                    [{/if}]
                [{/foreach}]
            </ul>
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_LANGUAGE_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>