[{block name="usermanager_admin_requ_registertimespan"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_registertimespan_editor"}]
                    <SELECT id="RequRegisterTimespanType" class="editinput" name="value[sRegisterTimespanType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="minimum" [{if $edit->getValue('sRegisterTimespanType') == 'minimum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_MINIMUM"}]</option>
                        <option value="maximum" [{if $edit->getValue('sRegisterTimespanType') == 'maximum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_MAXIMUM"}]</option>
                    </SELECT>
                    <input id="RequRegisterTimespanMax" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sRegisterTimespanValue]" value='[{$edit->getValue('sRegisterTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <SELECT id="RequRegisterTimespanUnit" class="editinput" name="value[sRegisterTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="minute" [{if $edit->getValue('sRegisterTimespanUnit') == 'minute'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]</option>
                        <option value="hour" [{if $edit->getValue('sRegisterTimespanUnit') == 'hour'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]</option>
                        <option value="day" [{if $edit->getValue('sRegisterTimespanUnit') == 'day'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_registertimespan_viewer"}]
                    [{if $edit->getValue('sRegisterTimespanType') == 'minimum'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_MINIMUM"}]
                    [{elseif $edit->getValue('sRegisterTimespanType') == 'maximum'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_MAXIMUM"}]
                    [{/if}]
                    [{$edit->getValue('sRegisterTimespanValue')}]
                    [{if $edit->getValue('sRegisterTimespanUnit') == 'minute'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_MINUTE"}]
                    [{elseif $edit->getValue('sRegisterTimespanUnit') == 'hour'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_HOUR"}]
                    [{elseif $edit->getValue('sRegisterTimespanUnit') == 'day'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_TIMESPAN_DAY"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]