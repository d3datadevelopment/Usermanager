<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
