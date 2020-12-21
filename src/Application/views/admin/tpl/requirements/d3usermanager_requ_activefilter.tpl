[{block name="usermanager_admin_requ_activefilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_activefilter_editor"}]
                    <SELECT id="RequActiveUserType" class="editinput" name="value[sCheckActiveUserType]" size="1" [{$blActionRestriction}] [{$readonly}]>
                        <option value="set" [{if $edit->getValue('sCheckActiveUserType') == 'set'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}]</option>
                        <option value="notset" [{if $edit->getValue('sCheckActiveUserType') == 'notset'}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_activefilter_viewer"}]
                    [{if $edit->getValue('sCheckActiveUserType') == 'set'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_SET"}][{/if}]
                    [{if $edit->getValue('sCheckActiveUserType') == 'notset'}][{oxmultilang ident="D3_USERMANAGER_REQU_GENERAL_NOTSET"}][{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_ACTIVEUSER_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]
