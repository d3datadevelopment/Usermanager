<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blWishListCount_status]" value="0">
        <input id="RequWishListCount" class="edittext ext_edittext" type="checkbox" name="value[blWishListCount_status]" value='1' [{if $edit->getValue('blWishListCount_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequWishListCount">[{oxmultilang ident="D3_USERMANAGER_REQU_WISHLISTCOUNT"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequWishListCountType" class="editinput" name="value[sWishListCountType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="less" [{if $edit->getValue('sWishListCountType') == 'less'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}]</option>
                <option value="higher" [{if $edit->getValue('sWishListCountType') == 'higher'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}]</option>
            </SELECT>
            <input id="RequWishListCountValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sWishListCountValue]" value='[{$edit->getValue('sWishListCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
            <label for="RequWishListCountValue">[{oxmultilang ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_VALUE"}]</label>
        [{else}]
            [{if $edit->getValue('sWishListCountType') == 'less'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}][{/if}]
            [{if $edit->getValue('sWishListCountType') == 'higher'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}][{/if}]
            [{$edit->getValue('sWishListCountValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_VALUE"}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>