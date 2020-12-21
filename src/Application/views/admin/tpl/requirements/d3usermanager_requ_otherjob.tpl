[{block name="usermanager_admin_requ_otherjob"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_otherjob_editor_editor"}]
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
                    <label for="RequOtherJobType" style="position: absolute; left: -2000px">[{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB"}]</label>
                    <SELECT class="editinput" name="value[sOtherJob_Type]" id="RequOtherJobType" [{$blActionRestriction}] [{$readonly}]>
                        <option value="exec" [{if "exec" == $edit->getValue('sOtherJob_Type')}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_EXECUTED"}]</option>
                        <option value="notexec" [{if "notexec" == $edit->getValue('sOtherJob_Type')}]selected[{/if}]>[{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_NOTEXECUTED"}]</option>
                    </SELECT>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_otherjob_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_NAME"}] "[{$oView->getManagerTitle($edit->getValue('sOtherJob_ID'))}]"&nbsp;
                    [{if $edit->getValue('sOtherJob_Type') == 'exec' || $edit->getValue('sOtherJob_Type') == ''}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_EXECUTED"}]
                    [{elseif $edit->getValue('sOtherJob_Type') == 'notexec'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_OTHERJOB_NOTEXECUTED"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_OTHERJOB_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]