<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
