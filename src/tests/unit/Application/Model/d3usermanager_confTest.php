<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
