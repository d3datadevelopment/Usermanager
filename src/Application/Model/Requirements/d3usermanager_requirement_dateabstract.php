<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
