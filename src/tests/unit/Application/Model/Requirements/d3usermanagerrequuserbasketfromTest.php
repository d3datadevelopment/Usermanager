<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
