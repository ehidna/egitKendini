<?php
  session_start();
  session_destroy();
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    // Bu islem olmadan surekli ayni session id
    // kullanma sorunu var burada session'i tamamen yok ediyor
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
    var_dump($params);
    die();
  }
   echo "<script type='text/javascript'> document.location = './girisPaneli/index.php'; </script>";
?>