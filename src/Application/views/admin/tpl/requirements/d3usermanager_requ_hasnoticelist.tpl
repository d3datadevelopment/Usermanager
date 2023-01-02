[{block name="usermanager_admin_requ_hasnoticelist"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_hasnoticelist_editor"}]
                    <SELECT id="RequNoticeListType" class="editinput" name="value[sCheckNoticeListType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sCheckNoticeListType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_hasnoticelist_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sCheckNoticeListType') == $ytpe}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_NOTICELIST_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]