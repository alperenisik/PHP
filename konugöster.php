<?php
session_start();
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

    $v=$db->prepare("select * from konular inner join kategoriler on kategoriler.kategori_id = konular.konu_kategori order by konular.id desc limit 20");
    $v->execute(array());
    $c=$v->fetchAll(PDO::FETCH_ASSOC);
    $x=$v->rowCount();

 ?>

<h2>Son Konular</h2>
<div>
<table>
  <thead>
    <tr>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> Başlık </th>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> Kategori </th>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> Ekleyen </th>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> Eklenme Tarihi </th>
      <th style="border: 1px solid #ddd; padding:5px; font-size:20px;"> İşlemler </th>
    </tr>
  </thead>
  <?php
    if($x){
      foreach ($c as $m) {
        ?>
        <tbody>
          <tr>
            <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_adi"]; ?></td>
            <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["adi"]; ?></td>
            <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_ekleyen"]; ?></td>
            <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_tarih"]; ?></td>
            <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;">
            <a href="?selection=düzenle&idduzenle=<?php echo $m["id"] ?>">Düzenle</a>  / <a onclick="return confirm('Konuyu Silmek İstediğine Emin Misin ?');" href="?selection=sil&idsil=<?php echo $m["id"] ?>">Sil</a>
            </td>
          </tr>
        </tbody>
        <?php
      }

    }else {
      echo "Konu Bulunamadı...";
    }
}
   ?>
</table>
</div>
