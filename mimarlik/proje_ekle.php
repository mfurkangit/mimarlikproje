<!DOCTYPE html>
<html>
<title>MSB Mimarlık</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<body>
<div class='w3-container w3-padding-32'>
<h3 class='w3-border-bottom w3-border-light-grey w3-padding-16'>İletişim</h3>

<form action='apanel.php' method='post'>
  <input class='w3-input w3-border' type='text' placeholder='Başlık' name='proje_baslik'>
  <input class='w3-input w3-section w3-border' type='text' placeholder='Proje Resmi'  name='proje_resim'>
  <input class='w3-input w3-section w3-border' type='text' placeholder='Proje Durumu'  name='proje_durum'>
  <button class='w3-button w3-black w3-section' type='submit' name="yeni_proje_ekle" value="yeni_proje_ekle">
    <i class='fa fa-paper-plane'></i> GÖNDER
  </button>
</form>
</div></body></html>