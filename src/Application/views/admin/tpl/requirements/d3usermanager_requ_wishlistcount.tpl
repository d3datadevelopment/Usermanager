[{block name="usermanager_admin_requ_wishlistcount"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_wishlistcount_editor"}]
                    <SELECT id="RequWishListCountType" class="editinput" name="value[sWishListCountType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                            <option value="[{$type}]" [{if $edit->getValue('sWishListCountType') == $type}]selected[{/if}]>[{oxmultilang ident=$translation}]</option>
                        [{/foreach}]
                    </SELECT>
                    <input id="RequWishListCountValue" style="text-align: right;" class="edittext ext_edittext" type="text" size="5" maxlength="4" name="value[sWishListCountValue]" value='[{$edit->getValue('sWishListCountValue')}]' [{$blActionRestriction}] [{$readonly}]>
                    <label for="RequWishListCountValue">[{oxmultilang ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_VALUE"}]</label>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_wishlistcount_viewer"}]
                    [{foreach from=$oRequ->getTypeList() key="type" item="translation"}]
                        [{if $edit->getValue('sWishListCountType') == $type}][{oxmultilang ident=$translation}][{/if}]
                    [{/foreach}]
                    [{$edit->getValue('sWishListCountValue')}] [{oxmultilang ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_VALUE"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_WISHLISTCOUNT_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]