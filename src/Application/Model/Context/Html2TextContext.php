<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
