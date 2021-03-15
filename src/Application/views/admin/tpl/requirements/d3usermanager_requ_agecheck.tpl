[{block name="usermanager_admin_requ_agecheck"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_agecheck_editor"}]
                    <SELECT id="RequAgeCheckType" class="editinput" name="value[sAgeCheckType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sAgeCheckType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                        <option value="less" [{if $edit->getValue('sAgeCheckType') == 'less'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}]</option>
                        <option value="higher" [{if $edit->getValue('sAgeCheckType') == 'higher'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}]</option>
                    </SELECT>
                    <input id="RequAgeCheckValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sAgeCheckValue]" value='[{$edit->getValue('sAgeCheckValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_AGECHECK_YEARS"}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_agecheck_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sAgeCheckType') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                    [{$edit->getValue('sAgeCheckValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_AGECHECK_YEARS"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_AGECHECK_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]