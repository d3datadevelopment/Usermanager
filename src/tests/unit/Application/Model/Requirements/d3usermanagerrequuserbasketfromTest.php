<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
