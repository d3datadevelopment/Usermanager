<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
