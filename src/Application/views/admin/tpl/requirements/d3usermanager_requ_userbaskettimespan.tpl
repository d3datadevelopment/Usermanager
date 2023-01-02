[{block name="usermanager_admin_requ_userbaskettimespan"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_userbaskettimespan_editor"}]
                    <SELECT id="RequUserBasketTimespanType" class="editinput" name="value[sUserBasketTimespanType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sUserBasketTimespanType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                    <input id="RequUserBasketTimespanMax" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sUserBasketTimespanValue]" value='[{$edit->getValue('sUserBasketTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <SELECT id="RequUserBasketTimespanUnit" class="editinput" name="value[sUserBasketTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sUserBasketTimespanUnit') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_userbaskettimespan_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sUserBasketTimespanType') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                    [{$edit->getValue('sUserBasketTimespanValue')}]
                    [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                        [{if $edit->getValue('sUserBasketTimespanUnit') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_USERBASKETTIMESPAN_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]