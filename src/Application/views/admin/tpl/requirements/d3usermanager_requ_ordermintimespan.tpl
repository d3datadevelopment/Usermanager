[{block name="usermanager_admin_requ_ordermintimespan"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordermintimespan_editor"}]
                    <label for="RequOrderMinTimespan">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMINIMUMTIMESPAN"}]</label>
                    <input id="RequOrderMinTimespan" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sOrderMinTimespanValue]" value='[{$edit->getValue('sOrderMinTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <SELECT id="RequOrderMinTimespanUnit" class="editinput" name="value[sOrderMinTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sOrderMinTimespanUnit') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_ordermintimespan_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMINIMUMTIMESPAN"}]
                    [{$edit->getValue('sOrderMinTimespanValue')}]
                    [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                        [{if $edit->getValue('sOrderMinTimespanUnit') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERMINTIMESPAN_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]
