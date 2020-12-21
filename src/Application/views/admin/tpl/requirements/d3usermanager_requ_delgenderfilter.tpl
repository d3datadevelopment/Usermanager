[{block name="usermanager_admin_requ_delgenderfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_delgenderfilter_editor"}]
                    <SELECT id="RequDelGenderType" class="editinput" name="value[sCheckDelGenderType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="mr" [{if $edit->getValue('sCheckDelGenderType') == 'mr'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MR"}]</option>
                        <option value="mrs" [{if $edit->getValue('sCheckDelGenderType') == 'mrs'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MRS"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_delgenderfilter_viewer"}]
                    [{if $edit->getValue('sCheckDelGenderType') == 'mr'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MR"}]
                    [{elseif $edit->getValue('sCheckDelGenderType') == 'mrs'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENDER_MRS"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_DELADR_GENERALDESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]