<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
