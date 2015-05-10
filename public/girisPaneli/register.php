<?php
  include '../oturumKontrol.php'; // bu include'u bi turlu calistiramadim her seyi denedim 

  var_dump($giris_yapilmis);

  if( $giris_yapilmis ){
    echo "yey";
  }else{
    echo "<script type='text/javascript'> document.location = './index.php'; </script>";
  die();
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

    <title>Eğit Kendini - Kayit ol</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body>

    <div class="container">

      <form class="stilOfSignAndRegister" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <h2 class="form-signin-heading">Kayit Ekrani</h2>
        <label for="inputAdi" class="sr-only">Ad</label>
        <input type="input" name="inputAdi" class="form-control" placeholder="Ad" required autofocus>
        <label for="inputSoyadi" class="sr-only">Soyadi</label>
        <input type="input" name="inputSoyadi" class="form-control" placeholder="Soyadi" required>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="inputEmail" class="form-control" placeholder="example@domain.com" maxlength=32 required autofocus>
        <label for="inputEmail" class="sr-only">Email kontrol</label>
        <input type="email" name="confirmEmail" class="form-control" placeholder="Email kontrol" maxlength=32 required >
        <label for="inputPassword" class="sr-only">Şifre</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Şifre" maxlength=12 required>
        <label for="inputPassword" class="sr-only">Şifre kontrol</label>
        <input type="password" name="confirmPassword" class="form-control" placeholder="Şifre kontrol" maxlength=12 required>
        <SELECT size= name=meslek width="33" class="form-control">
        	<OPTION selected>Mesleğinizi Seçin</OPTION>
        	<OPTION>Çalışmıyorum</OPTION>
        	<OPTION>Akademisyen, Öğretmen</OPTION>
        	<OPTION>Avukat</OPTION>
        	<OPTION>Bankacı</OPTION>
        	<OPTION>Bilgisayar, Internet</OPTION>
        	<OPTION>Danışman</OPTION>
        	<OPTION>Doktor</OPTION>
        	<OPTION>Emekli</OPTION>
        	<OPTION>Ev Hanımı</OPTION>
        	<OPTION>Finasman, Muhasebe</OPTION>
        	<OPTION>Fotoğrafçı</OPTION>
        	<OPTION>Gazeteci</OPTION>
        	<OPTION>Grafiker</OPTION>
        	<OPTION>Manken,Fotomodel</OPTION>
        	<OPTION>Memur</OPTION>
        	<OPTION>Mühendis</OPTION>
        	<OPTION>Öğrenci</OPTION>
        	<OPTION>Politikacı</OPTION>
        	<OPTION>Psikolog</OPTION>
        	<OPTION>Reklamcı</OPTION>
        	<OPTION>Sanatçı</OPTION>
        	<OPTION>Satış, Pazarlama</OPTION>
        	<OPTION>Serbest Meslek, İş Sahibi</OPTION>
        	<OPTION>Sporcu</OPTION>
        	<OPTION>Teknik Eleman</OPTION>
        	<OPTION>Üst Düzey Yönetici</OPTION>
        	<OPTION>Diğer</OPTION>
    	  </SELECT>
        <p class="form-control">
          Dogum tarihi:<input type="date" name="dogumTarihi" class="form-control" required>
        </p>

        <input type="tel" name="telNo" class="form-control" placeholder="xxx-xxx-xxxx" required>
        <textarea name="adres" class="form-control" cols="33" wrap="soft">Adres</textarea>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Kaydet</button>
        <a href="./index.php">Giriş Yap</a>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
