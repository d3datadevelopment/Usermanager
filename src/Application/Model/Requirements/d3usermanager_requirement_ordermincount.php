<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
