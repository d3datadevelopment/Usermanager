<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
