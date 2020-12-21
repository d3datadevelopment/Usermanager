[{block name="usermanager_admin_requ_deladdrfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_deladdrfilter_editor"}]
                    <SELECT id="RequDeliveryAddressType" class="editinput" name="value[sCheckDeliveryAddressType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="set" [{if $edit->getValue('sCheckDeliveryAddressType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                        <option value="notset" [{if $edit->getValue('sCheckDeliveryAddressType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_deladdrfilter_viewer"}]
                    [{if $edit->getValue('sCheckDeliveryAddressType') == 'set'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
                    [{elseif $edit->getValue('sCheckDeliveryAddressType') == 'notset'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_DELIVERYADDRESS_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]