<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
