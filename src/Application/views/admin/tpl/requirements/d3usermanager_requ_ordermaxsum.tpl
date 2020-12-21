[{block name="usermanager_admin_requ_ordermaxsum"}]
    <dl class="[{$blActionRestriction}]">
        <dt>
            <input type="hidden" name="value[blCheckMaxOrderSum_status]" value="0">
            <input id="RequMaxOrderSum" class="edittext ext_edittext" type="checkbox" name="value[blCheckMaxOrderSum_status]" value='1' [{if $edit->getValue('blCheckMaxOrderSum_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <select name="value[sCheckMaxOrderSumType]" id="sCheckMaxOrderSumType">
                <option value="oxtotalnetsum" [{if $edit->getValue('sCheckMaxOrderSumType') == 'oxtotalnetsum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_TOTALNET"}]</option>
                <option value="oxtotalbrutsum" [{if $edit->getValue('sCheckMaxOrderSumType') == 'oxtotalbrutsum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_TOTALBRUT"}]</option>
                <option value="oxtotalordersum" [{if $edit->getValue('sCheckMaxOrderSumType') == 'oxtotalordersum'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_TOTALORDER"}]</option>
                <option value="oxdelcost" [{if $edit->getValue('sCheckMaxOrderSumType') == 'oxdelcost'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_DEL"}]</option>
                <option value="oxpaycost" [{if $edit->getValue('sCheckMaxOrderSumType') == 'oxpaycost'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUMTYPE_PAY"}]</option>
            </select>
            <label for="RequMaxOrderSum">[{oxmultilang ident="D3_USERMANAGER_REQU_MAXORDERSUM"}]</label>
        </dt>
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordermaxsum_editor"}]
                    <input style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sCheckMaxOrderSumValue]" value='[{$edit->getValue('sCheckMaxOrderSumValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUM_DEFCUR"}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_ordermaxsum_viewer"}]
                    [{$edit->getValue('sCheckMaxOrderSumValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUM_DEFCUR"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_MAXORDERSUM_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]