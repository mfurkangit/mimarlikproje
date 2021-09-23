
<?php

require_once("baglan.php");
require_once("yetkikontrol.php");
if(@$_GET["no"] && @$_GET["duzenle"]=="evet"){
    $iletisim_id=$_GET["no"];
    $iletisim_getir = $baglan->query("select * from iletisim where id='$iletisim_id'", PDO::FETCH_ASSOC);
    if ($iletisim_getir->rowCount()>0) {
        foreach ($iletisim_getir as $satir_ara) {
    echo"<div class='w3-container w3-padding-32'>
    <form action='apanel.php' method='post' enctype='multipart/form-data'>
    <input type='text' name='iletisim_id' value='$satir_ara[id]' hidden >
    <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[adsoyad]' name='iletisim_adsoyad'>
      <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[email]' name='iletisim_email'>
      <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[konu]' name='iletisim_konu'>
      <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[mesaj]' name='iletisim_mesaj'>
      <input class='w3-input w3-section w3-border' type='text' value='$satir_ara[ipadres]' name='iletisim_ipadres'>
      <input class='w3-input w3-section w3-border' type='datetime' value='$satir_ara[tarih]' name='iletisim_tarih'>
      
      
      <button class='w3-button w3-black w3-section' type='submit' name='iletisim_duzenle' value='iletisim_duzenle'>
        <i class='fa fa-paper-plane'></i> Düzenle
      </button>
    </form>
  </div>";
        }
        die();

    }
}
if($_POST["iletisim_duzenle"]=="iletisim_duzenle"){

    $iletisim_id=$_POST["iletisim_id"];
    $iletisim_adsoyad=$_POST["iletisim_adsoyad"];
    $iletisim_email=$_POST["iletisim_email"];
    $iletisim_konu=$_POST["iletisim_konu"];
    $iletisim_mesaj=$_POST["iletisim_mesaj"];
    $iletisim_ipadres=$_POST["iletisim_ipadres"];
    $iletisim_tarih=$_POST["iletisim_tarih"];
    
    $sorgu_duzenle=$baglan->prepare("update iletisim set adsoyad=?,email=?,konu=?,mesaj=?,ipadres=?,tarih=? where id=?");
    $iletisim_duzenle = $sorgu_duzenle->execute(array("$iletisim_adsoyad","$iletisim_email","$iletisim_konu","$iletisim_mesaj","$iletisim_ipadres","$iletisim_tarih","$iletisim_id"));
    
    if ($iletisim_duzenle) {
        echo"<script>alert('$iletisim_duzenle İletişim Gönderisi Düzenlendi');window.location.href='apanel.php'</script>";
    } else {
        echo"<script>alert('İletişim Gönderisi Düzenlenemedi');window.location.href='apanel.php'</script>";
    }
}
 
    if(@$_GET["no"] && @$_GET["duzenle"]!="evet"){
    

        $id = $_GET["no"];
        $sorgu_sil = $baglan->prepare("delete from iletisim where id=?");
        $sil = $sorgu_sil->execute(array("$id"));
        if ($sil) {
      
            echo"<script>alert('$sil Kayıt Silindi');window.location.href='apanel.php'</script>";
        } else {
            echo"<script>alert('Kayıt Silinemedi');window.location.href='apanel.php'</script>";
        }
      
      
      }
      
    

  echo "
    <form action='apanel.php' method='get' enctype='multipart/form-data'>
    
    <table class='table'style='text-align:center'>
    <thead class='thead-dark'>
    
    <tr>
    <th>Kayıt ID</th>
    <th>Ad Soyad</th>
    <th>Email</th>
    <th>Konu</th>
    <th>Mesaj</th>
    <th>IP Adresi</th>
    <th>Tarih</th>
    <th></th>
    <th></th>
    </tr></thead><tbody>";
    $sorgu = $baglan->query("select * from iletisim order by id asc", PDO::FETCH_ASSOC);
    if ($sorgu->rowCount()>0) {
        foreach ($sorgu as $satir) {
        echo "<tr>
        <td><input type='submit' name='iletisim_id' value='$satir[id]' hidden >$satir[id]</td>
        <td>$satir[adsoyad]</td>
        <td>$satir[email]</td>
        <td>$satir[konu]</td>
        <td>$satir[mesaj]</td>
        <td>$satir[ipadres]</td>
        <td>$satir[tarih]</td>
        <td><a class='btn btn-primary' href='apanel.php?no=$satir[id]&duzenle=evet' onclick='if (!confirm(\"Düzenlemek istediğinize emin misiniz?\")) return false;'>Düzenle</a></td>
        <td><a class='btn btn-danger' href='apanel.php?no=$satir[id]' onclick='if (!confirm(\"Silmek istediğinize emin misiniz?\")) return false;'>Sil</a></td>
        </tr>";
    }
}
    echo "</tbody></table></form>";


?>
