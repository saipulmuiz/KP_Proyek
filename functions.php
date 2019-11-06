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

        // Query insert data
        $query = "INSERT INTO petugas (nama,no_hp,alamat,username,password)
        VALUES('$nama','$nope','$alamat','$username','$pass')";
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
        $query = "UPDATE petugas SET
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
        mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas = $hapus_id");
    
        return mysqli_affected_rows($koneksi);
    }
 ?>