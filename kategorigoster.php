
<ul>

<?php

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

session_start();
if($_SESSION)
{

$v=$db->prepare("select * from kategoriler");
$v->execute(array());
$c=$v->fetchAll(PDO::FETCH_ASSOC);
$x=$v->rowCount();

if ($x)
{
  foreach ($c as $m)
  {
    echo '<li style="list-style:none;">'.$m["adi"].'</li>';
  }
}
else
{
  echo "Kategori Bulunamadı...";
}

}
 ?>


</ul>
