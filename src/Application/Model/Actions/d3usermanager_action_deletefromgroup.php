<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
