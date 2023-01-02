[{block name="usermanager_admin_requ_ordermaxsum"}]
    [{oxscript include="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"}]
    <dl class="[{$blActionRestriction}]">
        <dt>
            <input type="hidden" name="value[blCheckMaxOrderSum_status]" value="0">
            <input id="RequMaxOrderSum" class="edittext ext_edittext" type="checkbox" name="value[blCheckMaxOrderSum_status]" value='1' [{if $edit->getValue('blCheckMaxOrderSum_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <select name="value[sCheckMaxOrderSumType]" id="sCheckMaxOrderSumType">
                [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                    <option value="[{$type}]" [{if $edit->getValue('sCheckMaxOrderSumType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                [{/foreach}]
            </select>
            <label for="RequMaxOrderSum">[{oxmultilang ident="D3_USERMANAGER_REQU_MAXORDERSUM"}]</label>
        </dt>
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_ordermaxsum_editor"}]
                    <input id="sCheckMaxOrderSumValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="10" maxlength="10" name="value[sCheckMaxOrderSumValue]" value='[{$edit->getValue('sCheckMaxOrderSumValue')}]' [{$blActionRestriction}] [{$readonly}]> [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUM_DEFCUR"}]

                    [{capture name="d3JsFnc"}][{strip}]
                        new Cleave('#sCheckMaxOrderSumValue', {
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
                [{block name="usermanager_admin_requ_ordermaxsum_viewer"}]
                    [{$edit->getValue('sCheckMaxOrderSumValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERSUM_DEFCUR"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_MAXORDERSUM_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]
