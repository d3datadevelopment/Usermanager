<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.3 SourceGuardian (03.05.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3C779760BAAQAAAAXAAAABHAAAACABAAAAAAAAAD/VReN0YyiH7oCCVkCkPbKT4vwkI8gHUDZxj73DsbzTyle7c/U/eu8Ottq9B8bb6Va/A6X1tt2B/b0HhgqZar7nj0uR9YC9phn+GuTJ2bnv9C5kjKgmYmOy80R7gxGiFur/D8cAWkdfLA3xOy0bPO4CwgAAABIDAAA2zU27fns1h7/WQTdx1Px1hjNuXwtMi4PglNSJN9w/BvT7FBiOQrDdGVkQ0WL/amPma886SkihzSPQzjLw0XApA5uxnR9gPijPGMt0YuEN7f/m6ccsFTsRNbAKNTWh8iPrIJte8O09cgStsBfMb7qt1HrgRws95u88gp+1DVNOh5Ix+gqCdJeqYGGKD8Fmv0fAUMnDeBNt5sn8B8LG75aSnWTdxl0DwcMvJJGurCWPeM+68WmnNeuWKVUkZTE/2qHclW+UMK+cAc0w+fqA2H/q4cg/fPCuolY9u9R6DkFgZF1UOY09L+wika6EITwIZheCyb4yVnw1SkCG/2rJauRQNMyPrQmvg1H1KfffbNt41eFTf40pZ/6qZxEEtH9gxMOo5y85ppHJWSyRcv15nWJqXqJS9dTrXu7eB/96IZ/55ZbFv/4xZh4xYzuQMvMhM7KV0GUOAqyFumy6HwWZl+Iv1bnVICoE+rB6uQxSxxbL5sK8TpyB7an5/Q1kaTOnqc0zW3+MnD70AMzl35YUm2x7kioSfVI6ySk1G/1VcIqGBuoFVc1KQj8nADZIV8Bv2p8oe60hjnRvWHeAnAdd1ljsVaAcReLCfrWEWDbg1NjOvf89u3pTYj6iR+grKM11k8ZfJCQvkn/DIjdgxl82WDcKaJKcxYXmD7NtYrnAwGU2dYf+ej4UiW0qWU4RraDYhKvGVcIz+Z4JD++dQePPFgKcn/hfg9+Mfp+9wfwq91VNFWPBOCJoaMsXcWis8M3DQsEb7MkFWpdTUot5uC1ljrHH+J1DbUIMEAbz+Im79Hit/y5f5VZi7Sw8gPyVa74srRoePNSFcZBtrMboz58Q6nCh0h4WyRD6Rg8dwMA4iG4gIJNUnYxTWaX54lNvWzwmvnKEdyUhwu76Cm9Z7s1++7o9osgpwcfaudGJpP3c7sMi1aMtUxYydGCLXhUCFjI1M9R2VgYts39cUECZpjKhpFMec+aPHv4vTSlnR/Ghpfpl+gSujS/VzoGDG/+2BmplooypMk1Hva06TIytupa1I0XG1oQalG+4PWmpHT5QsFT1lcGMOLP4obxN2xZivqK7UzNeJB+lslwmBfaPZtUP8mfOE74+uMcCPwTG/aOPwUUb1oTA2E6U8zaS4SmFvv7/rxmP5YHSEs1XjZ35+1r2P1f5uZcjOguX4hJ26l0yjR0gFZ8X7TfveqF8FdAfX45Na9eLen3tI8xwPZW9hb5XnIx6+dYGJqa4U+22F4sSqYjWEnElyKq+rHNRZTpc7Pgh+uUrKjV3DWBCl4CE7hII4vNudAyGrUE6jXLBEq0ueG/rUK/mhTQXUtDty45128gilSvDOZAUlUhVhZSe8Zl4HxAFjAd1Mq1AmDOyDbgSner52fO28YyGwOYLs2Ofpa4UllxMYPhIIsKMOCkGVeQcGfVRCvy5W0hkXDpQJILs2af7FRf8TIVsbOHzBHIkJNJXSlJ+SoWOKkgspY4eBvxZUx5QLznKleD60pfgnrh9xpSiZaXK4yjEf10+qGJ7cxtAMLMyjYXVdDQ9o0wXkLttHpzLTfBSN8TLU5oOTTaYgRZ+Fmf9PLmdpdzjHG8Szp9hsnWecvw+2p22dV60Rcv3lyalUUbL9x0MapbjNvo4QUOyM9ImLfcor6K44pSI1ZnaqJN3JB3pI6hGlJdL/WE1qvpE0WCP9haF8WHbMt2MlgmIO8JLmDuqlgp2b0D0mU2YmIy/QO8RwYYfWnUmVf8Iwl+o89d/KuOnGkiJTHfRcAVHKmxFn8WIMfUwIMy17v7VyDf8zyg8ZjnkudkWB1tkDERCuyWUEk77Fj8e3lZF909JC5d3MpCzzTKSScC18N3Mtn+YMctTJZO8pJcCNZ8Q5q2rAEQ2O+o6VaUmHDbO/ZYcrjo7u2tIrarY10f87bVlCU+ccTCpJI/EEcBcVLJjzPY+eCovtikDG9Ud/J3K+J2zd+og1egwUdHLJYsVaJUCfwjOg8xC9bnikRoDl8y/TK6hzW2Z10QEX5g1/EsxIoTxmeBdJVynrfadDqUFy3mgq061XwCycPwgM2BrA4QkS3AcYQive68EqHJBOjvPcMAjrQwO4FmlZt1j63Ht1acsdN0ssZaxCKgwNuFHG+5DVnlXyQ+AxxLZCuQe+TKkr/5Dhk23PdYaG/XDiQAwqlxf16qodbcUwr7vnNXSidSrNNUCHW+dAij/5bbk9pAkpVB6hPQqwOtAAjCditn3wG8DLRlaHYk3DdRdYnFpZ7TG4zzB+j1nHaSBZ98tA+oG5KaTSq2spgfPiIXZaBmAEACLRkUh4MbWeDRSNQXQlpKABblAfClYvH5vUxDmWGap+728U9sRUJPCctFTpsx4s4WK+dXqx3BW98JJqeSO5TgVq8UesJOOMuCGRd3PZd1AJaoJzOezcYAVdKgesKakNju9mjY5fI8vsxanRMF4+t9RKWMekN0tRXqU9gZ6Wa5XOVSMj1Hc5nBBZ/Wd5bXX+y+PIvgEN//AcfJoAid4fteiLC7KRW4GsGoAQq7Qxtmlit4D0cSy/Sgi4UK8+s60gYbcoUv/SCXqBzdckjpii46bmBe1Xta0KYj0qvf8vs7bYKASFFlsSK1O3DdIaCFNtuzTbQfWB516EnlXzsoz9PPnQy8xUgBpbEBGCqAOXHuauVQ30ViFsdH1wzECKtGk/excd3j3+rFSw6SPzmM147r6jY35efcZUpMUTsAEeBesiC8t/BJ4tLWGnQT3vML3Zmz6iXrho3U7zhfuEO7vmyVGlwsqBxv0dHXXDaF4Q8NqCcXNE48nGVYo339spY9uTBnTeQen1P/xbMPYfvtiMy7ZnP8bpCg2+2CMT+ON6JEJBoDZtV04f8y0m1bWhcTaNJ8dUA+aNFeYDvzV/mbIvo3AZXEg/9TJEEBVzHmnFWfMJNR+Kr0kuEU5YChyDrWkYO6gC/l44pWxEuNT/satUDecxrdMK7gMBVKzsxzqJPZNFT1CJgY1W5DjewBNWEB816L+97nfCD96k9BkvEoTdIGD4+JC0q5b9RzX0oMbGOQTl9gqZu3BduvSF/aRZoxA25aniZ8ivGSKi6bxjWxftCZ9GQfp4D9zYQk41Zgr065tecHVtofbpCbPAShb/J3m98DY3/U4Kzgi13esUm+Qbdv3PEczetLlIkC1ZCE+g3RSMNNQEVY7VjrAyxgYSpQs/tD08YuzAIK20VLslxFWuoSd6Ww/GN7orJdUeCGpBpZFfD8cEbicJTFQAQcfPlseGQR9e+8RQtrp8+sGWBOj+AruXuf78+2aUJr1FAJu1bQW0alJynqfSS4KGVN1GafrGHex8u7Hqx6jLL01Xbzj9tUQbBMeHxBdHLlrugNjS+t97AaCT6mSH2KvB+p8in2Mp8HEGsFIdJ2H9uNVnNuLcb1N4elvnwaAuoPx686wiwoHEFKRGxFt572xA60xQKbXt4gZXSnBuCjPlvsz3mWU42Aa15kVCLLTfsgQCeoFA/jmT4yXJC3SV+yX1rdTG8BOssEsfDEbDbN7gHyR8b50JnKsHnL+gHMxcY7DFu0+warAheIpzfl/wFbhLl5XHzKrw86Mc0hx/48uWfsqXNCNw9nirx610dUfzaI1d4tDNhjEFRtJIQfuMckflcIJa69iREfJ0/aGxLn9JXJ1jFzpFKJYbL439V1Z/dClrnwgdb/xbPyZ2g5Hx72NIyZJe2XUbtCvI8qKhzTJA473eJlCmtNdqcasS5Q4YN8D8zbFU9jeisTgyHglCWyW9t6I54LlAOHG4v2AoYDcu1s2jJYNIJQsvlks2uCXs6rAWUfBQCC4MIiXy52hGsBOkhWiw3zWw3sJCWjUN93sJIflT3N+6UbHlv9eNFymhdHHjzocmNSWUX0V2fmIik5rRcMp8+86eSPQ3iVgWeyKgGc3GtLNWgGck6Gai4e2AlFIrQ6h19jaIONGpX/a/SrxC2EDkFrjPS2z6JmM6iGy/VI8AmG3OWjIxPjKEwIQOqk+R0tm5P7IwLsljmVFcDPN2WGRGWVHuHdJzpNsJoJfXwyb5SDt/H/q53mi31q1jgYU51l8WndwsKR2x7d+q7OJ9fSne984PfVCnid5xXD4gGqG0d+AS/qhO6CnEABYyUSoAHtt9MIhvKOo94j4oJKnSQe9BDsplDKp9CKlPf/cTlbtZsEBhrLgtbOd/3shA4CRGPRUQAAANALAADf2FvxUJzr35eu1KnVfIHPmcAzupasu6yPYRn08cf/0G38Cqk1YoyXYgMEyGZ7tZv5OHhn32yLmRyr4UvZxpHKtr2Ej+mS/U6WR9zx18jwYjkQX+CuoPYWWu5lPCU6if1O3ZPh9po0JW9cCbP0aP7kEm6cMuT4ArDr5H8G6uTJYkZ/DcNHyDeoMBs66PdHf7b85i8ATnAYz+txJPZ+UP7QBj2h+g7pWgMYyp7TN0C2e01sTpQyjyMz5OeFS8tLbwhIHZwb0EPUpT1mHYepWEocjX+d3qVUQDkB6VDjOh+gGN7HyWKqREEh7zIvFBdrZy/s8fWlX56VLfpivs37vJFuOYkRooL5tiBEEN+gTM+wbWs6hSwg1rwGo/VmnXgEbex0WFGqCn6nNPEMZQ0Rv18+rnJhjo8MalrEyAGTTeiIXlVHF0V+xOQLh+nENsz2HlQiwZuifajX+wJgV7eFJEcRJoKc4+4Pxpm+zWhxZe6uxf71cN7P6ur5H1mHo8S14mW+P9uqUnstD7zKn8gvbhtqdb3OhFaBqa/i4+Y5+sAiUlqbTePCk5hchN8Dz07Xb44nYYUXYkPKKagm1zJHfdC2lYJBOxG1DoQjtR1T6oYtEQz1c4X06xhvs/Rh255LvX/rIX85SyRe2YxuUwFQcUPaASwQFBoMAlr/JpOn03UKlUz6PgoPn6uoJ4iCf4wgicOU4BFk59Uf/YxUtVB+YPq46H42S8WIFKFLbD4kmulV1h7EvsXEht/CP4SH5ge6U3ktOahmt7tY1ug6pAg3hiU8QQ2Zi8gNTtpdnWK820DjWWKeMkUsqM3oZBY3LYM81iJT4LI8yFqf8FBSSr+YIu8bdBByZDD+xGqUo4KnqEAM5nLms0ZifMue6VvSyS8BLilYGj7ZtY0gXYS5bEUfZutZxzfcyyxrYeh+9wj1GFwZRX028gFn0GvtmP6VXIds+MZjN9DZIySZ6q268RVbxSPk421j3biEEQo1XDv3cQzazKYkFD2nG94ZF4dIGQRGdHn/jBLXUlX9MUBqRkjY8u6aYMzWL3PIE//G7OR65CrVNjIKRlOJmf7by+vDD7QOJGZKRXhEulfLYj8Izx84dB5ThIIAiKG/h0maVLGL76qIqc9gvdnyR2acYNq59ZkZP+yo/fvNkRp0tmEGh8P23WxiL0rYb1tDpzQp1vjut2iEs7TJhmrWGesnKpy1+eYl77F4FN75iWuqXIBEF9So2ui78WrwxHldboY0UohfjNisgW/YZud0igwje/c/HmnTK5XCfP1d5Q+4xyFEvt2Xqh4R4HL3MG4ihwV4MybxG2mQzBE4dhEZKthQEnlwOW41y3KjxolKSRFKuGLmjPqgen7zoyblcoMTaP4AlXK1ln8qbCOY/qZvRb0UwL1e2cT8oAcZWIWNUjnwq8CQT7wJqjh6pvjUtDm7aapZBJ9cx31UuwRPcaMuU1hTVY5APUD4ke/+y3d8AvqWtKhE+L9KrKClGpsA1E55hr+AeYofE2nY+j5S5gSdsg9g6MfQyfRaZn/ItBmmyNWARbC2BVbY0g9//JYl9QLoYKLIm+jGZnEYlKTElz//F0JYfx6DrJQbPoR6vMzABaxWT7BYNFthi2xOXmGTffnDltfa0v2rMl6NDQ/Yz7egvPQRfTdeELccKwXfg2pcJBrfGdVViSK//dBA9eqnCFjDgiSYFrF7FSjZmC65ESNHsCHCW7uZVMn+2ZfAcfg0FoVt5Nbm9rAsbhVX9sghNumVurGHUUsA/1CURdn+M6XmGcXEB61Oaps3tGDB6NF/0r69GESqcjhZ0TxMrnPOTxnHtHH5oSiO3Nju8Pehzmkya5Bo0mhkHhKM7e9zCtJK2Wg/CD4ifGHxQvRtoCFxtJXv126zgmXzv5adzbCEmXzNG/Am9L/uao5mGLS+1z+iXYPTNT0hBZmAXINN1SaUkothWUhEbF/XZMnspTVaIRDECqK/N8i8zuS+oV9rhgW3dYo3fhfHHFFsKAv0IaCGYpqYXPDzBZP5Y+pBKklgGqK6XXIMY5fnynTmdnL+4WHGqftHkki6WWbrYpcdbJcGtl/gKyEF2wSfAAwPvyPW4lqRRCRzyZdXg1+MK3H1iTaliXagAzcwMcztxTfSfqzDsdAee//sT/xYjF7g1QqgSduZ2nkAzwDptiMNjgKDF7UKuV82na8arCRmOo13jEjunSwuppAmmMROgJf92l56HNh4riuIHFgA33lWmXvuagvEy02hzZhl7mvGJpW9Ndf49DZlU0EiTQh57UpUOsZ+jzJDjeMg94bis92LGl1S5Rgqpz6F57fjvXa9nkmh9XtcCqcwfHYiWuIAzakXQpfEMtNyOcumXwUowF1bYzPHuYfKMTzap1xeZSIay28ExyBI7cNbkLmJrhPFatuLGkDnw+HoTfw8CshHbhLwS7GsqmOgqPYhVd9GPmj03eoMO+5JK8zmDaSNZtKIHyykj4cnljJzvVrdWnqhyYYyXJoLpOPKbywzyr1gArSYi4YH5mHxxIkSQSpYTzQRiK9ic+io3JcPtWdGvViM4KIisaoTggvcv/iGy1cQnnOJmXb8BiHR9Odr5ZmvYxFqmKKFcm1Xca6oWc7UXI/bXWjHGWYMc46xIeGPt9jRXikvTnC0E5MeuzuAj2MfURcwAnATCucLPr38u8Uv3dG/giQuQZbwSIFGP8+j7qXIO9wUTJMpx/5VcARNaWjnijCnjldlRidC28LwOt5HHMZDgNdGaZoRCgQXixoiEy6hHiOffEgrBiQkeX6McQG5NOOBngKc4kT15C+yz6FZoFR8NvubGB4g2f9DyIZ6UjKDQnJGpKpQgp23O2Np9TOtis5JBg1+LUe5t+RF5er+B2V03GJMKpXYFzoH80NvpB26IzqunqlVpU3bY1PWcrOJXZTs324Kl2u2ZXTd5X/r2QCfHqCP3t9Nty9f7bmaC0+Rh/3AiFiRuNa/bZjy0XbvuL38g2eF6qacWp/Pyp+6LxIrlw7h0Zect6OPwBndbaKUkMpddT5OUR/6M1i8DCUO0T930ht+P3glE2PkT2lZeNF97hG1xpvxsG1LzngI7iW2dIgA3W5dETHlvreSkbIADKoe4fU8F5z5Ay8q7vFDSLbOnqzbffrYXKddbAzb4swkubHre2dARJqZ9LK405zB8CJ2DqCjKsTDZhc6G5gYVinZl5edgZiziNjMFCsiXZ95gYhiKKhYMFcmu2bLwUcdEwq7eBugA5fCX1C0lsR/GaduJ6gIw0S/e1DHOHyr82rlYaIfWEysarXp5l5iQ0XTVZc6a5+2A5RgT1Zg0iIS7hNhPY1xtRW65SJa61r/F2oZyLfb8RorogS3TeIVOXK6eOKSJNO0+SLA6epRZkaMo2b3IUaFAR05hKKQcFcZ9eIq0DKdNMWH5TGOQ5PQM1jvqYWmrBpsbL5u1BBxKVamo6wTpxqI5ZEwkkPy/Kwj7eJDYumYirET158zVq71FcOhg+0aEhEvjEUYQzC6Fm5z6M34WU3gX07LjRlnQvdpe41U2odZiGxpYsTuSF9nQU8editsAmiKDOp26z2AFfrs02rL3fEB3ADH13YpmM5LMz3lNx27ktnXpvdCWX8KP90UQLJppLP1fgmwXnFe/D6gIggPn1mOfaGlSwj7r5FDQXLeyfdjri9/K5TccYA8bFDdMTQmMoPaY/7mGfR1bzJkYderabjLhtHjhUar+YrZ0HYiPfQGi5YtXl3BjZQr/xgM0lEIAYCGtYUSugK0mh5vvPr4lNFX9ER9I3TROOvNoVQMy1nulcyxeSfVJXnwEFM4xF66uew8BUA/Vlcrqocpug1tWd1BpY7PbCE6pVP3joDhLgtlDtCWXP9hyH/J6P/PBV00gStvKvNXEfPE4ybg4g79yW0+4EK0SC+ntTGMAmG6YbTOdFOVNPs9LRldWWD8GDTdYHhNCZVcuY5s4paULAutAEcqfv2VOe6Vj91OpD4wD8a85RbyeNYFT9Vb86EwG2BoUIRvVUfVUDjzMGKPlfMmwV8K2uIAAAAA');
