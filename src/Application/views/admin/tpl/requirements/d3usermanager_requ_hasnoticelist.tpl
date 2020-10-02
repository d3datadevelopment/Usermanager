<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckNoticeList_status]" value="0">
        <input id="RequNoticeList" class="edittext ext_edittext" type="checkbox" name="value[blCheckNoticeList_status]" value='1' [{if $edit->getValue('blCheckNoticeList_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequNoticeList">[{oxmultilang ident="D3_USERMANAGER_REQU_NOTICELIST"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequNoticeListType" class="editinput" name="value[sCheckNoticeListType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="exist" [{if $edit->getValue('sCheckNoticeListType') == 'exist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}]</option>
                <option value="notexist" [{if $edit->getValue('sCheckNoticeListType') == 'notexist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckNoticeListType') == 'exist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}][{/if}]
            [{if $edit->getValue('sCheckNoticeListType') == 'notexist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}][{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_NOTICELIST_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>