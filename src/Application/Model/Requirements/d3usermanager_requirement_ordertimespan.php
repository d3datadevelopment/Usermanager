<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
