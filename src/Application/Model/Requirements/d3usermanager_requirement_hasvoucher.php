<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
