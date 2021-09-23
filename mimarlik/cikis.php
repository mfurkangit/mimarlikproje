<?php
    session_start();
    setcookie("giris","",time()-1);
    $_SESSION["kullanici"] = "";
    $_SESSION["yetki"] = "";
    $_SESSION["islem"] ="";
    
    session_destroy();
    echo "<script> window.top.location='index.php'; </script>";
    die();
?>