<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
