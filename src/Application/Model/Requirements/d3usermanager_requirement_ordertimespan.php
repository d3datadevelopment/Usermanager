<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
