[{block name="usermanager_admin_requ_invcompanyfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_invcompanyfilter_editor"}]
                    <SELECT id="RequInvCompanyType" class="editinput" name="value[sCheckInvCompanyType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="set" [{if $edit->getValue('sCheckInvCompanyType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                        <option value="notset" [{if $edit->getValue('sCheckInvCompanyType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_invcompanyfilter_viewer"}]
                    [{if $edit->getValue('sCheckInvCompanyType') == 'set'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
                    [{elseif $edit->getValue('sCheckInvCompanyType') == 'notset'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_INVCOMPANY_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]