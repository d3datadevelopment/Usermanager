<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
