<?php 
    require '../config.php';
    
    if (isset($_POST['tambah'])) {
          $kapasitas = $_POST['kapasitas'];
          $jml_ayam = $_POST['jml_ayam'];
          $sql = "INSERT INTO kandang (kapasitas,jml_ayam)VALUES('$kapasitas','$jml_ayam')";
          if (mysqli_query($koneksi, $sql)) {
            $id = mysqli_insert_id($koneksi);
          }else {
            echo "Error: ". mysqli_error($koneksi);
          }
          exit();
      }
    if (isset($_POST['ubah'])) {
          $kapasitas = $_POST['kapasitas'];
          $jml_ayam = $_POST['jml_ayam'];
          $sql = "UPDATE kandang   
          SET kapasitas='$kapasitas',   
          jml_ayam='$jml_ayam' WHERE id_kandang = '".$_POST["id_kandang"]."'";
          if (mysqli_query($koneksi, $sql)) {
            $id = mysqli_insert_id($koneksi);
          }else {
            echo "Error: ". mysqli_error($koneksi);
          }
          exit();
      }
    if (isset($_POST['hapus'])) {
          $sql = "DELETE FROM kandang WHERE id_kandang = '".$_POST["hapus_id"]."'";
          if (mysqli_query($koneksi, $sql)) {
            $id = mysqli_insert_id($koneksi);
          }else {
            echo "Error: ". mysqli_error($koneksi);
          }
          exit();
      }
    if (isset($_POST['id_kandang'])) {
        $query = "SELECT * FROM kandang WHERE id_kandang = '".$_POST["id_kandang"]."'";  
        $result = mysqli_query($koneksi, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row); 
      }

    // $kapasitas = $_POST['kapasitas'];
    // $jml_ayam = $_POST['jml_ayam'];
    // $query = "INSERT INTO kandang (kapasitas,jml_ayam)
    // VALUES('$kapasitas','$jml_ayam')";
    // $tambah = mysqli_query($koneksi, $query);
    // if($tambah){
    //     echo "
    //         <script>
    //         alert('Data Kandang Berhasil Ditambahkan!');
    //         </script>
    // ";
    // }else{
    //     echo "
    //         <script>
    //         alert('Gagal Menyimpan Data!');
    //         </script>
    // ";
    // }
 ?>