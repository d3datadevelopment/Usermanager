<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
