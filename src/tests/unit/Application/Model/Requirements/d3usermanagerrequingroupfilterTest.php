<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
