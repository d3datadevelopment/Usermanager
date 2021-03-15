[{block name="usermanager_admin_requ_bonifilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_bonifilter_editor"}]
                    <SELECT id="RequBoniType" class="editinput" name="value[sBoniType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sBoniType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                    <input id="RequBoniValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sBoniValue]" value='[{$edit->getValue('sBoniValue')}]' [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_bonifilter_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sBoniType') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                    [{$edit->getValue('sBoniValue')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_BONI_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]