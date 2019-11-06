<?php 
  include 'config.php';
  $tampil = mysqli_query($koneksi, "SELECT * FROM petugas");
 ?>
<div class="container-fluid mt--7">
  <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <h3 class="mb-0">Data Petugas</h3>
        </div>
        <div class="table-responsive">
        <a href="#addModal" data-toggle="modal" class="btn btn-primary">Tambah Petugas</a>
          <table id="dataPeternakan"class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Username</th>
                <th scope="col">No. Hp</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                while($data = mysqli_fetch_array($tampil)){
                  $id = $data['id_petugas'];
               ?>
              <tr>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['no_hp']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td>
                  <a href="#editModal<?php echo $id; ?>" class="edit" data-toggle="modal"><i class="fa fa-edit" aria-hidden="true"></i></a>
                  <a href="#deleteModal<?php echo $id; ?>" class="delete" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
                  <!-- Edit Modal HTML -->
                  <div id="editModal<?php echo $id; ?>" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="post">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Petugas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                            <div class="form-group">
                              <label>Nama Petugas</label>
                              <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required autofocus>
                            </div>
                            <div class="form-group">
                              <label>No. HP</label>
                              <input type="text" name="nope" class="form-control" value="<?php echo $data['no_hp']; ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <textarea type="text" name="alamat" class="form-control" required><?php echo $data['alamat']; ?></textarea>
                            </div>
                            <div class="form-group">
                              <label>Username</label>
                              <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" name="password" class="form-control" value="<?php echo $data['password']; ?>" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Kembali">
                            <input type="submit" name="ubah" class="btn btn-info" value="Simpan">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- Delete Modal HTML -->
                  <div id="deleteModal<?php echo $id; ?>" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="post">
                          <div class="modal-header">
                            <h4 class="modal-title">Hapus Petugas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="hapus_id" value="<?php echo $id; ?>">
                            <p>Kamu yakin ingin menghapus petugas dengan ID = <?php echo $id; ?>?</p>
                            <p class="text-warning"><small>Ini akan menghapus data petugas.</small></p>
                          </div>
                          <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Kembali">
                            <input type="submit" name="hapus" class="btn btn-danger" value="Hapus">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Add Modal HTML -->
<div id="addModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Petugas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Petugas</label>
            <input type="text" name="nama" class="form-control" required autofocus>
          </div>
          <div class="form-group">
            <label>No. HP</label>
            <input type="text" name="nope" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea type="text" name="alamat" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Kembali">
          <input type="submit" name="tambah" class="btn btn-success" value="Tambah">
        </div>
      </form>
    </div>
  </div>
</div>
<?php 
// Tambah Barang
  if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $nope = $_POST['nope'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    

    $query = "INSERT INTO petugas (nama,no_hp,alamat,username,password)
              VALUES('$nama','$nope','$alamat','$username','$pass')";
    $tambah = mysqli_query($koneksi,$query);

    if($tambah){
      echo '<script>window.location.href="index.php"</script>';
    }else{
      echo "<script>alert('Gagal Menyimpan Data!'); 
            document.location.href = 'index.php';</script>";
    }
  }
  // Ubah Barang
  if(isset($_POST['ubah'])){
    $edit_id = $_POST['edit_id'];
    $nama = $_POST['nama'];
    $nope = $_POST['nope'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $query = "UPDATE petugas SET
              nama = '$nama',
              no_hp = '$nope',
              alamat = '$alamat',
              username = '$username',
              password = '$pass' WHERE id_petugas = '$edit_id'";
    $ubah = mysqli_query($koneksi,$query);

    if($ubah){
      echo '<script>window.location.href="index.php"</script>';
    }else{
      echo "<script>alert('Gagal Menyimpan Data!'); 
            document.location.href = 'index.php';</script>";
    }
  }

  // Hapus Barang
  if(isset($_POST['hapus'])){
    $hapus_id = $_POST['hapus_id'];

    $query = "DELETE FROM petugas WHERE id_petugas = '$hapus_id'";
    $hapus = mysqli_query($koneksi,$query);

    if($hapus){
      echo '<script>window.location.href="index.php"</script>';
    }else{
      echo "<script>alert('Gagal Menyimpan Data!'); 
            document.location.href = 'index.php';</script>";
    }
  }
 ?>