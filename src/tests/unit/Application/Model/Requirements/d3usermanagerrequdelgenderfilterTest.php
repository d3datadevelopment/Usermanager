<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
