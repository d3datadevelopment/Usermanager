<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.1.1 SourceGuardian (16.03.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3C379773BAAQAAAAXAAAABHAAAACABAAAAAAAAAD/3SRMjrn/B7HkmEiKQU5rSZOjj4CNmnedcXts4f1T6OPRbhTYnz9jARCxD/rvwpCyj9nQtiFdzkOQSa2ruJBmB/6yI3dlp8bnFOoO/EhDlm1C8VrSHtcAVK7BAXFh+Lgz8MhBLq2kBiraqMaLB4fBOwgAAAAgCgAAS5XAkYsqfFtu4iahSmnx3OEDdRLqoO2ivy88fys+KQTcNtc0YTcchbExgVXWrp0bKABg051jUyrufL6tCIu2Vlp5HufgsYSCZAlYIDeS7NzOT1mYB+mDju+bTNlPwX0gPRAdXr3/lGXIFH5yPKJkbfZCf58yltlMkezyjiGrPMMqSjwZONJKy3PtpqjDg/Xj7wi4OF5KgTmOyIvRQVbGioxL5zhUQws4u+LiuYi/02zWZPYPyKYa1dSw1aAz6JTEQ4W1oV8NOpVKN+28Pv3Jj9wcCetqk8diqO/fSUWLhZLgu9DX26FjF7oFhDf3uRIOMcx6adr/wTp+UASetQsp7zSj8yedGMXiQZyxyvmwGDneuaGi2Tgd1Cm6GJDOBPv8T4yamztRZ1815atPkLJ7hNeN0212r8mlOoS21iAEDUCtx4jediBOfFpsHeq1K9FzOZsuwxqC5J/Wf/bt2t2f/oEhLczsLXzJanYxI+/eAWToYrVCe2WjM5r3JHt0EY7PFfRbX1XFEsGVhCknPiSIj7Yh0iQb0mVwyvb3weo4zWIN1dURQ5pQn18my3Rg4zj2XcrAsk6Kac0FS7rWGpttdSU22+0Go1ePn28JJcvxBgVx1bItyaeR/bhweIs2LPWp9+w/CFIe7Mp2N/IgeOThSnODvz4fqFiHM08Sf0OWNrvmukIwbEQu9WLkT1uRc5D7sdxiJ7Mpyhyz0GORx5N+y4QTq2NqUKw5Ui318m0PM47R+CU6gMS1WtEWhYcvFigCIK5CLQIqSpLM6D4Ap5FjBUWIWM/gryQIk/FBjRmTsdd4p87nnYSjYE4k9B39tKssqOLe2qVs9tUou/p/RMYJonAuPbE7IlglCh0gW8fc6VyfHR6mCMQbzq8UMdYtvmKdBV6KydlYpGVBdTWNf3D+XC/ZLujlHZlnk08mp4e3by2NFY+YRioaqacZpKDvztI7jtFt9DbwCz6ATfkGrIK7zXOtPfT4sxYRa0fQ81W+FAzU086CeAD/wDqXc8BBYRq1KNzmZ47/3EIgK28+34d7PIYBf7W6p5gbWdgrD18pZDOHgOp4jH9Ky4L1NSA6tF4mrkmSktTRkZl7Q1dzRf5KU5JPAZR9jxPngtHaAKKSwE9qUxk/kjh2uo2D41KPRqbzeD8XMsjthM0JIM7vndb9wk+RrGbKTGDVlupmEOkq7Fc2aMjRBnY1cRDvEswwcSOQm9WNkQsVk2GBS3KsOCVonywdiz89g3UJ8okCQU9oXyyVhysdCliKnM+P53A+EeE7wbIN52SaqWSZRC2PuetxAim9F8bqRg8YRHElDEuwdEC0wF3a/ttQqo0cDzOOi7DMeu1Xa0zFZ5bE6VWwLV4hnMTuCXIk1yFXpxP8qTb2dbHyXzmAliBbz+5euZtafIIEIwAoxSPlYIApN3OkQrw0up/6CfYe6abJQYi4xLWvsvSyeHWW11mltepSpwVeR2FyRS4HumFugivk5IIf1U1oUkUPJrDMxnu/ywEq7dhj37TtxI4zLNTawT6u72GbxRK3EjZ06tKMb6oebgFb1Q/ZhhHFHeJ2XAw1sMFGvZkq0RuBMNKxvUVCl0QquyQ42y7NfPwoO5m7RCaOKgm3F9ZooAPbbbTxW1Lpv0kOSYRg/nSpDYYCueDLZs4yEowGVZuOah32h3yzxZVacPQy30RyitjSKh2HUD1DyCk/5X/MjBImDVHmWLKFP+NQ6BOMHB+/86gs4eUpJsxDnnJ3maMoIEgb98FZVIfRpjFPg7607h1HNaqdHeUYYt0fVO0StHeWuLtGRaf039lGQZlQ5j2vYwUdoyNWfLHMWyGXY5YF2Gb1/xNm4L/XRaWJelCXc1cs4fz9FKwO52EaakOlsoYzbhS2Kj1cNFF4fdsrcSzc79J7AEqvbuKH6ACdg5utYna6ed3I04pzrkl+slcnwb78BjESD7BOIqPPgwl1Q48nm8tpWDvXu8pKh2xBbmgT8a/+1/EkV4k7+AreO+/8gQyRn80jAPKiLQqEzIzLHdkeIAdoHJQE4ai1Y5Bsd+auwQSAT/RLtr8rD/VNQLXknazurSGywSoX0YCcSeLztJjbDty+rqoYezF619TchNOEuYIK2If1p2yxjpvh4W/airfgkrW1ewVcsYHIPM0xXCJJKV7QuiM3ngNKH7dGHr2TfZkJtdD7ilzrAqzSk12Sjcx7L8he6JZ/gWxiE8sWUBrvQc0/+6h1QXIJX/lim+Jx2YlV8H08Y9+gAapZjx6LQSNHvVnDT2oi/6rRiWUP9kXKf+r2gDtHqjy4VzTW8N07InHWTMQLeH3zp3QCOu6LAK1D9bd895fV6vA1cLrm9/zTRpSd28ZWZleRNFUGRjO3Zp+yeYLFCk9rCiUrK+ZOBO5n7G//CmypviiGzTNg/ZDAnVjhcEYx6s4kJZvXBt0IuZ6dxGB6O1EW6mHwm5p5LIYdGFI7XRUcxt6DrQ2T6p0slHHivU89dMYGg1/rhmeSArl1PDa9C7K86AB2vV8ZzlO5aIT/hN7YEeD9R5iEe9OndXJ+C757pLVRsycN+RvHt/NjOeW/2LeHjcHD4w1Y3tiokXQOtn+gIjPtuZb/Dmlb+4UrZfmRiz5SogHR+Fdu8g+8XNqWSza2b5RqPIKcH0Y0vL29A8llnS4hsSeY+Y7Si2B1jQz3cDvcwXRZSe6oQpV5VijpMmq7DMnhzxy+P2/cif7T3i4mb5GbtJZFnkSYurQPgIomSyKU3uzT6RRUHyS+uH1DNVZ87YKQZ6sxFHTwSvEnwc+HjwSd/+twa7sc+QA+wzkhbQrpqvyfpdZMhe9ZiNf9eEuJsJRuRF4PakCVh5qQA06G4ApbTCrj4+5knqgnj043XdZYOg8DkrFU+wLhrvsE4dS+2fkVgBshzNA3Y0gJTpfge8qMkgWjj24JabxL2aaq5H1pWKxKCPGih/QQtkM6xG2vZDxxdyyDJ8HnM/gJtv5O5fwuV4o7gA0S5f9oKjvfFC/W7OBdUzcWar2EQMM9eJHLFdKKHi36MxiphjnQpVowGixaIGigY+vh9+mOkM/rhD5QAtyJaPTOIgz7TPpSp4l5siVG3G7hTwZU/gffGwKpEyb+KWgTGyvkz00zjk8Hj456C2/s5KNsKlSFPFyaKDUpnCnfJdXngtHUhOIVnKwALZfrL1SN7vHK/7EitRBu5CngHK8GWxyGkErSQDyHvwbrN15BonDOSg0Dk19+37zCPnhwHvLNQjszEeTFFd218EK/z+TA4u4NBhF+Rp1MBO5KQnS+u98D0zmQrSpte75Ie0BaaQg8yW1NlukRQti/txYBE5gbbtgo6dK6da4bG93Xo89qHMJFfXCiZZznTrB4VUCndksBfZXVcd7PpNpqjDeXM9zpD1Jl4ZsdyAK93wNs/kKvtuO/6/ukgKCWJmL7zrazFQOAGrWYT7NiC309kk7YLE/MZRvUmUGQUQAAADgKAAAr+jNc9il5nfFHTY8C3ZOPdm9blbHdaOKTTYVQa9m5aW16LibKper3HhsPuNhKJDJA7fkXNLOJTql1CDXn+w/aPUflN603GEh3vl/O+pwNIHnrcE2zC3i7nrLvDJ4k325L0tcySgzKxGBtItpojJFRyEu2nrm3IAe8CzkPIvtOBGzqg1SIhkSGTwgbXRLX7O3j4fiyMx6qPzUtHy16EQIKNMJGvD2i0xUmQugEG6ElB6a4FTC6biEj1tnvdYaJLUjOhG5nb4GE6bB0gjiXmYS0tyUa+3wlhYJDFTveUDfZYcuvG6V+LR5QEV5ENuLfxychyS2sKQWmfmqIAmA/NEQH4VGrWi9SyXsVlxs5UHGhzCt4MIf+SwNllhwpHxQhNMGWmh25KACDpfUucN8Rgmm5ybM0/vjGM66MgB9OKd32ubTp86G3jPktODqdvE66PifeYVj3grZvLjQoTgXUbDy4Ngptq3PpDh8HaoUhC8xuMnvzdTBIkR/7oNBGMhxbpXErggCG6v82r9HqpW2R9moGHDWrCZ0SFDOYLnNVh4CLrl63z4ToIe//V62KjbIFdECYb5bkXAaLBfVODI6Tgb74mQ0IIIYRB5tURGlBgMl4PInU1OuZqVkZdXkVJ6qW+7iiZY9uJMd8Fr9DJqqXh9jurVPGg1l6j5L3HvqEE2zqpfn9ZfyS6gDRx49ALOj5WvXHJdLa4l28YPxEEFkdy/vnZQ6UWPw/dwGXajJV6XqFSRuXQwoH9z+cNRTcm3OmlyaseBqFthQknDTI2LgQ9AWfGt9dJNzjxiQWUn5G/GXsIg6Kam+JI4SC4CKd9GylKe339Hgrqk3Z2yPqjZpP0WdY88+5wdiYcyABzF0v9MfMqSBojbcS5RPPcX2En4pMn25m8/3SfO/9xAGSxnMJq2fCemIh4wVRk3z8fF1RO8XRGgHgjFDeOsEt4zSRF/8JXNWeB/AsTbX/qRfstlytRWZcHiQRTxJQjy2Kp3BeyXN0wpGP8wbdJTx9ZZwGxd1ZndwH9212jZ/2yo8m6XSl5EFHnUl+D/lLH2EdyPhTFPJRtf4zMrQxlKQZJnZp6usso06nCJJZHdBxBW0S2nUE2sZ8TM+GIiwlUlp2dP+O//uXlMDfQLhltBhsOH8XaKRvn5+MO7zZ6r/Mf+RCs4IGndv2XssRDl46WE7ibTsN7MV47QVv05qLxAP2W0kVSVvP/rosRsSiB7BeZXUe6busSJmYzjdgFFUYE1qhnW+R0VLzckbN/551iLjDffPjTJdsB1yoG62GpWwL9e/5dQAKZzA0jleBRd/ewW5MJDRfdh8Udc9geXyoqCmqOYvZJ86vlx/1foDJBqi5cprJPwmMafuOKM89wFtj7wzzf9hbfOhItAX7yQKbwM6HXluV4bu29ddkHcRf0CppMvP60HRrKMdOlTXwu1HfRO/Ky+K4dZvE0QONx6OcZ3iv7+e64R5txdld74W1ezrDr+W+TEGqm0gEw1nbVygWju+OP+LQd9/cCshcy/NYTSlxqDr1vig+n+X39uDSD3jNPZnojXbQWHEAR4L4giMGFqfhh2/5aAaIpThPHt2ddl2WWeSsILWhbWPXMpJlKiMSD6eGwkvb54xQHCxxYYUo0WyUzu85liTSxM7xlRiB5nQ4sBqtD6zoNm0ZpLNx3WK9xERPA3yvyqH7Kroyjod6+la4HUoprOcFTszFdgZ7ZHMm5kcUPcHvEGKmdpcv7tUxnNb/T5UynUx5F8/3ArjXFUArHk/Dd1midzJvJ1DvxNxASqI2ATq1owx7iHmxocxthV5/XhjkcWczpuBFKLrKkojjIYUFRYUA7bxWzH3AA3oIxWAfg/y9ImmxSeBo81/Q/5smSs2oAvxgMj2PyrsV/IG/WxOBTBO/4OEsMEb6cp1BxDql/EYzk6d/ICM6pW3yPQIjc+PgW7eVV+j4G37lrzCWUReZp9+o1fvcG4a81io6qZhr2hhuT9udJ4YmjxC/fpfrRIY/D4PX4BEcdvEeRGfEwrHBPGuazYG4OklhQijqKDag1ucZ/gxBgXP4IGRv6cEKK5FnjIrp2fdjer3yV/BOXXGimPrSNTZfQNiEFZuwNBhrZuwOz8dplk8mStnKRgLX6puThmrjWiAKby2ggXQy+syZW0uBQXPGLzgqlgFbyBFlWrkCaJgp0WBmLupG2otVpqMfbXvcp4uRNQeLWsYL4HfSGDYMXxt6DSOSnJd1op5U39NNMODvSJXb69z80w6DmZpxpWOSPJD/YO6OZMWwUx+JqueruMwCI8AKRhYEqxs6RQ00yu6U/21JPFjDAij71fxBVPiV+7I0HnzGryDg9wRklpvKSzdF9F/bnqnyYMuMmXUDcNZ7tSg4MSI6/GBlzfiiWvUebfb+Hh2iSUOEA+RFZ6+njKOk8YJDVfGqcS2OClw6T+nbCyZ8E+PL1VhL7SH94/nwYuhD2eN3bE9vEgIV2IIC5WM1hOdSMA8ZocYyflvLjZTVlwy7oIyQWTn+baG46hSTnoRoOXqd0vsRcyLTpDkq+p2oA6dztms4ay9ymEmNoY5ofFaJWsdxdkPJzoUOn5Ps7BZIjTx+y4s0MiXvQlSIpxm9vTObb8cQT19tT4n1mohy2+J0RHbOHxAW5kuGNVt8CoklAEdyBYSnLGGGqUjeHpG7JHKSMyDRm/yqnraYW2pVbY1teYlnVijVT1kxnkaxNScJ6avaqDObq2k08NbsE5Nzqfm+Rn2erS06vBZulTq3SnPZawDgRZP6Z384kVgv8uEvRzJ2zce0eKZ9Tj/p6AJtaDgr2+yakzqcSMhUQxxMd3klQAC+W6ewBbl55pvqmoMoU4eO96Fgz9oVDG3MUzdQQckDOjvR3q3WRX+gScZYNuiTGcHHD6ZLMXEQKSmg6Qag2PqfR7t+dz9Yasg6ZYCLoumkF6PgiIQQs+Y4zvMQkuqdgCcvDt5DnYk7tRzZbud7oHU3+w7eNlYrsMd4BWhKNqw1+wtWHA4SaER2jWIzDzhV1MOq1GcONcjFN2p628XcC8fOoD0eB82Kun9FUqhqyswYPSpJnEJ/KSRU7qorSyLVYbxTUG6/ncGEYl02ljVuN6b+yz8NLNQuoUO2Moo3QmCcgBCLKI5R5sYFuMA3noFqH02Ml6Rk1AsdB2pMXr2L9tr2eo3JCIhobSoam0wzZtmz7IGTrrDa2WlUQx17Rad3D2uVMe+Z6w/xw1v6GxW5kFE8vBwrgoHV/2pZ36wSXICRCdiDRnlcn3VnkwIxG2sKl87sHM6hkMBIH3ZqOuLEhwEp9zj2Ph5PwuiN3xmWM7VO5uGZ/ZSjJzf/lvo4iWMnrDW8wR+qc4KNZa6tRk4IZnkHeDMgUwyLP3nn734fMaToN6Q0ZbgDV2PbWMUXTLn/cN0PE++m3lPTHvsl8OaMzR3/uIuwdVfu7marm5cepORTR7r5tL12775sqaBWwzI7MgJXYn+oc8jHxrjqxDLZf2qhTNwAAAAA');
