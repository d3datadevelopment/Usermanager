<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
