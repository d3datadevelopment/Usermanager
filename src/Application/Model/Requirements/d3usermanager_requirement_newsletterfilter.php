<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
