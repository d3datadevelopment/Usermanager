[{block name="usermanager_admin_requ_ordermaxtimespan"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordermaxtimespan_editor"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMAXIMUMTIMESPAN"}]
                    <input id="RequOrderMaxTimespan" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sOrderMaxTimespanValue]" value='[{$edit->getValue('sOrderMaxTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <SELECT id="RequOrderMaxTimespanUnit" class="editinput" name="value[sOrderMaxTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="minute" [{if $edit->getValue('sOrderMaxTimespanUnit') == 'minute'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]</option>
                        <option value="hour" [{if $edit->getValue('sOrderMaxTimespanUnit') == 'hour'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]</option>
                        <option value="day" [{if $edit->getValue('sOrderMaxTimespanUnit') == 'day'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_ordermaxtimespan_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMAXIMUMTIMESPAN"}]
                    [{$edit->getValue('sOrderMaxTimespanValue')}]
                    [{if $edit->getValue('sOrderMaxTimespanUnit') == 'minute'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]
                    [{elseif $edit->getValue('sOrderMaxTimespanUnit') == 'hour'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]
                    [{elseif $edit->getValue('sOrderMaxTimespanUnit') == 'day'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERMAXTIMESPAN_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]