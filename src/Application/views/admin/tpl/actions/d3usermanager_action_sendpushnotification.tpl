[{block name="usermanager_admin_action_sendpushnotification"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oAction blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_action_sendpushnotification_editor"}]
                    <label for="ActionOrderSendPushNotificationUrl">[{oxmultilang ident="D3_USERMANAGER_ACTION_ORDERSENDPUSHNOTIFICATION_URL"}]</label>
                    <input id="ActionOrderSendPushNotificationUrl" type="text" name="value[sActionSendPushNotification_url]" size="30" maxlength="150" value="[{$edit->getValue('sActionSendPushNotification_url')}]" [{$blActionRestriction}] [{$readonly}]><br>

                    <label for="ActionOrderSendPushNotificationMethod">[{oxmultilang ident="D3_USERMANAGER_ACTION_ORDERSENDPUSHNOTIFICATION_METHOD"}]</label>
                    <select id="ActionOrderSendPushNotificationMethod" name="value[sActionSendPushNotification_method]">
                        <option value="GET" [{if $edit->getValue('sActionSendPushNotification_method') == 'GET'}]selected="selected"[{/if}]>GET</option>
                        <option value="POST" [{if $edit->getValue('sActionSendPushNotification_method') == 'POST' || $edit->getValue('sActionSendPushNotification_method') == ''}]selected="selected"[{/if}]>POST</option>
                        <option value="PUT" [{if $edit->getValue('sActionSendPushNotification_method') == 'PUT'}]selected="selected"[{/if}]>PUT</option>
                        <option value="HEAD" [{if $edit->getValue('sActionSendPushNotification_method') == 'HEAD'}]selected="selected"[{/if}]>HEAD</option>
                        <option value="DELETE" [{if $edit->getValue('sActionSendPushNotification_method') == 'DELETE'}]selected="selected"[{/if}]>DELETE</option>
                    </select>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_action_sendpushnotification_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_ACTION_ORDERSENDPUSHNOTIFICATION_URL"}] [{$edit->getValue('sActionSendPushNotification_url')}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_ACTION_ORDERSENDPUSHNOTIFICATION_DESC"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{/block}]