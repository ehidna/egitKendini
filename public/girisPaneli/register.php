<?php
  include '../../DB/oturumKontrol.php';
  if( !$giris_yapilmis ){
    include './pdox.class.php';
    $config = array(
     'user'		=> 'root',
     'pass'		=> 'root',
     'dbname'	=> 'egitkendini',
     'host'		=> 'localhost',
     'type'		=> 'mysql',
     'charset'	=> 'utf8',
     'prefix'	=> ''
    );
    session_start();

    $inputAdi = $_POST["inputAdi"];
    $inputSoyadi = $_POST["inputSoyadi"];
    $inputEmail = $_POST["inputEmail"];
    $confirmEmail = $_POST["confirmEmail"];
    $inputSifre = md5($_POST["inputSifre"]);
    $confirmSifre = md5($_POST["confirmSifre"]);
    $meslek = $_POST["meslek"];
    $dogumTarihi = $_POST["dogumTarihi"];
    $telNo = $_POST["telNo"];
    $adres = $_POST["adres"];
    try{
      $db = new PDOx($config);
      if(!empty($_POST)){ // verilerin bos olup olmadigini kontrol ediyoruz

        if( $inputEmail == $confirmEmail  && !empty($inputEmail) ){// email kontrolu
          $emailSorgu = $db->select('mail')->from('uyeler')->where('mail','=' , $inputEmail)->get();
          $checkEmail=$db->count();
          if( $checkEmail != 1 ){// email onceden kullanilmismi kontrolu
            if( $inputSifre == $confirmSifre  && !empty($inputSifre) ){// sifre kontrolu
                // Veri tabanina girme islemleri yapiliyor.
                $sorgu = $db->pdo->prepare("INSERT INTO uyeler (ad, soyad, mail,
                      sifre, meslekID, dTarihi, telNo, adres)
                      VALUES(:ad, :soyad, :mail, :sifre, :meslekID, :dTarihi, :telNo, :adres)");
                $sorgu->bindParam(':ad', $inputAdi);
                $sorgu->bindParam(':soyad', $inputSoyadi);
                $sorgu->bindParam(':mail', $inputEmail);
                $sorgu->bindParam(':sifre', $inputSifre);
                $sorgu->bindParam(':meslekID', $meslek);
                $sorgu->bindParam(':dTarihi', $dogumTarihi);
                $sorgu->bindParam(':telNo', $telNo);
                $sorgu->bindParam(':adres', $adres);

                if( $sorgu->execute() == false){  // veri tabanina yollarken hata olustu
                  echo '<script>alert("Hatali veri girdiniz!");history.back(-1);</script>';
                  die();
                }else{
                  // oturumu aciyoruz
                  $_SESSION["success"] = md5( "oturum" . md5($inputSifre) . "kontrol" );
                  $_SESSION["email"]  = $inputEmail;
                  header("Location: ./index.php");
                  die();
                }
            }else{
              echo '<script>alert("Sifre eslesmedi!");history.back(-1);</script>';
              die();
            }
          }else{
            echo '<script>alert("Email onceden kullanilmis!");history.back(-1);</script>';
            die();
          }
        }else{
          echo '<script>alert("Email eslesmedi!");history.back(-1);</script>';
          die();
        }
      }
      $db=null;
    }catch (PDOException $e) {
      echo 'Baglanti saglanamadi: ' . $e->getMessage();
    }
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
        <label for="inputAdi" class="sr-only">Adi</label>
        <input type="input" name="inputAdi" class="form-control" placeholder="Adi" required autofocus>
        <label for="inputSoyadi" class="sr-only">Soyadi</label>
        <input type="input" name="inputSoyadi" class="form-control" placeholder="Soyadi" required>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="inputEmail" class="form-control" placeholder="example@domain.com" maxlength=32 required autofocus>
        <label for="inputEmail" class="sr-only">Email kontrol</label>
        <input type="email" name="confirmEmail" class="form-control" placeholder="Email kontrol" maxlength=32 required >
        <label for="inputPassword" class="sr-only">Şifre</label>
        <input type="password" name="inputSifre" class="form-control" placeholder="Şifre" maxlength=12 required>
        <label for="inputPassword" class="sr-only">Şifre kontrol</label>
        <input type="password" name="confirmSifre" class="form-control" placeholder="Şifre kontrol" maxlength=12 required>
        <SELECT  name="meslek" width="33" class="form-control">
        	<OPTION selected value=0>Mesleğinizi Seçin</OPTION>
        	<OPTION value=1>Çalışmıyorum</OPTION>
        	<OPTION value=2>Akademisyen, Öğretmen</OPTION>
        	<OPTION value=3>Avukat</OPTION>
        	<OPTION value=4>Bankacı</OPTION>
        	<OPTION value=5>Bilgisayar, Internet</OPTION>
        	<OPTION value=6>Danışman</OPTION>
        	<OPTION value=7>Doktor</OPTION>
        	<OPTION value=8>Emekli</OPTION>
        	<OPTION value=9>Ev Hanımı</OPTION>
        	<OPTION value=10>Finasman, Muhasebe</OPTION>
        	<OPTION value=11>Fotoğrafçı</OPTION>
        	<OPTION value=12>Gazeteci</OPTION>
        	<OPTION value=13>Grafiker</OPTION>
        	<OPTION value=14>Manken,Fotomodel</OPTION>
        	<OPTION value=15>Memur</OPTION>
        	<OPTION value=16>Mühendis</OPTION>
        	<OPTION value=17>Öğrenci</OPTION>
        	<OPTION value=18>Politikacı</OPTION>
        	<OPTION value=19>Psikolog</OPTION>
        	<OPTION value=20>Reklamcı</OPTION>
        	<OPTION value=21>Sanatçı</OPTION>
        	<OPTION value=22>Satış, Pazarlama</OPTION>
        	<OPTION value=23>Serbest Meslek, İş Sahibi</OPTION>
        	<OPTION value=24>Sporcu</OPTION>
        	<OPTION value=25>Teknik Eleman</OPTION>
        	<OPTION value=26>Üst Düzey Yönetici</OPTION>
        	<OPTION value=27>Diğer</OPTION>
    	  </SELECT>
        <p class="form-control">
          Dogum tarihi:<input type="date" name="dogumTarihi" class="form-control" required>
        </p>
        <input type="tel" name="telNo" id="telId"  class="form-control" placeholder="(536) 555-1212"  required>
        <script>
          document.getElementById("telId").onkeypress = function(e){
            var keycodes = new Array(0,48,49,50,51,52,53,54,55,56,57);
            var was = false;
            for(x in keycodes){
              if(keycodes[x] == e.charCode){
                was = true;
                break;
              }else{
                was = false;
              };
            };
            var val = this.value;
            if(was === true){
              switch(val.length){
                case 3:
                  if(e.charCode !== 0){
                    this.value += "-";
                  }
                  break;
                case 7:
                  if(e.charCode !== 0){
                    this.value += "-";
                  }
                  break;
                default:
                  if(val.length > 11 && e.charCode !== 0){return false;};
                  break;
              };
                  val += e.charCode;
            }else{
              return false;
            };
          };
        </script>
        <textarea name="adres" class="form-control" cols="33" wrap="soft" placeholder="Adres"></textarea>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Kaydet</button>
        <a href="./index.php">Giriş Yap</a>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
