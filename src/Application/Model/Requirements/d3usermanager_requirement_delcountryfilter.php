<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
