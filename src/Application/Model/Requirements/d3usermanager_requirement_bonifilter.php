<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
