<?php

if ($_POST) {

  $Name=$_POST["Name"];
  $Password=$_POST["Password"];


  $dbhost = 'localhost';
  $dbname = 'name';
  $dbuser = 'root';
  $dbpass = '';

  try {
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8",
    $dbuser, $dbpass);
  } catch (PDOException $e) {
    echo 'Bağlantı kurulamadı';
  }

  $y= $db->prepare("select * from uyeler where uye_ad=? and uye_parola=?");
  $y->execute(array($Name,$Password));

  $a= $y->fetch(PDO::FETCH_ASSOC);
  $b= $y->rowCount();

  if ($b)
  {
    $_SESSION["admin"] = $a["uye_ad"];
    echo "Hoşgeldin:  ";
    echo $a["uye_ad"];
    header("location:adminpanel.php");
  }

  else
  {
    echo "Hatalı Kullanıcı Adı veya Şifre Girdiniz...";
  }

}

 ?>
