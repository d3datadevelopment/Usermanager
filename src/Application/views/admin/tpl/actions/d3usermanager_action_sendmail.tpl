<dl class="[{$blActionRestriction}]">
    <dt style="width: 20%;">
        <input type="hidden" name="value[blActionMailsend_status]" value="0">
        <input id="ActionMailsend" class="edittext ext_edittext" type="checkbox" name="value[blActionMailsend_status]" value='1' [{if $edit->getValue('blActionMailsend_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="ActionMailsend">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND"}]</label>
    </dt>
    <dd style="margin-left: 30%;">
        [{if $oView->isEditMode()}]
            [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROM1"}]<br>
            <input type="radio" id="FromSourceTpl" name="value[sSendMailFromSource]" value="template" [{if $edit->getValue('sSendMailFromSource') == 'template'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="FromSourceTpl">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE"}]</label>
            <br>
            <label style="margin-left: 15px;" for="FromTplSubject">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMSUBJECT"}]</label><input id="FromTplSubject" type="text" name="value[sSendMailFromSubject]" size="50" maxlength="250" value="[{$edit->getValue('sSendMailFromSubject')}]" [{$blActionRestriction}] [{$readonly}]><br>
            <label style="margin-left: 15px;" for="FromTplHtml">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE_HTML"}]</label><input id="FromTplHtml" type="text" name="value[sSendMailFromTemplatename]" size="50" maxlength="250" value="[{$edit->getValue('sSendMailFromTemplatename')}]" [{$blActionRestriction}] [{$readonly}]> [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE_DESC"}]<br>
            <label style="margin-left: 15px;" for="FromTplPlain">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE_PLAIN"}]</label><input id="FromTplPlain" type="text" name="value[sSendMailFromTemplatenamePlain]" size="50" maxlength="250" value="[{$edit->getValue('sSendMailFromTemplatenamePlain')}]" [{$blActionRestriction}] [{$readonly}]> [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE_DESC"}]<br>
            <input style="margin-left: 20px;" id="FromThemeAdmin" type="radio" name="value[sSendMailFromTheme]" value="admin" [{if $edit->getValue('sSendMailFromTheme') == 'admin'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]> <label for="FromThemeAdmin">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_ADMIN"}] ([{$oView->getManagerTemplateDirs(1)}])</label><br>
            <input style="margin-left: 20px;" id="FromThemeFrontend" type="radio" name="value[sSendMailFromTheme]" value="frontend" [{if $edit->getValue('sSendMailFromTheme') == 'frontend'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]> <label for="FromThemeFrontend">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_FRONTEND"}] ([{$oView->getManagerTemplateDirs(0)}])</label><br>
            <input style="margin-left: 20px;" id="FromModule" type="radio" name="value[sSendMailFromTheme]" value="module" [{if $edit->getValue('sSendMailFromTheme') == 'module'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="FromModule">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_MODULE"}]</label>
            <select id="FromModuleId" class="editinput" name="value[sSendMailFromModulePath]" size="1" [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getModulePathList() key="sId" item="sModulePath"}]
                    <option value="[{$sId}]" [{if $edit->getValue('sSendMailFromModulePath') == $sId}]selected[{/if}]>[{$sModulePath}]</option>
                [{/foreach}]
            </select> [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_DESC"}]<br>
            <hr>
            <input type="radio" id="FromSourceCms" name="value[sSendMailFromSource]" value="cms" [{if $edit->getValue('sSendMailFromSource') == 'cms'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]> <label for="FromSourceCms">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMCMS"}]</label>
            <br>
            <label style="margin-left: 15px;">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMCMS_SUBJECT"}]</label><br>
            <label for="FromCmsHtml" style="margin-left: 15px;">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMCMS_HTML"}]</label>
            <SELECT id="FromCmsHtml" class="editinput" name="value[sSendMailFromContentname]" size="1" [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getContentList() item="oContent"}]
                    <option value="[{$oContent->getId()}]" [{if $edit->getValue('sSendMailFromContentname') == $oContent->getId()}]selected[{/if}]>[{$oContent->getFieldData('oxtitle')}] ([{$oContent->getFieldData('oxloadid')}])</option>
                [{/foreach}]
            </SELECT> <br>

            <label for="FromCmsPlain" style="margin-left: 15px;">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMCMS_PLAIN"}]</label>
            <SELECT id="FromCmsPlain" class="editinput" name="value[sSendMailFromContentnamePlain]" size="1" [{$blActionRestriction}] [{$readonly}]>
                [{foreach from=$oView->getContentList() item="oContent"}]
                    <option value="[{$oContent->getId()}]" [{if $edit->getValue('sSendMailFromContentnamePlain') == $oContent->getId()}]selected[{/if}]>[{$oContent->getFieldData('oxtitle')}] ([{$oContent->getFieldData('oxloadid')}])</option>
                [{/foreach}]
            </SELECT> <br>
            <hr>
            [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROM2"}]<br>

            <input type="hidden" name="value[blSendMailToCustomer]" value="0">
            <input id="ToCustomer" class="edittext ext_edittext" type="checkbox" name="value[blSendMailToCustomer]" value='1' [{if $edit->getValue('blSendMailToCustomer') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="ToCustomer">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOCUSTOMER"}]</label>
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOCUSTOMER_DESC"}]<br>
            <input type="hidden" name="value[blSendMailToOwner]" value="0">
            <input id="ToOwner" class="edittext ext_edittext" type="checkbox" name="value[blSendMailToOwner]" value='1' [{if $edit->getValue('blSendMailToOwner') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="ToOwner">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOOWNER"}]</label>
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOOWNER_DESC"}]<br>
            <input type="hidden" name="value[blSendMailToCustom]" value="0">
            <input id="ToMail" class="edittext ext_edittext" type="checkbox" name="value[blSendMailToCustom]" value='1' [{if $edit->getValue('blSendMailToCustom') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="ToMail">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOMAIL"}]</label>
            <input id="ToMailInput" type="text" name="value[sSendMailToCustomAddress]" size="30" maxlength="60" value="[{$edit->getValue('sSendMailToCustomAddress')}]" [{$blActionRestriction}] [{$readonly}]>
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOMAIL_DESC"}]<br>

            <label for="ReplyAdr">[{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_USEALTREPLYADR"}]</label>
            <input id="ReplyAdr" class="edittext ext_edittext" type="text" name="value[sSendMailReplyAddress]" value="[{$edit->getValue('sSendMailReplyAddress')}]">
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_USEALTREPLYADR_DESC"}]
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROM1"}]<br>
            [{if $edit->getValue('sSendMailFromSource') == 'template'}]
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE"}]
                <br>
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMSUBJECT"}] [{$edit->getValue('sSendMailFromSubject')}]<br>
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE_HTML"}] [{$edit->getValue('sSendMailFromTemplatename')}] [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE_DESC"}]<br>
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE_PLAIN"}] [{$edit->getValue('sSendMailFromTemplatenamePlain')}] [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTEMPLATE_DESC"}]<br>
                [{if $edit->getValue('sSendMailFromTheme') == 'admin'}]
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_ADMIN"}] ([{$oView->getManagerTemplateDirs(1)}])
                [{elseif $edit->getValue('sSendMailFromTheme') == 'frontend'}]
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_FRONTEND"}] ([{$oView->getManagerTemplateDirs(0)}]) [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_DESC"}]
                [{elseif $edit->getValue('sSendMailFromTheme') == 'module'}]
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_MODULE"}] [{$edit->getValue('sSendMailFromModulePath')}] [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_FROMTPL_DESC"}]
                [{/if}]
            [{elseif $edit->getValue('sSendMailFromSource') == 'cms'}]
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMCMS"}]
                <br>
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMCMS_SUBJECT"}]<br>
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMCMS_HTML"}]
                [{foreach from=$oView->getContentList() item="oContent"}]
                    [{if $edit->getValue('sSendMailFromContentname') == $oContent->getId()}]
                        [{$oContent->getFieldData('oxtitle')}] ([{$oContent->getFieldData('oxloadid')}])
                    [{/if}]
                [{/foreach}]
                <br>

                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROMCMS_PLAIN"}]
                [{foreach from=$oView->getContentList() item="oContent"}]
                    [{if $edit->getValue('sSendMailFromContentnamePlain') == $oContent->getId()}]
                        [{$oContent->getFieldData('oxtitle')}] ([{$oContent->getFieldData('oxloadid')}])
                    [{/if}]
                [{/foreach}]
            [{/if}]
            <hr>
            [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_FROM2"}]<br>

            [{if $edit->getValue('blSendMailToCustomer') == 1}]
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOCUSTOMER"}]
                [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOCUSTOMER_DESC"}]
            [{elseif $edit->getValue('blSendMailToOwner') == 1}]
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOOWNER"}]
                [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOOWNER_DESC"}]
            [{elseif $edit->getValue('blSendMailToCustom') == 1}]
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_TOMAIL"}]
                [{$edit->getValue('sSendMailToCustomAddress')}]
                [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_TOMAIL_DESC"}]
            [{/if}]

            [{if $edit->getValue('sSendMailReplyAddress')}]
                [{oxmultilang ident="D3_USERMANAGER_ACTION_MAILSEND_USEALTREPLYADR"}] [{$edit->getValue('sSendMailReplyAddress')}]
                [{oxinputhelp ident="D3_USERMANAGER_ACTION_MAILSEND_USEALTREPLYADR_DESC"}]<br>
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_ACTION_SENDMAIL_DESC"}]
    </dd>
    <div class="spacer"></div>
</dl>