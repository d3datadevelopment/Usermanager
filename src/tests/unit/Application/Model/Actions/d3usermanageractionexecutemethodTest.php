<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
