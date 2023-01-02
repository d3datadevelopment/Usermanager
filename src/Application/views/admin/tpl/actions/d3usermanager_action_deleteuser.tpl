[{block name="usermanager_admin_action_deleteuser"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_deleteuser_editor"}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_deleteuser_viewer"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_CUSTDELETE_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]