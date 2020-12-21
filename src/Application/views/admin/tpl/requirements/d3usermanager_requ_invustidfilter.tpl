[{block name="usermanager_admin_requ_invustidfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_invustidfilter_editor"}]
                    <SELECT id="RequInvUstIdType" class="editinput" name="value[sCheckInvUstIdType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="set" [{if $edit->getValue('sCheckInvUstIdType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                        <option value="notset" [{if $edit->getValue('sCheckInvUstIdType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_invustidfilter_viewer"}]
                    [{if $edit->getValue('sCheckInvUstIdType') == 'set'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
                    [{elseif $edit->getValue('sCheckInvUstIdType') == 'notset'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_INVUSTID_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]