<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
