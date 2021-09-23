<?php

require_once("yetkikontrol.php");

if(@$_POST["islem"])
{


switch (@$_POST["islem"]) {
    case 'proje':
      $islem="islemproje.php";
      $_SESSION["islem"]= $islem;
      break;
    case 'hakkimizda':
      $islem="islemhakkimizda.php";      
      $_SESSION["islem"]= $islem;
      break;
    case 'ekip':
      $islem="islemekip.php";      
      $_SESSION["islem"]= $islem;
      break;
    case 'iletisim':
      $islem="islemiletisim.php";      
      $_SESSION["islem"]= $islem;
      break;
  default:
    $islem="islemproje.php";      
    $_SESSION["islem"]= $islem;
    break;
}
}
else{

  @$islem =$_SESSION["islem"];
}
?>
<!DOCTYPE html>
<html>
<title>Mimarlık </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="bootstrap.css">
<script src="jquery.js"></script>
<script src="popper.js"></script>
<script src="bootstrap.js"></script>
<body>
<?php

echo"
<div class='w3-sidebar w3-black w3-bar-block' style='width:25%'>
  <h3 class='w3-bar-item w3-light-grey' style='border-radius:0 0 15px 15px'>Yönetici İşlemleri</h3>
  <form action='apanel.php' method='post' enctype='multipart/form-data'>
  <a class='w3-bar-item w3-button' href='index.php'> Ana Sayfa </a>
  <button type='submit' name='islem' value='proje' class='w3-bar-item w3-button'>Proje İşlemleri</button>
  <button type='submit' name='islem' value='hakkimizda' class='w3-bar-item w3-button'>Hakkımızda İşlemleri</button>
  <button type='submit' name='islem' value='ekip' class='w3-bar-item w3-button'>Ekip İşlemleri</button>
  <button type='submit' name='islem' value='iletisim' class='w3-bar-item w3-button'> İletişim İşlemleri</button>
  <a href='cikis.php' class='w3-bar-item w3-button'>Çkış</a>
  </form>
</div>


<div style='margin-left:25%'>
<div class='w3-container w3-dark-grey w3-teal'>
  <h1>$_SESSION[kullanici]</h1>
</div>

<div class='w3-container'>";

@include_once("$islem");

echo"
</div>

</div>";
 
 
 ?>

 
 
</body>
</html>


