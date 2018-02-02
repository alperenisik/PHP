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

?>

<?php

session_start();
if($_SESSION)
{

if($_POST){

    session_start();
    $baslik=$_POST["baslik"];
    $kategori=$_POST["kategori"];
    $aciklama=$_POST["aciklama"];

    $baslikkontrol=$db->prepare("select * from konular where konu_adi=?");
    $baslikkontrol->execute(array($baslik));
    $baslikkontrol2=$baslikkontrol->fetch(PDO::FETCH_ASSOC);
    $bk=$baslikkontrol->rowCount();

    if ($bk) {
      echo "Bu Konu Adı Zaten Var...";
    }else {

      $insert=$db->prepare("INSERT INTO konular SET konu_adi=?, konu_kategori=?, konu_aciklama=?, konu_ekleyen=?");
      $kayit=$insert->execute(array($baslik,$kategori,$aciklama,$_SESSION["admin"]));

      if ($kayit) {
        echo "Başarıyla Eklendi";
      }
      else {
        echo "Üzgünüm Bir Hata Oluştu...";
      }
    }


}
else {

  $v=$db->prepare("select * from kategoriler");
  $v->execute(array());
  $c=$v->fetchAll(PDO::FETCH_ASSOC);

  ?>

  <h2>Konu Ekle</h2>
  <form action="" method="post">
    <ul style="list-style:none;">
      <li>Konu Başlığı</li>
      <li> <input type="text" name="baslik" placeholder="Name" required> </li>
      <li>
        <br>
        <p>Konu Kategorisi</p>
        <select  name="kategori">
          <?php foreach ($c as $m) {
            echo '<option value="'.$m["kategori_id"].'">'.$m["adi"].'</option>';
          } ?>
        </select>
      </li> <br>
      <li>Konu Açıklaması</li>
      <li> <textarea name="aciklama" rows="20" cols="80" required ></textarea> </li>
      <li> <button type="submit">Konu Ekle</button> </li>
    </ul>
  </form>


<?php } 
}
?>
