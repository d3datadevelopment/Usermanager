<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
