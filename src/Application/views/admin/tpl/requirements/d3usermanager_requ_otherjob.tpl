<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckOtherJob_status]" value="0">
        <input id="RequOtherJob" class="edittext ext_edittext" type="checkbox" name="value[blCheckOtherJob_status]" value='1' [{if $edit->getValue('blCheckOtherJob_status') == 1}]checked[{/if}] [{$readonly}] [{$blActionRestriction}]>
        <label for="RequOtherJob">[{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB"}]</label>
    <dd>
        [{if $oView->isEditMode()}]
            <label for="RequOtherJobName">[{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_NAME"}]</label>
            <SELECT class="editinput" name="value[sOtherJob_ID]" id="RequOtherJobName" [{$blActionRestriction}] [{$readonly}]>
                [{assign var="blUnknownJobId" value=true}]
                [{foreach from=$oView->getJobList() item="oJob"}]
                    [{if $oJob->getId() == $edit->getValue('sOtherJob_ID')}]
                        [{assign var="blSelected" value=true}]
                        [{assign var="blUnknownJobId" value=false}]
                    [{else}]
                        [{assign var="blSelected" value=false}]
                    [{/if}]
                    <option value="[{$oJob->getId()}]" [{if $blSelected}]selected[{/if}]>[{$oJob->getFieldData('oxtitle')}]</option>
                [{/foreach}]
                [{if $edit->getValue('sOtherJob_ID') && $blUnknownJobId}]
                    <option value="[{$edit->getValue('sOtherJob_ID')}]" selected>[{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_UNKNOWNJOBID"}] "[{$edit->getValue('sOtherJob_ID')}]"</option>
                [{/if}]
            </SELECT>
            <SELECT class="editinput" name="value[sOtherJob_Type]" id="RequOtherJobType" [{$blActionRestriction}] [{$readonly}]>
                <option value="exec" [{if "exec" == $edit->getValue('sOtherJob_Type')}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_EXECUTED"}]</option>
                <option value="notexec" [{if "notexec" == $edit->getValue('sOtherJob_Type')}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_NOTEXECUTED"}]</option>
            </SELECT>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_NAME"}] "[{$oView->getManagerTitle($edit->getValue('sOtherJob_ID'))}]"&nbsp;
            [{if $edit->getValue('sOtherJob_Type') == 'exec' || $edit->getValue('sOtherJob_Type') == ''}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_EXECUTED"}]
            [{elseif $edit->getValue('sOtherJob_Type') == 'notexec'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_NOTEXECUTED"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_OTHERJOB_DESC"}]
    </dd>
    <div class="spacer"></div>
</dl>