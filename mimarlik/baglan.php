<?php
    try {
        $baglan = new PDO("mysql:host=localhost;dbname=mimarlik;charset=utf8", "kullanici", "parola");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    session_start();

    /*function isim_degis($metin="") {
        $bul = array("ğ","ı","ü","ş","ö","ç","Ğ","İ","Ü","Ş","Ö","Ç"," ");
        $degistir = array("g","i","u","s","o","c","G","I","U","S","O","C","_");
        $sonuc = str_replace($bul,$degistir,$metin);
        return mb_strtolower($sonuc,"utf8");
    }*/
?>