
<?php

require_once("baglan.php");
require_once("yetkikontrol.php");
if(@$_GET["no"] && @$_GET["duzenle"]=="evet"){
    $ekip_id=$_GET["no"];
    $ekip_getir = $baglan->query("select * from ekip where id='$ekip_id'", PDO::FETCH_ASSOC);
    if ($ekip_getir->rowCount()>0) {
        foreach ($ekip_getir as $satir_ara) {
    echo"<div class='w3-container w3-padding-32'>
    <form action='apanel.php' method='post' enctype='multipart/form-data'>
    <input type='text' name='ekip_id' value='$satir_ara[id]' hidden >
    <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[adsoyad]' name='ekip_adsoyad'>
      <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[iletisim]' name='ekip_iletisim'>
      <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[gorev]' name='ekip_gorev'>
      <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[aciklama]' name='ekip_aciklama'>
      <input type='hidden' name='ekip_eskiresim' value='$satir_ara[resim]'>
      <input class='w3-input w3-section w3-border' type='file' value='' name='ekip_resim'>
      
      <select name='ekip_durum'>
            <option value='Aktif'";if (@$satir_ara["durum"]=="Aktif") {echo "selected";} echo">Aktif</option>
            <option value='Pasif'"; if(@$satir_ara["durum"]=="Pasif"){echo "selected";} echo">Pasif</option>
        </select><br>
      <button class='w3-button w3-black w3-section' type='submit' name='ekip_duzenle' value='ekip_duzenle'>
        <i class='fa fa-paper-plane'></i> Düzenle
      </button>
    </form>
  </div>";
        }
        die();

    }
}
if($_POST["ekip_duzenle"]=="ekip_duzenle"){

    $ekip_id=$_POST["ekip_id"];
    $ekip_adsoyad=$_POST["ekip_adsoyad"];
    $ekip_iletisim=$_POST["ekip_iletisim"];
    $ekip_gorev=$_POST["ekip_gorev"];
    $ekip_aciklama=$_POST["ekip_aciklama"];
    $ekip_durum=$_POST["ekip_durum"];
    

        if ($_FILES["ekip_resim"]["name"]=="") {
            $ekip_resim = $_POST["ekip_eskiresim"];
        }else{

            $yeniad = "img/ekip_".$ekip_id.".jpg";
            if (move_uploaded_file($_FILES["ekip_resim"]["tmp_name"],$yeniad)) {
                $ekip_resim = $yeniad;
                if ($ekip_resim <> $_POST["ekip_eskiresim"]) {
                    @unlink($_POST["ekip_eskiresim"]);
                }
            }else {
                $ekip_resim = $_POST["ekip_eskiresim"];
            }
        }

    $sorgu_duzenle=$baglan->prepare("update ekip set adsoyad=?,iletisim=?,gorev=?,aciklama=?,resim=?,durum=? where id=?");
    $ekip_duzenle = $sorgu_duzenle->execute(array("$ekip_adsoyad","$ekip_iletisim","$ekip_gorev","$ekip_aciklama","$ekip_resim","$ekip_durum","$ekip_id"));
    
    if ($ekip_duzenle) {
        echo"<script>alert('$ekip_duzenle Ekip Üyesi Düzenlendi');window.location.href='apanel.php'</script>";
    } else {
        echo"<script>alert('Ekip Üyesi Düzenlenemedi');window.location.href='apanel.php'</script>";
    }
}
 
    if(@$_GET["no"] && @$_GET["duzenle"]!="evet"){
    

        $id = $_GET["no"];
        $ekip_getir = $baglan->query("select * from ekip where id='$id'", PDO::FETCH_ASSOC);
        if ($ekip_getir->rowCount()>0) {
            foreach ($ekip_getir as $satir_ara) {
                @unlink($satir_ara['resim']);
            }
        }
        $sorgu_sil = $baglan->prepare("delete from ekip where id=?");
        $sil = $sorgu_sil->execute(array("$id"));
        if ($sil) {
      
            echo"<script>alert('$sil Kayıt Silindi');window.location.href='apanel.php'</script>";
        }else {
            echo"<script>alert('Kayıt Silinemedi');window.location.href='apanel.php'</script>";
        }
      
      
      }
      
    if($_GET["ekip_ekle"]=="ekip_ekle"){

        echo"<!DOCTYPE html>
        <html>
        <title>MSB Mimarlık</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='style.css'>
        <body>
        <div class='w3-container w3-padding-32'>
        
        <form action='apanel.php' method='post' enctype='multipart/form-data'>
        
          <input class='w3-input w3-section w3-border' type='text' placeholder='Ad Soyad' value='' name='ekip_adsoyad'>
          <input class='w3-input w3-section w3-border' type='text' placeholder='Ekip İletişim'  value='' name='ekip_iletisim'>
          <input class='w3-input w3-section w3-border' type='text' placeholder='Ekip Görev' value='' name='ekip_gorev'>
          <input class='w3-input w3-section w3-border' type='text' placeholder='Ekip Açıklama'  value='' name='ekip_aciklama'>
          <input class='w3-input w3-section w3-border' type='file'  value='' name='ekip_resim'>
          <select name='ekip_durum'>
            <option value='Aktif'>Aktif</option>
            <option value='Pasif'>Pasif</option>
        </select><br>
          <button class='w3-button w3-black w3-section' type='submit' name='yeni_ekip_ekle' value='yeni_ekip_ekle'>
            <i class='fa fa-paper-plane'></i> GÖNDER
          </button>
        </form>
        </div></body></html>";
        die();

    }
    if($_POST["yeni_ekip_ekle"]=="yeni_ekip_ekle") {

        $ekip_adsoyad=$_POST["ekip_adsoyad"];
        $ekip_iletisim=$_POST["ekip_iletisim"];
        $ekip_gorev=$_POST["ekip_gorev"];
        $ekip_aciklama=$_POST["ekip_aciklama"];
        $ekip_durum=$_POST["ekip_durum"];

        $_FILES["ekip_resim"]["name"] = isim_degis($_FILES["ekip_resim"]["name"]);
        $ekip_deger = $baglan->query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='mimarlik' AND TABLE_NAME='ekip'", PDO::FETCH_ASSOC);
        if ($ekip_deger->rowCount()>0) {
            foreach ($ekip_deger as $satir_ara) {
        
                $ekip_resim=$satir_ara["AUTO_INCREMENT"];
        
            }
        }
        if ($_FILES["ekip_resim"]["name"]=="") {
            $ekip_resim = $_POST["ekip_eskiresim"];
        }else {

            $yeniad = "img/ekip_".$ekip_resim.".jpg";
            if (move_uploaded_file($_FILES["ekip_resim"]["tmp_name"],$yeniad)) {
                $ekip_resim = $yeniad;
                if ($ekip_resim <> $_POST["ekip_eskiresim"]) {
                    @unlink($_POST["ekip_eskiresim"]);
                }
            }else{
                $ekip_resim = $_POST["ekip_eskiresim"];
            }
        }
    

    $sorgu_ekle = $baglan->prepare("insert into ekip set id=?,adsoyad=?,iletisim=?,gorev=?,aciklama=?,resim=?,durum=?");
    $ekip_ekle = $sorgu_ekle->execute(array(NULL,"$ekip_adsoyad","$ekip_iletisim","$ekip_gorev","$ekip_aciklama","$ekip_resim","$ekip_durum"));
    if ($ekip_ekle) {
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
    
    <table class='table'style='text-align:center'>
    <thead class='thead-dark'>
    
    <tr>
    <th>Ekip ID</th>
    <th>Ad Soyad</th>
    <th>İletişim</th>
    <th>Görev</th>
    <th>Açıklama</th>
    <th>Resim</th>
    <th>Durum</th>
    <th></th>
    <th><button type='submit' name='ekip_ekle' value='ekip_ekle' class='btn btn-success'>Yeni Kayıt Ekle</button></th>
    </tr></thead><tbody>";
    $sorgu = $baglan->query("select * from ekip order by id asc", PDO::FETCH_ASSOC);
    if ($sorgu->rowCount()>0) {
        foreach ($sorgu as $satir) {
        echo "<tr>
        <td><input type='submit' name='ekip_id' value='$satir[id]' hidden >$satir[id]</td>
        <td >$satir[adsoyad]</td>
        <td >$satir[iletisim]</td>
        <td >$satir[gorev]</td>
        <td >$satir[aciklama]</td>
        <td><input type='hidden' name='ekip_eskiresim' value='$satir[resim]'><img src='$satir[resim]'  width='100' height='75'></td>
        <td>$satir[durum]</td>
        <td><a class='btn btn-primary' href='apanel.php?no=$satir[id]&duzenle=evet' onclick='if (!confirm(\"Düzenlemek istediğinize emin misiniz?\")) return false;'>Düzenle</a></td>
        <td><a class='btn btn-danger' href='apanel.php?no=$satir[id]' onclick='if (!confirm(\"Silmek istediğinize emin misiniz?\")) return false;'>Sil</a></td>
        </tr>";
    }
}
    echo "</tbody></table></form>";


?>
