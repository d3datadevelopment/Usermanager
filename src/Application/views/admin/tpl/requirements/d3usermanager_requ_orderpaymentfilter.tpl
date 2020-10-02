<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckOrderPayment_status]" value="0">
        <input id="RequOrderPayment" class="edittext ext_edittext" type="checkbox" name="value[blCheckOrderPayment_status]" value='1' [{if $edit->getValue('blCheckOrderPayment_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequOrderPayment">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERPAYMENT"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <input type="hidden" name="value[aOrderPaymentId]" value="">
            <SELECT class="editinput" name="value[aOrderPaymentId][]" id="aOrderPaymentId" size="5" multiple [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getPaymentList() item="oPayment"}]
                    <option value="[{$oPayment->getId()}]" [{if is_array($edit->getValue('aOrderPaymentId')) && in_array($oPayment->getId(), $edit->getValue('aOrderPaymentId'))}]selected[{/if}]>[{$oPayment->getFieldData('oxdesc')}]</option>
                [{/foreach}]
            </SELECT><br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
            <input type="button" onclick="selectAllListElems(document.getElementById('aOrderPaymentId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" onclick="selectNoListElems(document.getElementById('aOrderPaymentId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            <ul>
                [{foreach from=$oView->getPaymentList() item="oPayment"}]
                    [{if is_array($edit->getValue('aOrderPaymentId')) && in_array($oPayment->getId(), $edit->getValue('aOrderPaymentId'))}]
                        <li>
                            [{$oPayment->getFieldData('oxdesc')}]
                        </li>
                    [{/if}]
                [{/foreach}]
            </ul>
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERPAYMENT_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>