<?php
  session_start();

  $cikis = $_POST["logout"];
  if( !empty($_SESSION["success"]) && !empty($_SESSION["email"]) ){
      echo "ANA SAYFA";
  }else{
    if(!empty($cikis)){
      session_destroy();
      $_SESSION = array();
      var_dump($_SESSION);
       echo '<script>alert("Oturum kapandi!");</script>';
       header('Location: ./girisPaneli/index.php');
    }
  }

?>
<body>
  <form action="index.php" method="POST">
  <button name="logout" class="btn btn-lg btn-primary btn-block" value="cikis" type="submit" >Cikis</button>
</form>
</body>
