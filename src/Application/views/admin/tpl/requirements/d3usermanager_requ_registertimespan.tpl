[{block name="usermanager_admin_requ_registertimespan"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_registertimespan_editor"}]
                    <SELECT id="RequRegisterTimespanType" class="editinput" name="value[sRegisterTimespanType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sRegisterTimespanType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                    <input id="RequRegisterTimespanMax" style="text-align: right;" class="edittext ext_edittext" type="text" size="4" maxlength="3" name="value[sRegisterTimespanValue]" value='[{$edit->getValue('sRegisterTimespanValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <SELECT id="RequRegisterTimespanUnit" class="editinput" name="value[sRegisterTimespanUnit]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sRegisterTimespanUnit') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_registertimespan_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sRegisterTimespanType') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                    [{$edit->getValue('sRegisterTimespanValue')}]
                    [{foreach from=$oRequ->getUnitList() key="type" item="translation"}]
                        [{if $edit->getValue('sRegisterTimespanUnit') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_REGISTERTIMESPAN_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]