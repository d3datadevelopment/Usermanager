<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
