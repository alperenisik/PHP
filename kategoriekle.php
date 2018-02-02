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

if ($_POST)
{
    $ekle=$_POST["adi"];
    $insert=$db->prepare("INSERT INTO `kategoriler` (`adi`, `aktiflik`) VALUES ('$ekle', '1')");
    $ok=$insert->execute(array($ekle));

    if ($ok)
    {
      echo "Kategori Başarıyla Eklendi.";
    }
    else
    {
      echo "Kategori Eklenemedi...";
    }

}

else
{
  ?>
<form action="" method="post">
<table cellpadding="5" cellspacing="5">
  <tr>
    <td>Kategori Adı</td>
  </tr>
  <tr>
    <td> <input type="text" name="adi" required placeholder="Kategori Adı"> </td>
  </tr>
  <tr>
    <td> <input type="submit"  value="Kategoriyi Ekle"> </td>
  </tr>
</table>
</form>

<?php }

}
else {
  echo "Burada Yetkin Yok";
}
?>
