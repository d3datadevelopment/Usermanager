<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
