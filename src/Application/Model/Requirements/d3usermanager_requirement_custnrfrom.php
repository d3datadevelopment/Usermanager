<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
