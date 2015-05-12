<?php
  include '../DB/oturumKontrol.php';
  if( $giris_yapilmis ){
      echo "ANA SAYFA";
  }else{
    echo "<script type='text/javascript'> document.location = './girisPaneli/index.php'; </script>";
    die();
  }
?>
<br/>
<a href="logout.php">Log out</a>
