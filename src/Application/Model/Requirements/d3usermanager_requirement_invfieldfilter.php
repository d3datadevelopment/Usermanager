<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3C5797783AAQAAAAXAAAABHAAAACABAAAAAAAAAD/d4AwzkL09su/4IQFKPQT4n3o/qWsxf3ILyi2hGMKGvqkW4kFuvSHoBLRDjHrEVF1fWtUuNqHjAQQvodglSDfGZB0jdw+dtN23nyFQ+/tjNi/Fi2NHp0tLB2q7bI9yTUNKKNnCfgEfmZuXu6awzeQlggAAADgFAAA2s678qrPI27UH4wwpEQm41mkX3JNI9J1hksfIFqzwsyoqouWdFB3dmPpSmGiJ1ulQFSKXKJ4O/+d5OMYOyvfvXU7raeU0wqlWqNoBPAPVlDP8XtEU1iOx/gqgB2+4Y69/ja2DXt+r7pgVCE0g1VPmtFphorntymmQ711G13/JPK92FvrDSoPwTSOWXWBEKqmT6RRehdxCDPgeg7mQPVwfjIpVh5ECEDw8tJeIzhUcYuh7/8dfX3rM748FIkOPoYLK2utez+R/Wxl8H0E6X4OjeLAbuUOkeGRQZgrGGTDBmFhtmA8FN07FLS8cy9wtjMBEt9CtJl6kDsg+EHwq0hYV3yqNVeDcmK8pbHpmNYUMSPO5nqAaX38gmgo1WmQXzqVhNbLpJ0uPG6XYyA1RMOYRQr6Xtkb++8yAXG0vwYSolezhbjWnjDzjZvSNAX9LrMHeEK33Ha9X/lOayAAlxGsBX3HXzEFtE2oXN4nRkS+oIwOxevGs8lchY+mhUQdBLowLuVR8rK4C6Ia7mxbR6Es/ODSppdqp0veTvNy3VyWE4ehtrnUJNUuPQFxH97B/xk5kYm65VoMqAJAetiy9dU9PUFeB1Xz5E1GN0mqsO+kyqDFfRymGc8Ypn04MHMAA2FucKq5rqw2m4ymF4ssussrQvb+8oBa3ynWr8m4Hark5ohjlUJ2Hj4dn05ZkxGE11wnBMCKBGoY+UKV/v6tKpuiODDISwdUqZtoOsdi/MOdeJw38tEouiTC9sJJFVpTIZsIwtRufQ5W/3Yleq2j1DQEDabKMzKYAo48WrNUdhLgfOWxE5vm1fDBovEyuRwmYAG8dd997q412y37RVC4m+hro723Pv6Yfb4AAlyZtmUhrbl3UxmhMucWh5iwWHkRCgJCYdV7abTlHhDuEU1oYO36y5bH5sHg1HtJMerKqLXX9STn4Pon+Z3QRKWFa1qZ2TjyyursR0Au6OcQivfD0W1Lsy3H3Izl+xOyOkH/Bq7/iSxJa1feWRH9c2fQ4CAptiXM2m2GWY1jkd6OhFk8u+wXkeMP+aVc7mEIL04qO0GZsmbklTmDIQeiYeGeXbu/ZEfWzo7HjxzuY1T6BKbQKlRGV7CgzWNk+fBHkuzz6nT8ZjvNq9NQfJZAOJdYkBKX8ZVt84k/pApJi4blFrk02xNEE/EG10zOdRbS4W2EPSrvkw9MOUa2du+/aT1mEyrdkKFmPCLXZ+h0Q8XYmy7hcH+EMxVsTI9G3rRev995XEXRLyO0dGPpygXgPdaXGO37wiSuzUyve/zgL7BPXjil6L5OtHdv7vFTMLJng323b32U/BU3IWf9LD6dq+QiDit32uSewuGRd9NdLueujjGKz7H5NhPNdhM+5pjP6nKOTGeLZiBntA1Hgr/s5f1OG7X21Wz8A28qUOHmZlk8zN96E0QHTHmKSslSTJ6tE0y8154N0D3MbOvJJz6EUidXt+DpFiuDs4rePsvaiLMolW4oXliTvzToFMgfju2TasMoDhoXWcpwjR0ELQEMw1iQ98zfN0qR4PXa8/EMsK+OClkUxgSz/zdISv3Hj1Eef6zEnCNjb8/Eb0jjJIK1B5ZHpVyyvC0FbtuH0g9gIw++EgjZA2lqc3fny2e6uUUIGc+REN06kIJN3tJPj/zQnt01k7IIbNFCbGXkujRVcokQralazKA3KyqhQQuQlLNajyeWBmeydk0oSM5U7KUG4WOsmwe1pgCGT0Ph99gmPpGo9+FhKVzdNZgW5RpSqfPPt1jQ+oxKsUytXMj0gggMxGPP3S8Woe7yuEYWettDnKqngRwmXof5nlbkqCYCK/mkuZUDNkhr8ER+K6dLEV3T0mVroFRJXrR7DUydrV5hRiagcFjeaP9eqmkGYIoCXBaGxG9sOn/jUFIZay4crZD0DGR2jDjIWKC+TkohZ5rvHdKG4Otfj4ReE9EprT0QpuJD+Kk5YCduBoD8xv3sRxNPukqj6r4yJ7ZDNyFBh3RyJvc6CwL2YALvYvIm8Gv95lboGi1Lay7i10e0j1KkcRFFyhXnm+EJTBW0MqzGPahpT6wI7XpOnWyDpffEudHpH6rGrP/lSQfWy2+SDk64sKw67ZUClikpQqcJCDBSmFt9vMhxqbpNv+z/yeecl7GUilttNmbQ+4iUsMyFC7QzkcHSLiUk40OHY3/Ha+EovmwDXkzkMOOiWmYIva/s8D0THalhr0ALmAi1MKQc4smOZtRGRvJvgERK1uJ/882BgygS3lOXwaiFBetnfhyAQhFWm70ffpM09dmPpeoUem9cNVCjZlzZK5DkqKj8aH2ghjXiBeFcK6uAi6svlL75ndVXj6INmyoIPB3K/PA5eYNto5C1VR8j+uXUkXmZHNkXMeJcBf0GV98194xq97gelequY4EltlmYsbK6igJCzrkKIdZnOiD5dF33NjtYOWV62y4YrYuwGUpiYOhnGnQQKmCKOf4LdqY07SeWQ/8tzjF2WR618d+azaQPrqxFSwqh+4dZkrzk0gDf1kXMuctDXlYe6Yf9OIWxm85JT98O7zJrVjHnpj4X7rjCn7Hb/XputoSCbUKzgF6HNIppc4+i4x/gXzI5EAI41JJTebJB50PhQzuM1hheC51718w34OQB+aDNsBeCD84ArpT6LsQUh2UOw0WSFhscih+Kf2TGsluybcVQdzvDb/17slJbfUmWXt3lqbhwq/n4eCXxq9sIoIMBKZwkkPMRyddbB3VPz7xz6RAuM2BBlZ+ZCHAV2dRda/lZTxiChTcdYLuxbz7GQZa+yXnX3WvTOE0l5q9ruu+GhhwgHk0Rj/lvmwYZX6j3gqReqI9McR41DTTHtJKyG2uS3R/Lv1oMNj6aI6ikf0JFO0AhiA+lvVEZp71Uo68TYWkDqxDIsC7LuZ0g/ViWrASVp3Ne4NoJpSIWegZoBZiV/alqk4rCpnR2+zm3WO7QIJFdmE2p3jc+0qLW44Ud/MfkZmuh2KUAqgto6ESDei5X1u2b4H8xIbKmUsTvlcko6WpbTAd016nN6DQb9//DCsPbxoeHscNTjoaZxDYuajY5evIkPXoysPv860+Z73dRkvyFM+YRgCa9fggrGf+h64/c74vgUTgZw8L6aKeArpGgTvBHhIwSGMiujzy4FhWkUXI0viBlLTS9APXEeaOknVPnQdT6YaMAJ5WDFTQiK85qXsX+cRGDhOzUxB1IuujpXwhCtsUFoPSvGtCH7q8GRknVH4EXQA2w926i5ISiJnX87rNUt4wRFn+A5B6xShYawlTHhOhg+ocDhEeOvNFvySKjUUoRa66hwygkOY7mko2moQyM+4HRPBSWvYz2Z3uU3ziG5DWlgjhG5TrrZwjTg2qV2SV9/MkUPzQ19UXNKYEd/WHFFQ9qM4pIecnsuWrgGRMjghfCaS8W1/nLM5Xm3Bb/pqGbhHCAhM/0zmua7Pz6w0DesOW2OjAEZN+ZEnj33AaToaiuS1o6Brfg+UHtk1XT7/MZAWLqVMxNE584twcjt4/ropq4QxsRXBbHDN8LHw7etu8+Yd2oYJ5p6QQ8rmYFdW4mVAvjz3xRypvMp3OHmylz5FkYE5rlza2YUjtwHQgSY9GpMAYJxhe2IyskV0JvvrjpnSYsDPAgukZSb83WsoOBh/bkeqbJ03+E8NwjhV9rypudwi3g5pNjm+CF14HHs+1idxmufgPlSmIdHQgEhV7R5+lyp+yjDz0GkmHeIvxS8atR703JEcapZYeEAx8HXs8r8C6uFBwSTIBlcl/qJirSo7YkUPtXU2d8620i0WW/1B+3+eTEzyFc7ClER8gUCvxILGdgXwcjPC7ConU4tXbsQ1/XE/YG8Ix5lvP8Taa19mHl8ws71zIz28xmcTfZTzg8ZFrClzRDSoOrxUCaNnir/3oKFn2ftYywc44YloX4vD/Ba/3JUIYbTXwz/WCNwsQQo+fJpijad9Hl81fa0s3m167QCvJv+Nl/VlIbwvpMWy5sb4vhOiMbVAugigtcocItsGose4XkjNHrwG2gC/v5jH635fVznU9OnU97n8fNFmfj0dRIEVkGTOFUiJgvyg2Fu+CQMLb3rAQlKPt/EUjR2bhSiJv4LBeUHdZtwip8wqP3vejzZoMdZ3VXxHC1aIOwZMZSJ4Pszos+LWyqk9m1XjEB1gymctJ4nuecasGh5nqGhxpK9Os/PO7V0gJ0v09c2uONjTsRS4H7aPtLf9cdyXqNxYiHWT1DJzkkUc9j0LxaqldTZ8AYtNTJXUObSppvI32R5usqanoqBUf8uhZmSjdOHIoPl3Q7yD6mjpbIigTcV4YLjda9IKr13isx4mgC4sT5Be0SH4r/zOGY1C7F8/6lm937R1HJkcNdofaCRmgbF6bkyL9tbQJ7lyLQeRbJ4MExbSMur/oZjK1fywa/c62w3fk14NXjX5C/iFVZLI4/wnqbtHNsg2UgCN9WnaXfGUUwAIUK5i/VVXH9vD4MRbx5YX9KCgSc2fZkqif5kjrhDZ31vCWha5B96QMXLvqF5MKLfk5HxYVnXZDh61JhudSjfc66wQGVnuXkBGXO2QklMd74qoE2XcXu33Pf9jYd0J1SJrJiPdWRLbYYO+aftHSn7MwBjkAAEcggsbVNUU22uIyZ4DXXsKiQw7fZeHO0jP9ycQ4Ox4b2QQSXUCiADwKpQTJoSylkk6ms4HKE0QLaRo9wqsvPzZnFa2VSlQ/oFbmRXeISH6Rc6b+X4yzBFDJpoqyNpOVBSd520CEU01iThjM+zbLOFz66frSPEiD/+bDJel/Q8rBh8yFnTj4sr/zX8WJfBYQkerb5MePtLJBP7A7gYd4lxCgs+zfodFHukdCpj5UYtQIu4PadCXVe2tuU3W/pwvaT7xOjKBNC7p2PZAjroriHdna6OjKXMSJ/qnEUsqqX2hWjpJqFGa56Ml90PcbUWkgNdoOxcePRP5i6WuchjwZ/Qnrmj/MZWV2PTfxstyUKCDpMtQE+1aPgoJrj/+55dRTLPJkUA+bG6ICNUIACD1TQLyM5qlp+lQOGT0moP7qcfrV3nh537kPNLCci/q1E8QRTS59P7u9cJprYVfx92gOyXllutEQGI/gQbxZoBbSVPu9WCTcCoeT/CtrKr10xkbImilEP90OJJdxTJQd004IQaOIlgx/WMcGgscWprNudKn+GMoZz1YTyeTCnSbD3ctC7lBuxHP3YcwE5qZshfs6r2JC2r1yMXx1YQ66lToTp+6wl4C1zZyJOnRIGuiUlS/BkWj0OXN+wEBrPVoXY0i5+roU/BrL1nu48XaDCbaFJqI3glzP1HkNLJWV5qkDhdmSeW0A3alu4AdtD6d3SSQc7fCKJCF1Td4kYdL6cIL33jOGJame+QKYIRhvbTmBZfQZMGwfEkEPj20aIPS8M+vrOyI7BS5Ut8OiW9XB6SauhkDXVXCu/IEV4YeiAbikKd9ivA16bTmzsKCOuhvE0x/v37C+gUQTkvYbI1PisZ1+I/kROAF5yTvdKyD5DTZThSQ3obs1keAYic2TG66hD6JPZe5J8fhLDeqmsgCG6PPey8tecBRvuuHOPsTIWmvyldglAp1AuT3ZbnBKFkITDWTq+Y/VxCnXfTH+Z/trP+XvF0vufmJ2qU3BwLTO8iaobM2P1hyibm19NBZFrCBE632HJAijUWWl8KB9VE2csL7bwEdPdBgbsGHdCKcj3hBtHH5yomKqriqTT+n/QJkbbOV3DFMpgyt36xXA30z2kziHV9Q/TQUFXaajbJ5kdcstXbRT8ULh4Qrj0JxKLoW3oQUUmzBHzHJe+qyTGLI/dIhz8AmPWL+or5+QAQrAjSJIp4ZZPk7yvLiG6ZD6lgqRtUT56qbnHNGlz5Un6zDLI81KPL9fv+NVMk2JQhhC6XK7tYY2iqJKEjQBoqAhhB7fGSoKGJxUcclCpUFGMBd2RQlVYjYgOLMDyeXvAwExAGCk50Y0RYb5pqB2DXl1bcnsDh4I3C59Q++73wvV7nDye1MR+DdMQh8mPaPbX76Yw0RYAAwwXfCjwAmMUCTzbAEq/JZJVYPJlkgBfFeGUiMxLRn9UyCvFhtlZW7x6ARpm/BraIKgNaoWTm0/iDSOe/wR5ShdY2pQJC0wnMGnvnDjedI2+nTRWJSV05QKRmVA2pE6wiJBGsqnbYDmEP8Te4hZE9uqldQKlntuKgUbzpfFzyU0/P1MVPJD7FC5TdMPg6+e/+4sffHhRSeWbGkmJ9uPz8Fukn0k1VX35NNzGxNrzM4Kv/yaol4KojnYM0KrZBc8mkJSjynEgVis7Lv4g25NQg8LS8dCemoKhOgoGUYayilR78+gZO6fYLRc+ccfyR9J4xagOGZvfTbvC+XcVr5EUO4IYqyisD8XdeRanFa7L4BVe03nf21GUwCQMLs2mOQvY32U6PN7b4X+Kj2fA6frGX9s4zS5iwIelYH1D0azRp0Oyz8GMKXdpZN2WOun5/vkJoMVfkWpfyG6H3AIriUPMddLV2uAKQwI+Mu2SfZx9zXz4bHWE/9pL0Zvja2+aFwsEZ+EndZ4yGAkn4U54a4pbS+B5I/00tzl+ESQjZDEfWzvUcUWdmemBQ4FtCuyO93n95wynUhjoNmnrBu3v/v5MFlQKkjkjPaJPpjN2yvi/N6IhhWKmhGrfdVf92nQMi+T3BmZHiarEcQBkrA2UHqqFjY6S+xzIUzUNwTy8p3Y5AgEV8VrOYgPu9DPuhoGZt3khL5bjDj0+EChlOdwbNnGQ52qL9ajxrYm4DyFOZwHDEZfgHdUI3PQOCby87VHZC/0ucu5b3z7miDb66IauDkm9Z8kpben3qwb227+GCDV+0cvITE34Re7LwSssi3Yr5Z2qfjeaH1lIYfW8GVLbdN5Uc26SwpfujwVSwBQpE6c0Q/rn0CVnWtETMyz1aofduZdM+LC7FIkFt3Awy11Bvwl8+vixA5qyyKShUzunPwdBjOPqY8sF7OKWWR84xluspo8if9n6BQsmJi4CmCiPwPKEt2Oap2qEkGQBHF3Dw9qvO2RNJuukeXFqQ3N7o/7zKVjNR8Y6CW46/rxoGcIiijESAkSy9tUbeSsn5Cnen3iRZ1qcv+nrG0JuVF9WcEXFlBQWjR3PW4OZ5PzK1cmM88IdsEIMqVEAAABIFAAA1ErAROflATj52FqMmDrJQJwtg1XFbsZ+7GU2EmDQmGHdHNT8Xf5UCCSho4e3LZkgi7OvzxKS09X4qxnuQblaidsCjszC++LOkboX+nnZdkAKBgI1yjNlhhZyf/gySBB4x5oZz6xBrh73ffsn4pyJ/y7xpfurDq/tsqoAUUOlp5YnkzjDOuJtaDQnGM6jQbbnr5jJA5u7tEe2yMDH7L1yZFJBTOqnz5oJl7gZsfcHGRj1/lBDgQWoNsOY3zQ/DEJ3gDe3ZLGKXmsBDo6xbYKcnyvC7FAOz0IPq/LyJFMPwNuLwJGx5Ndctvo1EySeGgWmDaTo0RgW/IUeQL1PsZh4IiGqQrDLoQPFA9WwZAyi5FZdFiOzfNuiYzU5QS2bN0YevnV51zkzWZTzh+ppMgaFqdYL/sjfrRxxUadxbo6rpnf3LxmQ+nx+8+MkRgXFspFcN09fhss8FUKpt0befnr30pkNkMpUfOkPSOvbN5IS7bL1cvDW+L63yyWNLOC6RvZ/eH8lwhM3PlRmLY/NZhBUiYAvLghakhKhK1Wr+fWQ3bwhrdb9jBgGVcTgS2KM/O2ux+065mUm73norJjfy+mDX6wzMmLx3R5rBGxf9dwazh9hHX3thkWq9sXAasAg33b1VsaglY9IAOiBdoKxoxrKxXIqWDP5c+MJCMoGd2Pki0wAms4xmGR4V8/869scFWsaGNDijENrrDzD5GajE1ugTfbtn6k4qFOmd6AztrENQpsQDavQFtq+iR8H2OFIDBZvv1YPARdS/ki2ygPp4+2vQz9CK+YMMbnYkXbhBk9ZWECjBb+qkKclBdO2sWXQFHfyQUnpy2dooopBizTxvF3eqHhPeiIaWuymkYmHFqrgIAVUm+yP74uLcyqaBPcDEF9Vvs1pADKg74cQCQRpgRdbzcE7OA6JXlmbBuUoAyAx3lYlCC5Ut3gXMAfOXv9DQQs6n2pq0TRA8eM+c8besYKC2SN5jAAO47O8yXcTF+XTKUKKjo2k+KuYi1a/nvglRv46pxWsB5NatVYqaybCunBUvqT+a/NpgEnZQAjr687b8YpPm61rwumLbwj+13z0pzhLD4YsdjBAjwJx3JyiWv3QiqtTH0+SoMvhRIIxc0h2ivhb/2jcsSnvNYZELqnVJCa6o64cD+IWo69rrPXmFEGSB1tspHFuqoSTzUYlDAwiAmKbAIjlpQ5g25/Fsu3K+3C9Rn+9cs72veX4HImusUqK32P2n9fbOaqcPw1c77FLO0I7kRNGTXkKoacZTs4xBGWWIdSbW+no8IPCobQnMFNo5c+rjrNKXezpp/tTceJndzPpj+8aAMbAm8OFjoAfjeQDeJj4BjhoiTheevEiNuZHr+aOE3fY2AIh95hrYZYIEEbpBqRijmkvgdrnY3OlTw01orwSCatM74nx0mulw3EGvv0Ib9RVxYnTEdmIAOza3LkNZxLC2JPKG/nDMwuGqbev9c1ix7Jz1ZhAI4qe5zpokVQCU6tozeQUesTrNYFiWsVx/bXLppwOJeJC6N4XM3U4CD9N76Z5yY/5bnaFbc+EelV/mrpv+y3oiCN4Y0bjvJfqDcqf7+k1GbyxieTv9FdQh3qdTipx2KjGtgR4hLhOfiE7TFfjqQZs9Cqx3vxDhE1jJ3GxhWWYOHRXGCFznXA5CVOw1HAKQBlXu9ZCP/Ds/k6h02ESC25e/2VygM/ejunzbtBkMzDTiaqiH+LTXBF4H4mJjWR537st+JlPXUW0uHkdTde3w5QUdN6v3vmfQG76hEswyP8gOHHmAwbsDj9/aR+7PCSlHQ+bn3F66s7W+wa3RXZ04JMgFUk0VnoaRLikSkMw/jGmB6BRipgjvYgcA4oc39MG5IIbMK9SLTZPB3lmFcv2EJ1+pWqGidtCSbfZAma/K9IWEo8px39XNXroGhJyyOpypjq9Mnydkg5zBwiLwckUnLZnYRBduAPfP81OD8r0pWSSj/xLrsde6SSrmCpkW3KmwmXNu2VM/ophkrxDsjjJBrC2rGxlGI4d4fxzyU2Ushsh++QLCf8QN85cPENnHyfoue3nVrnHFuBXLZc4y+ZXaC/EDwRmcIQx7ONwIvahYbmEE+ahg+JiDDGU+A/UVY4MHIPWwbtRIsI2s6pdGJWmLuQp0lkFY8S0cpe451wTXnEsdBq+4gZ6pXiIpshTIykMtwQQlmRSixA4fEK/Ui7HXt0KCaEfoOUUEOoXgKBfvxZwzVdGpwVH/LzYFehIEqE/mp2atiap4b1dKDVNYP2lEopqg9GBUfIhnyFIxNr27I+oWfumhYB9GluQVgbGWTFEg440mqUkMZV0ldb+cKINKEcXN/6p2dFzcKLiwmW9vOCTFsQbGnHN5heaKUs82RMuomwcxLgfLQVJBNjnAs6WM1QCd36ie5FARRQPTbl5+TDrRWrhqEAY11A0BL3CcUYsvwNYKFkdnfbzTthRt5rdw1SPQUbdJdEPT2ICTkstSBCQ4CsPOlLmdTGeCj4tjEN2nB10ruxEj5wdlysFoXVgdvLb7fTWQzf2LTX84qEnTpIiXZ+b2cbVX/F3HJq+24tG/JFClV7w298Y5Vjak1YvIWWF6gOBKaBdfHTPhzH7mEleXg7PlKV7sKVhZhW+B8cXqvkYHDhlEQwpQxwpooljoAJlwL+qdZeUdYqFe26k/JaBeR78dKoS4D3qpsgFUbmTAkwNq8Owlpk0iGtMTGpOjxhoxWZxBK0z7T93lQbaHUKv+BhsvQY73SN0XMaG83qL5jHhpu0hdvr2wdjiOlQ0jgNLGO7vykfBfgY9/qpKu6yPMhe8g4GfCWrHudfBFCQ3qbHE7xqcVmC0ch2ZTKzHBXAZr+Fvss2KbraZl+jGXia/NHb6u9CDYNtPw+fJJVDXEA9N/8qlTD3vml0pZZ+9FKt/00eZWU3wE2foJQdqvl8YkQuoA+092RhGHZykiXkr01XG10crFipDYL0ywPXqYn2AHCcOr9LjB+gcDZ5qEBPDhL1c44GXqyTPpoEopDrozh2PSqehDryyFrKhW1Ow555haiD9DgsxuZWpwgAxA/5VKfTgb+2YV/5tz83NGFuvoWkoVLf1+86rhSsm5ccSwIbk6/Xn4nO8VH0jbN7Mr+OCLKMznkl84lcNKZNa4bYglT2FuHnG444AKjtbbj8ReqUAdUjvUy6riOQK5Bj4j/sLnRuvvGyOiE8QXlO2V2OIGi5ahoIK7nq5aJFuckS0MByICuWCl2XcF2/TytkPtgxxtvCdQLOfsUV+t1FJzteARP/GoWiIdxriHe46v6wsE8bIbbzoY5zsSkYp70JyJrs8ZNBwPMuWxW6lxubtQTtKBsA2Cp0VEyycf/ZDS8lRxlOoFeqriLXC4yxjGTLCXPi4IDbK3Ta69gpwugt4ytuzJ1vvjYTZ+dOfqa1Jf7Iy6HeOkebOypXOW7vUQSysxC+VHh/zD30cAfvFMRy3PpiyOPgvQD94FLsigsnL/4jqzVlCCdPWZukrjV3CuFvSK5lyMXg9SDvM7mjPLl8O3y1lI+4eC1clNSA3jGtyRyyI7Ba0R4yY/rNWUD53hTU6da6N33pj5jv1KX9XA0y4xjAtqMmdhY/27XjD4/mSV6XBFbNTglhWpJ7gu0bkLA8NVOzu8SwxdJHL8nh3vDDjqJo1jnqXdMEJdopR6EjDFQc0yn/XfI1yJlrSDy15W/uZ2l1B/mJRyZw6IKoyX6GsbnAP8t1Rc8Sz8rqeZRik4o+nYHmC3AAVrIDv9/XwUx//16jcTKjrtf+udWFrKfKkhonINIwuehi1bgoCzbL3Baiyqez8r3Ax6AvjCl6LKYE6reG8H8QGD7m/xI6rFSuDl0R8cikJgQ3YXcocQC4cxJ7dXstf3eO0Wxkg/mvssBAeW7kXHk/h5FLj2ZTcw7b6OJ1qC2qAcdFsqw67PFu9Xtjp6kFgZPpRyn9Mv7vE/wEt8t15WzdjuqJ1wnvpmgbJLQJe+p9eSLLow41LzfTkgZLvRY2P+6vi9WOXL5mfS8bDKwiE/KU7Gu0/jBe4IAxS8gs09HOud+HjLb2/izMAvH4b/1h1zgvXdwD3E9N8Hcn+ZOSfm3bhcCRz6Kov9+BU/XC3iU2XJZrQY6mGm6GRrrywfS84JGudhZ17gHY08zw+QmLvEW9X6/WO+ZGjFjyJRQUVhLTzR0Js5LCsMNO/QrPTeUZUuoBf1M7972TJmmLZzEwZu6hvxs1d472SGuhBLgNjReSqBREl3ilWOKKF7Mo5CY2zn0Le3bgRvkenOrKdxQ/s84+GyXRlb0gdLQAQ6atiyYsWfNcqnDRuZ20AFf6199XsqK7+QUWJxrvPFPpXOqXnWFL1C0VevDwBhcATnOTwVGhhafSKkbA5MIX3MSNkLedrt3Ydx2Z7jWfSuNJNFRsQFSxUb4lvTlcl87ZvPPpoVq6L1yLPJPsenMQ5qu2t9o3alRa1nUrP24qWebyuaAP7pVzC9DaaJUkT7ZuvkOaPH+Gj7KnTwLabdRLQWJZKHb+7HvpMhmssAx9VeGOPuVXxLXuP69UwrjtOcKXgYYEdKGZJcZsLptOEX63xxew8H9Nc+y2GLqrPiZOx+PZjgt59bUYpOjqtrSavbDsstwQ02bfMwczEvhInji4tHCwtMqCERU58/0SVg1ndJugDj3d8f8KceONnmaf7F/q2eeEpKDyDhCqi2uXCmXv7LcqpiZpyvZE7LAf1NtpsGbbo9lrpHVSgXK8O2ogtoszED5FzbkYpil+aIFH10NHculyL1x820Nn4XjBdhxvR19Nv8ZbfVBJ8hfRzr/te+SLCAS6QSXTIpdG4FPiEOB4vLc6e+ZZ4CQn0rnfdiVfr/TVgufyUx2v9Tjno/3PBLefuYlxFWjCbeOGrtHGkDteNrw21/GhhbH3bNMKKkEvEo4x65T8iE1fwznO6UR01C3PMuo/IdzCubhb1J5nHYL5YOgEmewl8widf2Zb2eKSk2XFEHBTIKyJutkOFeAKbUaBfAvroXjlRCjB2cQjuMNiu3Vboauvb0xLMgDYxEH9X94cCQp81QnwPJSG1LJlw0H//jqdKB/ZiMlo8+4nXXQcCjXyBFW8PvjgFZnd+OBLdBaPv3W3N/6DrWyt/mwvdyhtlBmx4CRAUpFR2WMtv8alET7wDVEnVA3N+r2FvwlpgkMhuarJXV8nKMYkHkIjT1J1via96ZjCxYnqpwbPI5lGGGa9ijvxhcPQia0IcGl6FRK1d3SeJDfcYOJoNzBxEC01YU77XnbTYc/AdByBNgU52bhrkp3V9qq9qdB62a/gVx1txB6oVM3iOwcUPmyJm8PfgAqgHAMj4HzOAystkvCyto/SsJv1MsLwJr8jYqSLxWw2H6YChCgps8Kcd8qNYXpyLyxB7ZxJlzq82zRYRlY0lVltejLFVuVtuaVfQ2x+6/SQ/CI/HrjQ7UQSuKkgI16buc7vU83hKuMDL+xizCK9u2I1jEeqhuNcYy7f2ZgmWt15lRdR0F868Sro0r9N6e2f0iSOzXgRQX6fWBRxOC8gSg1AP4BUYioiyiUbwtZdjHGAGHCNeYJsHNA9Zg1wU7TCCOFtEnJK4s8UgQtHvH4r1XHSVBXd4bER1/GpAKPaJGHCxT13nsVl+RxnoeL7I4Oy1AYpY92SAuJGWY9twUW/vb10THF6Rf2x1mylubYtg2oMJrplFhrwWv+M6EKDTbJwI59Xime8b3iImud8KwYQdEEaHiGgwwni7mA0hDKSnWkv88qFvyAYbwElqyKah6elNMU6cN6uNELBtc4i4CVWWML5Itpvpr3JhJgfbOkOzeGkhtZpnb58Y8bI5xu24TIFTT0k8tQTomXaV3uyJHvx1a04J+2vQLqKbBYhCkVu1BRwMslavYnr7bzZLy+2Hk0QWtuu+iEnUPBpXuSuF2ov8kjDCVQ8eEu4cJHEBCfqEapQ38j/mz7E4t9j0OEaLrkkXJo7QiVO+B6gHSAaJM+KV9vAsI9pk2vbqdtc/bPw9m9duy/5sNEN6JcjWBvaDQ5CzBTZvS4RyEWdT7Up5dEMozp/KGOm/Agc1e0ayrXnnQAxDbEI9wQaLb9sxpv9+AOmae9sAUgJKiq4EkZKbQFWqtZjOZfD593qoPxs0yAsviZZ3odkaUzBYjaSThwX88ssgklqxK117LKmvjifJfgKCDDYm1KeGtA8dcw71y7FZ9s6cUfVhVEvkBr0pmloBGoAwm/HYGp17vhzzFs7NHhDShDeCWFLb6ACslJS2JkhBqd6jFM+Hm6E5AHUVGkKVQOWI/gw2VidfRp8eI6kRMn2No85pPbUbSxRAIIdPk996X58L0hdTxuEKt0a6C5w6JRmyY+NJIYsSab37dLwBiht27PLWriCYfSodV/VLkztx0BvWkgPxDRG9yZwi6GaIe3C6jBhrVjE9u96qqYXPO8Qpxuw6Y/a0q4rZZZDHUpcVJE3eyx9ShROIMB29JPylaW5i1KF1SznhXn05YfdHQp14q3pDTr72aazNpQe1N3Qr4HyAjLZdTPpbaP5ZjyU8pS8ceio4LBp9+/DgblG4/YWZXuQbJ2BxxQxiA+NbV6DnQBfttvWkpbokYaIcE2AthAWhajViUuFChiQT0ykCUTUmXsRdlXOB3ArDK0kdqMFGxJoipp7gW6E9RtdqfwP4Sd+npSu4CLUuFte5UFiGJ57s0eQo8OpGPTWH92Kz6RVYv/M6o1NXPL2E1oViCyltPxAvWBLFkz3tOWvE+Rxk3HJIljE+lCoXHUg/C8nr6Z1lx9HhyvTaOVzG1fnaHdbyaoR/0ZTjMWLU8w5S0/gAQTB3en3iIdiXS0F2dh2H9u3MptxydxsV90Gm6Zku/vCAJBBGZ5EqHrsjD3itvZmfKE7lJjQVbQWs74ay3T9KeHZRscolvERjAyloE68bj/62p+1aQLikQFwAAAAA');
