<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckDelUserField_status]" value="0">
        <input id="RequDelUserField" class="edittext ext_edittext" type="checkbox" name="value[blCheckDelUserField_status]" value='1' [{if $edit->getValue('blCheckDelUserField_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequDelUserField">[{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <label for="RequDelUserFieldField">[{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUE_FIELD"}]</label>
            <input id="RequDelUserFieldField" class="editinput" type="text" size="30" maxlength="100" name="value[sDelUserField_FieldName]" value="[{$edit->getValue('sDelUserField_FieldName')}]" [{$blActionRestriction}] [{$readonly}]>
            [{oxinputhelp ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUE_FIELD_DESC"}]<br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_USERFIELDVALUE_VALUE"}] <br>
            <input id="RequDelUserFieldTypeContent" type="radio" style="margin-left: 30px;" name="value[sCheckDelUserFieldType]" value="content" [{if $edit->getValue('sCheckDelUserFieldType') == 'content' || $edit->getValue('sCheckDelUserFieldType') == ''}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="RequDelUserFieldTypeContent">[{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUETYPE_CONTENT"}]</label>
            <input class="editinput" type="text" size="30" maxlength="100" name="value[sDelUserField_FieldValue]" value="[{$edit->getValue('sDelUserField_FieldValue')}]" [{$blActionRestriction}] [{$readonly}]>
            [{oxinputhelp ident="D3_USERMANAGER_REQU_DELADR_GENERALDESC"}]<br>
            <input id="RequDelUserFieldTypeEmpty" type="radio" style="margin-left: 30px;" name="value[sCheckDelUserFieldType]" value="empty" [{if $edit->getValue('sCheckDelUserFieldType') == 'empty'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="RequDelUserFieldTypeEmpty">[{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUETYPE_EMPTY"}]</label><br>
            <input id="RequDelUserFieldTypeNotEmpty" type="radio" style="margin-left: 30px;" name="value[sCheckDelUserFieldType]" value="notempty" [{if $edit->getValue('sCheckDelUserFieldType') == 'notempty'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="RequDelUserFieldTypeNotEmpty">[{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUETYPE_NOTEMPTY"}]</label>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUE_FIELD"}]
            [{$edit->getValue('sDelUserField_FieldName')}]<br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_USERFIELDVALUE_VALUE"}] <br>
            [{if $edit->getValue('sCheckDelUserFieldType') == 'content' || $edit->getValue('sCheckDelUserFieldType') == ''}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUETYPE_CONTENT"}]
                [{$edit->getValue('sDelUserField_FieldValue')}]
                [{oxinputhelp ident="D3_USERMANAGER_REQU_USERFIELDVALUE_DESC"}]
                [{oxinputhelp ident="D3_USERMANAGER_REQU_DELADR_GENERALDESC"}]<br>
            [{elseif $edit->getValue('sCheckDelUserFieldType') == 'empty'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUETYPE_EMPTY"}]
            [{elseif $edit->getValue('sCheckDelUserFieldType') == 'notempty'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUETYPE_NOTEMPTY"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_DELUSERFIELDVALUE_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>