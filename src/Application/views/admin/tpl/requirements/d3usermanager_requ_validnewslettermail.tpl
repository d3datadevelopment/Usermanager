[{block name="usermanager_admin_requ_validnewslettermail"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_validnewslettermail_editor"}]
                    <SELECT id="RequValidMailType" class="editinput" name="value[sCheckValidMailType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="notvalid" [{if $edit->getValue('sCheckValidMailType') == 'notvalid'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL_NOTVALID"}]</option>
                        <option value="valid" [{if $edit->getValue('sCheckValidMailType') == 'valid'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL_VALID"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_validnewslettermail_viewer"}]
                    [{if $edit->getValue('sCheckValidMailType') == 'notvalid'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL_NOTVALID"}]
                    [{elseif $edit->getValue('sCheckValidMailType') == 'valid'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_VALIDMAIL_VALID"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_VALIDMAIL_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]