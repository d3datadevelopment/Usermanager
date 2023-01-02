[{block name="usermanager_admin_requ_ordermaxtimespan"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordermaxtimespan_editor"}]
                    <label for="RequOrderMaxTimespan">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMAXIMUMTIMESPAN"}]</label>
                    <input id="RequOrderMaxTimespan" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sOrderMaxTimespanValue]" value='[{$edit->getValue('sOrderMaxTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <SELECT id="RequOrderMaxTimespanUnit" class="editinput" name="value[sOrderMaxTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sOrderMaxTimespanUnit') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_ordermaxtimespan_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMAXIMUMTIMESPAN"}]
                    [{$edit->getValue('sOrderMaxTimespanValue')}]
                    [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                        [{if $edit->getValue('sOrderMaxTimespanUnit') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERMAXTIMESPAN_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]
