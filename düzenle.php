<?php   
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
	?>
