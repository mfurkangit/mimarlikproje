<?php
    require_once("baglan.php");
?>
<!DOCTYPE html>
<html>
<title>MSB Mimarlık</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="bootstrap.css">
<script src="jquery.js"></script>
<script src="popper.js"></script>
<script src="bootstrap.js"></script>
<body>

<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
  <a href="index.php" class="w3-bar-item w3-button"><b>MSB</b> Mimarlık</a>
  <?php 
  if(@$_SESSION["yetki"]=="admin"){echo"<a href='apanel.php' class='w3-bar-item w3-button'><b>Yönetici İşlemleri</b></a>";}
  
  ?>
  <div class="w3-right w3-hide-small">
      <a href="#proje" class="w3-bar-item w3-button">Projeler</a>
      <a href="#kurumsal" class="w3-bar-item w3-button">Kurumsal</a>
      <a href="#iletisim" class="w3-bar-item w3-button">İletişim</a>
      <a href="giris.php" class="w3-bar-item w3-button">Giriş İşlemi</a>
    </div>
  </div>
</div>

<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="anasayfa">
  <img class="w3-image" src="img/architect.jpg" alt="Mimarlık" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>BR</b></span> <span class="w3-hide-small w3-text-light-grey">Mimarlık</span></h1>
  </div>
</header>

<div class="w3-content w3-padding" style="max-width:1564px">
  <div class="w3-container w3-padding-32" id="proje">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Projeler</h3>
  </div>

  <div class="w3-row-padding">
    <?php
        $sorgu = $baglan->query("select * from projeler where (durum='aktif') order by baslik asc", PDO::FETCH_ASSOC);
        if ($sorgu->rowCount()>0) {
            foreach ($sorgu as $satir) {
                echo "<div class='w3-col l3 m6 w3-margin-bottom'>
                <div class='w3-display-container'>
                <div class='w3-display-topleft w3-black w3-padding'>$satir[baslik]</div>
                <img src='$satir[resim]' alt='$satir[baslik]' style='width:100%'>
                </div>
                </div>";
            }
        }
    ?>
  </div>

  <div class="w3-container w3-padding-32" id="kurumsal">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Hakkımızda</h3>
    <?php
        $sorgu = $baglan->query("select * from kurumsal", PDO::FETCH_ASSOC);
        foreach ($sorgu as $satir) {
            echo "<p>$satir[icerik]</p>";
        }
    ?>
  </div>

  <div class="w3-row-padding w3-grayscale">
    <?php
        $sorgu = $baglan->query("select * from ekip where (durum='aktif') order by adsoyad asc", PDO::FETCH_ASSOC);
        if ($sorgu->rowCount()>0) {
            foreach ($sorgu as $satir) {
                echo "<div class='w3-col l3 m6 w3-margin-bottom'>
                <img src='$satir[resim]' alt='$satir[adsoyad]' style='width:100%'>
                <h3>$satir[adsoyad]</h3>
                <p class='w3-opacity'>$satir[gorev]</p>
                <p>$satir[aciklama]</p>
                <p><a href='mailto:$satir[iletisim]' class='w3-button w3-light-grey w3-block'>İletişim</a></p>
                </div>";
            }
        }
    ?>
  </div>

  <div class="w3-container w3-padding-32" id="iletisim">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">İletişim</h3>
    <p>Yeni projeniz üzerinde konuşmak için formu doldurun.</p>
    <form action="kontrol.php" method="post">
      <input class="w3-input w3-border" type="text" placeholder="Ad Soyad" required name="adsoyad">
      <input class="w3-input w3-section w3-border" type="text" placeholder="E-mail" required name="email">
      <input class="w3-input w3-section w3-border" type="text" placeholder="Konu" required name="konu">
      <input class="w3-input w3-section w3-border" type="text" placeholder="Mesaj" required name="mesaj">
      <button class="w3-button w3-black w3-section" type="submit">
        <i class="fa fa-paper-plane"></i> GÖNDER
      </button>
    </form>
  </div>
  
<div class="w3-container">
  <img src="img/map.jpg" class="w3-image" style="width:100%">
</div>

</div>


<footer class="w3-center w3-black w3-padding-16">
  <p>Powered by <a href="" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>

</body>
</html>