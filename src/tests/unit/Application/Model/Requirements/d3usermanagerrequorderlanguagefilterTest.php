<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
