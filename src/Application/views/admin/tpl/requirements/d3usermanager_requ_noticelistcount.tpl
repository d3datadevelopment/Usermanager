[{block name="usermanager_admin_requ_noticelistcount"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_noticelistcount_editor"}]
                    <SELECT id="RequNoticeListCountType" class="editinput" name="value[sNoticeListCountType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="less" [{if $edit->getValue('sNoticeListCountType') == 'less'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}]</option>
                        <option value="higher" [{if $edit->getValue('sNoticeListCountType') == 'higher'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}]</option>
                    </SELECT>
                    <input id="RequNoticeListCountValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sNoticeListCountValue]" value='[{$edit->getValue('sNoticeListCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <label for="RequNoticeListCountValue">[{oxmultilang ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_VALUE"}]</label>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_noticelistcount_viewer"}]
                    [{if $edit->getValue('sNoticeListCountType') == 'less'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}][{/if}]
                    [{if $edit->getValue('sNoticeListCountType') == 'higher'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}][{/if}]
                    [{$edit->getValue('sNoticeListCountValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_VALUE"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]