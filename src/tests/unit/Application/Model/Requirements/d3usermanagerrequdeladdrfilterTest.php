<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
