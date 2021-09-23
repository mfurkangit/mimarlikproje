<?php
require_once("baglan.php");
if ($_COOKIE["giris"]<>"var"  || intval($_SESSION["kontrol"])<=0 || $_SESSION["kullanici"]=="") {
    @header("Location:cikis.php");
    die();
}
$sorgu = $baglan->query("select * from yonetici where (id='$_SESSION[kontrol]' && kullanici ='$_SESSION[kullanici]')", PDO::FETCH_ASSOC);
if ($sorgu->rowCount()<=0) {
    @header("Location:cikis.php");
    die();
}
$sorgu2 = $baglan->query("select yetki from yonetici where (id='$_SESSION[kontrol]' && kullanici ='$_SESSION[kullanici]')");
$satir2 = $sorgu2->fetch(PDO::FETCH_ASSOC);
$yetki = $satir2["yetki"];
@$_SESSION["yetki"]= $yetki;
if ($sorgu2->rowCount()<=0) {
    @header("Location:cikis.php");
    die();
}

if ($yetki<>"admin" || $yetki=="") {
    @header("Location:giris.php");
    die("Yetkisiz Giriş!");
}


?>