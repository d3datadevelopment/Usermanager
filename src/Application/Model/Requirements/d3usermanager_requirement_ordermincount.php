<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
