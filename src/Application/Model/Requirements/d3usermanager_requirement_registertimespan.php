<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
