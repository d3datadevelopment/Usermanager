<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Kundenmanager @version 5.1.3.0 SourceGuardian (07.09.2023) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('7A3737B3D179772BAAQAAAAXAAAABHAAAACABAAAAAAAAAD/2BQfB5naXJGdtTyGafGFrfuooL79C/LT3nDvli1aqVadevuhundlcrH7wFbSzFZMqTea0zEpmS72b+TUMymWkaJxAcTfEvPYnc3Ijwuxrztq3yyWPKG6E+QXjmCY1H/6RD684ZkvhenN6p04cn61nQgAAAAwGQAASba2wTXfoAlibvloX8JQqbg07XmXwFWFF2MEFP5H9zivRXHSpTj0SdBT/vSZyH4xOKZ813txDNWqSCCT7dAy40Zz7q3hBPjxsuwZwBl+J23YxEBGN+u1J33uEM40jQFpcH4txwKN2Kk2UJtVQfCRZRuOO4Zpk1VA37jKFyhA7et6dXleCp6yw+aXZwmCD8MKZ0uKni0OsWNH0w4wSk4tjg1YREizu8iE6Sgk5GQej+16AW2+Pl5OYE3hIezXu88D7Z1KQFIfNj/IxmQ2tAvJfHTAXfuAqeCZwdo7pvOn91rNJvmfBWZlJ09o3LGozg2ZA1T4Ypf6TP4LkTMexQLiQs8WP3PGrKQWXhHpLUAmW4SXVCni17dX9qnuhs4J0eu0g1LWGaqCSqSpOnLfIsYN16LPmk7urHSZ9wEn0hCEGpOkzuvSobRUXW65PpLTRQesFpLEZcRftdgY7ShWdRM78Uo6hqPU2zeSjyJNU54XHKiuVvwzODILeqfQ0ovgywfRa0Le3Qesz3kXX7VzBZpxSHn87TAwZonLpS/pz/XtnEd/uj5ogBp2nwWQ4W/56Mik2KjTh4jLqMJDdeLHB/8wKvujDOucbxMbSZ1H4W62PMo8K00NqJIiKbnCevy8bNwpLnyxcQK2AUr+Jvv/nnDujJd7FwDirPNxLZ7DfSx3NkPaO0zvAhco/cJBieM4AuabqGENOhgM+DZ9vWowfmbdv1xTdA4IU7mAH6AVLefIiLkVXoPWCyYWmpTGJfObnCZ8froDSu2n0nQHTJfxfXwo8nVvylE0m0yBwgT9xGXiTKJF0pTt/JSNhxETXwN0AYEsI8AhJ4hSX6rplHr+Tk4NX9WXlwKlSjqXvIakDIROR9snt6fj7LETFNxGUat/pdzOHFo1Zd3QVt9IuVYZK1bNprOlJzRyOAO3eJuQrUQi/efEjbOoXrclmtnrXjc6qq/siJlAkN4e9I/ETB1ay2bBnLI3x386qzZSacYKifvxbGmgrOYKdaigp5QHXKaG2doOhXG5lPBLFNCFnp6tM1JP281lOLWI3DAhCMbs8rhnQ02BrjNknLxxTWprwwvNMkb8Ez2tkTy6pWBdzzBcLZcPIBd8tMPlWu3ctoucCLHctWpxt3MjEtA1XyRLmbUP38kwtDSPTSpz9ijO5K+CXT00psJSucrbUVXFhHPtFZA2+bE7gaeBCsWkNMcQ/4dJLEyRCKLVA9DVMblyOCB89Bxz+jZEtyusyNosbmO+lExb8g+6O0AoMazj8m8LCpFkvt9frLOiA9E//UIHaSy+b/kvTmORdooFBG9r8qwaql76YuoubPlkxDsK0aTy9Xn5/1LSbj7aHqM5tgsMN96GNtkT5S0UTYT8fCI/pQJqwrLmI5XPYWc6hmiF/+u9ehOWWYuKVZaXILrk4isqUwIk/tLvP6tkk8g6gQ4rlFJHYVXOdfLDU/IAH4WyT/7U2tyEOPXULpxWrX3/InxILnLtUrQvjmF65i+u85BYgeZ6CNkwhADg/PuQJo32MNBD9LzeaC7hr6tZxo6YFRlOaCXp2xp+WbZESrtxu/6qLm27v77pi7uWgl1s9XfScOmJZvaUUQtp6xthB36Zdw8NBKuwU4zo38NmswjUn22wfnYC88VAeWbNusw/pBL71jdQJNA7KPf3ZCDTEUWcxP5drAGWlekz1EqjpTPnjF1jaH1VnbRNlD7jXnc3QVckFohmx7WLjsIM9jPYS+VAyhjcbos4wmSJKA3oQ+0RIehlPTwfjL+6AP4adZh5IaMQYIpH+Eb8eiFJWKinGa9s3y28psY1zYhUIAt7a67HVI9Cibh+w3Bx/qXm+CFy2sT5mYQ+LxAfrbewx/iu9W1jzof3IYVNXxbsKz2e6jrx9x8NYSoqyAo8nzeuEysEwzUfqF3wkXpR+myeSC5o/RzBFWPkBnJjCwZnuIDFN31zcTDY3QxfaPOKChi91fikCevMcaG4dq9uO5m8l9GThUKqKRhViElgnck9+ECTtByGYYui+tu6A9avxyW1AVH1eQjMVmPfPikr9e+5vGNGZ5ng/B5jjXTUKCIyAVTRwPTCUKOjv92SddxBWuamvTHbCwG2Z4fUX8jTFoyTf+MYIQ6PH2amfTiWsJoxluEnUpu32JMv5fUVfPWplTfJAMeVEQAQH/lsfDAhHWyojqNgipnZw5t57qe7GMIyIitps90rq082jdOjhVmYv0eE8TIAUi+Y5IyMji1pfth3fURb+kWsyYShTRl7NXVyBFvihXgkaf2kdt2pm2VyFh5LJihI61tq6X6Mps2Apmn0StWtxMbI0R6wnED4igIPtmSVeOiR/Y0v0hdIdMfUJSr/Y+iCA4yvx5KyVZ+pla4t/AJKwRkBpTQcc2QgRvHQaS1OApid6TDeyZFlkHIlILWq+vICo9HC6GQrF7zvkfxi5z+Ggp8AiT9PN6HsN0o8Nh5F3Wsc/KiCG7dCT6JZBirdJ4DlHcP4/Qb6lcPfQizfKpBo3FEbjh6MGXv4qhDxMAvgy5XDcot77iBRbjpBY4WAp0pzj/MBEVK0c+hv8b5HwGpEeAnnXkfLNkYVmu5ndhV3sqSR/Yk1X3ltIEc4CwJ9ntaJfU5yQ8g2qt08o/tFysD2ycLEHJ11NoJISfxWEnaZa+gvlaMGlFrcCyHF7Afxz0hT9VJ1xUqV4cR24693gxRqlTj1zSQgaQ6v8DgWVeGG71ViX2LQumbrvCnDVO3TcHinJ9Vn+pX9+MrmU9BHwE6EokNHuLsU6urgTGLKBdlL/vXuvjWWdtcuq3mmCAzOHxS9qtkX8UvgVE5wkdJJdrGVS9oh0p/ZRLWCBN+CFERdwY1CRSPFBduB+hNgtcLa0HnBLKK/cjiFNnechju4U60mYUqsH5DOXHKfjY6Y/JegB9WOxU2Mi4EtZ9dSMqxB3PFl4cVXD+YOZb6OUDOEdVLyQZWgvl4gJXFpbM7l7e2YH20TWdxkW23qQenUtrcySn0IHxJ9klx9C6/X+ASxNPuJ6IeE7hmNvshSTHi3YcL3sSbl6+vYBgPbjWk6KgqofurqcRAhxi0ZYCxwh8edjfKHyiVnRXPrNl6dtRwx+4FooqWvhC4IDfSDEQsyMBFiIwtmHExgQHSCRZlHwLscZEm4reOipLfG4cxrM5/Q6t1JEdc5gGnOqPlef6CsyqZpw4KrZn8LUq89+rfKESF6DQLbL4boCymVpwRe6rC1LZARdxpDuXZR4ziUvbWkwp6moUDHaukeUDhI+Jcc5NY6j4Od6Q9jWU63/5Hvwu676SG9qmcdMrZRK/Zods9DS6SkOf28PI4FHXN/W47OrobCNC3pKOri2lurAYyLct9iiKcHN1fdClJcwq0z1qkKOcJVH+ISVZwGJtjcWqN1EyPb24mDZnEuduvmfdosG/Qs1PNoklpdBvnf9E82/d0DTdbkSGTO/HajThtOK7ayqi2CGvZ+y+9TQROg9QNynuic/cl8+SH1INf+GZfhK8K5E5lyulGiefL6EhFRZ0/LCh5cQkZPL20NXtpqgJVFgs5DxJHBlBEzeTnhuLytgYLbrOwAkL6y7d5wddytY8ylHKQIqde2ezz4eF43MXapjuQjWEBj5QnGYsqgvW5ES/9D3ihxL0JH37cxBtEwbjtaKCm118nN/6xd6AUUGKwbMZisYWfA/RiGUYiuNCFSwN2MkAdmKN/9qkaCnN3DyZweMEFeNnpBfjmzVjkU73yWym2v7saY89g2zosmZChyECrOxqUo2HWg+3EpSrC0MjAMfWIvksjfR5yiYHYdB6XQl+swQu56GTZKD69xw9OFmkAoKmK1nRuaR1ffe7Fx2un/FRtEt4u0xNABksnee4ukB3LqysxlnosJRePgCM84Rx5w6CGmarc0kn14FYODaNPkoMx4+SKJL1SoeyhAnoDjE+OSY3zhgjqW/hEpCOvoGqdZ6YPLjCQlSEa0pRC4vucWhub3OH50B6rZDWicqRRR8yHdXdjCuz6R6u7stA0Obtk42zz7xuTle1T/jTQHhlP9518WGuW7AVPpgDw6EQXA5GgYzch+dW+niTOOGN+s4fPlPK8eO0bcBm9U/D4I+KWf8MF5FyIMKD1U8gn/xblb+h8j1kXD1BAS8gnMxTNm3EvwVDiZ8uSiuD0b5FtcDTsPDcT07WzTy8rtkG7PKtdJLQelyN2/tr/ZBLmUuEsKxGwxxiZelufFuS0bPuARiqLoGAZekqf/MbGRQDoMf18DvBPlSeG1PtHCpEtjwQha/Mqss8BFf+TbyNpnLjxvr/zA3RF7iAtKsiOyhKJ3bzj1N1dRMe7A5QUalJ8ibSch/MOkkmymmI8JidmxaXJVPmn4ogKeS39c4Yh+NyNRO8bnHhtMO1CJVClew3QTnmniiDMeWDhFmWX5dQLDfmVNZygVlTGGLefwJypQxLe0dsmHtJjN6d7NZSvChc2QO0Zditai3CXughbTa4cDiLuBGhBUIP65abICzM3nF8b5MPpOOI88tV0kseN1A/joZF95LMwclHTC9KWNddgaJvikaF66YD8XYiv4VzSNpB+I8VgWVYPfSDqgO1zePXmeugUhvtdwM5EyX1jDdQYCXwHCHpBFiBF9U9f6s1EjEonYywlSCTbjuKiSSOhjPNrh/xawc7snhEyd9f089BxCpVXOlOm89qWUFPhW5Hq0RTqMBedS88+/7SfnNO+So945ktlN5jHcZrOtXNMmbjZH5OUQC5p+MLKgHtk2bzJKZK0opsFeladZnaYMJXuPF9CTJDcir7yAVQAiJP6eOFqkL69m1M/XCY2IXlJWPftOWQI1cathGN5juFN3VizWjR/Dc+93tFOo3mGT9MrMIiIwRgGIKzHj0z8DKtQxNAk4FnK/HiwXs4/n4pSQJN4ukPkPniIEEB6LavkuXD5r0fePgiyjmYQ7krxzLU7FfYh4cKNowusdF4+k2cXPIL9pPf1XsTGOE3SZ4mMe4SSn+ag7q9r3pImVxvzU1qocM2RhzlOKyA9CVZbGIMwopvdfxKhS25JtpXmJuYimwb2zaLTV+zBppKWc9/GJ0z+xRLdF5opCPwUFC/Sg3uDn2vKJgmeduwLX6vVm2Fp9MwNgoKR+sCIq4mvnSWbc9BAiWdsgZbj3MAs3gEW1fUdQ8kjoRmaYwTKh+XAWIz+ybHf6Z0H/TCSgkaiMRMdX8vkqEITN+kx92DJ5MIcBpF2FCuroUiTl9HNVs1MQgcLzIo+qcWTlutzTadjLCrpKjpudOk1z0suAu4XZSBLgywezTNF1Cb0WD4v0m7Xj2vtHsw7LiNhAF2fAJu7/nvKPEYwq3dZS0FpsZK/MPlKV2Sxr1ZEAiJsQqtegLA6b3GOnhk3q0fW4RMdj/YTiOngfl0ENRksbPiHO8eirngUgLiK+1mo+M3KCo8I9NmJDRPS8bx1Fr1iooiWF/kp7yPG3VRTIymcbMXtgGH/SM7jAsCGCFFPyfwLf/J+sjFGHaD2BDIi2mdC/NTPSGagvmbF6bmo505RPPv/p0rxdotEqjyXoZ3AhInJBvpLBen809wh7/pP7EQZ7bcZN85YspC4rTDw76QIPJht9ybaR8TNyJkPkyls6cCurdxqq+aLatpZvVpCGjq0qJhfAhD27T+96Fh1cSrxqBlEbZ0tgtt8Tzn4DLcXzi1XDrMf8zZ/wyvjmVft/KHcbLLdb8bXMUS3IiSvYwOOg3Qb0DS0JVR/snPQOOWAJAvZEccTQfSkmmcLyFaBKDirxgoSFscKATC6cY84FTcd0QF5MupaRaOiSfUArmUHlSrSbstTUEerdjMrDAC6SwWsn5UiJ6X0HKF9tkgsGFCzhcqSO74TzbBAl0qu/NfnnmwYvTTtYcKiSxhMdSRBneTgpe9OuSJ9+bf50bCW+vKWSU8GcUcnrW1zYKFu/eInEVj64dvjz9NpYSgg8Od/RQZqhO9sR8BYgDcsT5nKHnY4cTf/K1AEukq+iZ02WICHIuqKKUbGuX1RtxBJK6zWyt6GpSCpqm3LZvYpQaACpuVlUvA9i1UGTfVA2qjtMq7KB7XMA9b2NCoU4DyB2AtBq/e2wHQKMkEkmv7zk4MrHTquXTFnu7N1NwNbc4ABAX9pD52Cmd6FwGgDFpqfCrsaSWlLSXmJ0Itnzf6woLzwLIA8KAhfQcBsM0xqUxlbs7NoAD/CzZajl3dPTrC+avkjgmf+ea45i8c+RnY/wJ2sGVyqael8R3Eo7iul4+Nzl3UGtdDR+85l/wOoLElBCgdlj/zAOU+NNHwvKeguh3xQmCuwWAq9bKdrpTpqs6MPWN1B7y+NyLXoHEctHSAX4h2K+fTXSZQqUhK8jRMrYlfTCcSzEbDQ/LCo4l6FIxgas1G4Z8qR3UOdzQrefFmaQUEv8F/B+6BpWjjlmJylxEliZHM/3uZMJZsn3TS1OSABE/FEFhLw6HwsI6+euqV/Ff5xmhGThsk85Ce2oJ9h1ekzoQ5dmigYjdnamTCqcQncvKjaB0iQcpnyNxbZP2diFrnXp/yzB110kd+qp8jAihmCG3CvIdTXN+xIZPmumhp0UVeq2ZYQ8+m3WexcHq9xe3rah5jEceZ5UKJeODbHp5/r0ggP/2iJuWt9KFGuTvJCkpia8iA9GNQOWR3wTpgvn1VxJlz09L1FjP91vjYxxABgfc5YQRK52GpTOzEDFAEPkmzJbnL+eFCXucZ4E+LPPOASvyXi3tWf9dPkgI1NZ2zkfWCOZ2aSHa2kPvJ23DyaEk8mpbhmITve21TtklEjlavq8ONOE5iWPPGsDEV4FVXyQQkcA/or3tqQfDwW2dkxy3nP+jhkEcZJAdf5sTPR5x1AbZTgDdxiT1B16EPl8avPpdGT8/0GkiCKN7I33xy+iv+8Odf1FHhuBd/gFXtpd3GP7Tz/IH8mAarjoh5GI1IhGkDUypk/EIYdV7FuUTcgUWbjvZ1Wg3NmJo6JG+aFupDdZdKooSGyd2i2T17OtdIB+6++eEwKLYw6qWYOe43jSnJr6Bze6mOB7qfD0GsQzmBNenAazw6sFNND7SwgxZiMQr6ANY3h+SvSvhA/c4186yngSm0WxKcwJbZh0PQVQlq7noeTNGC7+9EaN2IHo5AAgykLsL8DJByfDTUr/SIQ9PpDgmsLJHLaDhHmRBL4adcORph/WFJF7ks4Leh5ZBiRyXlau+dlZpcnw7UEf2nENxUVMG/NaiJHFVNqdoDwAZHoVDzp02VHPLYKkel64REYhDmegh8u9DXfVXSnk27jWVDNM8ORFn634YJm9xDfdezaOc8oK4AWk1LkBaXIiDeCewl9PVF+1jzXPib9aKVsPDL62vu4jGf7/kXCYucTPQbwUj8uHK3/FjtcEjf4cr+YCsKeVdG/jSeQsJg5sfoQMTzTgftd8/OZ3MASjHXhhopyB5t1WTNNghXHQfZcHf16dem4DhxfOpp2MKsUkoVVsLYmbfPxbv0tRjMqvz4qA+giNsaOt9B67gjxEILED4WgiIvYCQ/+egXM1NrCO0C/iYtTx24UINhw2rTOBGzqHPrU7N4BGSJlv7I1UQSB7fwGlNA42+w2ToZbV9vzEt7yD5GHZo0thA0frsBDmlSu58sC61qd4Onvae2WKRxQSGohPfA5X2sP269vygHCcsIK++F681iPolZAMKt4dQbaEwujA0CZvuT+vS3lXb+fFwuyotNuLkekB/3lxAr/7+hWQrPEDwBYm87ok0m3ptC7s3srYYM9rzDRWWkq32ZCYwa9mAnIgpRG0zJ86XxJmb7SOs2Jm7pShD26UP1MKGzNAbuMpCtbSN3p/9v0K7skZBJJnALQ5AxPKgdkSnDc1RQg1JMsK4qoTxYSmxy/5frNJNEBjUbvEm1VAxr5pbtIyCTRScTBsy6w9/VepaZ87BTAydCCqi3YrIaHODO8R2aPi4peRRbcyO6brSY9iw67qcBGCIy+mG/l37XtvUpQkBt5nzUTX7bZvCyEepcTXxFETB20JpBl2Lhf2rSBhrHGyEDjZuVivdqnd+XeZI4oNWcprGwluSK04g9DhbHlsjU86qQ57KL/dJgsEooooScHIZLMfhDcbQu+o2tQPJ8HplVMEhbWIrZ3JhpvL/nolGXCtUE64hCPAIZx4gy3ONcvqXgrlW3Oje5dj+8LS2ZCH4NzXdEo8iMij0X5ASXdme5lvvzPY6t9cA2EpF3cfOs9wun/Zniq2V/GfQ3f7vBwX6/+BF7tqrfNH9Wf2dp9NIUoUaGRg0Ffg+7VwGGFpAeF/9Og+hyB1FfKM32D8BYgbys3Qgp2d7jqQfkqYHM7bsbjsZ+4Ntt+UXefOnf1NYDpT4gzrTStOSEf8W5xLW0jpZEPfK4+MHT2xcSs3w76hr2bSUqxRgpI52ScK/fmtjzBRuWlTFQZVOkeztTDTMzU/ausIdeDmuQg1EXHNWuQ1odwsmjhjSWGwUFaM7yD0k1ml/gnFNBdl1oLFyEkqikQ6ohBeWlSKnLhD2DqzL8hC39OkN5LgXNP3DN6+kAjt+Dg07WzoEho0urNJdn/hiFCi9jnPEEEHAe8vlixcd7Xv+18g09yJHaB9wanwnZbYeoSNbtGy0WDoJz8hka+XwTZ+cFEAAAAQGQAAfVSvfyyME9rVNtjJwDbPes7pxtqMNAo7Fv9l/5OEKHkbwo/n7TiTkRE734XkS2/p4kF8n2XgNLFinuYKYC3sBQz3eMfX/4NqlBTE1x0mwvkiQ81+f8yBaImqXY7zlQkLz5QDNVv6haPfAkFfq49Fg+3ZCpWpWCzMvboItJA+VCjgbXb4m0amqo+lizBJwkDjnMbC99YLnroM3V7YF9DghK+1GmUnDOyL0yRKPNi61CZ6C7l1EiSuDAGgI0nelXz4oqnG0FodyAsXPiNav7wWrl6AyAp5yuyI0o/E4fCCKPriSKYwlT0QBwgbleX4NLBj2bvMHT5DVG79PKDA3mXqQNq4TJYZZonhr1tRCvTN7Xrof64EB+i30YErwgph+CWacOu0HtGJi23imbaao2EC76phSDq0X5C0BwrXBzl/wmnuKonzqhRhDonQ8NBjsMECARvJfI3sItD+FgDEZtZmiFPImyVXWv/N+KCzLMYVLxQRcPvJdcTOzeZontU2KBhZ8LPjDnIWgDGITMdz+hvUDXq8Yw0NBsAcvNWkOVPii+8d4X45Ouys0KtD0gIyDTYQvk/Tq7dbmKjz/KmQeq13cMvCZ6pgKfcuIXSoDM4H8LjJWqaWbFr/OrnqPZvFQKpxgPt8HZwlofpVeoeq1blHw+699kzM3V4Ly/gEKT00Myhx56D80/I5Ibezl6/mK06CUQL+3AUZg5Vvan5OfMOYBYvCOar1XILvSwmKWkM7PtZqOPegpNq4Cnsaph08+HqsiNhfHonh1rfd+S0zmBQKWTkghGW0GnhBT9+zY9bALIK+AnQ5pPNtZ3WwyEAihXljK9tHTSH1iZ8UFuqbDVVfRpKfkNB9KtCoWX8c8xy3g/JMgbxwf/m7ATdfGbgA2ktXNd3Oc2t9lkRUzyTBWZiU9Bny3SUmFx7Yfc4YH20PA5onxv+SKbQUP5d52xYz85ys7lNjbA/kuKqKojLbT17WMQXiDdC9p3u18E7uontkP0N5aLSA/dSMKb+nhbWx6vb3v5a94vvJuWR7BAX2QsgBt+um5wSErq1axJwDqUb7UY/sXO29yhI+1tZgaj0o0dyb4TLFdPqpED3OoEo1FUMZS9a6LvGqJ7S9rvGy3bJnRiIbdR79cQr1dQOsD5APicRCnsf7SP2EQ6Gd/J/tHOYVnNSlT/oREx6iTQX6VpjvGSMNeSsRA/sagVOOB+g3yxOtp9eVV2AFLw0fwSn58TkcfEkGM/udNLcuIBER1z/H3y6sQGtOzZQqI0EVXd1leqs6Xc+aQcR5sOVNr25kYRIlZrJBrPE6XQuA2xDfc/qQ5AMj4lSYXpnG6T5Y+vdicOgQOmIRwXtnyBvuxuwCHXGd9oEADvyMexpuHH+Dq2GXi9Fbk+ohFn6BMMgXM38gx1GBkwSPLGJpBHg5nlkl/QBHvbEkc6aw6m/hAkD009BaQwW0SpA2nNK1b+0lQXdDgeHUz/xLhzs/GCuU3xWz++e15NwFff0gzO+yzmYy+b71FEKUe/bLiNcWrf7U0lU0azNNxVXZqleS7NiYv3/AYQEaaOw6X+h34AiwB0nAARPOjJn6ayX5vPAss270Cc1oATEBcWJih1NVBRZq87Mduo74mv70JZXQkO2Z70g8DZxdb0OScUEzRqK0U4S09mnSOp5sjK5kpgSOYz3eujxWlEQlN94c3oz4uP4UfaRqYrMl/d+WpQ0U9gAYSx734TqRZV0LDpHfJNnVqjnZO5+9SzoiHhuVSqQotOg6KHWpo1aqUf1vKm1aYEnyaxjM7Bb1bgstavTcot0gEsb/yCxxHm9vt5GrEebJeuiRgCDDzh00y0ehWQ2g4P6Y9Q1zFoeoi+OZBXmapLvQxLSY/HyUWpdR2mlNm5SqF1nqFuhnpy0zIkbthL60TN5GbXIikeTb/VeK2ndP62r5n+o9c7WmjU4RVG4foYcN8Le7D6j3w4Wx53h/TXXINzjLQumKCUEQVe07k2pqNoCVf1f8Qb11wiE0s/V5j4dDhnvQ04DHqFrMSwz2KeJuijktkf94NPRUv2KDJFTKdP8sBKUXA5aTD34QEXgsNPy9PT03cYMj5qyk4YFMhsZwaS9UA6NNIBj9WaLVoY60feu4WWQVMofk/G7PsWYM+qj/Nx9cbazKtQ2pREC0B5mKAe5bNq+z252dddmc0GA6P+c/lFjDr4UXq2qt+DalD4u1tRvPq9VDQKngq2N3ItKAmP+SOlBpP2nbYOstT5ymOKKuq/u+3b5uARYgyH16xW+D0oM4cieeg12uZ+piSK7837BbPh9swrehzM3KBwgvD4e2kBiUlvzxv9mldw2VvgDoJjtcv6ejxsAGPZ+iNqNrB4/Q7w5cmv7rd4MNdy14dq/KDMDDEH11DFt2phMqyxhOwWZe6peS0Qe5xzXYnHSCZ7VJpbK5tOdrtEA5Fsy8kgO/i3TDlvcQHbEizO+a8/b3oWb1GVoF+BoLHas4bN7l3E9NOSHpJl/jDHVb15wH1pE+I7kU2RN4tkeq3Ws/CWV6Q1N4WUBxNzykmY/X1v6DtA9Qb9ZDh4G5GsVUMYpY1vIC915qTmFCwJ2qxc2/C2jGMhFNmX9GAF9tOAMwsKIYWsqKaAlFV/EboWKrL6MjcTdXi8hQIvzceySTrzYYVrcHR48nBbAfZEXFGnli6dIgRhSZwz/YjOy4JgAk+zPnOGE9/ZLW4zs6T8qm55PHR4jWMo9wyKvsJz6xDx2+dOqns71JKJpL+vQrKTgFjzzSxzAbT7cUDZ0LZBG3FNdVdSIhabvrJm7celaz3sTOPhcDVoGHhDY8FoH/MIeabRJ/wZ4CWcdWMlPG28AtazB3dI6HAYTp8gOOz29hUgxK537IUS9MAerN2+0VDE4lyyBQXSEI6imnRGtwnULwXJ0hPGhRDCtKiT7DmBXGB7iYDuAuSE8TiwzGhRK7kFC59Vxexrt1RFv+DL5Ih0NGPSbwK453x7FoEF13PnFpovWla6sAkqvQo/fP4xJIaQ3LdwktWDoKVVljLbUzWaZVY6Plg+9jWAaKqBz4Jm6mIaIqUiOvogwP0xBP70tV0AEBAV/uPxtzg5syrjHCq+urEAXu5MsxH48MYsdLfvW09lXfyPioWVGPhDNb05ETPNzy5RYgkZQgw+khjFc1teJGwJ+0jLp2l/OBCCAtKOSZuBJhEob9MPuKYO9BcjvpLjWAYEU4NOL9VYntD5rhqkfQiNOEZy/AD85vS1sw6wQLNOJcGhDh8iw2TZA5j9+5eaiJ1lz0czcnVSyZL2xAxmZPGV7JDfX78UbP7LdSS5oXGhO5mTW8H8e9C+Vj7dewxs9HemztHGsF2ZPULl8OBB9PYJ6zFZaAQXeUcsdheoDA17jIMiPWMu8BwOy6iUukr6PPU8aTlWnRTEJeLSbEYayMkPGZeTyDsV0Y2/omGuWGJYiEDgVLPHT35LvcDcgAQAiJ3yHzt/rrDPYB34UJRW/g9a6eqqpHn7aC4wLfe2I2B7+D0JEZGzQFmYIntZu/r/fvfBj3HgyNvFfkeRTZPozZQvS3bAz3owAatA6hCcIk02MzGUx6uMXKe/lPTsflv+PnsO0XBX6vrOvRHHhnWmSYnX/liRk0QqtYeb/1YNOAAZHgpSjEFLdxTZ8k9e9BnsDt0FSJaOk9oCmVeCEOVg72w1bw1soYFt4hQd9+WqmsepUPDMqXgSG/YFJVsXcvHls5GS054Z3hu3DjvRLF2aR5WE2AJ+V6ZA13M0K/36SonDSZOB/H12oJRgMHzC5r/b5MThWu4B0Mz5MkelZ2qJQS4A0qXMW8SgMa6+o2NVhYiweW6dztoA0BjMKwtVTSlsvaOZPM9wzD0zvwdhbp27xddyXqGGVfNpTsY51p6qGRgFibeMIk5uSbX+43wfzdyudPKdp+5SXmGTIpsFcYdN1Ki8C8mNP8rjrO3G6UKnQvbrVeCdhHu2fBOc/5GYqRuBPCUBYd0odrr6uIVWnsJHcyNpZak4d5ZOMk1LH9WNfhZFRBQfNep/4SPRKESZiZcPG0OeYP9lDE+oQCw2tiZz4u25Q3xLJWuscuyx5/mw+94rB0M/LA4H/WZ6cmbp5ph2L/vSK4w/corJnip0VJ3yAQmplZpJYdXm2aIK5VK2PpSUnWn3MpUtbE21YINMgq9cxvUuQhEyIM3Z+6FVcHj7BRpiqsmaSWZ03XCLRCc8w+Yii8ZD/FmC6v5JFxt6YSpFkan8cu5xb+AR99q7VSFCHMdzzZggRoIklr311aN9FatrWzfrlVuDKy0rVYROA4RvNSJ9BRC8Pg/DBEFG1T+y0dcPmVEGJHFGJRHICP/R31xuHEDXidqxSYHip4jXGjF0lykxLfip7Iy3G8zx99TWDxPzfoBO0hEx8J4w5sZWmXby5F9YeuoZK1o/11XMps+g+llqqG6vmFvUYc94LEBktA+FO11kupoeJb9gr/FXdsN9MImnRkxO6iRVLMoDJ/dNaOYjQU3+ykfOm00uKipM7l60kwhf9BJjmYVTi3bZBIgL8x+53T55MUF3H5HtsLGztdMEzDrJWxCCz+MCBikEcHwaPI268LL8XjwElp3Hpnu752jNy2y60f8vU9hP1gvS1Y40Y22MSVrYY0LQOkY0l7h4aEy+tG4C8eaxCUCVhX/cCytYbItlA3c+yZnZium2CzfeEmj8B9iazeoM+00uy1muvYCqAGVOkQgMjZbz5dgBT8GNpJ+IhL/LtrNCvO/bmsw22Y+69C9xLo0qmudMQzjFyDDRWsN8AqtjVUP5RVpxPufubSls4Jg3NTLcjkaKfdBy6laQCtoiBC5frcA8SSh7t5sGDPoVqWWkb39TGmn8iLBj7VLVDWoT9q0m9r201F0yIthqZ0gJH2YfISpgYuWGBnpyaMKDYNSgnazTP7sTY9h5R6Uy/13q5Rvn03569sIGlkNSUlWFhgJRZdkUor31d3DKLMOnn3hhaw3/bDK2naCwdNZ1WMeEfAwlyshF9JwfsiSnkfgPqAHFgB2gQJR7OT803cJ8CfSfcHE8SoZw+72iGg6tQevwwyn3ls7VsVS3qRfoapBAsa8mipCOkPaubkZslzsep7jkzaknZsHU4Qih2e/lrkZz+ekuBzeMihAkCZWxssY3eW4KQYzWontyZQ6hzvY3BHsBtxpX+neeL6chWyBGBCcncwmumgwyMsXAJG9QlzQPuD8DH1oA4XJWrxD1lDAZ2ak4mc3bAPKjmH5mCMnUwcJ/WlR4E87h/cHAMQ3jzR8sd812RtNQD4h3xiJF58xT7IG9Km/PLFVlzlK15vsdLUJyfaPd1WOlH+wYkerRRiwZAd0ScmL/3jy0XWZ5s2WX7ejnvCU59X8Khm3pKa7NJEx95HvoZt089jUfVdp0vSuKvSOgvzuy918h/aGfQ+mCsdvqenWIfIVtAAHL12fgUcdP2MYxC1OQzALBDfYj9fK3031Ug7KWwjc1/CMJafY5fMKgduRLNNBVfvoftrLI5ggQ8EipQhOA7oc4qTuEcp63m5kfKxHTixeLGX0dXvIKsV+CAzvcuNEMxfSrV/tpQvLK8YsuqlyfPebqCbI0KrGKAJaEOMvn5YQrG3aSuMvVtfP0vKPceMsuFo0VwZoB6par0JXcB6tCmUlh6gmR1w/qr1PNgh8WiHApgiNpyR5aGBWgj5fPw9tYHMO0vxInA+Q3JdrWr7mADhpnQjC+05dg4Mj/326m9JtLLvx8UMxPA4QUSBbACiGB5303fxhMuiQjqlwqbXQjAo79W1axJbAE5Id1o0AmAFE2X6N6ct0zE9J5uaC+soZ2GTXyz8DmKDYtiV9nFg9C41nSXlanXnhQ5RdGjMTwxRjI/a04lh66Hr8Zn7VooY9MazMxZHWgii7LgoFKDohE8u98PDR6CuIx4wuKHJ/8PxjCd5Hne/IEMT1z9OEN62GYl6te/caXS/H5XisqqB3S2l1+WUdEPNvad283SCdcxGnXTPCw4eIGmSQ58OigcS2AyCSmXsT4aTJxyMV258aogr1LXAZ9GVu0hMfpyIOWm7zBmNYznPjPUyR06SoGNuFagInpZCWoDAEkY81AK8PnpMaEB7yedgSXXwTCEXC7GNtnydWHOe7tRzjJdmjPDAyTSxtk4+bkUMLUSX8TFwuldhEKtc73PHcPMQ7clr1Kenxg/ZXf3N1S24P1qj9UoSa/iUDpihpISSWa0DM5JuWoxZZG41UCO1QVLvHvtdr+emAnFWWjsOp5cDGX5zXpGzaGzvMfRKl0zwIQnV53F9GfgJ4xt4a72C5CW0va6dXrOdDA1QhGLN0KovK7JJ/BkVLGlwmNSrgUlZRG08ZJ0hVnNfiUFM95ruktqhhWGBZavXXeAOTh1FiEKEdB69fjy771XwLIRIXTgZzjqlTuwz9X4+zJXxtXqfUFLRZDbIeRbM3Zg9HN7s2FeJqdh2TLg579Jejtm9uhXT8ou8Uo+hJtA5WsuWLgqdFj5an0znxnxLEaPkRM7CThPz+qUbb9QnG90VDPk5uOpASfrOLPRbexSADLsgBZenp1pY239zm9fcvw8mbZv/1IKBVagZrR/N/yNzNk3mC+m6Ppo96Slvl2qVqft/sO2k6uzO8PiiyZpfbwQ/Yo/T4qUKrUfgC7kQzA3FR3Uk69zMY2iy89PHPEX72kChj/8scyawYg+MzRZJiKbIMl4W9F5lLRGcStavF0PO2EM74YZMRvmU6NRlEGeU6HpUv5Q6VGCfalaCGrH6ycdim1qFGuLmP/IMTxdCe3dx+Y5IFuf7uxL++zqaFjubcLG/Z1COczK1dbl46DXjv5y2PxjBpE9YcZGxxEpqQRy+eJJQD1U7k29lfrU5YFq+xqktwU1mop2V0dRSnuLOMcRDYNnzJZpLJ1ptRiQ0zYUNutCY+l6AStf3xFCn4ClTgr6jccycvH4ciWvYcT9mS326WIuB/dSMJaI0BjCU9Ow9MTIacc0c3tRMAwsrwNgbcTlkA6v5kDsaahwDLp8IAHLofigK4RB1SBOKqWCcG2K08Oe+TNatMw0+k+0rveaLlbZFXscerPLwbzRDTAN+gypirX6jVdITL+CPlgOXGgqrKUiOyB5Luf/n5FuQqkRIao5z6iT3UWtrD27PRojdGOxWgAvuwVyjtQs2PRCXKuDqCi8zyWDscJV1Crfgqub7psSHI8N/aX1O5syQzjUcaHeOc+Zq/kk8QKjGkxmro7+Gct3+rGseBNPrlfcNYQawFF4xLtc3ZwvfVVsoG8wvt4LG7u9Xt/j4T48nSrSrY7gv8sZBMVLkp8Ycri9QF8iy65Pslt5R70+TNyBxRyFGaASVEgvU5vTeqg3UHtYHkgU+XB5+x4MmOhrs5RG35Q1cCbH0J77FPdNPgQhX9zsK4Hvk+uI7p5EqJOmg0nqxOqYb/NwQY70wFJ8AtMgREQi0JJdB+K+9GKwIruKfe5E2jxFEO1o61GaZ2rBdAU1IkhSpGOgYKedxzYidHUHSv/jXbg2h6w1BI86yJIKHxF9BNwXJIDCRu4Pbe6oHP9+vJmicB8Jj/z/IV2nj5SFHhiHZsmMLlZu3foxsEks77hKdli74mqtoTfoSuLDOfbeBtBi4+R98UOtVdo0mPXgX4IV5vL9u+C3uZxufFb7nB8er1SHOaj8KG+QA077NKnwLV8any/NjOeT43Pcog7pMsBYP/hd6q1GNsKIdzr1iZlrD/WdsNMrXzVA9SFdwGL/+0rsoECh+CjoaS0+ZAynWLoj5cwtllSzJt2B43/3iwZdyFwHn/Azs1i/OLRYVYtnv2y6LkMmzNAVQVMLs9vilo5FPP1KDCxEwQNCowbvmuHeLXTT8urjIkTaRst5se5rzTN0gOSNKHt+1/8zGslRNG2WA3oneWRK5wMIF0MHf1fFPFY1d2SxPg+smFxywdJexUEHP0/hxK/cf/vw+Go8XuwNMp+liUrfWpQo4zxM3IHycvnNG32jVGlvGwc7tQc/ABFdWflyectrY6R5SbmxMjjXsDIbAUp8Sp7VpUFYeXMHEKnVCHygA3fhsUnn/9VSfiY5jO6Q5w++XGFGimEiR02e4tixdIKiKt0eG9JQ77ZhRFp5Ac7k86D3QTM9IeUvq7Sden6gsRjTQ3xWyfpigbHwXbrEC2E3ewbUHVhP+JOGZ61aADwe1B0eQavNkAEOhr7UtWbbrxwPEbdDmVofjDKdhlwK3gVaRYpqdyDeUn6EZoUeD1SRSLVGt+5GAosMKR/rsjc9O+SdEtDrdPM/qYiS4+a+eO5laiczRbLYghLEcEM74NQ/OruAlHKDBxeXu1ByCUDzKj8D7PYiTFOtN3BUACE3G9P4hFyMd3Wy+q/ydsREiw4JF+TtgkWUIHTLNR39gjvVRxdSsvOilr51fIy5GWCy+9i1wgVGURJz3ew+Nmqaa0EfCfgyv/5H44iQqBOwTgEggxB37PKZCybIDBVs4ax+S8cFzBd9W86rogud5JBPfXGuDFZR4YBPZ8XIiJA5kxsrAP8OzixqrdCGlC+xwUB5H9CJXzxEAIOi42d4LzGNi9odeLCy+9m/jr2PwwJUAAAAA');
