<?php
  include '../../DB/pdox.class.php';
  $config = array(
		'user'		=> 'root',
		'pass'		=> '',
		'dbname'	=> 'egitkendini',
		'host'		=> 'localhost',
		'type'		=> 'mysql',
		'charset'	=> 'utf8',
		'prefix'	=> ''
	);
  session_start();

  if(!empty($_SESSION["success"]) && !empty($_SESSION["email"])){
    header('Location: ../index.php');
    die();
  }else{
    try{
      $db = new PDOx($config);
      $kullaniciEmail = $_POST["inputEmail"];
      $kullaniciSifre = md5(trim($_POST["inputPassword"]));

      if( !empty($_POST) ){
         $sorgu = $db->pdo->prepare("select sifre from uyeler where mail=? and sifre=?");
         $sorgu->bindParam(1, $kullaniciEmail);
         $sorgu->bindParam(2, $kullaniciSifre);
         $sorgu->execute();
         $sorguIcerik = $sorgu->fetch(PDO::FETCH_ASSOC);
         if(empty($sorguIcerik)){
           echo '<script>alert("Email veya sifre yanlis!");history.back(-1);</script>';
           die();
         }else{
           session_regenerate_id(true);
           $_SESSION["success"] = md5( "oturum" . md5( $sorguIcerik["sifre"] ) . "kontrol" );
           $_SESSION["email"]  = $kullaniciEmail;
           header("Location: ../index.php");
           die();
         }
      }
    }catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eğit Kendini - Giriş</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <h2 class="form-signin-heading">Giriş Ekranı</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="inputEmail" class="form-control" placeholder="Email" required>
        <label for="inputPassword" class="sr-only">Şifre</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Şifre" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş</button>
        <a href="./register.php">Kayit ol </a>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
