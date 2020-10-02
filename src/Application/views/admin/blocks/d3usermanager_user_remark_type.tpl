[{d3modcfgcheck modid="d3usermanager"}][{/d3modcfgcheck}]

[{if $mod_d3usermanager}]
    [{if $allitem->oxremark__oxtype->value == "d3um"}][{oxmultilang ident="D3_USERMANAGER_REMARK_NOTE"}][{else}][{$smarty.block.parent}][{/if}]
[{else}]
    [{$smarty.block.parent}]
[{/if}]