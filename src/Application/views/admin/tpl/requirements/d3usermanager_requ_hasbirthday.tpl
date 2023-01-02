[{block name="usermanager_admin_requ_hasbirthday"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_hasbirthday_editor"}]
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_hasbirthday_viewer"}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_HASBIRTHDAY_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]