<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
