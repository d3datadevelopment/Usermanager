[{block name="usermanager_admin_requ_invfieldfilter"}]
    <dl class="[{$blActionRestriction}]">
        [{include file="d3usermanager_activeswitch.tpl" oActionRequ=$oRequ blActionRestriction=$blActionRestriction readonly=$readonly}]
        <dd>
            [{if $oView->isEditMode()}]
                [{block name="usermanager_admin_requ_invfieldfilter_editor"}]
                    <label for="RequInvUserFieldField">[{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUE_FIELD"}]</label>
                    <input id="RequInvUserFieldField" class="editinput" type="text" size="30" maxlength="100" name="value[sInvUserField_FieldName]" value="[{$edit->getValue('sInvUserField_FieldName')}]" [{$blActionRestriction}] [{$readonly}]>
                    [{oxinputhelp ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUE_FIELD_DESC"}]<br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_USERFIELDVALUE_VALUE"}] <br>
                    <input id="RequInvUserFieldTypeContent" type="radio" style="margin-left: 30px;" name="value[sCheckInvUserFieldType]" value="content" [{if $edit->getValue('sCheckInvUserFieldType') == 'content' || $edit->getValue('sCheckInvUserFieldType') == ''}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
                    <label for="RequInvUserFieldTypeContent">[{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUETYPE_CONTENT"}]</label>
                    <input class="editinput" type="text" size="30" maxlength="100" name="value[sInvUserField_FieldValue]" value="[{$edit->getValue('sInvUserField_FieldValue')}]" [{$blActionRestriction}] [{$readonly}]>
                    [{oxinputhelp ident="D3_USERMANAGER_REQU_ARTICLECONTENT2_DESC"}]<br>
                    <input id="RequInvUserFieldTypeEmpty" type="radio" style="margin-left: 30px;" name="value[sCheckInvUserFieldType]" value="empty" [{if $edit->getValue('sCheckInvUserFieldType') == 'empty'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
                    <label for="RequInvUserFieldTypeEmpty">[{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUETYPE_EMPTY"}]</label><br>
                    <input id="RequInvUserFieldTypeNotEmpty" type="radio" style="margin-left: 30px;" name="value[sCheckInvUserFieldType]" value="notempty" [{if $edit->getValue('sCheckInvUserFieldType') == 'notempty'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
                    <label for="RequInvUserFieldTypeNotEmpty">[{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUETYPE_NOTEMPTY"}]</label>
                [{/block}]
            [{else}]
                [{block name="usermanager_admin_requ_invfieldfilter_viewer"}]
                    [{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUE_FIELD"}]
                    [{$edit->getValue('sInvUserField_FieldName')}]<br>
                    [{oxmultilang ident="D3_USERMANAGER_REQU_USERFIELDVALUE_VALUE"}] <br>
                    [{if $edit->getValue('sCheckInvUserFieldType') == 'content' || $edit->getValue('sCheckInvUserFieldType') == ''}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUETYPE_CONTENT"}]
                        [{$edit->getValue('sInvUserField_FieldValue')}]
                        [{oxinputhelp ident="D3_USERMANAGER_REQU_ARTICLECONTENT2_DESC"}]<br>
                    [{elseif $edit->getValue('sCheckInvUserFieldType') == 'empty'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUETYPE_EMPTY"}]
                    [{elseif $edit->getValue('sCheckInvUserFieldType') == 'notempty'}]
                        [{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUETYPE_NOTEMPTY"}]
                    [{/if}]
                [{/block}]
            [{/if}]
            [{oxinputhelp ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUE_DESC"}]
        </dd>
        <dd class="spacer"></dd>
    </dl>
[{/block}]