<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
