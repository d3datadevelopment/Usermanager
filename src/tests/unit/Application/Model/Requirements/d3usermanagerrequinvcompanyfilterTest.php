<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
