<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blNoticeListCount_status]" value="0">
        <input id="RequNoticeListCount" class="edittext ext_edittext" type="checkbox" name="value[blNoticeListCount_status]" value='1' [{if $edit->getValue('blNoticeListCount_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequNoticeListCount">[{oxmultilang ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequNoticeListCountType" class="editinput" name="value[sNoticeListCountType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="less" [{if $edit->getValue('sNoticeListCountType') == 'less'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}]</option>
                <option value="higher" [{if $edit->getValue('sNoticeListCountType') == 'higher'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}]</option>
            </SELECT>
            <input id="RequNoticeListCountValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sNoticeListCountValue]" value='[{$edit->getValue('sNoticeListCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
            <label for="RequNoticeListCountValue">[{oxmultilang ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_VALUE"}]</label>
        [{else}]
            [{if $edit->getValue('sNoticeListCountType') == 'less'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}][{/if}]
            [{if $edit->getValue('sNoticeListCountType') == 'higher'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}][{/if}]
            [{$edit->getValue('sNoticeListCountValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_VALUE"}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>