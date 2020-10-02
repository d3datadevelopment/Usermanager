<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckOrderTimespan_status]" value="0">
        <input id="RequOrderTimespan1" class="edittext ext_edittext" type="checkbox" name="value[blCheckOrderTimespan_status]" value='1' [{if $edit->getValue('blCheckOrderTimespan_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>

        [{if $oView->isEditMode()}]
            <SELECT id="RequOrderTimespanOrderType" class="editinput" name="value[sOrderTimespanOrderType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="first" [{if $edit->getValue('sOrderTimespanOrderType') == 'first'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_FIRST"}]</option>
                <option value="last" [{if $edit->getValue('sOrderTimespanOrderType') == 'last'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_LAST"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sOrderTimespanOrderType') == 'first'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_FIRST"}]
            [{else}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_LAST"}]
            [{/if}]
        [{/if}]

        <label for="RequOrderTimespan1">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequOrderTimespanType" class="editinput" name="value[sOrderTimespanType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="minimum" [{if $edit->getValue('sOrderTimespanType') == 'minimum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_MINIMUM"}]</option>
                <option value="maximum" [{if $edit->getValue('sOrderTimespanType') == 'maximum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_MAXIMUM"}]</option>
            </SELECT>
            <input id="RequOrderTimespanMax" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sOrderTimespanValue]" value='[{$edit->getValue('sOrderTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
            <SELECT id="RequOrderTimespanUnit" class="editinput" name="value[sOrderTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="minute" [{if $edit->getValue('sOrderTimespanUnit') == 'minute'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]</option>
                <option value="hour" [{if $edit->getValue('sOrderTimespanUnit') == 'hour'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]</option>
                <option value="day" [{if $edit->getValue('sOrderTimespanUnit') == 'day'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sOrderTimespanType') == 'minimum'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_MINIMUM"}]
            [{elseif $edit->getValue('sOrderTimespanType') == 'maximum'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_MAXIMUM"}]
            [{/if}]
            [{$edit->getValue('sOrderTimespanValue')}]
            [{if $edit->getValue('sOrderTimespanUnit') == 'minute'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]
            [{elseif $edit->getValue('sOrderTimespanUnit') == 'hour'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]
            [{elseif $edit->getValue('sOrderTimespanUnit') == 'day'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERTIMESPAN_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>