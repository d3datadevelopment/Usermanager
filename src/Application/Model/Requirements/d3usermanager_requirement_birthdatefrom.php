<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
