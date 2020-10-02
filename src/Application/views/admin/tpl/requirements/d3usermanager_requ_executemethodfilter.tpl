<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckExecuteMethod_status]" value="0">
        <input id="RequExecuteMethod" class="edittext ext_edittext" type="checkbox" name="value[blCheckExecuteMethod_status]" value='1' [{if $edit->getValue('blCheckExecuteMethod_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequExecuteMethod">[{oxmultilang ident="D3_USERMANAGER_REQU_USEREXECUTEMETHOD"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <label for="RequUserExecuteMethodName">[{oxmultilang ident="D3_USERMANAGER_REQU_USEREXECUTEMETHOD_NAME"}]</label>
            <input id="ActionUserExecuteMethodName" type="text" name="value[sRequirementExecuteMethod_name]" size="30" maxlength="50" value="[{$edit->getValue('sRequirementExecuteMethod_name')}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_USEREXECUTEMETHOD_NAME"}] [{$edit->getValue('sRequirementExecuteMethod_name')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_USEREXECUTEMETHOD_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>