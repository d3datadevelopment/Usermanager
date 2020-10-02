<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckMinOrderSum_status]" value="0">
        <input id="RequMinOrderSum" class="edittext ext_edittext" type="checkbox" name="value[blCheckMinOrderSum_status]" value='1' [{if $edit->getValue('blCheckMinOrderSum_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <select name="value[sCheckMinOrderSumType]" id="sCheckMinOrderSumType">
            <option value="oxtotalnetsum" [{if $edit->getValue('sCheckMinOrderSumType') == 'oxtotalnetsum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_TOTALNET"}]</option>
            <option value="oxtotalbrutsum" [{if $edit->getValue('sCheckMinOrderSumType') == 'oxtotalbrutsum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_TOTALBRUT"}]</option>
            <option value="oxtotalordersum" [{if $edit->getValue('sCheckMinOrderSumType') == 'oxtotalordersum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_TOTALORDER"}]</option>
            <option value="oxdelcost" [{if $edit->getValue('sCheckMinOrderSumType') == 'oxdelcost'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_DEL"}]</option>
            <option value="oxpaycost" [{if $edit->getValue('sCheckMinOrderSumType') == 'oxpaycost'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_PAY"}]</option>
        </select>
        <label for="RequMinOrderSum">[{oxmultilang ident="D3_USERMANAGER_REQU_MINORDERSUM"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sCheckMinOrderSumValue]" value='[{$edit->getValue('sCheckMinOrderSumValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUM_DEFCUR"}]
        [{else}]
            [{$edit->getValue('sCheckMinOrderSumValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUM_DEFCUR"}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_MINORDERSUM_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>