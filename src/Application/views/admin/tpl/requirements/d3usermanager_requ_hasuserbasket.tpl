[{block name="usermanager_admin_requ_hasuserbasket"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_hasuserbasket_editor"}]
                    <SELECT id="RequUserBasketType" class="editinput" name="value[sCheckUserBasketType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="exist" [{if $edit->getValue('sCheckUserBasketType') == 'exist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}]</option>
                        <option value="notexist" [{if $edit->getValue('sCheckUserBasketType') == 'notexist'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_hasuserbasket_viewer"}]
                    [{if $edit->getValue('sCheckUserBasketType') == 'exist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_EXIST"}][{/if}]
                    [{if $edit->getValue('sCheckUserBasketType') == 'notexist'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTEXIST"}][{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_USERBASKET_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]