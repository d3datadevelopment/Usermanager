[{block name="usermanager_admin_requ_executemethodfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_executemethodfilter_editor"}]
                    <label for="RequUserExecuteMethodName">[{oxmultilang ident="D3_USERMANAGER_REQU_USEREXECUTEMETHOD_NAME"}]</label>
                    <input id="RequUserExecuteMethodName" type="text" name="value[sRequirementExecuteMethod_name]" size="30" maxlength="50" value="[{$edit->getValue('sRequirementExecuteMethod_name')}]" [{$blActionRestriction}] [{$readonly}]>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_executemethodfilter_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_USEREXECUTEMETHOD_NAME"}] [{$edit->getValue('sRequirementExecuteMethod_name')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_USEREXECUTEMETHOD_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]