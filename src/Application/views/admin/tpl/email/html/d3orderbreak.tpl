[{assign var="shop"      value=$oEmailView->getShop()}]
[{assign var="oViewConf" value=$oEmailView->getViewConfig()}]
[{assign var="oConf"     value=$oViewConf->getConfig()}]

[{include file="email/html/header.tpl" title=$shop->oxshops__oxordersubject->value}]

    [{oxcontent ident="d3orderbreakhtml"}]

[{include file="email/html/footer.tpl"}]
