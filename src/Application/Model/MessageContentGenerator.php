<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
