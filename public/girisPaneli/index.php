<?php
  include ('../../DB/pdox.class.php');
  $config = array(
		'user'		=> 'root',
		'pass'		=> 'root',
		'dbname'	=> 'egitkendini',
		'host'		=> 'localhost',
		'type'		=> 'mysql',
		'charset'	=> 'utf8',
		'prefix'	=> ''
	);
  $db = new PDOx($config);
  session_start();

  if(!empty($_SESSION["success"]) && !empty($_SESSION["email"])){
  //  echo '<script>alert("Oturumunuz acik!");</script>';
    header('Location: ../index.php');
    die();
  }else{
    $kullaniciEmail = $_POST["inputEmail"];
    $kullaniciSifre = $_POST["inputPassword"];
    if(!empty($kullaniciEmail) && !empty($kullaniciSifre)){
       $uyeVarmi = $db->select('sifre')->from('uyeler')->where('mail', $kullaniciEmail)->getAll();
       if($db->count() != 1){
         echo '<script>alert("Kullanıcı bulunamadı!");history.back(-1);</script>';
         die();
       }else{
         $sifredb = $uyeVarmi[0]->sifre;
       }
       if( md5($kullaniciSifre ) != $sifredb ){
         echo '<script>alert("Yanlış şifre girdiniz!");history.back(-1);</script>';
         die();
       }else{
         $_SESSION["success"] = $sifredb;
         $_SESSION["email"]  = $kullaniciEmail;
         header("Location: ../index.php");
         die();
       }
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

      <form class="form-signin" action="index.php" method="POST">
        <h2 class="form-signin-heading">Giriş Ekranı</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Şifre</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Şifre" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="beniHatirla"> Beni Hatırla
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
