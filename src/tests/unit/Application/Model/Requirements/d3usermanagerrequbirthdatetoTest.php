<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
