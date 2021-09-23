<?php
    require_once("baglan.php");

    $adsoyad = $_POST["adsoyad"];
    $email = $_POST["email"];
    $konu = $_POST["konu"];
    $mesaj = $_POST["mesaj"];
    $ipadres = $_SERVER["REMOTE_ADDR"];
    $tarih = date("Y-m-d H:i:s");

  

    $sorgu = $baglan->prepare("insert into iletisim set id=?,adsoyad=?,email=?,konu=?,mesaj=?,ipadres=?,tarih=?");
    $ekle = $sorgu->execute(array(NULL,"$adsoyad","$email","$konu","$mesaj","$ipadres","$tarih"));
    if ($ekle) {
        $kayitno = $baglan->lastInsertID(); //Eklenen Kayıt Numarasını Verir.
        echo "<script>
        alert('$kayitno Sıra Numarası İle Kayıt Altına Alındı.');
        window.location.href='index.php';
        </script>";
    } else {
        echo "<script>
        alert('Hata Oluştu.');
        window.location.href='index.php';
        </script>";
    }
?>