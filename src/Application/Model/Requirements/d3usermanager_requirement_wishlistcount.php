<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
