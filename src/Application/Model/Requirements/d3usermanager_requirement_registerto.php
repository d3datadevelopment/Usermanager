<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
