<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
