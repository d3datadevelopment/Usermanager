<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
