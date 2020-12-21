[{block name="usermanager_admin_requ_passwordfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_passwordfilter_editor"}]
                    <SELECT id="RequPasswordUserType" class="editinput" name="value[sCheckPasswordUserType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="set" [{if $edit->getValue('sCheckPasswordUserType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                        <option value="notset" [{if $edit->getValue('sCheckPasswordUserType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_passwordfilter_viewer"}]
                    [{if $edit->getValue('sCheckPasswordUserType') == 'set'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]
                    [{elseif $edit->getValue('sCheckPasswordUserType') == 'notset'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_PASSWORDUSER_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]