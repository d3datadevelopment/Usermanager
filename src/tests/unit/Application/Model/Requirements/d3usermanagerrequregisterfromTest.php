<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
