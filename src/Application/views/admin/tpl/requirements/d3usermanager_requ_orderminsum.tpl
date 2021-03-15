[{block name="usermanager_admin_requ_orderminsum"}]
    [{oxscript include="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"}]
    <dl class="[{$blActionRestriction}]">
        <dt>
            <input type="hidden" name="value[blCheckMinOrderSum_status]" value="0">
            <input id="RequMinOrderSum" class="edittext ext_edittext" type="checkbox" name="value[blCheckMinOrderSum_status]" value='1' [{if $edit->getValue('blCheckMinOrderSum_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <select name="value[sCheckMinOrderSumType]" id="sCheckMinOrderSumType">
                [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                    <option value="[{$type}]" [{if $edit->getValue('sCheckMinOrderSumType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                [{/foreach}]
            </select>
            <label for="RequMinOrderSum">[{oxmultilang ident="D3_USERMANAGER_REQU_MINORDERSUM"}]</label>
        </dt>
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_orderminsum_editor"}]
                    <input id="sCheckMinOrderSumValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sCheckMinOrderSumValue]" value='[{$edit->getValue('sCheckMinOrderSumValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUM_DEFCUR"}]

                    [{capture name="d3JsFnc"}][{strip}]
                        new Cleave('#sCheckMinOrderSumValue', {
                            numeral: true,
                            numeralThousandsGroupStyle: 'thousand',
                            numeralDecimalMark: ',',
                            delimiter: '.',
                            stripLeadingZeroes: false,
                            swapHiddenInput: true
                        });
                    [{/strip}][{/capture}]
                    [{oxscript add=$smarty.capture.d3JsFnc}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_orderminsum_viewer"}]
                    [{$edit->getValue('sCheckMinOrderSumValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUM_DEFCUR"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_MINORDERSUM_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]
