<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
