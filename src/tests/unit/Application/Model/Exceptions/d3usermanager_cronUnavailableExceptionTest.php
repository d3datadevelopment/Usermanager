<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
