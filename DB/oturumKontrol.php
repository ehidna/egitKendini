<?php
  include 'pdox.class.php';
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
  # uye oturum degiskenleri
  $giris_yapilmis = false;
  $uye = false;
  try{
    $db = new PDOx($config);

    # kontrol ederek bilgileri dogrulayalim
    if( !empty($_SESSION["success"]) && !empty($_SESSION["email"]) ){
      $sorgu = $db->pdo->prepare("select sifre from uyeler where mail=?");
      $sorgu->bindParam(1, $_SESSION["email"]);
      $sorgu->execute();
      $uye = $sorgu->fetch(PDO::FETCH_ASSOC);
      # kulanici bilgisini alalim
        if(!empty($uye)){
          # anahtar kontrol
            if( $_SESSION["success"]  ==  md5( "oturum" . md5( $uye["sifre"] ) . "kontrol" ) ){
              $giris_yapilmis = true;
            }else{
              # giris yanlis. $uye'yi silelim
              $uye = false;
              session_regenerate_id(true);
            }
        }
    }
  }catch (PDOException $e) {
    echo 'Baglanti saglanamadi: ' . $e->getMessage();
  }

?>
