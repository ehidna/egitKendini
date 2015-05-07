<?php
  session_start();
  if( !empty($_SESSION["success"]) && !empty($_SESSION["email"]) ){
      echo "ANA SAYFA";
  }else{
    echo "<script type='text/javascript'> document.location = './girisPaneli/index.php'; </script>";
    die();
  }
?>
<br/>
<A HREF = logout.php>Log out</A>
