<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
