[{block name="usermanager_admin_requ_userbaskettimespan"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_userbaskettimespan_editor"}]
                    <SELECT id="RequUserBasketTimespanType" class="editinput" name="value[sUserBasketTimespanType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="minimum" [{if $edit->getValue('sUserBasketTimespanType') == 'minimum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_MINIMUM"}]</option>
                        <option value="maximum" [{if $edit->getValue('sUserBasketTimespanType') == 'maximum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_MAXIMUM"}]</option>
                    </SELECT>
                    <input id="RequUserBasketTimespanMax" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sUserBasketTimespanValue]" value='[{$edit->getValue('sUserBasketTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <SELECT id="RequUserBasketTimespanUnit" class="editinput" name="value[sUserBasketTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="minute" [{if $edit->getValue('sUserBasketTimespanUnit') == 'minute'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]</option>
                        <option value="hour" [{if $edit->getValue('sUserBasketTimespanUnit') == 'hour'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]</option>
                        <option value="day" [{if $edit->getValue('sUserBasketTimespanUnit') == 'day'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_userbaskettimespan_viewer"}]
                    [{if $edit->getValue('sUserBasketTimespanType') == 'minimum'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_MINIMUM"}]
                    [{elseif $edit->getValue('sUserBasketTimespanType') == 'maximum'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_MAXIMUM"}]
                    [{/if}]
                    [{$edit->getValue('sUserBasketTimespanValue')}]
                    [{if $edit->getValue('sUserBasketTimespanUnit') == 'minute'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]
                    [{elseif $edit->getValue('sUserBasketTimespanUnit') == 'hour'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]
                    [{elseif $edit->getValue('sUserBasketTimespanUnit') == 'day'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_USERBASKETTIMESPAN_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]