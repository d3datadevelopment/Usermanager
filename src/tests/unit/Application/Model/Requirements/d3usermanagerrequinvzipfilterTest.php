<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3C379773BAAQAAAAXAAAABHAAAACABAAAAAAAAAD/3SRMjrn/B7HkmEiKQU5rSZOjj4CNmnedcXts4f1T6OPRbhTYnz9jARCxD/rvwpCyj9nQtiFdzkOQSa2ruJBmB/6yI3dlp8bnFOoO/EhDlm1C8VrSHtcAVK7BAXFh+Lgz8MhBLq2kBiraqMaLB4fBOwgAAABoHAAAE6PeMPBrPCVhlIK1AxQnLADTvef/TziRBuecV3byUqjo4BJ0GyutAjY041difh1LXrQTfXRX1UOgLbaK/vDBLFNcVn322RHC1gCTmZ+fIVlTItFYFRuqj8rPwgD1kGm0Fmk7NiTJ7rQ1e+rsmdF/8uj9Uu0Bh3IVzym8CSpSP3i39ZBnwd1ukSJZ8W6TlvxC28K6w9OSLOKxh0i/CAn4cfydf+N0reOCxtftIxHc5CAlwlA2CckYvMsRsUdWiA/vsLmUKEIK1/OwChIpzfJfY35238aPAIclx554O2w1uc/LCR98f2znMAAhJmALN9lvCGQhn0zQngiV7ccjHTk8cMKukt1ASFlMQdRA6q0Nko/rk5M3xMVB3Jb8BGQ9R7RTanIZb3GVPvho8jLmuz1mhcdA3PGVM2nN4V+FmGq2nfH3aLsdBviTmdiev/mAIMZsqA/E4zTLjZrQ8ppSJK5aEG1nLtLpnY7VFZb+eKOwKetQ6bT6BeoPvXFd6/U0Ap6Fm4PRyr6OejxRUfQIFgq01pnAqfa0B9BmIEraKCQWj54387QbxfBt7QsxITcpG8zNE6hYkH8tNmLBtsxFrZPSUPXBk+7iaGGjNmckLuNKBqs9f5t1T8abjhIBdCESCtfrybKqnJb83/o/4Fcdm7Q1ni4BcWPscaeu/Z1JBeGDELe1fkJXE07cqhumKS/MJ2Vw2ignt3q9VySO7Ig0Uy1feiiR02TnsqVbAcpIJVgUbPcYbWUfi1FJQD4Qahl7xVAfSe2qiKPI5VV8fX/GHEXS7jAfyGEyYZQP9HJLX43icPMN9eXjHwjXwPiIK2Wg77Zgc1VtKhFRJlZ3HLxnR747k6TDhp3jfC+bhOkFwKCi9yuDNNWn30kdP1yr1tahcPF36SOyYWsGEhA2WeBeg2hTM03EL1yuO8WKJHkvBQj52dz+WXUFHf4jOaMb5Aq7DGKxyrovSZhw8mSLieIru2tcQM6j/EdAs7+A0LsAg/fJDxvk+rDHvH8WKOWzGcCtlLoYNyHDg94ZHFWmT9sAxglOAzChhX8907nqzS7vZBaetxVRE9lGo4vTcYtkJAZae6sKobO7s1uXgV+uxsMbzx01p93iixnjts08QgARl79FGTwLe4P446FZcwpKobkrcodw5JP6b96ELTOWhEXVM3t9pgtR8k+s+1epFu6P1ncaGn5itoYrdr175CXV8W42lSbXzjAqq81ReDcQEYi2SxuP6K1Tp+Xj/p2xqpSGVWK20D9MnKs5xiPa20H4JNaMYPOTa5N0x13Z1mflm5BkLOv2WSj/QJp1z2ir+Q+mnYrSY324629IJzbNjNtTyKT6hJeZ6fGqQNjqOTkPyHk5qY6g9oV6HQdjdAl3uMmaS08pT0V5YBcnBqVyfT2fF+p/I0AhhAwi9MrI5z/3Afz11VGFOcsBMZ677Dt+/5HsqHGuq7AolP/+alxZ0F7/7NTcfyZ0SAiKAlzgOnRIyLSDQsFvW/L1wlUkbsF+FJlfiHXImeIfA/PMDk980LYSr3poaSkFXktq/SqhxhRjOCSypsQomwG1Lp4PI9SIGQgdmOkVMCYjSJISZdntVNIVJf10tfOXxtLxlFVju+ByDWQ24qlRX86ITpbCNJOn/lTPNTDCDEfMiU6Qt5bLv6hOP4mvRFAz+OYIIZeB5DoNUFDtPiFdTgejEM0N0Zo8waNxVj+KnyPYAzRF4CgLyvBFTRfkd4npGKxL+xYJuRBb2hDhfsQbax9C8sRPJbg+8dq9+lJvzbotlFMrNMjEF6B/0CCygEONosepKXIiYAU3zwrMTDuoJnmkDnV41MSpbCROk2lH918m7VqenpR9m30z1SbmqjhOzP3S5/UDP5SiYBqL+L4LFZe9fz3WrwUHJU4mJ2/iOB53E2GOyHRyRfzJIAdBsIiHX4GkHMLszUTqoF63zFoSjgsPbKmGklZ08rdoOm3Px4UGQBv7X+JVZ8bDhMhpYgkMkD7DCwz33plyTmZx56nL8XmUqau0XCEEBGIjI6UiZK05hGZeWh9JpZzAsSBy2VeRD/McHV1HBO/mt8PcQ+OAkXUps763sZ1IR7MQJSmXm/1tsmoZHMgW42WvSht8HrVbin+EwS+lZD+ZCDgwjPDg/Ft5+vDKMzrYTwbC4HuB4BSwj6UtZ5KxjhKDZve1ms9inZN9Nrf3R6fR9zNnSSdSzfTPpWPLtWNSY3X3qT1FUkEU1JTELhDv6i3SZOgKifzKjtPO34dZUlukUvyVGWFJkmr1f9dIW2irmk18y92BQyIbOacTzzmwP7+QgCJRiF5jOdXXPmeCZn3pN71wfHS9q/8yA5YZn2G1UvVNe14oOM5WehWOHOKY7yesJkjXxEQWiBcpV6C+3IqPsRYuWkyspatPtA6F2rrJNT8UadPh85A5je7eOhre3eFrjYeqCYz9CNE8amwvqoZZyBuHxmxwqWuXgMWSOEus2b1ONEUbOu93npM67kVaYgShLbJ6gZ858OthUqfcdzHPqbfzGu7ocAyJ2Z02rtVywPQaVuh5ZmugoHnBUKAewPi6/8o5HY7CfkE/QjkANPT7IHBpuy9wWCio9tjzk2tIJjirrmqGzE+iEWJIzV7fhI6ii8EcZd3qSlORLW5hE2Py5o5kRN8OLzTwYqx4cSAUwt8TjbFurDQs2+S3vXXeRZZFhP/CRq9vYBYga0yDhEf9jpCUkDD0HX1JsT+dsW6xQO0bNkRLUIWB54/cvVbKkWS0YIE5LfIZenluRXv6qFhf72kA2ANk7nwG+gIVoRrtwZ1sMmuvtTmD/6ePqBW42/pT5v3h3boIcWFYKD+pWDNNHFoDKOYC1eurqL2IWHV96NAE4iIeffFMYYA0biTP9HLnxC3pXyi2SBk6BuTp00E/AqlCmAUqsa5qWXzZsB5RNAlp6iEP4w40jWdjRRcfppw7S1tjxX5JPsF3wBm9pso8M6LwnejOORkMSLu/fInTgSfNAdULVhv6te5eaY/ftYAq5Qq4V1k2QmXfWK7vx7a5zXDck6f9YG+zs24u9Jgrlt57UaIeILC2K9dhewFPlHrl0QFtVJLRcGjmQSVKgfvq/qkFVXvsz0XgblSNmpm3zB2Dj/EtHYnkqMTtqnJlDfhxWib7uvSyJvHaS8Pvq3ylLLtmTZU33/GfL0X+uqje9c504+3Xy6Je+9odclGrhOmEuTbl2PVQcfjn1WC1rcjbAysA0SJlYZstvPRYTLt1U6Q3yRmyGxPsfasUj5guOOaJIuJmtXUOJ8wf0YfyV9HE2ckF4ECsllSbNVP63m9wNsXuQ8m+3aFz/hFq/9B4x10emhgJkQ2K+hPyX6cu4EjaREYPrrACuNkpw0V69SygqJxTOwJ3s5Ur/jp+2NmVstw727G1MT3DlV5oTloomkmrwHZkI7fA15zUDc4TUa38fK0TqQX/NHOaSGDbMeMh6n/CY1fDJ6w64jdd0y+zCA/OOFPTb1D5e6WSeZbODIk4bdBs82meQZos/Fmk60aoLll74hIuOH2jRz7M4w1G79eRuNrQ2GfNTVOnmCcfjLu+50b97qEhrHxvMB9m5/fUp/39NwxvdAVjGa5fznGdSUuO1WajXwrsSA7hMExJhYqsFaMNVyRZhB07z4AiHr5qNgcYy4tGVkrVSYsJsIq8phCvtBL5Fgj0T9RYiXvi5AUYBO+SYitLjgW6E2CxlSJaa+pKn0WXZl90WGg3Hnq4hXDyW/0tniRsUCp0SoClo7yzeD2Pqo0eUuXOspQ+XayvkdTOBIkCx/yPvxJLdUIZC5b/NfupJTQXa/rdRFIaGeDj088iBy76XbY6Propm6OnctMeWJ+GoGGOQHvsXgHfp2Id6/pug7ks+/P5O9IEq43lJ9MZgEGPvd5Lpc8S3W8CV/lyX/pkXGy4XL4vE0J5U72+AflbbPY6guxXglNiXcYTLnBiFeF9pvliObhloy5tsUTKxP6q3F74me0hw7W7xZMgkoZ6HAQxjy48+zzI0PUsyCIeOz6IdQQsXkrM0cXvdv6UsLArWNpQ+2jK74ypfKCGga6ROGOd9dmSUswFqrnOSk3yqgq0s8weFQLzJ/QPld2/lETclc67VC2J7QFYnB6N+iWrEAjPrCdnVcl4RwCHvjiJxBAViaSQyDhQ13yoKpThPs3Awf+L1PdhYsyos+PYxqoNZOy9RBwWH2NEjDFwl025bdtjXlZpxCs9P0g1/oMYxb6GFOj99T60xKDpgIHj1xNiNZPOx/H05J2/3tkdjLWM2b//AkMMqeo+aFxgXRGml7oBBjtDhrhuKj1VC6xOQk6nuiKhNCc5Ie6am5lJc146v8X0evGpVY4pD9iYkSukqVNGNtFWvynFa7vvPbbciq+YMDXCPa2LrFMQ+F09URfav3vG2OVjzUuMlev0nb57jFZEwVAGTkiJ68kwTqCPDY1p8UXexSKSfPL2KKxI0J98iUVSCBdQHnzMoVEt8CUq2a+Ry3EdofPWr7OhrfAjafTkU5nP7amW/qhgsLSevDPwf+LwkmXxwvYHY58UKtM7wX5cGmVxdgQm/wkhxAQpmGZTpkK0jOS3HyCuca+5nfWRypY8HF5jarZxvL3HBNqHMjMzZd40UeTp1PMuFH72Ph1e1WFrAn3GmI0jLTgwZXe91yaTn1wV5GsV6NRJr+tG3L4Uvrxi2hhEgU0aMM49ma39HOImBBx9dbo8KUiLfQ9M0SC0gXSxnMTvCh4hYYlczqBRy7bsHgDY38N0Uo7xHJtCEFxF7rAJOn17gQdDHS3w/ksLDSPVUab2Ujx3V40/sMRt2kYWG4cflcNNbi6oz1LwRsTNo3m/U5AkWML+dULxGJ9Qauv3abgsQXbDiFJ5ZlmnN+bYm+x6UMonDyHQFMWhB/7KqQUb7QCT3Peq7wSoEZgBHnQN2g400gzikY/zGtLZU3jt36INOxUfxfggfLXjUQImsmf9vg+zAMB28i164lronkO9CF9NUUR3lS6cvPLopb83ZuZlpmLDREL+uZkI7Nu8ezBLh9LVGofSPJBi0rJKyqDiR646W2jl6mLrZaXkAeNnDTxDNNak7PqmmwTuzDBfggs0RO6nkfEutbWz4qJWYJMi3wkmZP9cs6+33Kp6/A+WDmeMzFJul5P2VO8wtckDm4VaVVxPTroBp8pedS0cwD5D5Siz+T19kaKRytlhbwqAyVxXXFrlxx5BpCorqCyzrun865EwPHtG1yU8NZqtsXchKmFi1c3Zc83ZS+Z4DDXLUF3qDJSnxjxj++l9cSTjQSXiZrlutu6M/fnj/hvugWBLVtNtI0CygfwYA4Gw5cdHMHZC36yEu/Aw6SOu9KLjcyGmtiM6X4IFajXBLuZGeWa9qMWYV5Nxvko2dapb/xkNUjqcUC8e9ZvjMg+tigW1qxl4RD2zohAF3gWudHISxCeInic2DTvj8cD91ZMWi4mfeJr7UxAVOaO2j2y3TgbBufdEm1UmevsqHRSvt9vf7CYCjYlhDGubRCwss2OWfPAX/ko2EPjHAyh5BYNiawJdoSZcrPR7yehWMAVzpNu+bjp5jrx0A1Mk1GlKWo2Cv3tiH8iCQnO7Ld9Nl6kdkfuaP4BcvffyiEskg18zuPbF5/i1p9h4eDCYLe+OAgI0yeNWe5eHx0b6Yt99IqBpJguNxc0aiY4XatNoNJjGxlxHYuUgifq/jvhSU6IFhx76H8kUhzpCTFCWS6JyCos5EzC+3/1ZPmzgW38TD6vpL2taJiIoSnQUAkJVBN21NXGFwGLAkxBHXVbOvqkp0UQghdQPaU6UpojteKpLsPVoYx/dj1EFXMQGka2fLo+Cuc+EAUHr+m5i967OO/+eFJAusIQNq3l9cCvTz9OZwwrKGQEqmNJmizvTMpTVhAe0lVPZbeFGNVsXKVGqk8EyumY6w+2a6A2S0KllVB+g0OiPl+GDg7U12qYJ9LH1MA2hSTXD1EA7wnPWgtrej2a5uNVfRGLs7naUu61VH1NbtXrKjQhLHvaWG2BYYz+OQD9PMZR11+otGHS+nE0ltJu/6uvhPOvC1IXbvgvNtP+/n5RVqsWPeokHvKfAFXzXheL7JKzuM3rpCnsQl83h1e7/CvrgZOjJaQa8qCuVMfPBGfKlY2vjWazdxprn29fyIA//ZMOxGqg62TJIPigEIOVGnBw+hANO/0ulAjPOR4B0iSVTBIDmgLhbjkf1c5NMcehohV6ujdZS+sYvncxLfbKa7ppLIP5J7iPPRWn1evkEULhcmKvHtXoQpA0+w3n1oKd2R48H8AvnU/RJOGpkyRuo9w9hjHF5nYlU8/BZKh/q7lw4l/1yGqv7kD7oLEUqlaWf3seE6xMkNFSH/jN8KbABMO9ij41VC9ygEL/IbWFBO1H1Vfu67FGgidIxO85ZSsC653NDqjnu5HAzqzCSbU2eu5P0hAH8CTM01MA0WOqzP0mOXZhmJKBZPwDrzkjUdQ31oCz9VP6fvZRMEV3B1fgF72QTfmoh2s1N9fZqZGwvZ7M25oZroZf0jhWoW3HAuT0nAzi5BcXyNf0IW2afEH58y8YNPZiURZb4oGe1lg5kq9CvgNOhB7R65B/QtZsfcl48g5iHs/V6vyTQcl1yg4uUK5WCv2V4NqcYqUcqzy8ICyAnH8TSh4YLtM8KF618bGnMAg4Nz2fraLjeJwISTq0Z+oC3VYKI7sT/LS7q1sjGlBFS83nV5DW+AlqiDYticZf1DYrf+ldTCzpUdvKXy+Hf1eY+g0+nTEzvlSbZRt/vsw7/DP0jETfL8LaVFQXCTbSr9BXgcNPCZuECu8ceRAWuV/vzO+mjkuh97kfRUxd2fnQGIE7G2FqfcfVGOWZZpMzjFqM30IYunU9ETkUrcIxraJLCWy4Yd6vhtoqaSGmnD3KhGQ8LXAXfttyeVeh+kB8ds5X0x/BZzpcdjdaiEQ6CBu2KngHZtdHLRGHOXcbcsRvD+ie3GMLuFEt0diFy8LhlqjPivAuxeQ1OJ+SnlMZY+p5O1ezmkvsYUVyh8nEjSwgrdxivUmeK5QpoG8y9ES8TULdWhWlJ3cOEtlFmHSVMcPNmljCfhJURej+VgM+gwLh0Eq6ULxWVpqNobumKnvKGuObU/+OWo5y28tAISWCn6uzuqkePxXxDddAgKk4QwVCPxmhvHCDqxxPZgtARmVC1WJ3S94ptfT2sjKSpneiEvGnTkHlUMyY+kGDdtoTKnMRtBK7IrqZfcdPL9Q2HHykpuC5osAPoyq6KrJikzJPTWwWfZoA+5UmCOdXbGTPbypaVfdArYk8d8DswO5LxiwSlYIkwsreLf50xIb0VfK79FnIBmk9lJaor20Lb68dPXIWNKOkmEScfWO6WNqqSipz0BukLMi5OPCMeQSyWnqOy7wyWbuTd2cKS/nOryKMi//dqIV6KupeUlxetpBJc+qF/Fs3it4x3Ufy+4VtIqf71/JCXXPreP9t/17Cg4qbUgyA1w65bWXxOOctBEiELkK1Aq+7Z+716EpvSfS9xgYotn2bXDxI5R2J5EAHNkVwFjlsg2WB3K4LtC3GGjVgo73cdZundCcYQPx7BQpRPTM3WIY3bHU5nHMVfMPRNsPlkzVOWBvJ9Zt0qLxuAo+8ptZfSht7sk8ETYF45ik8e1rj818ce0o06pH//OTWaiEYekxHWkcGryTuLzdDrmZdB5wZ0Un1ahqJPwxbxuS87DhToQbfV0RPcST3dRnK78wwqJFs4A39t57weu6c/BVNtLYkD6S9aQ7MNpSViVkE5CgSGaFjQNHKXAy2SkpQfmCClw7L00eLxBpt69nne+75h44Wl4co9SmBPM+/l0YS/exdhRCI+W/vXOaYPt17Jw69qVKzJGyAt4upP+uLbpL0em+cKUMWU7G95270IKUS50Wsw2bLu+f6o2YDzM9sAQROy0J0wHC5YrTyS9gsm6gdOoDmeg1RuqIsz1PNEL++ZXb+i349eblFv5yz+NyzJWM6PCewNWOj0pRZ+PZprGRXCly8lWP7HRXCQCzbczVkt9AXIEbM3SH7QibMeQuKgJPJxwzTNFzVdFi3Oip3w5wwf/8myhJMoXHRqG6Hcsqr+Zei4eMzk/SLteHAaPXEv7LRwkvlN5tExxIUxTBsPa1VebQKljFI/Z9j21A2FDAgttzOt3eLxe+tT1Aa1K3ow/QPvAwoWmvXUFwjRtQ/vk2JN9S4LXDozhtfrsKifWNWFM2uV4uBOp+XJw/pq3Sy25kh7evAbQ3gO0yeu6Z6ldnPBWlL45zvMdHEayHj+OihrTbEh5OWeWXjnGV9NQY8KZYvXCfhHnRvmbNCsnC8T8qNxjjO8e3PXx6phBlays/sQvh9jumMXxJbQPRXV/6W51iImPnH+c2s1vhgR3UHdDBgNOgmgAo8XCrK1VDALC8yj4yxyTvbIRuk1baKvKd60WKxVQsd9ImPWLfZ7qMD9MCyiSw1YIlo3ElklekYxK0hB3YHSA588iYJ3uU8UBCNMjDt8nAMFT0pgkXXNaNXGLWH9++MW/kfPM/TxKEmrAvHQg0LTGzj9/cXBa/lrPZ21n3X+o4u8aJOqBeRRVgVi+Qf3UPgu5foOoDB5vP9Wf4lbO8lzYNMvJU4zK6dSck4pwaZO+Yvg6Ud4SAah6v2CqhRMdIjlKV1MWi26sdauexuKLhn8kJrNfOXraLPJ+nrzvp4OTzi3ZIUZiOa76QCYOWU7KM9fuEx7Y+tDrBPFSEH4x9b28zoZ4YW1T1817gSpWy2VUy1sQS5cFk/h2lOZq3y/O6gg+/Mif7v60GEHTMN6jUOG+ROAC7J8x7EuqA4bnZ76sHx3z7Z18Mir3ZALZgKx6EiSW/mwNqGt3j9ZltKBDWQXOlICF5qJIpXFdy/Dg9BfNCY5fiASZAkKajwCtovVrrxZPl/69HednzPyG5Zn+4E0sdIJLGFvAHx3doC1eynUxdNVVTpe0x+EtzqCAO4qS2E9Fy6/nZzecOaldueKLNv98LEOc/pFCqIjBr6HFCV8YAniW7g4kUSUDjkHts9hDk/kJK0W7BsjxevaWtwlaGchMgy/67xLoDWtoikrOhE/3FFhcEmUnW41nh5aUVezi+KTD28T2GVHKLkJ/SQQR1b5c190fHbZ+aUQfRU1Fi1OpaVFOqjfohmlTYf2vZlws5HCyitwV4AstXi7SF4WZZSooN8u6QasB9H2wvyxyiFBsPe1E2aOwM9UIyVhO3M2I4UMCTfja9gm8n6s0Xp7IMuqAsGwWqEqC54159JC9kQ+jEbkY5DqyBgoOMMYF+u3XGr7QvKPcRYVSioFLe0blSWKKK5GlYIElzcaq8dd6KzolJ9KptqqiSChY8g21165l6F8J9knxC+gdhTvtBFgkKL3YaNrqSn8xMzmITtJok8nVvu1xGRPaeqYWzam0zDgwDwn3y/rKOkkofWUNRI4BSNjKWsr1g/vF17BpLKYTU3uPIgF3/Z+obfOGDwZJYpXPAiDUEOyS0g7mLSqSUcUtsq+Rq8AGIFJP0mOIACM92q3mVx081bIAUsWNNywOLtZsfjJABtOgVjIXrQ22w7MWNTosmferslQK87MtVMT1RQQhzWhYxOmVeAUOMMGhCbKxcgz8gM4iQlCivRNl/WqAx7qlGiDFEissUsrGk3bbbwkU/cX+WgsORACjQaykN7MbODhnpYbjld7WIgcBMPn2iIJhesGyO5b+B/3w+Q0F/PSUQAAAEAcAADmxgLOuK7b1WkcsZPC4SiqH0eqg2JNUF+eql+CpLGHDF4B+8ow1lpsDSlSuePGenNuON7NpllT9xeWp6eCUOw1rJ0AJC5/yXPE21DmZVeELVxD65E0wG26v7WoHfl/K6B5gZUBZCDSICd3IjIHoswcKvw7IDqow/HzL52L2u5r8C7AsUjMjy+FsrEj2bg7q6yLu8He5PtQM7h3CwjnzPzPSR5EzCkrhuwZbTQtIqlK5VLg00Y6K6b4DtvOpliI01FA1S+Zf7iyb0HAVgP41s7U7gWE0cCz4J0A45JJox0+tzN1Nw9TlmXPyHl3gwqnBFBdb+dy3LbPoDpAsWzM2yCZ31CUysqDuUKBc3AxY7JCd+YJA9Q2u3STk2nCxM7e2ilU3fcM0A2bzDHtEShNAFIAEQHB8OQS5tZ/g26kxnoKTtgXsQrOyMUKQGerz0Ffy1kyVpk818nyDJkz6JN3eQ7L5dSHYgft6CpMxh3QkKU8CP9QwG5qWKmiAfYEt1q3wmpc9CFuuridAEzo9p/D0BI47whSeNgxCIn5I/mA2LD1M4/ppO4BxIlqGvOiEa4SV4K75AHbFm2OPX60oaRuIX0C3+/+u22toOyq6xMhQ1/1G9Y3wDo7Fu2MbtPTEWoKwhdmos9EAAoHCQ7u5R/QhT8VTfo2g11by0ZeF0Yd7EOypbFm+1sEn2nEJpG+w3Qtisz2IHFuynlBMcEDVnQulv3czsis2bmszIjnfkPgI9h2oVvBMsT+BZraoI3gWpS5ptmj/Bh1U2vo0m7Gvpiax4EY9dCD4dqVIpCWMzJqXM7X9LEX+LJznNyjgexZIAe5mgwlen6suwxSXCD0ltXSJMBpk7mfnHp49BJ8keO9dJd3lYscnRfN3Ei3twohW3rvS+xEGwIHt/K/lUGpJFeIqf9olw5aAuk3uORlJczpfBXGrpNYMdLT1gbV1FXqeOwT1Rlck7+QlDuIoHAv776eaZTUxyg9gXaQjtpKobjmIK8GEQVjt6R7pKAJeeTUMAdkLvmyPHx+b/ug4aF5PbCOUcL6162W38SFdcsz+qXWFNerkVQWkusRWARqac/Q99VfkpA3h61VwSJ0+nhKl7f/ya+mRa/0lru9v9+KFOPusGA0pWu+ZX/mFb9s86/YlTVDJ3nHEQgUV1UOC2NQs+dX3MZeN75BIX2LTKTmzqiSE/YLE0b8m5/1gkZKH1fv01+ens/RuqyKMfnbg6fj4vC93H8bRkpl2WoYa3B07K1as8/ybjLqM/brAnn6yXE/SdGPVF13DtRyBftgBJPe/1qT4YMezMqYmFsCLQ9jlPBZFSsOmFbg0aWQM1uEmyXStSWMedeiGVGmkilFb1BjjU6iHnIMXXpI+pdFsZopJ3ejgqi1hWQ283dBNYHn+HiKlOS4qLZCH62Fs+XnW1X6EcSfp7c3hnGR303SixMT2621Fw1gQNjpzmGgk5UqWxrCVb2kPGsPRGMY7Ic2+4iVQGlURQtKsmeXekdrK/l5NxhzREwyhsBTQkhIFu2w7XvZOY46jtjgvrHHrTp7KXuhStxiJppw2SoxXeziONkfEqVb04SwkyZqJzD9EeQgK3CIJlQtp7xM4Nb7O8rYkuTdtVn1/26Ro7ZyWsFARxpF/bWWQZSAo5fLWZHPsJEzLZbkIHGEyPovNDkLcWF8FqSxscJXcFCQLQnykiSCHOJA7Nzpu95olH2gdKHnsb6xYQN1CeVuTS/qmwYzRkhIAvOGxdy6OP5uSpxiFM0GsTtYxl7wtqa8xiTsG6ZGC9dqKBIXyFACLYVz+bNQUyUrFUh7vIspZoK0rtksDTC1mZmAwID30/rjpTMwlClw8FG2f92rYUbYpDW/AQqJ10+Lm/Kpae7So87acquttb0IkBQR78IFDVg8v2zCSP/YENdVGNOC/NhgHIMXb87wI9STQTso6ww0zw9ZmFdhmhcPRteAyHiOCLI+6HYF4kvOwy/FcA3UWVdi6rgxjw8+D93eIWxkfdQYxF91qV9RwTG+lasR2UvPOsgVg11r8ukM+XlQ0ojw4IfJ4ijtFu0sI56aZkUS5YuhMkbX2rU/3rupS2bWUmDTVa/ChEmb4FIqvtnpntpDlEpz0KAq4dgwQAzMBRfQJOoWUinghBPruM4icDe2Fq2W0hxnMW2qUgXqhNUBt/HidBT3jR9u+OAQBtRVEJbMgn31FPHV/0n0XVYbMGW6KRlbWAOOfACZsOY02hXCSKp6PFIwZLPImrmnNuvdGawN9q9P+IOxBzp3cFlJHNi6WrGrHBB0YSAeKXOi3Fp6J/zfSxX8e8HFnOTwX15e3d0yRJNgVz3x40aBkAjnvLhHTAt7CIT7ItM3y7q0gBYl3HSIXDD7cs7SqC/kRDNwL9mbgJ9iKwNerD8SJ6NI2jcMSmUJycVA8eZ7gkOvPJg7Mb7kHt9pxNdgA3eqOmkgPnJLOb8RQKLhiNIUOKaUgad8pi/FEFBjCge6lYdm0QQV6ACNJWqV9raLZbjh5oPjXlpAUCGHFQQ0L608tP2Vep/rtcLqdW6bdBZF6VpHcAVOG8TXa2B2OF5SdyLWHIWBcMuVaTiNfJyYVY61S5zGwOVo1y8C3LFuU+uP/oRinYNLHYhfbSVENU0XHFXWahc5j4QkVtn6KuONd4mKu9Y62LXNH90iROO9A/sCIn7p7yZfW2qqGooE1XeoxJ0dA4nfhS6rtnPb0r3qWeHF/LyBoLcSvlcIKeedgLdPRISR1P6OmXa6ZGWn0Pr0/NngG2zjHi24wd7ascoOMeiL5jVLZrVqFPxrJa2EHKrfNnE/vd52GDvJ0n8pFz/5vL/XE+fF0WwlC9XyCsAPVb0Ne3l53zsEUDQ7ZUqMuE7pPcZWujHoM1JemovzWerdb4hUm6Xut4pC6vLhwBh6YlU0iLYvcT9h716tG5CNFwzaRL/l4hwJW7KgKT1KWcrrlFoAqaXMDQHLCTm7c6ye7cB1je9YCMlNoC7CeGYY9YUYdLi34D1kd8LIJo39mQaWhPxMsdjfTgrNpTOc6csMWeMkUh4+v8TgzpudKY2B9I1GLtK17KHqiAOoBSsNIoiaajjprK0DUgzXIAS9gMgAsI3dgxLFLTLGPgday7nxRsRMOi/rCQMjZOtTj5i8WB2hThcAY3lpfE9qP8CY/oBVZ9SFCX28kMRnmJBQPs0bCT3sXTXJcgbcoi5SGbrHc5UHtRZnnGq/lvIxBppIxd9ZYHFL76MMxEDo3kxrGVJMzrkqeo4EtG9V26PC2x3v2p6fmjv2sPeuIIm0nd4RJpmZlUkOmPDpYa8fbQC8NX2vmmnVbBYZ/ktimWQyHYq2i8sJdTHEP2OfYJ6NrKS/qCf9q9ZWfr6jTUlifXlg2giWPWdewTA4G9/a2CKif4ivSpRIQ8x1yO1c4Y+WXo9JNYhjA7kELrMy7mVEcNWsXL/md4iuh4X2S+cSk6TGyvI3yiCkZpEmO5oJEx7AHq/Z6aPVszpzTiV6t2OxqAmXvGSUW38ez3TVSwmDgeGePBFA2lxFB/SC9vMxjLtkLZsMcuEyL5MUwnxoGAuMQa4YTynu0Z0q1WffJatdieIdeA5L3b0Oo0GDt9cvOlurk8C2oWBIpcnwyAg8u7nr3sDXGVVudfFUp914SutWqPF6KjpcKL8thxicFkWEhEqwkBS1vefx+1p3Im+oqz0onruO1Whm385BMW6cDDshWLDqRNhMPzGvt09+YsFNweziKXg4y/VK1pYTr0GtJZi6LYT66Tn+qN0naxTzCuv8bCNQB98+5jrSp64gne6SAOehTn2AJvZi0oS10lUKg5/ncrWc8yI/RJPP/uEye184HkE5Y5z5//qjLSJmFewTz3zwDUNN+NDyu2BWVlZW0Rz0kFCbY5G/5PFpcZkqJCPAk4QoBUS8CVXK9cUlJ1pIRxSVubdeO9agSjAOP3+R22OWAQVOnlAQgg6pJDFsqPZoiKrkzXUbphL7EvdPg+WMk91uXztBvtSgNKi4VDDsnMWKA5YLhUQ9q4PeEbNA/qSsMSAF9m1rfCRxlk4KYe1+aAlOQmqxSCAVHdG0pwDYS2zU+soeI4C11HENqz78wYLmODURHSn3n4BTeZl0g+OTfSDDhGugMk3SpzATPdLmjJhGMuoqwlb6joH+6E6CBmjRZufLHEJuo1B1TYx9HM4S6zUCuTbXYSzXbamu7IUzs2YnT3M3X2ZfqpnhJHpQvSx4cX30VCK+9liGLwf/z14U0E3cZprw0JkZihNMTp4gU0ECWymZHl57KYh6SWvxuyOVCZCSf3OWslb/J6u/gbtgkDA1VMuF8/ATpV5hDioqfxNKL3b8Of0T+KeBq8qsF2dJ7EIFu6WsZGX5n4UtkPsy+91JYrznKrEuYxPDJNupe9WwS1E3B9oxxPS9rsPLX3BnfN/uymrGDIkAtqNcsm3hLn5JvJYpbRnASSJi0h/JMVMguR1No3kzRvHu9lhLoHFnFKkwcfUMbxV8NJEE6gFjd60KCAvFrXpieu/edIgdU6VQvMD7tNKOkWjnbKlkbq/R5xy91s5dj/I/3317uYydzqayV+paUVcYULVzMbTC0xo7Lwjz94AkFrec/8+K+TNYZnEz29Sjl0pg/LfFdIAnEAtlSE0jllTwlqH69MMw+He44qe/Rm7K9xNHyuN0uBT8t5YXnl7w+yNATT6k2UbEDjXx/LxZm9Sj7XSssYOZtRIrMlb1Auuj98loWd294/KIXcL7tDjVlQJN3XqUsXWPoIT4mMzPNMI7CrO7CIs6PbAsPhmoIgr3/h3G36WBqXQJLDhB87vXB96kNxveRtLVwbEPri10dw7wUp2+nBjY/YwRnF+E6Vre8I4eeeg61Mt5cjgJl7TNXNn6kVpO//+lkhKCYZV8iaXilgL2ETLwGJGmfUcCFbhCsOwiyWmLR4B+nw5wIcSj6Xw9Q+ZVLFqQCWBXF2jLyg6y5SfnoSJ6q0SZsnyZewTGBc+SevVgZXO9W5xpiWFjiq4ADplgS3WZJzsBDrd2tjJihBkuiLkgAGB6WK3g6Pdamoh4JIDlri4o68vD/kZ8tU0/xghlwsyFyBRZHfZMdw0VLPotsjv+ZKxhbQ+VI7cLuzd0GBG0h2NE4ohnq3QbWxkR8KPsVObUEtgW497iu4RplhDivAbztp5zp1PoHeGbCwX0efDc5z0JQMVu2Cw3z60p1mJzwoQG+v0Bsmg3zaRRzHZzFq333MbF/lmHNrKQjnr/ndl7Xa8RouMbxD9RturLnfwD1S/h0QX+D0fOAQcgm9wKz1NxIQQdEu88T9JfMccbZO2QetrCgTkUM98KWYCP17TDhwDYyIe3kQADal0SEOTgTpEIO9LlR3kTSng0z40606p42jihRFO5ZA+aUsAhb32cgJUKlpIoyK+lIt/tmntNKIsUADTzAcLMwroh8vDY2WXBqG7wxJPJTOZJCskXSx6yH/QXPNaRiWz66B1qa3iBjCEY5YfDB/O0acUeDwI01dTMZ2bkR6cBVfh0LsTqeCBGEJVpRVdkhXm5PO9xOCxLF6BONveNrS7wsaySEImUNKgmXCRPVsMdT1hucaXmW/PUOf/hvQQacrZgnRStVWDTpkXsFYzDXAhyPPIw17nmUadCzEzlF/68uxmO6Byk8thF5CFX3z/5xWWUrrHn5eGPTYF+n2emGGKwJGdfsCLZxFref2nwgNHGddYg05r3VJPPFKXIbyj2oYmtMjucnj5sYa/Ahybu1zdSzjo216qROzTkDbQpRqaB9UtfBBiR81rKNcz8g0dld+qAOCnYS8dcTScvc6N6kPEiJR4b6ijO26eDRiN3RBbItcJkuzP6iOODVyOTzOiZokMd6LALv09+u/w/mAyEQEsVt5eXgL32Aff2Xkycye+Rw2ILwR4HdoMwRMUZd7fjQpfWn0AkCskAZE2VreRfu/Iv1I/191Bz9qPIcdXDBhRaT5cEIzhXAW1hIoktd8vJYsBPBKTe52FqHanpy2R5ULpMQG83tXLo7S4DSYbWJZtop/gMkUzjtOurg6eWF4WNmEEXdrxgT1ryLNLZAbPqPkJ4iiY2GK+H1BXJNTdGHhpnLDPQ5xE1eDHH6IJx0QxvXHflm618h74Bm64kWZ6Nt/KvRk5ZPyxCilfkqETgffj1p+dFl3AuoUYjSyN8nB6qvU/JYk6ZXA3dExTfBT+B7xurM9WmOCinlcacom8dNowXN4EWbQYtdH4oOwqZofbj1pVRlo5s0vhMqj+XKs2m1HpaDr9ls58YaGoRCh0nqgGbGV2wPyE508DN/pNydVd/qtW6Zo9MvSEwLmJK090XmiAnMZaqO2B9/gomlVZvbbMKP5edmbsFieaobXs20fk0b0OHS+dQoBmu79lWFliNAY7wvzWyzw9QppSNdOIITyWD/2tP94tp7F3gM/d8+2aB2EnLaP+42X8Fl+t8FX2LsbsN3akkGalwlIn9xbkEQDsaOFHODxpitNB1qRb9aO7KxHl7aWFfsPZKZmmBbMzPmyamgPbfCwum0Uh97DL9HLIAhNlHxXGSTwNm461gdoniVrNW98eW6RRq4+gPbCjEhlKwn8HCr9+1ewU0urZZd7pNi84EhhS670jy0XlzJDiGjxx/UhiTvSifsH0BNV0YC8p7DuT6RTcM0Bk9ATHnLHb5i2ZBbrEDDXO2f6LRzLPZsGXCMfD5FWOh8z9LQVsnqi87D+HALPH7TFcP9trVkwSAmbF8WFZCGJHzC4dlNF0GyJIuG92p5kBgqpTrfENnzIG0pFAMRQCEtMizx54XBrm2sDlPEPsFvHrBJCUf8hMqYwvN+ou6AWGDBfqdLEK+iYyeL04CwF9xk8l8UDdO3BoLRfIq0untfG1kDKQ0EK+ivuIaSezhAe1tB5wwCDsqOM52K9TTY3droZqnuHjByd0WlA6PaciRv556fcUPZl0Ffjxb+UVn/wU03/e5UFM04Lk6RatInNgbvStY/YJezZya8Qg9n+xJphIO3nlbi9kxNrEtgbfB7aHxG0ZGs/Y89xTqf3CNkvo/G6bh5ZP3QA+/B7Chg4M/Z63y46Df6Vc6HUNEv5ThOZDtDZcFuqFM7jysj/Wa/QRFrxbb1NwK/geJEnr0Bcf+RX3ouSoxkQccVYVMvt9MoWOpYXoGOGrFQMEM5UxlkOZ1rgPaz8NswqCfyYawIoxCFHdpphST94r8K/D6RztIB+fRSH6sbIH7wEZoEKTn/41NIkEWlK0iMHm2r3rR2CtSY5GoWFeP5v+D8Yl0VKtT9GXvM3KGnMOwH+Qq4a2e+GSmxcDAaPnSmzlrF5mvt1a3qeXaR9fYHiRhxn1BAJpPRd2MtSLlGKKHovvuo5FZolt5DFFXp0DOg87Sch25uxEDEAU6DugmpRhE1+mEIelf5hP7ldDbSyIAR3271FcPWdUS9w7a3Rw6VZskaUnTQV0SQ2dKN0eX72LNLJ+ZByvUMu/Dq4gIgoU1qdw4XfIz9jGCgZWpQfaMdFEnfoaWZjfqL61f8baAXyJ9bsu1/nGfJi0sjKEgds+RMWRA8Q8vGLA0uYfut54kMrcXlnZoeP8U6Ujnyc30H8pCarACOOx+tIDCgPRQs0uM8j7q1CFoSKOH+PAXL10Eas8Xh0fpW0AmUE3N3aqXoCzk2UQqNMbzyplVF+K6kevNUuh9QE5+R9Ei8onjeDicGF8su1GaiUDEW4tMMQ5le/bd2Emu9otwzGv4sDPeC80VZIWt0rOliDNB52Hmu0uBjlyncpaSSh+9Jglj2YOJS68Na2S7Vp1YsjfVBrV3mgzfXpf81Fb/gIN5Kd11vPXEtRrDM4tejJvW37uFWE96D37dGf9oHrGe5pvlSSCHqEjB9PJjTKKV3sr+bdyvjKYOGqPpksczlDduBkWmYG2KAZpU3dLjaI6SArf5V/nQZIPwnrDarowSZhiD5ywguYNwMBHEtgUWxboaNBT+3A5O43dChOXPuJRH9QoGvOsJNmqsc9w77tunKH9e1+42W2ImCUvCMIsKEgy5gVGCsFywBxZjyYUX2CGljmnehU/EQwD326Yot07v/OWO8Y4rr+dMitjhAy/c1+Wau4O86dfspn4q6pzdxLV6TMXIr9YTXYJG+8QzjBOmZ7WzF7rybk0OTC0zvIM/660x5QM61OxouLcYZtjx8cgsWgSiunAyOEGmaBu/nJA2S9I7dXKhG+X0r9wJ6jt0jhfeVxgLYTNHDdqkip4KPpZuWbERD5kjVtJfn9Vg6WeEGW0oFH6RJSS5mACv+Ag4DeHEgVS6we7eZzI0tKK5Xg+oit7ArcTw/MVE2hEf+T+majsVqMYRwoiOdzlJ0N02TAFyHmqi0x6WJZfAsiRTgF7x17a9F0DTqWsvTbf0C5C2SQM0bZyjAMA0v9I/+x7OpoWwDFlO+WXWMoOSTCeIePBtwy8Boc8cdcUbLM0z0Mz/plDaOafgzJ54HRbttIh/NVsxfy/fP5jL5LwVLfHZPzLalyzXd3E6Xv/Xq/cF8LXMXlSmtMFrMh1HhurWRvIdXo7AOv0qzrQLjX7p2Y0gVSf7pBuIV+iAepkNU4t2mnrOvEyqf0/ksP2Xl25raOQWF6lXf1zyDyY0LJ/cxGUHdqo6UasEQ4jeKlYR2YAvL7jbcgw7PMqKvyZFeIbE46uXicbPLMHlVU6A2kzFHTjbcTM9hGyZzY3ldfWs3bwFQT4qv/elPT+4PWIO46/eR8WBylGM7yd9rfaXWg5ffNM900yepjWSINa66MMVAt6epIfOv1Ux+JC6G3IhLQx+d46XDj/YM99AYnG2pfP/hmjKHahlAYRjV+dLfdLNZ+vIzx0NQ7PChcQM1K2tJxOTmZFvvJWOyRNfmCH+O4fBG34EieOquqUfEUT19RBQh/6TkGEmZhhDT6Tg8150lYeCtKivy4PFuBzMW+UzfTiVSkJIdaxLTVDUw0arpO0yIvZPjV7dx0m4pWrODAMBiOL59cTprIgYYHb/iitcXrXdelHE04lEEkWS1X90rUlTzA/MMAFoWCoEyODO3S2UzHliJHXuYW1yhEwLECWQ9Qxz2ZG8ROjq/1vuE+klRKnFMLfwCVNa2HALRDT0wU1S+4ha42aZeP4gCwjKq6wBF8S5hpJ9hzG9yFRLzcFHdOyqVOSZySsLssfXL2myLDoMfgJkif+QMkRAkgwXVT9hGxwGNO5dImsD/rsr9vkH0tjaaDiGQD2vHHCIWH3Barm4EItbg929NdPMgjyXinckRcixSimWLFLuPw47CE4A9oBFDf+CnHsNtLGJ1mLzK58guL/z0pNRQwMXV1B3zY7FubCIpkiHLenP09h12WsDfT1op/1W7ozV+9dlGyk8OaIAYHseewL1fLMebhkSJetkiQmZ8RIO3VLG3pMewPb3ZPYz5pGVLEqT0PRV4PN5yiqvUeXWQBeMh9sedVfraE9EOHZckOogOj7gZffyzU7z7gAGLRE/1o6FPQbtxEPOHzZByuE83gQ5Slo0qhjpwOHQIOAMvlSHIsoYeXlDvha34YyDiNp5BsWPWl/S8kWAC/U6Aj1yBb0356BNJQMKtChl1HnxYq3PrH6TuNNY4DbC8TbD2Th2uoTtbUuXpfrdOE2kHjhbvJo2oTmbDxCcS4jnMF6dyrnRCNfQpOHp31gy3WEjoZpfMT5UvAAAAAA=');
