<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
