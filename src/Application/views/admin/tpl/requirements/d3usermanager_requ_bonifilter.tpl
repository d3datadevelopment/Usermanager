[{block name="usermanager_admin_requ_bonifilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_bonifilter_editor"}]
                    <SELECT id="RequBoniType" class="editinput" name="value[sBoniType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="less" [{if $edit->getValue('sBoniType') == 'less'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}]</option>
                        <option value="higher" [{if $edit->getValue('sBoniType') == 'higher'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}]</option>
                    </SELECT>
                    <input id="RequBoniValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sBoniValue]" value='[{$edit->getValue('sBoniValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_bonifilter_viewer"}]
                    [{if $edit->getValue('sBoniType') == 'less'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}][{/if}]
                    [{if $edit->getValue('sBoniType') == 'higher'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}][{/if}]
                    [{$edit->getValue('sBoniValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_BONI_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]