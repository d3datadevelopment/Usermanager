<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
