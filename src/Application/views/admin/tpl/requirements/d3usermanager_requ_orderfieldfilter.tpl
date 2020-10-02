<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckOrderField_status]" value="0">
        <input id="RequOrderField" class="edittext ext_edittext" type="checkbox" name="value[blCheckOrderField_status]" value='1' [{if $edit->getValue('blCheckOrderField_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequOrderField">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUE"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
            <label for="RequOrderFieldField">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUE_FIELD"}]</label>
            <input id="RequOrderFieldField" class="editinput" type="text" size="30" maxlength="100" name="value[sOrderField_FieldName]" value="[{$edit->getValue('sOrderField_FieldName')}]" [{$blActionRestriction}] [{$readonly}]>
            [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERFIELDVALUE_FIELD_DESC"}]<br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_USERFIELDVALUE_VALUE"}] <br>
            <input id="RequOrderFieldTypeContent" type="radio" style="margin-left: 30px;" name="value[sCheckOrderFieldType]" value="content" [{if $edit->getValue('sCheckOrderFieldType') == 'content' || $edit->getValue('sCheckOrderFieldType') == ''}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="RequOrderFieldTypeContent">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUETYPE_CONTENT"}]</label>
            <input class="editinput" type="text" size="30" maxlength="100" name="value[sOrderField_FieldValue]" value="[{$edit->getValue('sOrderField_FieldValue')}]" [{$blActionRestriction}] [{$readonly}]>
            [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDER_GENERALDESC"}]<br>
            <input id="RequOrderFieldTypeEmpty" type="radio" style="margin-left: 30px;" name="value[sCheckOrderFieldType]" value="empty" [{if $edit->getValue('sCheckOrderFieldType') == 'empty'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="RequOrderFieldTypeEmpty">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUETYPE_EMPTY"}]</label><br>
            <input id="RequOrderFieldTypeNotEmpty" type="radio" style="margin-left: 30px;" name="value[sCheckOrderFieldType]" value="notempty" [{if $edit->getValue('sCheckOrderFieldType') == 'notempty'}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
            <label for="RequOrderFieldTypeNotEmpty">[{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUETYPE_NOTEMPTY"}]</label>
        [{else}]
            [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUE_FIELD"}]
            [{$edit->getValue('sOrderField_FieldName')}]<br>
            [{oxmultilang ident="D3_USERMANAGER_REQU_USERFIELDVALUE_VALUE"}] <br>
            [{if $edit->getValue('sCheckOrderFieldType') == 'content' || $edit->getValue('sCheckOrderFieldType') == ''}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUETYPE_CONTENT"}]
                [{$edit->getValue('sOrderField_FieldValue')}]
                [{oxinputhelp ident="D3_USERMANAGER_REQU_USERFIELDVALUE_DESC"}]
                [{oxinputhelp ident="D3_USERMANAGER_REQU_DELADR_GENERALDESC"}]<br>
            [{elseif $edit->getValue('sCheckOrderFieldType') == 'empty'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUETYPE_EMPTY"}]
            [{elseif $edit->getValue('sCheckOrderFieldType') == 'notempty'}]
                [{oxmultilang ident="D3_USERMANAGER_REQU_ORDERFIELDVALUETYPE_NOTEMPTY"}]
            [{/if}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_ORDERFIELDVALUE_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>