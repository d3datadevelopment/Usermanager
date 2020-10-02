</div>

<div class="actions">
[{strip}]

<ul>

    [{assign var="allowSharedEdit" value=true}]

[{if !$disablenew}]

[{* usermanager *}]
  [{if $bottom_buttons->usermanager_new}]
  <li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$oViewConf->getSelfLink()}]&cl=d3_cfg_usermanageritem_main';return false" target="edit">[{oxmultilang ident="D3_TOOLTIPS_NEWUSERMANAGER"}]</a> |</li>
  [{/if}]

[{/if}]

[{include file="bottomnavicustom.tpl"}]

[{if $sHelpURL}]
[{* HELP *}]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.help" href="[{$sHelpURL}]/[{$oViewConf->getActiveClassName()|lower}].html" OnClick="window.open('[{$sHelpURL}]/[{$oViewConf->getActiveClassName()|lower}].html','OXID_Help','width=800,height=600,resizable=no,scrollbars=yes');return false;">[{oxmultilang ident="TOOLTIPS_OPENHELP"}]</a></li>
[{/if}]
</ul>
[{/strip}]
</div>