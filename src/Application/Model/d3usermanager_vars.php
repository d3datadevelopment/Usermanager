<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3C5797783AAQAAAAXAAAABHAAAACABAAAAAAAAAD/d4AwzkL09su/4IQFKPQT4n3o/qWsxf3ILyi2hGMKGvqkW4kFuvSHoBLRDjHrEVF1fWtUuNqHjAQQvodglSDfGZB0jdw+dtN23nyFQ+/tjNi/Fi2NHp0tLB2q7bI9yTUNKKNnCfgEfmZuXu6awzeQlggAAABAAQAAs7nfXjHj3HFKIY6i8PYqVe4XpJDUd7RKx1PUV+Akh1aavmyJdXpftcMNetdg6dchmO/lqvu8lrj5rJQdUDW/jasKoWh8TIYwMsDuBU82sdwGwXzhqvEozcxJ6jftj0ShkB8BaqoAyHUFAVNpiGQsuzS74OvogSXVtMn1FqKBd5HvS3Ij1A+hXMk4Ao5DO4N+id+eVuTPVBVydug2RUAmRQ2HlZYpIzfg4BV4xRT1HSRqYh2JrUYvN2YC7EzTahLTjsRlFpMmp4mn6ycoR4mylNMpv5qSDZ7wn9jMiZRObeQ83nUjJjzIMPFhKik1f1+jPCAja6XPFraDlPpN3Wsqg4yOeQcj3oV8A8Md34SSi68RPAzpSJ8l4pK2ikrWSRyjK1ONEGgjUw6iBSybT1MMz7fcAZRzeEA5/fm0CCJLtUVRAAAAMAEAAI4VOsYxWhgGDgxl4lAXfBYa8SAcHitczNC0KL35dn94KPCpVd+Ppfx/cs7sQ7t7ugEa1ejEjF/fGMNjJgoQnyunPeGiqQNuxjLF03a0YQro1j+e4f9/O57uUrbLnJXg3i8AqVGlAo5VL7Rm/LcRFc2oyE4aarwraE1ICtiQQHNZJhZTQs8fnWDTEWa8R8XfIVgwPdwALBK+kOTXbSbHervAZml6Bg4FGbPyzL+HtkeH0N9Aoy6dc/LjN1en/WvGm7SEcY4rlc91rCnPEQs82SClaBLK3AjhntqqJu8ZdXbp4dw/spvQaGkcgvyz9c1+aiNTEt1/Lf/LLEd3yB7Rxs+HNOtEC14J+XDNTeGeZbM1J0Vop09VIC9kt0Fqz9x1Je1xgXuu5C0sKBU46lzzflgAAAAA');
