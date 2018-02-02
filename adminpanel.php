<!DOCTYPE html>
<html>
  <head>
    <title>Admin Paneli</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">
  </head>
  <body>

<style>

html{
  background-color: black;
}

.yetkisiz{
  padding-left: 800px;
  padding-top: 300px;
}

.header{
  background-color: black;
  opacity: 0.7;
  font-size: 30px;
  padding-top: 20px;
  padding-bottom: 15px;
  padding-left: 10px;
  font-family: 'Josefin Slab', serif;
}

.menu{
  border: 1px solid #ddd;
  width: 300px;
  height: 800px;
  float: left;
  background-color: white;
}

.menu ul{
  list-style: none;
  margin-top: 20px;
}

.menu ul li{
  border: 1px solid #ddd;
  margin: 2px;
  padding: 10px;
  font-size: 20px;
}

.content{
  border: 1px solid #ddd;
  float: left;
  position: relative;
  width: 1500px;
  height: 800px;
  background-color: white;
}

</style>

  </body>
</html>

<?php
session_start();
if($_SESSION)
{
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

  <div class="header">
    <img src="" alt="LOGO">
    <br>
  <?php
  echo "Admin Paneline Hoşgeldin ";
  echo $_SESSION["admin"];
  ?>

</div>

  <div class="main">
    <div class="menu">
        <ul>
          <li><a href="?selection=kategoriekle">Kategori Ekle  </a></li>
          <li><a href="?selection=kategorigöster">Kategorileri Göster  </a></li>
          <li><a href="?selection=konuekle">Konu Ekle  </a></li>
          <li><a href="?selection=konugöster">Konuları Lİstele  </a></li>
          <li><a href="?selection=konuara">Konu Ara</a></li>
          <li><a href="xyz.php" target="_blank">XYZ Sayfasını Görüntüle </a></li>
          <li><a href="exit.php">ÇIKIŞ</a></li>
        </ul>
    </div>
    <div class="content">
      <?php
      $selection=$_GET["selection"];

      switch ($selection)
      {
        case "kategoriekle":
       
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
        break;

        case "kategorigöster":
 
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

        break;

        case "konuekle":
	
	if($_POST)
	{
	    $baslik=$_POST["baslik"];
	    $kategori=$_POST["kategori"];
	    $aciklama=$_POST["aciklama"];
	    $baslikkontrol=$db->prepare("select * from konular where konu_adi=?");
	    $baslikkontrol->execute(array($baslik));
	    $baslikkontrol2=$baslikkontrol->fetch(PDO::FETCH_ASSOC);
	    $bk=$baslikkontrol->rowCount();
	   
	 if ($bk) {
	      echo "Bu Konu Adı Zaten Var...";
	    }
	else {
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
        break;

        case "konugöster":
        
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
	    if($x)
	{
	      foreach ($c as $m)
	    {
		?>
		
		<tbody>
		  <tr>
		    <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_adi"]; ?></td>
		    <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["adi"]; ?></td>
		    <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_ekleyen"]; ?></td>
		    <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;"><?php echo $m["konu_tarih"]; ?></td>
		    <td style="width:300px; border: 1px solid #eee; padding:5px; font-size:15px;">
		    <a href="?selection=düzenle&idduzenle=<?php echo $m["id"] ?>">Düzenle</a>  / <a onclick="return confirm('Konuyu Silmek İstediğine Emin 	Misin ?');" href="?selection=sil&idsil=<?php echo $m["id"] ?>">Sil</a>
		    </td>
		  </tr>
		</tbody>
		
   <?php
	    }
	 }

	else {
	      echo "Konu Bulunamadı...";
	     }

        break;

        case "konuara":

	?>

	<form class="" action="" method="post">
	  <input type="text" name="arama" placeholder="Arama..."> <input type="submit" value="ara">
	</form>

	<?php
	if ($_POST) 
	{
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
        break;

        case "düzenle":
        $idduzenle=$_GET["idduzenle"];
        if($_POST){

            $baslik=$_POST["baslik"];
            $kategori=$_POST["kategori"];
            $aciklama=$_POST["aciklama"];

              $update=$db->prepare("UPDATE konular SET konu_adi=?, konu_kategori=?, konu_aciklama=? where id=? ");
              $guncelle=$update->execute(array($baslik,$kategori,$aciklama,$idduzenle));

              if ($guncelle) {
                echo "Başarıyla Güncellendi";
              }
              else {
                echo "Üzgünüm Bir Hata Oluştu...";
              }



        }
        else {

          $v=$db->prepare("select * from kategoriler");
          $v->execute(array());
          $c=$v->fetchAll(PDO::FETCH_ASSOC);


          $baslikkontrol=$db->prepare("select * from konular where id=?");
          $baslikkontrol->execute(array($idduzenle));
          $baslikkontrol2=$baslikkontrol->fetch(PDO::FETCH_ASSOC);
          $bk=$baslikkontrol->rowCount();

          ?>

          <h2>Konu Düzenle</h2>
          <form action="" method="post">
            <ul style="list-style:none;">
              <li>Konu Başlığı</li>
              <li> <input type="text" name="baslik" value="<?php echo $baslikkontrol2["konu_adi"]; ?>" required> </li>
              <li>
                <br>
                <select  name="kategori">
                  <?php foreach ($c as $m) {
                    echo '<option value="'.$m["kategori_id"].'"'; echo $m["kategori_id"] == $baslikkontrol2["konu_kategori"] ? 'selected' : null;  echo'>'.$m["adi"].'</option>';
                  } ?>
                </select>
              </li> <br>
              <li>Konu Açıklaması</li>
              <li> <textarea name="aciklama" rows="20" cols="80" required > <?php echo $baslikkontrol2["konu_aciklama"]; ?> </textarea> </li>
              <li> <button type="submit" onclick="return confirm('Değişiklikleri Kaydetmek İstiyor Musun ?');">Konu Düzenle</button> </li>
            </ul>
          </form>


        <?php }
        break;

        case "sil":

        $idsil=$_GET["idsil"];
        $delete=$db->prepare("DELETE FROM konular WHERE id=?");
        $sil=$delete->execute(array($idsil));
        $sil2=$delete->rowCount();

        if ($sil2) {

          if ($sil) {
              echo "Silme işlemi başarılı...";
          }else {
              echo "Üzgünüm Bir Hata Oluştu...";
          }

        }else {
          echo "Üzgünüm Böyle Bir Konu Bulunamadı...";
        }
        break;

        default:
        echo "<h2 style='margin-top:100px; padding-left:500px;'> Admin Paneline Hoşgeldin </h2>";
        break;
      }
       ?>
    </div>
  </div>

  <?php
}

else {
?>
<body style="background-color: black">
  <div class="yetkisiz" style="color:red;">
     <span class="glyphicon glyphicon-remove" style="font-size:200px; padding-left: 70px;"></span>
    <h1>PAGE NOT FOUND!</h1>
  </div>
</body>

<?php } ?>
