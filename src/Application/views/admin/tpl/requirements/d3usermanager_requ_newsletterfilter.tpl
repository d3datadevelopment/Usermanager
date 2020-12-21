[{block name="usermanager_admin_requ_newsletterfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_newsletterfilter_editor"}]
                    <SELECT id="RequNewsletterUserType" class="editinput" name="value[sCheckNewsletterUserType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="set" [{if $edit->getValue('sCheckNewsletterUserType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                        <option value="notset" [{if $edit->getValue('sCheckNewsletterUserType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_newsletterfilter_viewer"}]
                    [{if $edit->getValue('sCheckNewsletterUserType') == 'set'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
                    [{elseif $edit->getValue('sCheckNewsletterUserType') == 'notset'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_NEWSLETTERUSER_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]