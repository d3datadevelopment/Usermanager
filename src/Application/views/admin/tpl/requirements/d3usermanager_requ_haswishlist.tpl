<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckWishList_status]" value="0">
        <input id="RequWishList" class="edittext ext_edittext" type="checkbox" name="value[blCheckWishList_status]" value='1' [{if $edit->getValue('blCheckWishList_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequWishList">[{oxmultilang ident="D3_USERMANAGER_REQU_WISHLIST"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequWishListType" class="editinput" name="value[sCheckWishListType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="exist" [{if $edit->getValue('sCheckWishListType') == 'exist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}]</option>
                <option value="notexist" [{if $edit->getValue('sCheckWishListType') == 'notexist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckWishListType') == 'exist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}][{/if}]
            [{if $edit->getValue('sCheckWishListType') == 'notexist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}][{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_WISHLIST_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>