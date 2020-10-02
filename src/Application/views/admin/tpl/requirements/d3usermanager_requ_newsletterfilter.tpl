<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckNewsletterUser_status]" value="0">
        <input id="RequNewsletterUser" class="edittext ext_edittext" type="checkbox" name="value[blCheckNewsletterUser_status]" value='1' [{if $edit->getValue('blCheckNewsletterUser_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequNewsletterUser">[{oxmultilang ident="D3_USERMANAGER_REQU_NEWSLETTERUSER"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <SELECT id="RequNewsletterUserType" class="editinput" name="value[sCheckNewsletterUserType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                <option value="set" [{if $edit->getValue('sCheckNewsletterUserType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                <option value="notset" [{if $edit->getValue('sCheckNewsletterUserType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
            </SELECT>
        [{else}]
            [{if $edit->getValue('sCheckNewsletterUserType') == 'set'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
            [{elseif $edit->getValue('sCheckNewsletterUserType') == 'notset'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_NEWSLETTERUSER_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>