<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.2 SourceGuardian (17.04.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3C5797783AAQAAAAXAAAABHAAAACABAAAAAAAAAD/d4AwzkL09su/4IQFKPQT4n3o/qWsxf3ILyi2hGMKGvqkW4kFuvSHoBLRDjHrEVF1fWtUuNqHjAQQvodglSDfGZB0jdw+dtN23nyFQ+/tjNi/Fi2NHp0tLB2q7bI9yTUNKKNnCfgEfmZuXu6awzeQlggAAACoGQAAVbp0vFsEpZAXc6jKm0gbpMgj1RlSMG+y0yeB8sY5x4SwZ4UxZsFidvGjI8YpJTJFu6F7PvaSRReWNrTjvvnHXHupNpqPaQ2Rbs4fouxm/gQzwFXh6clDjCE4kwcS8MTIFit7g86yQ1to64XTHlvEze86UtzxIrR+7Tym5OI/YEaX0ePMu+/JFZCYlJ9TMU0DATMdqgCCOivcjHVI5XSWu1b47TVG3sZlNFxbBebXjLfKj1cXHesaz/VWXZXrHP62u/TGe3oOmthTkpUctCV4yS6f/1M/9vVQAVKV4K5PxbcC5/yupefvi4I1WCcXlbNUqqfHTfBecWjVri/n6FXFddq1fRICBwrKXITm5fgPc6r1cAgTP1bWYwrFT1rjv7UOlPLKaEMHzOkTTSHXkdiyK5n3SQZR49NK9jBgC2bkwR0cyCrcfPY0rLqQ+YMU4coBsWOOT9FYDHH4jSRGQ3JvGF8Hs+a5lpsJlkFVNN9c51lgAdpXRGtFLzzsfb7YRzOl5ubaQfn3Pq/RJ/Mxjh/S5gC85idJGkhH2zIUrX+4WV+TOKSgoi7urEZcjd8B+1QJQqTCjgAq7W9CoK2o/WtYlEI3tQblr0EP0dcbp03J/g9xyPQ1l0aXqZl72JcHqHrm6wdb7tnti2poZdpOENDHJz0NfRoYmXf5fz2nmf1bGJXBcp3p8L7rMIKk5r43XO3foizBMpfwxlyOdvRyO722S2ZoIzFOujBbUgFPxJGFn4dBmM4VXnLXYMy45QS6NB5pwUIOK1FKUSXt79FUgtHHJu+AYnaVxd8z0A61tWBngW+0qYYJv4W3IPs91h1sQWMilvy8jlw+9Y6/Arkyuu8JtZNtGw19A60UXnFLtV6mHhF3MV81A+PrsRpxoX2fRUYpNupumPQW37J5nR03DCBKr67glpq/IOVFjuUNxC7H2ZaTWVzcBjNg1AnCXBXOxEQIIWaI/GC6bvnL+SF5q4RT+BEiru1RZ4Rb9sFXcz2SxYjyfZ9azVQnqRuO51v7kImPstgtTJUm1+wXTqakNtbwpHl0qyLLUGgukAtrx5sHVa0AVFt9FcPjSnf14qTkh7I2H959qJ9k2klKIDLnWNkEP1tdzPEFt36dYgksjCglPK2rqHBG9JeFSZOik4LZ7YUbbi7A3OhBy0X7DWl2MVWY/XBuS+CfJYdrG9Kxx1sDaOw5iTayKe5GPThfmEgT2rDLCzuL8gRZsi8098LAle2fslxs4+sH0tLLVhtBvR+8M5C7EJXID8xy5lXflZGTIq+iuuM8t4W+eAsr5njLgE9GZV6F4CHz2e8lDXETjsUFHrYAsJQj3TKR2S2DT1Jad3SSC1ww5mep0mbXnFbswwIY00nX3cLEENU3bCuidb1lvCf9fkDdVVK9hwrf8rNQNp3elFpN23D7IDYLrgzlGaUmZZWvIGjdPy8VLkPVKijE446gTn4fNr94WYM8B6CAPhJhRjxAQ4bLRJVsYulTVBHAFhvh2CWim8BfxhPR9PMh5bRT4argNRKJ0cs/k6o9/g55TJOGgVUy0870Gk9WkuEp9SWIfYTAMTAcAcyvUZBLBnT7Fkl1S/8jtB/lywuVRICfoUyQt0rr0yJP+7Vk4hT2CJe9Qo9j38ZlBPzOYkDYNVgkjjCBhism1q11JvovcY9QBfr3QQz/UF7TLZSnPU2mnP8GZeefydiEYdEjfTIQ1jCy3nB6LITOl+CV175z0deOrbPSObnBj+nKLNhACYz7ntNm4QQynjIs9H+/v114yGF/ws8DS+lT8qpEX+yrQfxcZTLEewsv6MQPI0H4RNZBjYQWehYCYcM3Sc4+qIpXm6FEQOtM3VZOUR7qBx+xJGI5OgQZLBgoxYP0xbgXEuWDNafiynLVxY4iCCUDk6Mu1J7+CVC14NZ4jGEmNC/1mCmg6a2ksbVW+lu/yLDhefmY19wA1jhTPw6S35i/+XoVZ+Jb1y9Zc3rLsB7gm+V3LLs8Z3/+chVhxmFyofhA61V0HKjnMmrNbQQau9wStRbnlrp/7qYzloKvpeKE51JX0uWX8LHY4MOkuXDE8qk8qL1hN3U9tclAEb+ALmI5bGDgLkVFcbo2sOAhYM23WNt+JJsJ8vsc5DsuQmVLK/sbFZAYqEI6tqZAOKnxu+mEA8/Kv4AzR3tBMWwgkk//J1I8xROmBtunt/70QBJjw46r3RherU4M803JPOxrOvWwFDgGlNNF4iQNQf/JVNXAMRUCaBFXtD45UfQk0EHVbeIpZQFGR4P73RU/ykQWvFMvR7aR9B9KpXJy+Q5IH4RZpGSoZZrdkif/Tv+nXFgYD1bj9w0J1TfUnTLBaPDk75qdss4xE1a6Kp5ODfkRPN38zIUOsNwA8DHpfaImbDQwndhcjmuhveBzGzUCEEOp36bf1LAGtYIkT5nmHUEwi5t0H+fj8ToqumjVxWQZ15WVC/wY2bF8G8+h0YxkqtJCe9EzlZEszrastuU/mX4MO5cPviQeEPIbG8aJcO0xWC93povAW6XfQWsT07Tt9GqRsw/cgqIYTXdwUwEmvQaP9KjGi8FgavwxXRE4EckG2I+f4hj447kO958OCCxWMDahcojtW8vgeS5nRSB7Z7yzEm7kwFI5buogMbOaXmavurTs7nFCurmjhJ5NE10V8nNlf1jsKveKRCY3LQ0CdI8EcxtlnfZTQttu9CZJHL0hiKH8WUUwCoBnCxBKEwbf3zRZMqq3ap297rZ52WjakvL9svDiyGsY3hfN4LUN2m0GPm7J0NaMeDJWDQgwSu8bROKHnAXZX6MUTINPE7b+7JBaacnW+2OJYlm63kz0oJ4Lbfyh08QuK3oHD2Mh0yxKJ5HhZDaZGh4sRWeAbMzOw/osZqVTVf5u9mCm7zLFNYbvghzIcEHT9lT1IO/TleOkIGzI+2zTEYFU2Szo48RlgaD80E8V/XcY0/Kz2FyjpIEUPSAVVcpXEAtg0xIJE0nrffoulWqLqcYCHCIVd2RM4412VDt82Q9vVwIhm+iCuOsaIX9ZoT675NKjz5hWPn5TmzE6e4Zbf7uz07GY6ONZ1lA/p/pPHOG/g21txmjNPn3eKAIk5KvHcnNxBn3qq20hAlI1Bq+7Itn2W7H1bBU80mBzavl+pdJf8UKMA6gT0OggkptiTk2y+uJ90P/Wk3kX99qsVnP7oDpvq8/bLrEBW0SOoMlbV7btRez33WsfHN61qXV/nG9B340b4UMfXn+hi7uG+SkLG3yS2Zqxnbkj7g52KWgXIj/2livboimKc7bcG7aacdUphSRqj0zaxFw/PeeL4WAH7AC43DkkDZFN7VvQAWetJO/dOqQLINuW7A9RFmTyxE0RrWKvWTMio4GQSYoLaPMeEiPYo7UkAJ8+i64gGi6oloaGyFqwyRPJMGMMEt0xWquDg7bv9jNLF4p0mpiChOjcakTj14MVNN0SBcXXQQlFIspGjimkA01+LnM/7s1JrGj2OOQyvYofWZubLLXO2MpWh+RfdYMISdSkXuXM2ncfsfu7IDGpTiTO7Khmsf8fJpTMb2JTwo9ByFJ/PlAtjknXXi9TB6g96G3aSzOb3ZOUohAiJpUBK1Isc/xCnFDTlj3rLrNna8FS+WIqVCUvZRG6B95gYx8yYbo8h1D6oMjQwPh3k4yFxVmYX3mZW+ZaE+0pU64ktdmIbv6LScCCUQujArSHN9jBlMGqFVOkcEhGFsBwEMlrp69mptvHRYhi/3B+rciWx71Zeas9e/3TBDlmfYFelIxppCi+n6DNbRJO8ALI7Sto1gkZwX046jqTEu/lCL/a1HWiBTIKN7jxKmPL4zcBHjYG7gWXHHPm42i6Bn9P2zpHgDiTEJlkMgSgFyvXgyAbMpPEupD/996x0hlbdY5VAIXAn4k9xlRvpkHuGFQouYvqiEQUZiWMFigtpsTkut9kzUhmO76nXQWh6nRlK6Er9NFPErs6SlKfOw1zv4ksDNAMMIF28EGKCOFxQyoCtfW1kjqdpWDtMvfUNZig74kXleyQXRqv/HYlzrE1+dkhjNGODXYkagVU8C0mpbBdnOcwwIz5BwgB50GKO0mFMZ/YfFEHgpxn/HXiWzhzu6ualByV/dGRTYq7Ejx+EwDHrB5qgEAmVVkVVb7yj1KiAiBhp7wiPDFi4vlOrRMHaec6X8/99Do0XFre4iehIPmuLSRTvpPTcMfrae6p0cyzPofeSz4SoWNWhhGhSOHpcHVOwwYhZBh4/INQCMUJOJ2ucSQohjoUBmE88zbIaZ+Vmu4hwPqgEhW6oti/Fs4vGc9X8cifTepzSfHPbWO6FwNCVqiG4kw6Qz3RmoVUM3dyKv64z+bGAfC+0lgmnj4bbo/lJunkpdJ6pvWIiwUP6PA5gfazPfzEh0TmozIpTBUzhEh/EQ93x10RIlgT/2ix8lNFKS2dPBEEfvuzjdXaDMnwRjlU1GGLnMBc0J1wvNTA9P3nZrVs2agQu2KjOnHuYAUO6F4CLfJfMgVNXWqoZgBXsHKTD3SYBP8MkkHCKnV0m61TSuWGkpf+GmS68JfhK5fkPC5jMnSeNN2XgX8a2Bap1XHljaed67TAKqG+di6PcJpqGNnrFUdssFAFkhVyJ7MI7V8ec+rrMIp3qBruKzWRkKqS0Lsl/g6gcZ98+IlWvk+/B4Db1GSC+hImoU83SKMccAQstVMPhyA4uQg/mkd9gAw/v7VcHlZu58tIjmboT6uJvZ+Ihpt1bRaBaI6h/Y3Oq9PCc/R1rbk9upBSMucZwRNNBrjWxA2/cnCTtqgkuIXR1O0ftnZRYeSjiPNRJpKnsmIamsL2xbFxnkN6519n9HB9YKHRoCyoQ4Gr/B1NQ2Cd5d217E0hWaDRQWxeyHuZQ3R9/iG7GQoGkgf09RhaYt8Bs8w1XWRDOmFagqekWJjIphbw9CLzmtUhv26fTQVP2EehvsEBpG0nYszDqnDwAmFTUcezCCfhfA/bYlWFB18AKwHfkPhUL0tIhGUCoM5bWDuj0zUcmlLT6x2CF640sryOFnCCjyYpsIOhh2Xs18m4zxPO8hvein5c3kOFo72KNp8Ti2Zrnzs5j6xdsbwAq5HTPuof4fOnW3vKB1/OjCvhP5KEuE68U+uvBWhH/QUz6asFrNBLorlMcLeLyG9N2QCk8Il/3BLPT8tGCk8hgO1fl4CTQVnbFou3v001pnbootIKofd14AJlQ2/hqABDK9H3NiTNVBhthxJEqyz8ezGFyWUR1/y+NCEDKhIC9z3wnDlA80yH1nOhjD7QBdW0eFJXG1yCR9gmpCH1LZ4MnTXL9WwfrijJYw9irwjKMbK5uEcUHsBoxnaaHzFyM9FkNezHLR7zL9ZXCy70APbMOgqS4RuWDVCfRhjuVcK2H7Zo4Ea43PTvETb+ZBCAo7UOnQ+sAiiq6Plhz5Tk31jVOJwFIjzurDj4blH7k6sEFvDm1OfiktK2T0sHcT8b7iZ6aOUHQscjGjN9IVbSIk9odxL3TV5ETTTefFl74EWBvqZe45z0VXkUxBm6H0pmuFSi9dc7DWbeB4Pkt/JBXNKNuMhSFqXuVnCDAdHLhuqu1Uxebgduto3uHEGVlnNq7hbNGJICNi8+w2K7nqzSqJ8O/Pg8MZzLwiAazpFEKJn/vOjI2IxllPTIkqJUwkA3WNvf9Iou3l6TSyfdxBF0Oc0aOnRnlPtVGX9miFj3z7FC7XlDCzHRdq5YSLNmJhCDzAitFpgC34LGVUNS8+Xj7FoLtXMWjlTkZ+UWO87ptz3vfGOYaHnYu87EjSgaKfusgHzdrZVn77o5iETUsELyqVKtdeDA3/T076NbjW1g/RnkMZ7sWh6hbqhSmLM1mpzAXFG5771a8tOd6RuVggU6vED1bwS913RZrfIPLQE8DGlt6FTHStZ+rDN8MSYUGsWvnMfB/4jl2N8Jl5xBFW3BizIcYZOsuLi9gDMBiiOZGliAA+YsnGMBu4vB7YDR5gcW/vFja8SVTswwWnXbe0dqivdMcSSX7HQ/R5p/N8zMvWbTKcIpuAf19NsjT9qBaFvFmsTMP5YOpYjyoQaOtVSPQFRpHbm6fIfW39GnHKpxYARoSRF36KGUDwHrkUzA+7o7CMcsele+SPG7W4Gtfv1WLCXZsMcTEoahX9D/nSf0c940qX52C+5+rGIy1zoQj8L813AEfxmcp93RiPfH08N71eaCzaRG/qhTLYTMEVuAiAoW+BMfzKP5QXfasdYJ0Jqotvdiz6ZlWnKr3U5512Wk9qrpzTdwZ9oTiIje1NT3UOTyx8+8fLDjrGXGrLOPtRNYhzr9Hv7O2AnL39Ogeuh/RzOFcXnXaUBoccQev1qhIr0P7qi4X5SkvUdZRj4GcCa8uYkexkePeOFMdFKSnRGaZxdt1Xsph0sOMTDuM0GXUs1HaY6mhTpFx+UsVcP0+rdopGs0QmLdhhIZCLP3Ez5yc5lYTQIHA/hbe2LMTc+kDgJ/zwHZU3TP7u6Rx4kPRoeMn0eI/cvMauv31IHMRHHC3SqyngOgWri6Xc7tp3D0SD3PBhI6V6twOWMlpWdj0LYUVkS6h3Bcn3bgTdhKVCv3PGEFLWmny3fD+iQUl/mftQyZoDfznxokQC9sBo3OlYc8x1y4Uc63ghtOH9rNDIK8oWdWEWaORzz6oP3qjkOq2tnb28Xlx8UdKxJDfE2x7q6CfZxiqZwaAgBtZeycxFmXqyQkL0SJr7hOr/mnRUsjF87t76FUldFnWdJgcroWB7VbbsxV7RNfGXbsuM73qic4wbvlXOZuW2bxLdbCI3yYRGjXm5hnyiLke1vNI+PzpcZEDGYAnkA+dPgwFfRhHN28SUHCjgI/sjtCC/RTxZ56uqnxC46+33SevMBPzuDk5iUGUM5mhdVPar39bjRYZ1/gavWxygR7dDM2g1evo+iG6UxZxpwVFSOy76SJc6xw8UbsY/FnDRguiJzg599aZR8XzSAga3KJzZ+4QqPtU3b6zecM7cKvGrvxxCWXCbE8T+y58CDrQjYLEmV0gHFjoPXpHG8atcz7Jp9jVA2qHa+KGx5PMj3OPFKNP263tnYqUW/JYMNLKGHye0QGA9jVsSaHPgLshDQWKE4FPoI4jwxparXpvflBIpt+B/LijpKdAfywb5NNV9hhUfgcEpoW8XdiRfeRB7uVQLWHCkW378Fi8ckl5phd35piu8raCSN8wKtfbP7RYmyxKFoWEnED4HMJZmAw02uUwcx0JnSNtasHZ9pN2grVqtLgY9AxeLuUop4JzF/8qNQYQ/NKOO8qljQJg35jgVR7GMF7zvedf7BM7cabFzoOuEQlqD/cP5u6z/XfC5ilWCglWnHS0y4SkBuxad1/TTZ/QTdXcfoITsC77bmGYiXx8OFJupQ6XgKzF837m00IrNHyCTPYZe35U+ohAKxVxmvPznVDTzgAHc2ty1OIG6rPIQJAH36XDZiNBodkh9Jn11U3kICmNVXFBsr5IgmOVizeu7mhkC7bkkc6En89miMInDUU1qFHt2GJOJDmN0/h2NH2mn0aLhB5MNQHxpPD4v2zftB2bMiDuJqBl+/EwsHY3gIDaUilAdBzvY/ecEyBQoMbXA1u+VrhIOwWf7wuxauJD+edr8sdNaBs3WX1sA0NGJI5HAG28bs4tq70MEf94dqLb6cVMfo/OAc1QtKaQAyPPv2LJu3y6Ho8gir0C1q2BHjoECdFjqgX7Aspp59H+rAvjxc1Q1SQm4t3sEdKTS4Q6so4R74Dy0xiKtft+jbbEgSCBUTeOSuG63kG7Uy0Oi7j5ojJthVTph4zRjDIajjzLvBD1Vbq+cD8QCFEB8FkhfP48tnn/nhCkpyBWb4jsZaSVfyf/RkNtq55Gh7U7t930m16/QQbPG7SyGKeaYf8C16VEf3YSti+CjcjLrQYDpeLPAbbkSFCsSr+BH2mgg4zBRlJoDk54WnKCT19qZaUAgPFmBi2wLhvEw85hoHjaf9f0pN4vFKv3B1VmCb70Q/ZaDl90e4/mHJWnN1R4BRTJy94DitJgA/Sn1OHwHZV0X7xJ7DmxblRa7TIV0SozrmqkgCRd0H0Assn6WgDkV+rmfQ12Ex97XZX65e+Kv3bxwO/og4N4Nwt0PP5cQcsxdglgly2fQPUX/5vJZsOswgy3LUpEkuv3Y3Va5IfVcCAOdPrQkIyAmvmAftMds/woOznrrxIP0ln/PzzYEfkr+8mokJMnpHKeWyh52rYjZMNW8hSmXLNT7ZC0sLM/pboHIRIjcqybWM58FCEmU8G/RSrvXuQ8AoqrXYjGoXs72uP+Di7T8zaCxuj4GJggV/GB1Zy1mod3kNoIov/ThiJO0PM9leo1uOxB+lYIRng8lhm08eqoQ7fxCL0PPNgtd2bQaDEWwIqjAcs2Zot5DlJETEP1is6r22T+5XAnBVU/rqGu/BjX/gNbLEo5tC9P6I/tgqlWD2vcNdaudyYCaOrK7k62IY1rE0M4zzXq5UDbY5gYlkXWw95ix1gzhyH+2cFw01mRl9BSAC7vLMzk5C+27TWGNk/FULCYmLKtGUmxAjuEW2fIqGhakOAffBy2mheBc1ePG707dQkXk0b6ktliPv9vmgjOfUDiaFbaq/Xk4L7GPooga/WlIrYxz5s4m+UJy4cBl0YvohCiqFjO78H7qkBI5kZVemrUh7H3zlqZBRQGxc8KvzaTbCpD5/mcAk2K9zp2I00+G/xI8sxkJA5+WlKoQ+/9vAWPdmJ0LIuQJzSMMeJTlOxnhGnUJ4X/M3OUxpTw/dKn/uqh0y+nFEAAACIGQAAQdjPEfvg5Tmid8Rk5SQ6E+n6DToBqXQaVlS8pJJLuSZQZFqzqPuxkTqH3LMgR+FE5eK1mAA3+65qLLt7MseST6NAnEjBPJNUAx/FT0URVrLKWvoqzuEFq+hDqz7e479E4z6p8r0dg+ujLIbiszA9vuYC+lbjq8ILFxhpnjPO/Wh/YBGU4U2AR7EzRrUlqz8lWn8tIZztRg7nCuWp15pIMei3ygyfIdrTinmiir9c76Ig9w31uX131w8Oy19tx6XtBZvqJYSkGwsUwbW/DriJzAnD7ywkDV9HhmRjsI6BdvWtqgA9kgBbcNp0fWWiZg08XOuJ2W6Kgk7ntGrL14Bb+4Ji/KK7lPnAxA7WXqaH2d8HYfVyQEHQIV9WInIpbQ61K6GyqPnDW/k+4edtvShUl/lDwMMqwkSJMjwz/yguRyleiO90KDlqGlRbm+YeuXm4K8Y3lUBvUgHSZhHgPBY4ZgIV3b+qR8M3Xb1dHFXUWRBMbrR3Qw100L1c/phCBAJEC0L7YMV8CAPmMw6/NBDWfsPrOnzNAty+qfeG03a7AfrqpuCvsKJBiRJbUzixcy/TIcRrdcxuhTzjjP1o34jQzdvyNUiJBqXFpyOwnPoGNghIcTvQqTLUpFrhOMy2H0SKaIOLpdRRacCH87RwitqGWWNrPh86MAYP7T0YMu0X60el2H0mhApJG2LiHlEmFUm2MHWa+FleBLLTcd9bO0WHAe+U2MHx42nm2uL7nAc5Ny888nXu2FGLuWa+QCAOYWAZe5hTg8i6MGo5gO3y/RzYGUD9z+9N63yC6IgT7WGwkkfJHs1idBDGij6o26/sUNR6u5olTD/jlpS34ZBiKfqXUgVHYE12RNhVsMQqQ8cnmWIGabWA+HXBn0jYA+rLzTeASQ86j4anJ2+Ojs+5Rqv073maK/o+ArNKHpC6Xh/u/ydpj/5gM3dfFNsShyYDzFlodJjjrsyNZuzQHRIzU85Kv1YvJ/Pp+EJeW3HaOOIOsloTHE4EmeqS7FHunFgvJbjPgRxizRqXkMsA6iUQv8CjVJ/SkTh94I+ldK6KclfmUZaJS4fXDciw1G/ibj6b5L1bhj2Un7kBXXknZaauH2otnn8PDF+EwHVuuMogfwOkEka/Jx1VlqDDRGehg5UKM5leIkN/cYqpADayYFBPmHCFMdgPpGBIippO4sI+N+xQUWtE/wPRqkgXLs60rWf6cRqpZEHANT/mN6xc6T1WuLNJTmrL2xw6YPG5Uszlrb8pz6v3U+F3YmLpW6cZ59TKxx0p1dy69J9cYhF77qgfXXmmgVBmqDI5bgzeXU9Z02+CF06VE71zCtJh6NM512JHlFSLAZudKhUxeUOL0VAjSPOEwvydEovrbRstf2d39cr+yfdTi0YckmuROK38vSv4G40uayI4xoPHcWredON1UfIGrtVLsB6tPgstKnnQs+4Hz7S8dgtL5OkG+AfqZh21tl8WXDE1hHU6wsXKIeji2ZT1KdqfGosTbSWh5s4PSKbNr/cSI/sndVw43vCHbofdagaSQtikRAitOJL+duDiTeg15/R5Gau+98yKaTSmQVfjbkQ2Y7mLlzhcYaPiiI29fp5yv6EByme2pNrXZR7abFPWf7UkOCAhrFyLXvZdEJLccaFVEXE83ImSLibadrLbaFU80SxUBlYb/rywOUInnoar9qtI7wQi/UUq9JZLF2l4EE6LKIagIbu09/PTG9rchhm1cIMaK50PqgWu5aNdYgi542bEzmVLndmmFo5CLQhpEstVYvP8kZ0qJekYAQ9rZeQsBLL1fLJtsGnzNVmQ5lDTr7683IQpPs5bosPdOEPSMiHuLrmjt/+a6Qe+6JEFUu3H6lTpqV89KEgNloJT0EIvcmsldmoC9OeZDTIHp4BF15HE9oiT3u7w2S5I4DGwlIJKyeUopP8uhlX3l5kbKCq2CZ3zKyCWyZnLot2i1gWc+mj0hn+RFsyeSD+kmzeBFfuLgLSlC8CVDF+NOh1NS0/0pXPjmiSCgGwpCWrxUtT22XedPySDwemYcZw4JvFwYnQR3+5KxLiH0F/pgUEOpYxBMvrWmwpbOreqaO9xcApzOmcX+YwRqafYxtwEqxJPnvaP/EYXFyQcw3xe6umYkLWETeENXwA0eMau4JUww6I4shyG4iF9VjY92zFWnOQf1TVgtV3QxygEgiaNM1P+bHM19I5q0QCSLwj8DLEg2Dj+og8Vm9IRGtf4JDVvHlYvrXYAPxQKRLe5/NHrn3qc5TgC+3SsdqjtM309CUtjahq3Gs+iEish0iA52wQL88WODsgzAwIw0gEqHNc5vOREEuissXRX6XF8qzV8CH0XUo+op0s32MpbPLWttyFnlvwMyJ/H/lXKElMQl+O5UFO4igJbqj+0xDLbdeMmhnqW/cq6TFV3Qw6wz0om3vN6q/SO5CWsZOLot8c/duWPGH/PUe64pZQTrcgj1byB1c1oQEebTK9+UveHBooWlyFQUZke6Kdyh3Vpo5vhPkWq5wkV1P9rqvkCZIj/Ve11rf5wqy76T9VsQdsAsybExgYQLhZVVwHxZaF16BNN6ql2uCoqSicuZpASi/GuX42Gir/VzuLXmqc2Matr8TY2Hd07Kuuy5TQRc1Sf6UcEuSMEvO0PFBF1wujkhawrO6/WShRA19NZGj+cP6Do0MOWHSvFr9ymIq/Id6mLOLkT46LUZ54Qvs9mS0je/DV9fFn+5LHQXymb/vOCAtqYPZ3Bck6SOKvR7C3eWmmt7v4XWXl6ZOgYEe1sC5Oe2mi7zQSj34wcVR3ybxgkkHUCVuD75ArA/J3lvH7993RzidY9AckPOgVmCAVsYb7k4fUs9cn9AY8PsFbx5L304CDIaQ6pdGjqstvSCCmzdKRKSRwn14OoXvujU7zxBXYWXDqDpiwYyY4mN4l1TBdnyoh/RlgsYG6tBSGJoxtyLcQgr7hLhQ8FFoBE1dZz0rmjmJZijUGyUo1HTzsWiak875maiQIdAr2zNwOjAUOhb/iUeB1HBNbX8uU9DIqWVpOQGrRr92yomAs5yYzRL/ESJ1m9XyKZAdyhC9P9eASwCr+LpcWmLVu/+RD8IrM+dy7cce+x6/zNBBd66HeCPE7F5pw+wMqIJFcZErsN1flQNFwEJT53ozPlGlQpIYjb3f5sabHXsonmjrnfStxLWhAGVo+jfVZYr7nZ4l+PNs5NMLT/9nxNpn47Qzp955Egxmv8wWTXxuEKLofsQdnY5LGKZom8eE+pUEwdzmsjbAmgc9Y380QgModVcFlTHJ3zNJQFzLYsBjxKaUGarSqB2OSyncDTs5Y11ZYdJzu3x8TnCMtHdsca5XstQ0OS2yKeLp6PU81QI4foZQQAWlcU4UsVU4MFZ5zk4Z90ek1yokgzpsaXCqmiRP9uN1wTtXqmRC3oUbHP+1beYUiLUXNs8ETbibEGOg/NxvEScyvOtgWbb6EkB24uA+rPZF8pc0XSeFKA49oUfQblHXXjEI09eK3ouFMRyO1m1dQ8Y5PUpcZJ3N37Y4NAbpXyHYaug6wuJFkvAKKb/EsmT0/m43KBNPh8WkQy39IyiXAZ3ysCTCVuENRhnSML2VUV/fgr4hTb4q3OE+1KeZxrYF66xYJUFu090Lah6ZG5vFCBmJAUY++hmv8ANANEShIShlnTIqdYSslIhn8JmHPJuPDj0w3AOOWgbPhr+LE9XulOoQEQ15n8cmj/z2smE3R291bMRhbytoPRWPScID1NipoHXkbkuKDmnBS8CEvkDq7ySIsnqfaU56E16QoT+IDbLzxahTisaZcUa05gVdUTS6BgW6nIAxC0ij/R5Ag0hYxMvz4PSiwmGI7QCkhNH1pnaX5241LD3A/J/1jSDxW6YDdvLJ7+3nxtlOCNBhTQhdGwcN/JwcTnWBztxGtKRC6gZGjsxHbB95SedbwgZJmqG0NSazN6U7N0IqqOBpbbc0ccBrYCFfLBuabxoROv1fRS6qy2IUNkKoI7QgARhptRirTbBOTBhGuaBbjxE672zvpHsM/x5xAPT5f4NJHpEJW8hgwqNqtTJoIqoWEsHg8nEmiZr67oFHuRiuCz5eidCkDo6v5kfg4MoR4r/rNykbR2OsUmdsD8REJ82SbMD569xMBW0Wk3tZWiP9/hAVlD+difNNzVa1tQXImhBZ79oEiFL5BmCnAzpApqIIp3dp5v+bGBgMqSM9RD0EiUVRmzDuLzTxTYu6qncFMk0aox1i+sFPn1u+Tw++ivjcE0Ray3WRllSoX70SqIPUXgRWyJZ/xEpEOssG5kziDzd/Xa8cGgTyKvLGeXB6eo0kM4pNZwOsAsSEkIC6WZsqdZ6cdkuQSmML5wnSEXTV2SFMlVdmEhwI4Snof7Nq1ujc/+/64byuXcyNUgbm7ZKzbq4KG0FvcUWDmKjsekRIGo4+8c3nalhxkIGxrml5lUJnnYWqITJU/5W4nCWCBYgyCQZtkOlNLTzDlzIj22PeUIxrN84ANojc1EIQT/7YVOCM5dGJgP1Bm2mqTOqg+zE92w+zFKflFbFM7eUC8WSXOEihOlOnbT+q3ak878XXczU9JQJ7x0VVsfgTJjz+/zwffbhj40JHQedVf4EdUnGuxKsh/GVsS+0jFs/pPB/uFG8/fwnT/nJvF/UsyRLkZ8YFQlTd2nlYm7fHLLrs7MoUrFpqCcOkrsx2pSd5VZAM7UYPAyUhsSnPC0bE7KvtRvvxGnRcbyEnybWbr7Foj924f2ySJdboY9FNr+2Nq1Z3/JxaCieI0FeOTqzgLpDBDxuTdxoXZI8Wg+I1UyBw82jOZqPyjpf0VabvmAzmom+jSS/Cg/bgDN9/Ta/dTOb7ro0QDkXPiiJma3H9pHVYfwD38J5DIHqLSuXq0jhVJ2q5uxK4VEp1Xaddk+xgxP3TmQr4n5tzcGAIt7NLt1R1qxsuNmCBS0ugthhgwYTNM0UE/fPMg+icnUNyN+bBfGx0r+PkrE0qpc3hVm5WVnPhFFKRK5xJ2JS71+FdzeldFD8/uFvgO0IsXcIG6YoX0c8t5a9lcDogv3rZSZ21w609QYJ3IVqOlTb6387IjoDXHKO4G+EpUUwRuU6JUhwNZdSErb/ENtsLxLFHTklI2c9vtfeIcL1+Pas51pHV8zN/VvDg7gjKIhxDKjKho/zPTXzMf6vH0d3HDRC+QDnhZiipbC8rE58NGmm8QUaQ6jHzoacfwn/j/ZWzpA2OtRZC+rjuixObbCu1yqu0KaOszG2VYOndBbGe4KSTy9DDWWAgof749zXHqxdmWyPErsZERcfs87O18KYasCEueauEapbOhBcattclFzupUnkQmPOBPyiopTHX3HXIzNze9JYHfpYLXO9v1nZzQeueQh93pAKFIi3w1nQhpC8brUpFOE3bdCwBVdnC9c6m43H9gQwKAjb9XCY4uxTk3kOJl1+Jcr2sgry/J1sjAfd/CiwBCZsJflyJPhjIjYg+zzpO/t3oYMzmwQUPjvInaIbS4kkSbpVcTxYLGtXfAs1dUqaXX0edXXj/hqzHwpf7H7HaxuKN2bnbN7m1chJlKrvXe7GN3cwtqPjRxdu7i763tT2bQbjXPogBD4vf6lLVynj6P7xoiwxUJvSYsUPAozXeXoih874RYCzZ39qMFlRVhSeIASIZbwaPZ3m+TXbNA8JtGU88WjKwS3oU//t7mCg/LeBahR3JL8Dxjz3N8uS7iDJdXvZ2QmXUhTTRYvhW/dRdqpapN3+7NSml2VMK69RrDzTAWxhNU+hF9GNwnw0ZASBZYYJPIFxJ/oMqGLVp2/KJ2vmp4dmQnispxervcoN7V8YD1nU+DuTW7hKeAJyHgZl0pX5V2ZGXsrCgs7Piw+OKMIWiG5UOtcMZi+LVoWm87iJqG37n2z1YpQTOzXFSivMbHABEzpKvTG3sz5FPQjMYAZlCrdGeksc5C8S/fYhmBCdGcdBEBw7L1ZFMcWSd52ctkSZ7LgRgn4v4nFn8xyty3cyqpTqBvdt3Xf35xfyo0DIkLPGU0+ZsGRwYx2JCF2XfilztM42oSpF1kMxXWPX6FCzt5g49PyvRF53KfPxoNaOthOrEqWQy8cuV01OmCstCoeaL+1PVWB1f0zlRWU09aliGRThaCDa24m92pavY/F5TZsYxV+9mRmSZEg9J2IvofDBRSB+eDLjqUL1uvtpdj3b5PVeipyTeAG1jwlRpX+SaJ4r6yFe7uLACKKBRCXjbbMf6ZvU3i7MI7DX9aeV6IvvarSUfS2i2HFGVA36cwjlUPwe/YxCwn51JduqzBaF0Fj34puRblyVBIXflSN/UvimXRbtulUOVtHkFJkZCNxssxxHqyxhmfnIygTH4uQwvc73iZr+nio3u30X6TY5yHxJAMUYysqt68pSrjbO4ZloH9d1yITufdaHbPoRChLVe6VfGbuZJQEANzJnvHWBtjP70Q6Iz2+LZeuViF0tuEVOJlzwvKtHBNJ83s3wrKdINoSh84tX8Ym/iwlDQDX4vUlvKBmQQGwlitwGFEKlloJkd8aVYtDJQr4L+itefcvamO9hMwRRp35gU7acGFPt6W+W7KTkcQS6njb41jgIpuEVio2mfsr6AIsxrvpal6wNyilqfZIAa9jQrr2kc/Bk21AHV0LxmojLeXsAsjpTGIjSO+7yCYoos/v7cNyDcJ6ZAeLDLtNDp/W6TAlSOCSKhkY79EIHT/mTEt/dsyOKzhfFNasIeRku8XsgdrsfcsXjm8DbI7NFruZNymVWbSfn144MKbkOaYUA9AEpUGpIgxvTD4KGU3Gywa2umMNHjoO662aM7GVNvOYGIKriCLixR+0Avm0Gh8tRhjIhS/zQuIcIOdHTuT67qnk4oqi8bFrGzCMP3Yel1CKrHqNwLntufGpPP+mWGrnkMDaIe336KWTnXojpEgOv3Dif1wQap5FFCIOlIA36XuZC+0wUpM6q1GTKfu9sApo52MRMRnaEGpD/9FspqNZieDDnosW28PP8Pd+PiF4h0BYobs3XC6azfFW7QezUuOmoBbAjmL2shgcYO1EITNJ+xbVa68wHg7eY7QmM9XYcuNr3D2EHqQl9iF9S7aA7B8FasWyVWnjvRlEdNUk219I/XSfzxYjg5nfVEP3ztfN0/geBtzQi9PjzP6dj/xF564GwdjfQqgVytzxgGcLHGD/wjapWMbS8RpApSViq0AXx7KCQSCrtqDrRs+FkouEyJtV500TYV7scrL43GlHTfmjJNOspNUXEN1p0aRi/+cO1Fjs/UB2hhIZcZ9sEpRvJ7sZrqUxaowzdG+jUhAWUagHp6uAiqKBOEUUO/PIB/yMON0XMPlq88hFXTfEpHvaoS6Bv3DAM2XZ5mZ+DHwdatlp/Ibp0WV5Ivg2VMhxwC9Q+p/lvDLMqQHtyuEiVZtlnuomrscsE9/S91LcPwHJNDC5fIdDNr+g5nkhpcWEMkKCFdlu1QEkobLfexPrIwPpwF4FdtU6eHbKsi7aTxZ9CzgCGi2FcTYpZ3uhGhaQVdGydDgGF23qfR9q3qZ+SwfGz3/gIHPlSeOu24vtq8g5OQC6jEQdc4lBe+gjObfHIcNdBiV1HAp6FJ+/AJGALjGllKRgJ7gFMxKwFRLAZjzL+UILqgJ7v7o2QdKEVcORXTde8mgonv44EY+MstXFkm2FG3ltstUMRtNKc2p4+NEtX5X+61g6G3nBErZhvi5phF+ej+GaEMl7H+XFkmA/MGzpWx0nFLwxLPMBfAMtUZWkNZOKZ0wQw1lAqbOkmPHzPmozPvh45VwjleFHlUwS1z0wLjUQ6ylB7XMa6G04V8HVEQLueNN9vVkb2WM06s1lAJAXWGt5tY5umLhT44Cp8ldHargSqfQZw6FcTS/NYhTuXrKSaNntmyDuniZAeYhlTAXpADSHR55cNDBMmZ+i2auKFg6/Mx2qL9cy3VJXp0SYQhNAqo5oNXZF4LSYgyyCgdbJEKsJVFPxdIM4J5F3MADy+oL1JxNiuizE6ZvXiQ+CBIrUvhd5TTk5gKiu3KnRrtW5sgmtIEAal7Bayd0dC5oBt1TDVTLBxNaE3Zqj6HOvlUUkWasWmFTOidS9mECbJ7dcLv/QNA8BRL84WnsNzDWEHQ3+LTnX4/Vm6xUoORynqPK8SykwoT19ZVr26Gvq2LhKEC4Nt96FuPbJYy9hA5PadPpP/eJtdR7i0xI7YwxBZ679XWKWDHJbzsM0UiP7ezobCWo0AfW3KlcamWZfxwrIk9uQg2Y1faokBSu54U0KE5MC1uapQbI60U7I8o+Mu9TV3QDhT4FxkPUwc5pvES6R3uzbgEadRJbLVfxlSXvFqJX/tPPi+m8vnf439PpSZ7q3Zv/vXIs4ybEfUHLnpucJJsTian75Zxz7rZQz94c4C+hQXv9JvrIarwT501HNPX9kyc5HjS9HB6fM5pKW0H9dGZ16AxqCyVwKEpBPx6Xlqh/605HfwNtn8uOdO1Y90QcK3HsO5OPRjmJSqh2ejiATbpGhQ5mzaPN2oQRysHnFnxGLgCrNo0cHuEeHkLR3lzzuG1FrbxYmcxu1iTfqJD0ZcKUJtlde2fhNqi2/S+3BvPg7fEKicTfqkFl2YQgpJ/xuatZalyBIuxfV8sCEL/83uUtGEz5cj1x0l5hasQNu4lCTKXKADZzegPgvCGNev9/tLgUhQGt7iq/6368+uzfJLZpdRaY2IbBgYWkPHwcjXV8yJuw708t84m8AAAAA');
