<dl class="[{$blActionRestriction}]">
    <dt>
        <input type="hidden" name="value[blCheckHasNoOrders_status]" value="0">
        <input id="RequHasNoOrders" class="edittext ext_edittext" type="checkbox" name="value[blCheckHasNoOrders_status]" value='1' [{if $edit->getValue('blCheckHasNoOrders_status') == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
        <label for="RequHasNoOrders">[{oxmultilang ident="D3_USERMANAGER_REQU_HASNOORDERS"}]</label>
    </dt>
    <dd>
        [{if $oView->isEditMode()}]
        [{else}]
        [{/if}]
        [{oxinputhelp ident="D3_USERMANAGER_REQU_HASNOORDERS_DESC"}]
    </dd>
    <dd class="spacer"></dd>
</dl>