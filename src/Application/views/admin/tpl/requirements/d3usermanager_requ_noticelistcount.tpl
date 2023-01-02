[{block name="usermanager_admin_requ_noticelistcount"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_noticelistcount_editor"}]
                    <SELECT id="RequNoticeListCountType" class="editinput" name="value[sNoticeListCountType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sNoticeListCountType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                    <input id="RequNoticeListCountValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sNoticeListCountValue]" value='[{$edit->getValue('sNoticeListCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <label for="RequNoticeListCountValue">[{oxmultilang ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_VALUE"}]</label>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_noticelistcount_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sNoticeListCountType') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                    [{$edit->getValue('sNoticeListCountValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_VALUE"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_NOTICELISTCOUNT_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]