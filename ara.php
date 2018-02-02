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

<form class="" action="" method="post">
  <input type="text" name="arama" placeholder="Arama..."> <input type="submit" value="ara">
</form>

<?php
if ($_POST) {
  $arama=$_POST["arama"];

  $ara1=$db->prepare("SELECT * FROM konular WHERE konu_adi LIKE ?");
  $ara1->execute(array('%'.$arama.'%'));
  $ara2=$ara1->fetchAll(PDO::FETCH_ASSOC);
  $ara3=$ara1->rowCount();

?>
<div>
<table>
  <thead>
    <tr>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> Başlık </th>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> Ekleyen </th>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> Eklenme Tarihi </th>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> İşlemler </th>
    </tr>
  </thead>
<?php
  foreach($ara2 as $m)
  {
    ?>
            <tbody>
              <tr>
                <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_adi"]; ?></td>
                <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_ekleyen"]; ?></td>
                <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_tarih"]; ?></td>
                <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;">
                <a href="?selection=düzenle&idduzenle=<?php echo $m["id"] ?>">Düzenle</a>  /
                <a onclick="return confirm('Konuyu Silmek İstediğine Emin Misin ?');" href="?selection=sil&idsil=<?php echo $m["id"] ?>">Sil</a>
                </td>
              </tr>
            </tbody>
            <?php
          }
       ?>
    </table>
    </div>

<?php
  }
 ?>
