<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckOrderDelivery_status]" value="0">
        <input id="RequOrderDelivery" class="edittext ext_edittext" type="checkbox" name="value[blCheckOrderDelivery_status]" value='1' [{if $edit->getValue('blCheckOrderDelivery_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequOrderDelivery">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERDELIVERY"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input type="hidden" name="value[aOrderDeliveryId]" value="">
            <SELECT class="editinput" name="value[aOrderDeliveryId][]" id="aOrderDeliveryId" size="5" multiple [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getDeliveryList() item="oDelivery"}]
                    <option value="[{$oDelivery->getId()}]" [{if is_array($edit->getValue('aOrderDeliveryId')) && in_array($oDelivery->getId(), $edit->getValue('aOrderDeliveryId'))}]selected[{/if}]>[{$oDelivery->getFieldData('oxtitle')}]</option>
                [{/foreach}]
            </SELECT>
            <br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
            <input type="button" onclick="selectAllListElems(document.getElementById('aOrderDeliveryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" onclick="selectNoListElems(document.getElementById('aOrderDeliveryId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            <ul>
                [{foreach from=$oView->getDeliveryList() item="oDelivery"}]
                    [{if is_array($edit->getValue('aOrderDeliveryId')) && in_array($oDelivery->getId(), $edit->getValue('aOrderDeliveryId'))}]
                        <li>
                            [{$oDelivery->getFieldData('oxtitle')}]
                        </li>
                    [{/if}]
                [{/foreach}]
            </ul>
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_DELIVERY_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>