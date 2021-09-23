
<?php

require_once("baglan.php");
require_once("yetkikontrol.php");
if(@$_GET["no"] && @$_GET["duzenle"]=="evet"){
    $proje_id=$_GET["no"];
  
    $proje_getir = $baglan->query("select * from projeler where id='$proje_id'", PDO::FETCH_ASSOC);
    if ($proje_getir->rowCount()>0) {
        foreach ($proje_getir as $satir_ara) {
    echo"<div class='w3-container w3-padding-32'>
    <form action='apanel.php' method='post' enctype='multipart/form-data'>
    <input type='text' name='proje_id' value='$satir_ara[id]' hidden >
      <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[baslik]'  name='proje_baslik'>
      <input type='hidden' name='proje_eskiresim' value='$satir_ara[resim]' >
      <input class='w3-input w3-section w3-border' type='file' value='' name='proje_resim'>
      <select name='proje_durum'>
            <option value='Aktif'";if (@$satir_ara["durum"]=="Aktif") {echo "selected";} echo">Aktif</option>
            <option value='Pasif'"; if(@$satir_ara["durum"]=="Pasif"){echo "selected";} echo">Pasif</option>
        </select><br>
      <button class='w3-button w3-black w3-section' type='submit' name='proje_duzenle' value='proje_duzenle'>
        <i class='fa fa-paper-plane'></i> Düzenle
      </button>
    </form>
  </div>";
        }
        die();

    }
}
if($_POST["proje_duzenle"]=="proje_duzenle"){

    $proje_id=$_POST["proje_id"];
    $proje_baslik=$_POST["proje_baslik"];
    $proje_durum=$_POST["proje_durum"];

        if ($_FILES["proje_resim"]["name"]=="") {
            $proje_resim = $_POST["proje_eskiresim"];
        }else{

            $yeniad = "img/proje_".$proje_id.".jpg";
            if (move_uploaded_file($_FILES["proje_resim"]["tmp_name"],$yeniad)) {
                $proje_resim = $yeniad;
                if ($proje_resim <> $_POST["proje_eskiresim"]) {
                    unlink($_POST["proje_eskiresim"]);
                }
            }else {
                $proje_resim = $_POST["proje_eskiresim"];
            }
        }
    
    $sorgu_duzenle=$baglan->prepare("update projeler set baslik=?,resim=?,durum=? where id=?");
    $proje_duzenle = $sorgu_duzenle->execute(array("$proje_baslik","$proje_resim","$proje_durum","$proje_id"));
    
    if ($proje_duzenle) {
        echo"<script>alert('$proje_duzenle Proje Düzenlendi');window.location.href='apanel.php'</script>";
    } else {
        echo"<script>alert('Proje Düzenlenemedi');window.location.href='apanel.php'</script>";
    }
}
 
    if(@$_GET["no"] && @$_GET["duzenle"]!="evet"){
    

        $id = $_GET["no"];
        $proje_getir = $baglan->query("select * from projeler where id='$id'", PDO::FETCH_ASSOC);
        if ($proje_getir->rowCount()>0) {
            foreach ($proje_getir as $satir_ara) {
                @unlink($satir_ara['resim']);
            }
        }
    
        $sorgu_sil = $baglan->prepare("delete from projeler where id=?");
        $sil = $sorgu_sil->execute(array("$id"));
        if ($sil) {
      
            echo"<script>alert('$sil Kayıt Silindi');window.location.href='apanel.php'</script>";
        } else {
            echo"<script>alert('Kayıt Silinemedi');window.location.href='apanel.php'</script>";
        }
      
      
      }
      
    if($_GET["proje_ekle"]=="proje_ekle"){

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
        
          <input class='w3-input w3-section w3-border' type='text' placeholder='Başlık' value='' name='proje_baslik'>
          <input class='w3-input w3-section w3-border' type='file' value='' name='proje_resim'>
          <select name='proje_durum'>
            <option value='Aktif'>Aktif</option>
            <option value='Pasif'>Pasif</option>
        </select><br>
          <button class='w3-button w3-black w3-section' type='submit' name='yeni_proje_ekle' value='yeni_proje_ekle'>
            <i class='fa fa-paper-plane'></i> GÖNDER
          </button>
        </form>
        </div></body></html>";
        die();

    }
    if($_POST["yeni_proje_ekle"]=="yeni_proje_ekle") {


        $proje_baslik = $_POST["proje_baslik"];
        $proje_durum = $_POST["proje_durum"];
        $proje_deger = $baglan->query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='mimarlik' AND TABLE_NAME='projeler'", PDO::FETCH_ASSOC);
        if ($proje_deger->rowCount()>0) {
            foreach ($proje_deger as $satir_ara) {
        
                $proje_resim=$satir_ara["AUTO_INCREMENT"];
        
            }
        }
        if ($_FILES["proje_resim"]["name"]=="") {
            $proje_resim = $_POST["proje_eskiresim"];
        }else {

            $yeniad = "img/proje_".$proje_resim.".jpg";
            if (move_uploaded_file($_FILES["proje_resim"]["tmp_name"],$yeniad)) {
                $proje_resim = $yeniad;
                if ($proje_resim <> $_POST["proje_eskiresim"]){
                    @unlink($_POST["proje_eskiresim"]);
                }
            }else{
                $proje_resim = $_POST["proje_eskiresim"];
            }
        }

    
    $sorgu_ekle = $baglan->prepare("insert into projeler set id=?,baslik=?,resim=?,durum=?");
    $proje_ekle = $sorgu_ekle->execute(array(NULL,"$proje_baslik","$proje_resim","$proje_durum"));
    if ($proje_ekle) {
        $kayitno = $baglan->lastInsertID(); 
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
    <th>Proje ID</th>
    <th>Proje Başlık</th>
    <th>Proje Resim</th>
    <th>Durum</th>
    <th></th>
    <th><button type='submit' name='proje_ekle' value='proje_ekle' class='btn btn-success'>Yeni Kayıt Ekle</button></th>
    </tr></thead><tbody>";
    $sorgu = $baglan->query("select * from projeler order by id asc", PDO::FETCH_ASSOC);
    if ($sorgu->rowCount()>0) {
        foreach ($sorgu as $satir) {
        echo "<tr>
        <td><input type='submit' name='proje_id' value='$satir[id]' hidden >$satir[id]</td>
        <td >$satir[baslik]</td>
        <td><input type='hidden' name='proje_eskiresim' value='$satir[resim]' ><img src='$satir[resim]'  width='100' height='75'></td>
        <td>$satir[durum]</td>
        <td><a class='btn btn-primary' href='apanel.php?no=$satir[id]&duzenle=evet' onclick='if (!confirm(\"Düzenlemek istediğinize emin misiniz?\")) return false;'>Düzenle</a></td>
        <td><a class='btn btn-danger' href='apanel.php?no=$satir[id]' onclick='if (!confirm(\"Silmek istediğinize emin misiniz?\")) return false;'>Sil</a></td>
        </tr>";
    }
}
    echo "</tbody></table></form>";


?>
