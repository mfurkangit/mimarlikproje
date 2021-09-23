
<?php

require_once("baglan.php");
require_once("yetkikontrol.php");
if(@$_GET["hakkimizda"]=="duzenle"){
    $hakkimizda_getir = $baglan->query("select * from kurumsal", PDO::FETCH_ASSOC);
    if ($hakkimizda_getir->rowCount()>0) {
        foreach ($hakkimizda_getir as $satir_ara) {
    echo"<div class='w3-container w3-padding-32'>
    <form action='apanel.php' method='post' enctype='multipart/form-data'>
      <input class='w3-input w3-border' type='text' value='$satir_ara[icerik]'  name='hakkimizda_icerik'>
      <button class='w3-button w3-black w3-section' type='submit' name='hakkimizda_duzenle' value='hakkimizda_duzenle'>
        <i class='fa fa-paper-plane'></i> Düzenle
      </button>
    </form>
  </div>";
        }
        die();

    }
}
if($_POST["hakkimizda_duzenle"]=="hakkimizda_duzenle"){

    $hakkimizda_icerik=$_POST["hakkimizda_icerik"];
    
    $sorgu_duzenle=$baglan->prepare("update kurumsal set icerik=?");
    $hakkimizda_duzenle = $sorgu_duzenle->execute(array("$hakkimizda_icerik"));
    
    if ($hakkimizda_duzenle) {
        echo"<script>alert('$hakkimizda_duzenle Hakkımızda Yazısı Düzenlendi');window.location.href='apanel.php'</script>";
    } else {
        echo"<script>alert('Hakkımızda Yazısı Düzenlenemedi');window.location.href='apanel.php'</script>";
    }
}
 
    if(@$_GET["hakkimizda"]=="sil"){
    

        $sorgu_sil = $baglan->prepare("delete from kurumsal ");
        $sil = $sorgu_sil->execute();
        if ($sil) {
      
            echo"<script>alert('$sil Kayıt Silindi');window.location.href='apanel.php'</script>";
        } else {
            echo"<script>alert('Kayıt Silinemedi');window.location.href='apanel.php'</script>";
        }
      
      
      }
      
    if($_GET["hakkimizda_ekle"]=="hakkimizda_ekle"){

        echo"<!DOCTYPE html>
        <html>
        <title>MSB Mimarlık</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='style.css'>
        <body>
        <div class='w3-container w3-padding-32'>
        <h3 class='w3-border-bottom w3-border-light-grey w3-padding-16'>İletişim</h3>
        
        <form action='apanel.php' method='post' enctype='multipart/form-data'>
        
          <input class='w3-input w3-border' type='text' placeholder='İçerik' value='' name='hakkimizda_yeni_icerik'>
          
          <button class='w3-button w3-black w3-section' type='submit' name='yeni_hakkimizda_ekle' value='yeni_hakkimizda_ekle'>
            <i class='fa fa-paper-plane'></i> GÖNDER
          </button>
        </form>
        </div></body></html>";
        die();

    }
    if($_POST["yeni_hakkimizda_ekle"]=="yeni_hakkimizda_ekle") {


        $hakkimizda_icerik = $_POST["hakkimizda_yeni_icerik"];

    
    $sorgu_ekle = $baglan->prepare("insert into kurumsal set icerik=?");
    $proje_ekle = $sorgu_ekle->execute(array("$hakkimizda_icerik"));
    if ($proje_ekle) {
        $kayitno = $baglan->lastInsertID(); //Eklenen Kayıt Numarasını Verir.
        echo "<script>
        alert('$kayitno Sıra Numarası İle Kayıt Altına Alındı.');
        window.location.href='apanel.php';
        </script>";
        die("sorun");
    } else {
        echo "<script>
        alert('Hata Oluştu.');
        window.location.href='apanel.php';
        </script>";
        die("sorun2");
    }
}

  echo "
    <form action='apanel.php' method='get' enctype='multipart/form-data'>
    
    <table class='table'>
    <thead class='thead-dark'>
    
    <tr>
    <th>İçerik</th>
    <th></th>
    <th><button type='submit' name='hakkimizda_ekle' value='hakkimizda_ekle' class='btn btn-success'>Yeni Kayıt Ekle</button></th>
    </tr></thead><tbody>";
    $sorgu = $baglan->query("select * from kurumsal", PDO::FETCH_ASSOC);
    if ($sorgu->rowCount()>0) {
        foreach ($sorgu as $satir) {
        echo "<tr>
        <td >$satir[icerik]</td>
        <td><a class='btn btn-primary' href='apanel.php?hakkimizda=duzenle' onclick='if (!confirm(\"Düzenlemek istediğinize emin misiniz?\")) return false;'>Düzenle</a></td>
        <td><a class='btn btn-danger' href='apanel.php?hakkimizda=sil' onclick='if (!confirm(\"Silmek istediğinize emin misiniz?\")) return false;'>Sil</a></td>
        </tr>";
    }
}
    echo "</tbody></table></form>";


?>
