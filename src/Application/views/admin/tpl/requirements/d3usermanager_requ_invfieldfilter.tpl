<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckInvUserField_status]" value="0">
        <input id="RequInvUserField" class="edittext ext_edittext" type="checkbox" name="value[blCheckInvUserField_status]" value='1' [{if $edit->getValue('blCheckInvUserField_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequInvUserField">[{oxmultilang ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
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
        [{else}]
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
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_INVUSERFIELDVALUE_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>