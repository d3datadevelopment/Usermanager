<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
