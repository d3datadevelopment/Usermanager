<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
