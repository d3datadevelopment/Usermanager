[{block name="usermanager_admin_requ_wishlistcount"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_wishlistcount_editor"}]
                    <SELECT id="RequWishListCountType" class="editinput" name="value[sWishListCountType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="less" [{if $edit->getValue('sWishListCountType') == 'less'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}]</option>
                        <option value="higher" [{if $edit->getValue('sWishListCountType') == 'higher'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}]</option>
                    </SELECT>
                    <input id="RequWishListCountValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sWishListCountValue]" value='[{$edit->getValue('sWishListCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <label for="RequWishListCountValue">[{oxmultilang ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_VALUE"}]</label>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_wishlistcount_viewer"}]
                    [{if $edit->getValue('sWishListCountType') == 'less'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_LESSEQUAL"}][{/if}]
                    [{if $edit->getValue('sWishListCountType') == 'higher'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_HIGHEREQUAL"}][{/if}]
                    [{$edit->getValue('sWishListCountValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_VALUE"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]