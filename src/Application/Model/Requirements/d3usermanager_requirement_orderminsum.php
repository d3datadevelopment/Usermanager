<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
