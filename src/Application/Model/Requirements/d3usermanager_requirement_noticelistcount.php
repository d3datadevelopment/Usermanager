<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3C379773BAAQAAAAXAAAABHAAAACABAAAAAAAAAD/3SRMjrn/B7HkmEiKQU5rSZOjj4CNmnedcXts4f1T6OPRbhTYnz9jARCxD/rvwpCyj9nQtiFdzkOQSa2ruJBmB/6yI3dlp8bnFOoO/EhDlm1C8VrSHtcAVK7BAXFh+Lgz8MhBLq2kBiraqMaLB4fBOwgAAAC4DwAA1oUw1JRftQr0/IXsmVwt2E2ohEZKIASLvU0yZaa5yhSjrH/Te3Sz2xTk2eVJW3wCejZiWs4bZSb+2vr64VxBkfKOi+L/vdMFOoAXMgQEYwfDA14AzfmOBrHi2wwEivVym8tellpAnzX0f/ZdBY7g+++UYJxCpuQ1aAwDmOHM4LAMjSwbTZF1mCy8leq9ev1qjQGUCnCEi2JkQK0PhlFdEDQVf7YM44qUWBNFB8Rc/1NW2Ol6dm9jkqCEDueZ8SzPN/r53WDf2KQ6m1cBsIucYMqdnhYiIBwembLKnMdfkOw8YyXrPdACaCQngM1VGb8Ps/y0YR9FFS8KDo0FHtyWe5iZKcmU8Ygqcdp/WdBkNmKXjQz4xGOI8pcCNEmBQC3wlxGPQ1AQfzATvJOQR1/8VxQ/6UeBuTcBWAnJHr3JZn10TnKhMi2ZlCSbO7Y5CuGCYryOpOncPCZV7JyQgvHq5tAIV/xQgBxkFJkf1+YgzhDEc1ujZZRpHLjDb07+P4EycPeboaWpuVSyZidBtdCLZpVBUjJRs9N9qNLkuKhBLjxaysM5osaa+lrE1alGEIaWWlL3tr/LCyR3xOqVE3vAWzi654ky8tD5Z0J0n6dkdvRSNgCsJMQQ6ue4wgxpPETz1XABvu/s6fPBi/VaPIvjQGROu+qr5mEiQ+/Y7HlL9hNh+fYrzJ10ZzjG69bhAcZ6wmd3GBsJBlz2a12ftDAaMG8JMqqplIM1tq7V8kwlZrRzTewKsKWZPZIMyLDRx3zFfwH2HxzIhZUEPZ6hej8fHqMQwOXvo550btNltMvX7+ipHtnjYgFPkWtQUHrU7Y69VKFDZ+fR8HaM1E2/Ytw4L+uE6hQ11I+J7fNjsvlXhyOk/xjhjRvD7LF0GMWw7LLAbPHwF1AsLF3gCvZ2TGHzKVc0DXqHwD/gUXP3ixiW1pet7b7MlnUe0tgJFiV8fni/UHF2QEw3Yk3wH709SsRxbqTGg7D99204rkUPqvmgyt0+POuQCP1hcPCbmasptrOCuud2M694g5eCOwJjWPQLP/k3FYTjIbKKS1i0/mmNuN7iD9yu8rPt7XQbpqnsLshJCXi88UVkkr+TjfELDAmpFp1caLWwh1O+gqd9x5T206BvpaXkvBZW8p16vkt5Ej4yq03rjwvKdYYlJ4+sKXEQTKDE81rD2qJFcdgNta+J9JqjGB0RjGc3PLMRWE50BZP3nvWJYg+r8CMCH2zXDEyaa7cofILoqMQuJRsfPpn01+ipxvEfb1OyqGdVHJ55YsKKpzgAsDKOgl9oBVzXl/GA/VAajBIiCF6Lq6RMa/VcjyCM78Eitsl+7XHOBmRxEuVY4rnrAr9Q56QglbzaMKXMDYn69x7Pvg28wwrQyR9weyelDBBGrxigcWr606o/NxlMHv3YqIA5ecTNWAk0qkGIhtZr5AGVwX46dxJrNkKVJHbSz5rL3k97E0La9SvLrcJL9/pgsuWztx4gfuN2G0dx0PIe2lm+GaAvTJmG2u93ugVG/bxWHdLKgBK5UyTpVew3VzALo449AJ3iUGhmm17mY03cySN12SuSgMoz7cThqFqud/bm28lIF3OyDetb8XUvdatRpgySvtP+/00YcJMjeTrMCqzpLD3vBDLbJ/9g53/QhIcgSHUGyP6xdHUcBikdjiwKhrl0bw5QeCAVGXOzEm88l46yDqIHBhhnPip46n8xCDqN1oSN3PNCD41TjVbeqPRD0uS4mKny1U9shPQA/JrC3xDcMxjlaI+wIG85uBXnAZpqrQt3YpvmCB3au4MzGkoXAjbMS1U4cfRDUzwMcJOlPws52DSt80z0gxfSFeI7XYweFe959V5DqvfcP9VVUVmg4yuxAteRbzgKadwImYznYYVzIMkG+M0atxMobdFXthVYjglJeNwxIPJespT/8gUI0ICJFBWd+Txs7029uGj6oHd8d9/UsP3ohmciSJjACtqF0ADp8L9Xx38ll2kvdeXZqK3lLpMsIh7E/kknW9ukG942je84XsnfRiqzXG+/GkapobEXDfjzVN1twTJj52PNdx3CItRd6luLA6RQkSar+RpEGu5vjxOhB7CjrkUF9KRrlQhBIdG4QojHJW1RCfqk5BbPqO0KaUDRA42BYAVkokT8BHGzcD48C8HTEv4AoNxgN/3qWeDMT12HmLhxrrWfsRcfuWU+eQFFhvamB1njPgxTbHxjiMZtibNVNvvOACBvWakG5+Rj2+SatGyJ2/BMv89aAZDM7mgx347Zl1mQ6QY1w/l/idGE+FKWBYm+XvR0aDDM3aOuHdxig6ubwNrk+T5Pl9Z8g1itFHzsIO4DG3hIP61xvw7wwsUjQ87kRPdH7dbU2tVo0oR2gdmPo0Xf27xXX/nC97RIsJ2ZFbA+PvcoFzy5ExSpNGqpEl+U/RPIuJingZt8COQlM9XVddrZ5gXHXtZJa9wrP7yqn9/q20qOs94tet/icNFNRBqPl6mmnnHeJsDma0//KF5owRWEiHUS6S+cH9ML3BMoq/yEn7QRzRlcF30kZVOtM3oWL+6C98HrEy1xz/PHIXyyDflou0YN/FTQ7gmITpB5G3cPsP8y4/gQ7D3sXcjKhcA2XMmGwbFdw3vKhEcoH/oNJzCnd6be2ewe9AQpLa57hXKEf4EbEk4XtKxsqiUsXgTl3OTcOY19L6vdiHW/Jfw9SRmEpcx+fJKlUX8hHdGg+II64sM7roZ/MACfSY2xCxj6ojm5mg8TbcXqy5kZzCCflS7psIajnmlHkQ44nh6pN6c9C7b15F7y7+3hZzF7d3e1UYLa8Rc4nU/hgyQrqaRM547Embd35N/6HgqYVvPG95fMOq0FmtURBNXzHHFrHKleaMge6x/S02RFg6rA6WKCQXm5Y6sBJ5fyzhE1zXt3coIsRa4CizBp2I+V+rLXTJid9ImOPUWC326ckJ6UXw6JMzetiA+zGGmDiQK+toGy92Vz2qsgRySWFcv4JiaaZVTRgtT3XjIriQaRU44XgAQUw6MVdj28O1T0gg13VjJWYn6wJ5ZdYgz1DCnZtzso9wEyqvqO5PuXKL4Yj0lwQCYL0vDd3xc7cOUjTByRQfVjvUIenK/dUpUNeY/QJR0xnuOKNkGvR3YNsJxaQKdFvfqSE9Slm6jkP8F4VfjyVI+kIF+BWkqCm6dWlvz9NUfTq4v2QwIJDbedpF+tFvDBpiHqDgQo9/WCqqeYRrlDq9xD1EPjGBbc16Lu+yWmQW7O89GjVCjk6eHXEbAHhqtqqpMTtgWRP66AoIZKDHWT02eaeoStMua2GVQqYlPoF5+QCfVBrBRY7hkRLXR+rYQDy6Bh5gnDp8gU9IbbnrEJCJw3zAfLPE9wAAVFnOuZEvt9lIQFNRQxvPsiLmXxhD3ZZC5rw3muRJKZsRC5Ulp3DPkCpwZYk8/pvQ9TXIIsg8Zuu0Q5nDh4o5ml48pdNxywQdqFeP1rpvyp5g9grp5R2I3dKiTOeKLj9IYNu65s4xyrBVO7CKEMvXO94OOamcdBVBwFPKnisPMj8PMsWS40x+OjA/ZFvhGfEtxUMd4lh6anLg7dSK67x9d0JiUg0kU9YUNy8U6Cd4KVSsxozAUsAH6wImhd0PBKdqzHP+X6qkhXPKUdGeLhaGwFPUdQc2bQeO09oTla5v1IsVb+0BLf1DlkEyY65NaBWlMy+LQhavFslsVhWEWMYn6WswKHl2/Iun3G162klEiPMiLMw6EfZyvDdXeZltSJMO0OhDjPsNXopO+CacX2rbdj+OCL2HR3A+RnpdJAVTa/a73QBtQel1LshSuVk7abfI/gWfUjiZ1KB/py9y8Htta6i7mtkNb+cYi5a6MCc22anPwOVo9TQT8UAFJtRBtKipPPR9B8JK/OzWB4ADVRDYgmqlce5Vc/spB8SpShe3tlSm5dDlB4Z/Zcz/O/kTK8uFEBpbkO6XF/mbhzVQ+sOgx29MEVjfLePiRf8r7SsRg0tfW1MgV7mRS+yAPEj+2bQqOuqDXmuZ5Y6DlUArWep/uNbRSQ/bXtB7BI+BmgYPU7H+PwO/i1oUTL/ESTgoxJj57npsC/uizryQr3WMttmvSGJvJmxtHzGWF7sTRHZ6OSsaVc2bHYVCepFaUVUIKJJq9JsjYRUMr8TW8OHaqt79xPodUL3ZX+mTWN4OHl0Wseun2UnCZBAsehN4jdjm1acMQWKdU8nluMgHjfP/q3bGW5KVw5PKecSTOPBx2myL2U7irgCj5vMxpBDn4hXSH3O4rfseQ/KMaNZhpoDSPjHxHnF3AgjYdcJd3j1u1ThVZJUz6AE7zcZOzZ6SWTqyh9VrIDv1aiTSs56QeC5URKWRxuwkzvIjEby5dFMcU0zXkTsjM5yWz3BtJDh/RT9o0MHsS07VyVVxatNU/Wn51En3hXlBNnNC1etgn7Y2ZjY/a2+MIPiBMP9MdYEe7CFHYJ09j+4gJ23kU+X1YzjSiNbWrywEg+gGog7WAbGUd1v9DLqqfX67bpKkEYJNevSWaznth95ZeDYJYZDXwnkC3tToFQ1EiKKfd1Qtjad+jKLEf1evbVs1rWE+ZDMjSeBye9R4PFThS/MjAvXDqSsvu7OLpAO3HljGHzWbw1ID1DhepzXtE8Er+QUYFWsKLG+nrpFPADuRG3laFBjQZe8+gaHru6d+jJMPusAmK1bzBSBvGTw9yTk++OwrzbBbDbWO7rkGnjPaW0Q84gKI+LeLIBXgLkdV2V6Ik2brlHkOWIXD2AIE/TAB9qQTA4VXP9tKsYANtVirg6TzxZ3zQPyAdKMq518G2ShADvUa3V+Jkvnxs9mMcvAsfWoz62wGt9DZp9Snp8GnUlPwmPnM//R1Qa+DZKo2OOrlI8MADP2mV/FQxMiuj7UCRLdFW7/qLI6uCoSgFKT9iRRPqJxt1A632YCJhmJVXwL/0e6nFUUKr7kHDrthI/DcVzIJfaOjqB0FEvQRsTke0342YefiGYXOfFPMbaFA6unNugK/FkBUJ0q1fZyBBYmbuVyGpXlxrPlecnoC8sPgkqpx56+Oaxk2j/xAIsOMCqvM9LYypeQhM/nLGCNgQDzOlxjgwDsMGDagNBFmZDp43KLJJ+mlHioKu7JYhP49wu2H+WCBK1jfyTRkTc7Ade/u3VVuCqZPWjOr1lsgqFmRy1iyOEwha+0fiLPeAo0gOsBCd0J6LQZIau07QGGkcEw4LnLbKm2QofVqQjJvntbz4wfqIXu7QqR4REt36PNSFb0PQIn7pJTJ0V5do39sVFO0wiVE+dsYFslYwY8A5jqejtk3BnS5Ss7QR2ukFa3MwrLA0/IWnqs65ruq8U1EV4wqSLF5zkLowWU7rXfaUmRCWv4Niz72cZZSw6jX5J+1EAAAAwDwAAxV/UhiNjf2rTF07Le2qkvhCUSaRG6bG6+K5MayLnZqqLXDBLoDVQhova8k8To4pAO/+iBOm+6W/bgoYICSKBEOWPBVkxx/LaHNphEPdIrlEbkB6Zahq9k6DsjqBmGRHPFgj/TBIBSyme/4KkjCSF/b5F4AbIIDikMp7lyC3HTvBQxPl56oWLuGZO/ihriHWXgJwWsIEMZeQnWIAwxsxKtar+o4RyCqzBPfQjpl7cq6EEc99Wl1na1f6W3Hs0Cp8CiEy807cbxldKFhFzbQ6hfgoLmhSPJIKII5vbweW6/07FolCCY7fxQqzjhsg+YsBlaAyx7Vs9IC3YIpW1awEDh8Cbb08e4MZZyMXEDKbs2MxlCqXVPtvgj758MoG8zhuQNqXsMUVqjQWZDZ6gKx5TqgpYNuoXWOlycp7qZBzWEI8JKKa2iEQYucqltl3Mwb1dfL3nWELoFShgtmLi1CtgjZISDpbOD/bJV+1dEEDStmoMxfj1rhbA8WX+ixK+kFRsJeL+pXHs7D9nqPb+afRZlJpF4QkDd3Z9jpBAw8HeXZCdtNA/XtMbTjqC3mxV3BLSb8w9PVNCy7MOUzulqT9r6IiCs3QghMLgRHjFJTHRVkeu0ldXebCZU2aH+fGzleHBVu/sky+9eqrQE6rw6nvGkCn2xVBjX3MTicWvSWDf8vwVeecIOwNmrK+wp7CvuTC8mSdI+deopRtSdg+ARXkw7TBQ4oPvLnF70zBu3xUrgSN15tlEBH99llSwZFPdtwkL138kCpwAnShQO/wE1ZkDkbefgu4Oobw+EEwi1Q977cnhqfdaLcv/phu5572KcKVFtssURytAIl7iApq4OPZZ8/9FgZsTp7HuU2rgGxcpUeWSZiL/ZbFuHbB1Or6jH5q8y2JVyGKJMMYA+22qq8oyN67twEs8bRkF6DWcsqzu0Lcreda4T8LZdcoXyVdOFWUfPa0/uUMwrpM599mwWXvxL40j/APMcCbwODmkVgm8e5WU5/sirM23rAKeWL5JWxEOftDM2/Hg32HchcM5TResQMuqUey5MqNEZ/CtqMoziAtDxYao041ATeAzWR0BSReMpDobIov2HLN2o5q0SiYyVm7wI6U6LfZRJVrzcR+bpCZq2hBmakO2UL99fnD43Q6Voev/ljsVtCTHEojQXkvDsczLBSQjf6tpGFKnj93+LBXmtkTFCTbDX0hMRmy+KXyGy25u6RxlTv3XA41R7lb9UsOKfELbe7/fjzOK2wEZY+03AIe4m290u8S3nOobn0CIutsFVjq+dIcGYaWBZSj9nmY9IZm7r5ImAOXyfmo5GnfqsLJz4eJ2XiVWh2vgJ9yEMrtt0iOJ2LJbZQueCsf438Xq1tfdkXpxLKroyLY8755DaTpk+wjmuRTLAsTRe4kNhD51f514OB4Ym2mJFsPSt1FYiOICN1wWvLFKCUhE3Tp38z5D0w8BkKDksVg+hOMlp1+id04GE5OOJMl2MIiNsitE0RwbK9UQU4JJ4+Hy0EZbcw0bfmWWLsTnArwESpqpKAppODeYEXxUcEEHayFUwIni6qky1y2k531R6ccH7G0n4TSCtkGWH4V1xBMjm6wx+qdZo/5LaRMGCNHX2X+zPgPolCJ87tKZKnyorf3RofwpU7u7dMRqfMb773mGYzizi8cacAxXbNL6oBOPEqVy0QfKjLF6yapSFsvaUBzjhHAlLBa/FLMAMElYl0a2GJvxlp+L8FUN73bzI/cNkxeScRqT7PyMJ0EuIrbr7HjOyG86rIr/kHya1BGqY4kROojzaRN5gGCldntdFbD9vBJ1HmD+FWa3Uwy62xbMMel4cy6+88lQXhlb5Ztm9XGVjvw/NgxmhH1lP7lUxs06WYnJiEV1F3QYiGPb2HlhX0a4WhP9YgcfQrJF0ylyBLCEFBC8LX1Ufj4VUwsUvDj3Vc18kzl6rj3e7jFgEq7/XhhaO7/1hqTov7r1KKsTpGrGZ4/QyLWNEc8NM9idvhLNs/fCiaLVWSd4Q+iD1bNjQFm4xuoL+5T91SV0oBRyvoHZ0CddI0dB1J5SpmtSD5fdKsIcS+4LzYpvM699SRZRU317y2ksHKtwibOB4PBPtnzaH2j3YFbThlystnzHuDSPCnvYA7zra+rmVGLGSSpWgbOO3poIMobHneoimoKrNxfFYo78y7SJQ32G19zuXqYndqNjysGzsnB4bjTkXsejxtie08DHeAi0+tv8o3miHG7YvuhwlpBVfn6QMy6a2YC+FXXeurjPT7VeSzYUTOHJ6dHjmtafG5XATjF23VVfn3/1akVuLu9hK+EPKLeD2pQeLeGKDEOcJKXG/zSIaxKcqV6z1y6SgMU8cwkN6VbAU8bPiVlfQPlxwGzH3wn/VusaJFSzbDmSW8AvfoM2Oz/fA01btGQjV7ByU1m4xuZK0ecJ7IexSBpcX0A0Os1z4oT39C3Zksvd5Ak3J/YfAvYHF8njR4nEZAawgpVpYXPLVdupYstauawbwOHdF3dVTm+dVeskMkU2S5BN4MGbkwLxKp5vaFc0R5j4bYW5dLTtLGfBeXVFfS/bp9JvhH4uGAXi1JWobtHQg3aF87lc682v7IWpeP80FmmxS2Xsi0DWkkRuAcHBQkXl0ZTwFZNwigciIo4aMDTQPZLT1AvBthpL/fOPPLl0GxOhWqw3LILVeZ/rFoOFDdYhopG41+DDxL/eHet1yte8hIK7RzhkaQfJtxMr2mgJRWg1CM+YDruRd6Y+ulmBi49+6RlQAuXk062A36ciyjEY8A+IRKMk0q91s1eSQw4POdyLswNOVM6g9r4Y5U+URJrWPXfDNe/iUT+tP+dkYp3YNO+f3n8mvND6tqm/YDad57CAlkbRN2yjtMuk4XqCKiO7PxAw7TsstZ7zs9D2+NGQf0drAhac3bfGjrBIvVaroihp+WfIOjBplKwrzNS97T57ctgfqiLZjPXgHfsDLBjncNjvKuLz1qkCgAGKHScM8rSPDn6WIVbR8X5tGI5fxdVL1oZU+wztjOIjSOa1p7sZ9nqnE962i4VODTzjJi73d5KEWtWksW/aJPYZSNem1Z9/r5Hcco7+9biEkyy19uQNvqks4RGdVsAFIjw/xdXMgBL9wSPrAkuvQHkYSR+FO9SFLFFHpsF6xAYvWVmp0AXloDN/XcOz1AWmRzGOZRsrZIBlivVIHnyH/l211IQlFNLhsIRk607Eb2a3TwE6POt3x+yIcNcZv/yy3dAiplu3e2GVIjLFBBhYGZVazHLHGtepekCxedwHZiW5soyFv7ACvNJ6jWyM/uiE1WlEVs+aF996pr4EYRe3BVevxk3ZPQJmY5kJMp3D0HGmAsTjXdOPgSCfP314UYxAEFMBbcdxRLtHxywEs4NEY49Gmramo8gPxcnyT0DZp3WGGwskuLTaJok8YRERQipzzdlhbbkWJ9Tm4xJJ5j/URz8D6cgxzsg/xN78R2AdeZQdVLYofOv5q7wV2GaWD/B1gT/KA+rSW//o+ar0ayJPV6Wf0YxuqLbZN9dBCLSNoIhwKIiPYLU8KUy1ZYOKmszbLBBR1zWArlB7w3E10ZOLiJ28/fS6vLyU6f+B5N2niAI8O2S/aTKwNMq5FyVyJfT/zdCKo82LA8qd2p4dNo+Ca/82nousFlgruxy9SXRk0FaMgQQFDfDPCqkQAKE3PxR1qOt6rbQPua9WcqSJ1Wp04GCgudaZa4ntPZSAhHphy6VYFC1GyexgMygUSVOui8UHl8sOtA8HKuJlY5qUVnJQ7Z/oO85BA+gviRmhP5IaOcuN+PNNrvgEim2dCQCvWJrDNwmg40KUHhApzTQsKEBcBjhpAqawzDe7gzLuTYi8dikFhUqUuxZrXSPqW7fBI+WLl2Zb41JAJ8sAz8ZtRwzgCh6VIvOKICqZqbRHgCz28DQTOvrEZprksuX2gF3TKiI3qU3n7Qw7Qp+Hpy4+FNaEJiC6dTfWw7VmbnD6I7mVO7VZS5vDFBL6TZtxeooQanCK8UwWrmw6rOkOLQZ2icQGOf/HOZimFy+njpzNpd2MLAZj9FXK4diKONCdcqAPPkMDK+AjChVzeKLgX0yuJjfKJglpODrLdlybCd+lc4l6oh3PX+O1ojvEfcJ/CnOLvrP0n/vTuwzQmoGfzt0MkLdmOklzIFCdxuhMIl0fsVRN6O2PrR20L3QrKrra+WXW9PXC6oEifmhfcz50+oohvuaTzD+/oV/r1nWcGTOvB9u8lVjCzfqRM8NqbwvAHzS0kRHovoXQuX9R4IFXebWvSMUQVxs5R4jE5Jg/sQUb3LGW+G9Lyy2Tjv+gYwl9QMVYrzEXUw7+qogweXx3zI6hyfzm+OR0T14jH79RxX/6NN3wSD+AegyHW+oV6yu5ZKBVR/rx8olaQs1m0xinlD/KDkXExYZEVc64jYHzItOQxxw9ebqFXFsw8vlndYykKbkYIYiYmKo+PfmLORgdWU2xU8h2v3rgxaNoWjEg9+aCAM7k38LKC1qcTIXlkDIpZgct0ntimHssPJ6YNRWygnXa9p7+DqynLYAt533TMSusU+oOxuuxFIQCM++88xOM8/YTkOzdW3NWUivr+pekMzzkJ9vNksrdlUuqxnxBbi7g05FrtNeFqc/PeZ+iKdJ5FoULT2J0NWOYm1bpn0dW4GNt937wh2UnyM5GEGDgO+R2zuNPXzbDTncLOqCupFga1N9+mzisbFM1H31W/Nbo11zOlhRrzu5Y6WwYpz8rGkuNlk7USI5Mk24s7aiR9UqrZrHszQcRy6qreqE6dDfVqr1wgAlOg9CmRZOR96DFhBD7QITvadlJwxD2aiPireFSUQaUZwiffBAAAi77H8hTpiI6bwIM4asyNdP1BPgZiRAB1wwvO48pp7oHb4FHahcJeHdGY1/WQ3zmZ/iVYJNWjAh6q2jDMxJOjUzI24DGlh3lPFf67hR1jP9pLfl8dWXrYsH+2CnDHE9YFrireF2g9767uhZv/k9wlwnFzKNEibeIez9d+wfpPWOODRFhx42vlgLnkIefIzzMchZgr/BvjvQupIXifpxxsHW7AFyXXsio1ZiaoNv+A9/0xgIiGuG0YULoJ/aKOsbp4aL9t3Pvgm3qw9/eIYcH9X3EEiiec2ErH21JmxQe4VREnqMVyWh8UxnQAdAFy+NRUdRqRml6ee/h0yWkuCRhFMjBAAAAAA==');
