<?php

  class Baglanti {

    private static $instance;
    private $DB;

    public function __construct($dbServer, $dbAdi, $dbKullanici, $dbSifre){
      try{
        $db = new PDO("mysql:host={$dbServer};dbname={$dbAdi}",$dbKullanici,$dbSifre);
        $db->exec("SET NAMES utf8");
        $this->DB = $db;
      }catch(PDOException $e){
        print $e->getMessage();
      }
    }

    public static function Baglan($dbServer, $dbAdi, $dbKullanici, $dbSifre){
      if (!self::$instance){
            self::$instance = new Baglanti($dbServer,$dbAdi,$dbKullanici,$dbSifre);
      }
      return self::$instance;
    }

    public function baglantiyiSonlandir(){
      $this->DB = null;
    }

  }
?>
