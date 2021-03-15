[{block name="usermanager_admin_requ_ordertimespan"}]
    <dl class="[{$blActionRestriction}]">
        <dt>
            <input type="hidden" name="value[blCheckOrderTimespan_status]" value="0">
            <input id="RequOrderTimespan1" class="edittext ext_edittext" type="checkbox" name="value[blCheckOrderTimespan_status]" value='1' [{if $edit->getValue('blCheckOrderTimespan_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>

            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordertimespan1_editor"}]
                    <SELECT id="RequOrderTimespanOrderType" class="editinput" name="value[sOrderTimespanOrderType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getOrderTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sOrderTimespanOrderType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_ordertimespan1_viewer"}]
                    [{if $edit->getValue('sOrderTimespanOrderType') == 'first'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_FIRST"}]
                    [{else}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_LAST"}]
                    [{/if}]
                [{/block}]
            [{/if}]

            <label for="RequOrderTimespan1">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN"}]</label>
        </dt>
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordertimespan2_editor"}]
                    <SELECT id="RequOrderTimespanType" class="editinput" name="value[sOrderTimespanType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sOrderTimespanType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                    <input id="RequOrderTimespanMax" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sOrderTimespanValue]" value='[{$edit->getValue('sOrderTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <SELECT id="RequOrderTimespanUnit" class="editinput" name="value[sOrderTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sOrderTimespanUnit') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_ordertimespan2_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sOrderTimespanType') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                    [{$edit->getValue('sOrderTimespanValue')}]
                    [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                        [{if $edit->getValue('sOrderTimespanUnit') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]