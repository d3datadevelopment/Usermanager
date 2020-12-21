[{block name="usermanager_admin_action_executemethod"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_executemethod_editor"}]
                    <label for="ActionUserExecuteMethodName">[{oxmultilang ident="D3_USERMANAGER_ACTION_USEREXECUTEMETHOD_NAME"}]</label>
                    <input id="ActionUserExecuteMethodName" type="text" name="value[sActionExecuteMethod_name]" size="30" maxlength="50" value="[{$edit->getValue('sActionExecuteMethod_name')}]" [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_executemethod_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_USEREXECUTEMETHOD_NAME"}] [{$edit->getValue('sActionExecuteMethod_name')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_USEREXECUTEMETHOD_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]