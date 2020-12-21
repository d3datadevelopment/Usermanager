<dt>
    <input type="hidden" name="value[[{$oActionRequ->getActiveSwitchParameter()}]]" value="0">
    <input id="[{$oActionRequ->getActiveSwitchParameter()}]" class="edittext ext_edittext" type="checkbox" name="value[[{$oActionRequ->getActiveSwitchParameter()}]]" value='1' [{if $edit->getValue($oActionRequ->getActiveSwitchParameter()) == 1}]checked[{/if}] [{$blActionRestriction}] [{$readonly}]>
    <label for="[{$oActionRequ->getActiveSwitchParameter()}]">[{$oActionRequ->getTitle()}]</label>
    [{oxinputhelp ident=$oActionRequ->getTitleIdent()|cat:"_DESC"}]
</dt>