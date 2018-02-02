
<?php
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
?>
