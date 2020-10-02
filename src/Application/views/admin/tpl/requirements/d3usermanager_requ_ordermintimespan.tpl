<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckOrderMinTimespan_status]" value="0">
        <input id="RequOrderMinTimespan" class="edittext ext_edittext" type="checkbox" name="value[blCheckOrderMinTimespan_status]" value='1' [{if $edit->getValue('blCheckOrderMinTimespan_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequOrderMinTimespan">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMINTIMESPAN"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMINIMUMTIMESPAN"}]
            <input id="RequOrderMinTimespan" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sOrderMinTimespanValue]" value='[{$edit->getValue('sOrderMinTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
            <SELECT id="RequOrderMinTimespanUnit" class="editinput" name="value[sOrderMinTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="minute" [{if $edit->getValue('sOrderMinTimespanUnit') == 'minute'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]</option>
                <option value="hour" [{if $edit->getValue('sOrderMinTimespanUnit') == 'hour'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]</option>
                <option value="day" [{if $edit->getValue('sOrderMinTimespanUnit') == 'day'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]</option>
            </SELECT>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERMINIMUMTIMESPAN"}]
            [{$edit->getValue('sOrderMinTimespanValue')}]
            [{if $edit->getValue('sOrderMinTimespanUnit') == 'minute'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]
            [{elseif $edit->getValue('sOrderMinTimespanUnit') == 'hour'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]
            [{elseif $edit->getValue('sOrderMinTimespanUnit') == 'day'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERMINTIMESPAN_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>