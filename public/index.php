<?php
  include ('./oturumKontrol.php');
  if( ( $giris_yapilmis) ){
      echo "ANA SAYFA";
  }else{
    echo "<script type='text/javascript'> document.location = './girisPaneli/index.php'; </script>";
    die();
  }
?>
<br/>
<A HREF = logout.php>Log out</A>
