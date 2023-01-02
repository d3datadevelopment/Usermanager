[{block name="usermanager_admin_requ_orderpaymentfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_orderpaymentfilter_editor"}]
                    <input type="hidden" name="value[aOrderPaymentId]" value="">
                    <SELECT class="editinput" name="value[aOrderPaymentId][]" id="aOrderPaymentId" size="5" multiple [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oView->getPaymentList() item="oPayment"}]
                            <option value="[{$oPayment->getId()}]" [{if is_array($edit->getValue('aOrderPaymentId')) && in_array($oPayment->getId(), $edit->getValue('aOrderPaymentId'))}]selected[{/if}]>[{$oPayment->getFieldData('oxdesc')}]</option>
                        [{/foreach}]
                    </SELECT><br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_MULTIPLE"}]<br>
                    <input type="button" onclick="selectAllListElems(document.getElementById('aOrderPaymentId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_ALL"}]" [{$blActionRestriction}] [{$readonly}]> <input type="button" onclick="selectNoListElems(document.getElementById('aOrderPaymentId')); return false;" value="[{oxmultilang ident="D3_GENERAL_USERMANAGER_SELECT_NONE"}]" [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_orderpaymentfilter_viewer"}]
                    <ul>
                        [{foreach from=$oView->getPaymentList() item="oPayment"}]
                            [{if is_array($edit->getValue('aOrderPaymentId')) && in_array($oPayment->getId(), $edit->getValue('aOrderPaymentId'))}]
                                <li>
                                    [{$oPayment->getFieldData('oxdesc')}]
                                </li>
                            [{/if}]
                        [{/foreach}]
                    </ul>
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERPAYMENT_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]