<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.0 SourceGuardian (02.01.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
