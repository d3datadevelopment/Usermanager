<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
