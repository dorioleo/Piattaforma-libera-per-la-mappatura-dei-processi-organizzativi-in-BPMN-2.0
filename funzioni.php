<?php
function escapeContenuto($testo){
    $testo = str_replace('&ldquo;','&quot;',$testo);//?
    $testo = str_replace('&rdquo;','&quot',$testo);//?
    $testo = str_replace("&lsquo;","&#39;",$testo);//?
    $testo = str_replace("&rsquo;","&#39;",$testo);//?
    $testo = str_replace("&#769;","&#39;",$testo);//apostrofo inincollabile
    $testo = str_replace("&#768;","&#39;",$testo);//apostrofo inincollabile
    $testo = str_replace("&raquo;","&gt;&gt;",$testo);//»
    $testo = str_replace("&laquo;","&lt;&lt;",$testo);//«
    $testo = str_replace("&#8211;","-",$testo);//?
    $testo = str_replace("&ndash;","-",$testo);//?
														
    $testo = str_replace("&acute;","&#39;",$testo);//Ž
    $testo = str_replace("`","'",$testo);//`
    $testo = str_replace("&deg;",".",$testo);//°
    $testo = str_replace("&cent;","",$testo);//¢
    $testo = str_replace("€","&euro;",$testo);//?
    $testo = str_replace("&hellip;","...",$testo);//?
    $testo = str_replace("&Ccaron;","&#268;",$testo);//?
    $testo = str_replace("&ccaron;","&#269;",$testo);//?
    
    //$testo = str_replace('&gt;',">",$testo);//>
    //$testo = str_replace('&lt;',"<",$testo);//< lo prende come un tag NON USARE
        
    return $testo;    
}
function escapeCaratteri($testo){                                
    $testo = trim($testo);
    //¢??°????`Ž
    $testo = str_replace('&#8220;','"',$testo);//?
    $testo = str_replace('&#8221;','"',$testo);//?    
    $testo = str_replace('&#34;','"',$testo);//"
    $testo = str_replace('&#8216;',"'",$testo);//?
    $testo = str_replace('&#8217;',"'",$testo);//?    
    $testo = str_replace(chr(171), '<<',$testo);//«
    $testo = str_replace(chr(187), '>>',$testo);//»  
    $testo = str_replace(chr(150),"-",$testo);//?
    $testo = str_replace("&#8211;","-",$testo);//?
    $testo = str_replace("&#150;","-",$testo);//?   
    $testo = str_replace('&#180;',"'",$testo);//Ž    
    $testo = str_replace("`","'",$testo);//`
    $testo = str_replace(chr(176),".",$testo);//°
    $testo = str_replace(chr(162), "",$testo);//¢
    $testo = str_replace(chr(164),"euro",$testo);//?
    $testo = str_replace('&#39;',"'",$testo);//'
    $testo = str_replace('&#60;',"<",$testo);//<
    $testo = str_replace('&#62;',">",$testo);//>

    $testo = str_replace('&#8230;',"...",$testo);//?

    //non vanno ma li lasciamo
    $testo = str_replace(chr(148),'"',$testo);//?
    $testo = str_replace(chr(147),'"',$testo);//?
    $testo = str_replace(chr(146),"'",$testo);//?
    $testo = str_replace(chr(145),"'",$testo);//?
    $testo = str_replace(chr(180),"'",$testo);//Ž
    $testo = str_replace(chr(96),"'",$testo);//`
    return $testo;
}

?>