<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
