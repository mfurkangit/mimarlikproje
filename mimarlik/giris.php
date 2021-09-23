<?php
    require_once("baglan.php");

    if (isset($_POST["giris"])) {
        $kullanici = $_POST["kullanici"];
        $sifre = ($_POST["sifre"]);

        $sorgu = $baglan->query("select * from yonetici where (durum='aktif' && kullanici='$kullanici' && sifre='$sifre')");
        if ($sorgu->rowCount()<=0){

            echo "<script> alert('HATALI KULLANICI BİLGİSİ!'); window.top.location='giris.php'; </script>";
            die();
        }
        foreach ($sorgu as $satir) {
        setcookie("giris","var",time()+60*60*3);
        $_SESSION["kullanici"] = $satir["kullanici"];
        $_SESSION["kontrol"] = $satir["id"];
        $_SESSION["yetki"]= $satir["yetki"];
        

        echo "<script> alert('Giriş Başarılı!Hoş Geldin $satir[kullanici]!'); window.top.location='index.php'; </script>";
            die();
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
</head>
<body style="text-align:center">
    <form method="post" action="giris.php">
        <b>Kullanıcı Adı:</b><br>
        <input type="text" name="kullanici"><br><br>
        <b>Parola:</b><br>
        <input type="password" name="sifre"><br><br>
        <input type="submit" name="giris" value="Giriş">
    </form>
</body>
</html>