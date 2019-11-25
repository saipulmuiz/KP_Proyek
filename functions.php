<?php 
    include 'config.php';
   
    function query($query){
        global $koneksi;
        $hasil = mysqli_query($koneksi, $query);
        $rows = [];
        while ($row = mysqli_fetch_array($hasil)){
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah_petugas($data){
        global $koneksi;
        $nama = htmlspecialchars($data['nama']);
        $nope = htmlspecialchars($data['nope']);
        $alamat = htmlspecialchars($data['alamat']);
        $username = strtolower(stripslashes($data['username']));
        $pass = md5($data['password']);

        // Upload Foto
        $foto = upload();
        if(!$foto){
            return false;
        }

        // Query insert data
        $query = "INSERT INTO tbl_petugas (nama,no_hp,alamat,username,password,foto)
        VALUES('$nama','$nope','$alamat','$username','$pass','$foto')";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }

    function ubah_petugas($data){
        global $koneksi;
        $edit_id = $data['edit_id'];
        $nama = htmlspecialchars($data['nama']);
        $nope = htmlspecialchars($data['nope']);
        $alamat = htmlspecialchars($data['alamat']);
        $username = strtolower(stripslashes($data['username']));
        
        //query update data
        $query = "UPDATE tbl_petugas SET
              nama = '$nama',
              no_hp = '$nope',
              alamat = '$alamat',
              username = '$username' WHERE id_petugas = '$edit_id'";
        mysqli_query($koneksi, $query);
    
        return mysqli_affected_rows($koneksi);
    }

    function hapus_petugas($data){
        global $koneksi;
        $hapus_id = $data['hapus_id'];
        mysqli_query($koneksi, "DELETE FROM tbl_petugas WHERE id_petugas = $hapus_id");
    
        return mysqli_affected_rows($koneksi);
    }

    function upload(){
        $namaFoto = $_FILES['foto']['name'];
        $errorFoto = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];
        $ektensiFoto = explode('.',$namaFoto);
        $ektensiFoto = end($ektensiFoto);
        $fotoBaru = uniqid(5);
        $fotoBaru .= ".".$ektensiFoto;

        if($errorFoto == 0){
            $gambar = $fotoBaru;
            move_uploaded_file($tmpName,'uploads/'.$gambar);

        } elseif ($errorFoto == 4) {
            $gambar = "default.png";
        }
        return $gambar;
        }

        function tambah_kandang($data){
            global $koneksi;
            $kapasitas = htmlspecialchars($data['kapasitas']);
            $jml_ayam = htmlspecialchars($data['jml_ayam']);
    
            // Query insert data
            $query = "INSERT INTO tbl_kandang (kapasitas,jml_ayam)
            VALUES('$kapasitas','$jml_ayam')";
            mysqli_query($koneksi, $query);
    
            return mysqli_affected_rows($koneksi);
        }
 ?>