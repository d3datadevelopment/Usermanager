<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blActionUserExecuteMethod_status]" value="0">
        <input id="ActionUserExecuteMethod" class="edittext ext_edittext" type="checkbox" name="value[blActionUserExecuteMethod_status]" value='1' [{if $edit->getValue('blActionUserExecuteMethod_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="ActionUserExecuteMethod">[{oxmultilang ident="D3_USERMANAGER_ACTION_USEREXECUTEMETHOD"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <label for="ActionUserExecuteMethodName">[{oxmultilang ident="D3_USERMANAGER_ACTION_USEREXECUTEMETHOD_NAME"}]</label> <input id="ActionUserExecuteMethodName" type="text" name="value[sActionExecuteMethod_name]" size="30" maxlength="50" value="[{$edit->getValue('sActionExecuteMethod_name')}]" [{$blActionRestriction}] [{$readonly}]>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_ACTION_USEREXECUTEMETHOD_NAME"}] [{$edit->getValue('sActionExecuteMethod_name')}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_ACTION_USEREXECUTEMETHOD_DESC"}]
    </dd>
    <div class="spacer"></div>
</dl>