[{block name="usermanager_admin_action_sendpushnotification"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_sendpushnotification_editor"}]
                    <label for="ActionUserSendPushNotificationUrl">[{oxmultilang ident="D3_USERMANAGER_ACTION_USERSENDPUSHNOTIFICATION_URL"}]</label>
                    <input id="ActionUserSendPushNotificationUrl" type="text" name="value[sActionSendPushNotification_url]" size="30" maxlength="150" value="[{$edit->getValue('sActionSendPushNotification_url')}]" [{$blActionRestriction}] [{$readonly}]><br>

                    <label for="ActionUserSendPushNotificationMethod">[{oxmultilang ident="D3_USERMANAGER_ACTION_USERSENDPUSHNOTIFICATION_METHOD"}]</label>
                    <select id="ActionUserSendPushNotificationMethod" name="value[sActionSendPushNotification_method]">
                        [{foreach from=$oAction->getMethodList() key="method" item="translation"}]
                            <option value="[{$key}]" [{if $edit->getValue('sActionSendPushNotification_method') == $key}]selected="selected"[{/if}]>[{$translation}]</option>
                        [{/foreach}]
                    </select>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_sendpushnotification_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_USERSENDPUSHNOTIFICATION_URL"}] [{$edit->getValue('sActionSendPushNotification_url')}]<br>
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_USERSENDPUSHNOTIFICATION_METHOD"}] [{$edit->getValue('sActionSendPushNotification_method')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_USERSENDPUSHNOTIFICATION_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]
