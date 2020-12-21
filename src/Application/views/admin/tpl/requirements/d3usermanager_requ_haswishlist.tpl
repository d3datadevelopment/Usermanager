[{block name="usermanager_admin_requ_haswishlist"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_haswishlist_editor"}]
                    <SELECT id="RequWishListType" class="editinput" name="value[sCheckWishListType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="exist" [{if $edit->getValue('sCheckWishListType') == 'exist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}]</option>
                        <option value="notexist" [{if $edit->getValue('sCheckWishListType') == 'notexist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_haswishlist_viewer"}]
                    [{if $edit->getValue('sCheckWishListType') == 'exist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}][{/if}]
                    [{if $edit->getValue('sCheckWishListType') == 'notexist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}][{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_WISHLIST_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]