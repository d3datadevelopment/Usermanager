<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
