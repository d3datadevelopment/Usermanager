<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
