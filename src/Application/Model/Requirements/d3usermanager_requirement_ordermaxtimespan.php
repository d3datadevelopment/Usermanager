<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
