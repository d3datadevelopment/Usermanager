<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckValidMail_status]" value="0">
        <input id="RequValidMail" class="edittext ext_edittext" type="checkbox" name="value[blCheckValidMail_status]" value='1' [{if $edit->getValue('blCheckValidMail_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequValidMail">[{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequValidMailType" class="editinput" name="value[sCheckValidMailType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="notvalid" [{if $edit->getValue('sCheckValidMailType') == 'notvalid'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL_NOTVALID"}]</option>
                <option value="valid" [{if $edit->getValue('sCheckValidMailType') == 'valid'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL_VALID"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckValidMailType') == 'notvalid'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL_NOTVALID"}]
            [{elseif $edit->getValue('sCheckValidMailType') == 'valid'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL_VALID"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_VALIDMAIL_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>