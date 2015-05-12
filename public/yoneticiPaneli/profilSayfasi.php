<?php
  session_start();
  include '../../DB/oturumKontrol.php';
  if( !$giris_yapilmis || $_SESSION["yetki"] == '3' ){
    header("Location: ../girisPaneli/index.php");
    die();
  }else{
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
    try{
      $db = new PDOx($config);
      if(!empty($_POST)){ // verilerin bos olup olmadigini kontrol ediyoruz
        $inputAdi = $_POST["inputAdi"];
        $inputSoyadi = $_POST["inputSoyadi"];
        $eskiSifre = md5(trim($_POST["eskiSifre"]));
        $yeniSifre = md5(trim($_POST["yeniSifre"]));
        $meslek = $_POST["meslek"];
        $dogumTarihi = $_POST["dogumTarihi"];
        $telNo = $_POST["telNo"];
        $adres = $_POST["adres"];

        $sifreSorgu = $db->from('uyeler')->where('mail', '=', $_SESSION['email'])->where('sifre','=' , $eskiSifre)->get();
        $checkSifre=$db->count();
        if( $checkSifre == 1 ){// sifre kontrolu
            // Veri tabanina girme islemleri yapiliyor.
            $sorgu = $db->pdo->prepare("UPDATE 'uyeler' SET ad=:ad1, soyad=:soyad1,
              sifre=:sifre1, meslekID=:meslekID1, dTarihi=:dTarihi1, telNo=:telNo1, adres=:adres1");
            $sorgu->bindParam(':ad1', $inputAdi);
            $sorgu->bindParam(':soyad1', $inputSoyadi);
            $sorgu->bindParam(':sifre1', $yeniSifre);
            $sorgu->bindParam(':meslekID1', $meslek);
            $sorgu->bindParam(':dTarihi1', $dogumTarihi);
            $sorgu->bindParam(':telNo1', $telNo);
            $sorgu->bindParam(':adres1', $adres);

            if( $sorgu->execute() == false){  // veri tabanina yollarken hata olustu
              echo '<script>alert("Hatali veri girdiniz!");history.back(-1);</script>';
              die();
            }else{
              // oturumu aciyoruz
              $_SESSION["success"] = md5( "oturum" . md5($yeniSifre) . "kontrol" );
              $_SESSION["kullaniciAdi"]  = $inputAdi;
              header("Location: ../girisPaneli/index.php");
              die();
            }
        }else{
          echo '<script>alert("Sifreyi yanlis girdiniz!");history.back(-1);</script>';
          die();
        }

      }
    }catch (PDOException $e) {
    echo 'Baglanti saglanamadi: ' . $e->getMessage();
    }
  }
?>
<!-- ÜST PANEL YAN PANEL BURADAN ALTI TÜM SAYFALARDA AYNI OLACAK -->
<!-- ÜST PANEL YAN PANEL BURADAN ALTI TÜM SAYFALARDA AYNI OLACAK -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Eğit Kendini | Yönetim Paneli</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.html" class="logo"><b>Eğit</b>Kendini</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?=$_SESSION["kullaniciAdi"] ?></span><!-- AD SOYAD VERİTABANINDAN GETİR-->
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      <?=$_SESSION["kullaniciAdi"] ?> - Meslek
                      <small>kayıt tarihi</small>
					  <!-- TERİTABANINDAN TÜM KULLANICI BİLGİLERİNİ ÇEK AD SOYAD MESLEK KAYIT TAR. -->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="derslerListe.php.php">Dersler</a>
                    </div>

                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="profilSayfasi.php" class="btn btn-default btn-flat">Profil</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Çıkış Yap</a> <!-- SESSION ÖLDÜR İŞLEMİ-->
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?=$_SESSION["kullaniciAdi"] ?></p><!-- VERITABANINDAN AD SOYAD GETİR -->

              <a href="#"><i class="fa fa-circle text-success"></i> Açık </a><!-- BURADA SESSION KONTROLU YAPILACAK -->
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">YÖNETİM PANELİ</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Yönetici Sayfası</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="index.php"><i class="fa fa-circle-o"></i>Yönetici Anasayfa</a></li>
              </ul>
            </li>

			<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>Dersler</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
				<!-- VERITABANINDAN DERSLER GETİR-->
                  <a href="#"><i class="fa fa-circle-o"></i> Ders1 <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="dersKonuAnlatimi.php"><i class="fa fa-circle-o"></i> Konu Anlatımı</a></li><!-- DERSİN KONU ANLATIMINA YÖNLENDİR GETİR-->
					<li><a href="dersSinav.php"><i class="fa fa-circle-o"></i> Sınav</a></li><!-- DERSİN SINAVINA YÖNLENDİR GETİR-->

                  </ul>
                </li>
				 <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Ders2 <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="dersKonuAnlatimi.php"><i class="fa fa-circle-o"></i> Konu Anlatımı</a></li>
					<li><a href="dersSinav.php"><i class="fa fa-circle-o"></i> Sınav</a></li>

                  </ul>
                </li>

              </ul>
            </li>

            <li>
              <a href="kullanicilar.php">
                <i class="fa fa-th"></i> <span>Kullanıcıları Düzenle</span> <!-- YÖNETİCİYE ÖZEL BURADAKİ SAYFADA KULLANICI LİSTELE-->
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>İstatistikler</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"><!-- İSTATİSTİKLERE YÖNLENDİR GETİR-->
                <li><a href="istatistiklerDers.php"><i class="fa fa-circle-o"></i> Kullanıcı İstatistikleri</a></li>
                <li><a href="istatistiklerKullanici.php"><i class="fa fa-circle-o"></i> Ders İstatistikleri</a></li>
              </ul>
            </li>

            <li><a href="siteHakkinda.html"><i class="fa fa-book"></i> Site Hakkında</a></li><!-- STATIK HTML SAYFASINA YÖNLENDIR-->

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>



	  <!-- ÜST PANEL YAN PANEL BURADAN ÜSTÜ TÜM SAYFALARDA AYNI OLACAK -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Kullanıcı Paneli
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Profil Düzenle</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">








<form id="guncelle" name="guncelle" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
  <table class="table table-striped" >
    <tbody>
      <tr>
        <td width="160"><div>
          <p>foto burada </p>
          <p>
            <input type="button" name="button" id="button" value="Foto Upload">
          </p>
        </div>
          <div>
            <div></div>
            <div>
              <div> </div>
            </div>
          </div>
          <div> </div>
          <div> </div>
          <div>
            <div> </div>
          </div>
          <h2>AD SOYAD          </h2></td>
        <td width="400">
          <div>
            <div>
              <div>
                <label>Ad:</label>
                <div>
                  <input type="text" name="inputAdi" >
                </div>
              </div>
            </div>
            <div>
              <div>
                <label>Soyad:</label>
                <div>
                  <input type="text" name="inputSoyadi" >
                </div>
              </div>
            </div>

            <div>
              <div>
                <label>Meslek:</label>
                <div>
                  <SELECT  name="meslek">
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
                  </SELECT>                </div>
              </div>
            </div>
            <div>
              <div>
                <label>Adres:</label>
                <div>
                  <textarea style="resize:none" name="adres" wrap="soft" placeholder="Adres" ></textarea>
                </div>
              </div>
            </div>
            <div>
              <div>
                <label>Telefon:</label>
                <div>
                  <input type="tel" name="telNo" id="telId" placeholder="(536) 555-1212"  required>
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
                  </script>                </div>
              </div>
            </div>
            <div>
              <div>
                <label>Eski sifre:</label>
                <div>
				  <input type="password" name="eskiSifre" >
                </div>
              </div>
            </div>
            <div>
              <div>
                <label>Yeni sifre:</label>
                <div>
				  <input type="password" name="yeniSifre" >
                </div>
              </div>
            </div>
            <div>
              <div>
                <label>Doğum Tarihi:</label>
                <div>
                  <input type="date" name="dogumTarihi" >
                </div>
              </div>
            </div>
        </div></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" id="submit" value="Kaydet"></td>
      </tr>
    </tbody>
  </table>
  <p></p>
</form>


            </div><!-- /.box-body -->

          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

	  <!-- FOOTER KISMI BURADAN ALTI TÜM SAYFALARDA SABİT OLACAK -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Sürüm</b> 0.0.0.1
        </div>
        <strong>Eğit Kendini</strong> Copyright &copy; 2015
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
