<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
