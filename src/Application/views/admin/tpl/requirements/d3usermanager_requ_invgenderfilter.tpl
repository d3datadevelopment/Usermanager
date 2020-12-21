[{block name="usermanager_admin_requ_invgenderfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_invgenderfilter_editor"}]
                    <SELECT id="RequInvGenderType" class="editinput" name="value[sCheckInvGenderType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="mr" [{if $edit->getValue('sCheckInvGenderType') == 'mr'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MR"}]</option>
                        <option value="mrs" [{if $edit->getValue('sCheckInvGenderType') == 'mrs'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MRS"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_invgenderfilter_viewer"}]
                    [{if $edit->getValue('sCheckInvGenderType') == 'mr'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MR"}]
                    [{elseif $edit->getValue('sCheckInvGenderType') == 'mrs'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MRS"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_INVADR_GENERALDESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]