<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
