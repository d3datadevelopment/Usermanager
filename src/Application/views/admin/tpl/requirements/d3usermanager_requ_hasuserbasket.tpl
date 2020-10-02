<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckUserBasket_status]" value="0">
        <input id="RequUserBasket" class="edittext ext_edittext" type="checkbox" name="value[blCheckUserBasket_status]" value='1' [{if $edit->getValue('blCheckUserBasket_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequUserBasket">[{oxmultilang ident="D3_USERMANAGER_REQU_USERBASKET"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequUserBasketType" class="editinput" name="value[sCheckUserBasketType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="exist" [{if $edit->getValue('sCheckUserBasketType') == 'exist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}]</option>
                <option value="notexist" [{if $edit->getValue('sCheckUserBasketType') == 'notexist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckUserBasketType') == 'exist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}][{/if}]
            [{if $edit->getValue('sCheckUserBasketType') == 'notexist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}][{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_USERBASKET_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>