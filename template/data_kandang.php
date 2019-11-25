<?php 
  include 'config.php';
  require 'functions.php';
  
 ?>
<div class="container-fluid mt--7">
  <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <h3 class="mb-0">Data Kandang</h3>
        </div>
        <div class="table-responsive">
        <a href="#addModal" data-toggle="modal" id="tbh" class="btn btn-primary">Tambah Kandang</a>
        <!-- <button onclick="LoadData();" class="btn btn-primary" id="loaddata">Load Data</button> -->
          <table id="dataKandang"class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Id Kandang</th>
                <th scope="col">Kapasitas</th>
                <th scope="col">Jumlah Ayam</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody id="tampil_kandang"">
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
      <form method="post" class="form_kandang" id="form_kandang">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Kandang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Kapasitas</label>
            <input type="hidden" name="tambah" value="1">
            <input type="text" name="kapasitas" id="kapasitas" class="form-control" required autofocus>
          </div>
          <div class="form-group">
            <label>Jumlah Ayam</label>
            <input type="text" name="jml_ayam" id="jml_ayam" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Kembali">
          <button class="btn btn-success tambah" data-dismiss="modal" id="tambah">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal HTML -->
<div id="editModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <form method="post" class="form_kandang" id="edit_kandang">
                <div class="modal-header">
                <h4 class="modal-title">Ubah Kandang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <label>Kapasitas</label>
                    <input type="hidden" name="ubah" value="1">
                    <input type="hidden" name="id_kandang" id="id_kandang_ed" />
                    <input type="text" name="kapasitas" id="kapasitas_ed" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Ayam</label>
                    <input type="text" name="jml_ayam" id="jml_ayam_ed" class="form-control" required>
                </div>
                </div>
                <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Kembali">
                <button class="btn btn-success ubah" data-dismiss="modal" id="ubah">Ubah
                </div>
            </form>
            </div>
                </div>
            </div>
<!-- Delete Modal HTML -->
<div id="deleteModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="post" id="hapus_kandang">
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Kandang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="hapus" value="1">
                    <input type="hidden" name="hapus_id" id="hapus_id">
                    <p>Kamu yakin ingin menghapus Kandang <b><span id="id_kdg"></span></b> dari data kandang?</p>
                    <p class="text-warning"><small>Ini akan menghapus data kandang dengan ID <b><span id="id_kdg2"></span></b>.</small></p>
                  </div>
                  <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Kembali">
                    <button class="btn btn-danger hapus" data-dismiss="modal" id="hapus">Hapus
                  </div>
                </form>
              </div>
            </div>
          </div>
<script src="./assets/js/toaster.js"></script>
<script type="text/javascript">
window.onload = function(){
  LoadData();
}
        function LoadData(){
        // $("#dataKandang").dataTable().fnDestroy();
        tabel = $('#dataKandang').DataTable({
            "destroy": true,
            // "retrieve": true,
            "processing": true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "data/kandang.php", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
            "columns": [
                { "data": "id_kandang" },
                { "data": "kapasitas" },
                { "data": "jml_ayam" }, 
                { "render": function ( data, type, row ) { // Tampilkan kolom aksi
                        var html = "<button id='" + row.id_kandang + "' class='btn btn-icon btn-2 btn-primary btn-sm edit' ><i class='fa fa-edit' aria-hidden='true'></i></button>"
                            html += "<button id='" + row.id_kandang + "' class='btn btn-icon btn-2 btn-danger btn-sm hapus' ><i class='fa fa-trash' aria-hidden='true'></i></button>"
                        return html
                    }
                },
            ],
        })
    }

    var recReq = getXmlHttpRequestObject();
    var _documentid='tampil_kandang';

//-- membentuk instant XMLHttpRequest ---
function getXmlHttpRequestObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } 
    else if(window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        alert('Status: Cound not create XmlHttpRequest Object. Consider upgrading your browser.');
    }
}

$(document).ready(function(){
  // Simpan ke database
  $(document).on('click', '#tambah', function(){
    var data = $('#form_kandang').serialize();
    $.ajax({
      url: 'data/query_kandang.php',
      type: 'POST',
      data: data,
      success: function(response){
        $('#kapasitas').val('');
        $('#jml_ayam').val('');
        $.toaster({ priority :'success', title :'Sukses!', message :'Data Kandang Berhasil Ditambahkan!'});
        LoadData();
      },
      error: function(data) {
            alert('Gagal Menyimpan Data!');
        },
    });
  });

  $(document).on('click', '#ubah', function(){
    var data = $('#edit_kandang').serialize();
    $.ajax({
      url: 'data/query_kandang.php',
      type: 'POST',
      data: data,
      success: function(response){
        $('#kapasitas_ed').val('');
        $('#jml_ayam_ed').val('');
        $.toaster({ priority :'success', title :'Sukses!', message :'Data Kandang Berhasil Di Edit!'});
        LoadData();
      },
      error: function(data) {
            alert('Gagal Mengubah Data!');
        },
    });
  });

  $(document).on('click', '#hapus', function(){
    var data = $('#hapus_kandang').serialize();
    $.ajax({
      url: 'data/query_kandang.php',
      type: 'POST',
      data: data,
      success: function(response){
        $.toaster({ priority :'success', title :'Sukses!', message :'Data Kandang Berhasil Dihapus!'});
        LoadData();
      },
      error: function(data) {
            alert('Gagal Menghapus Data!');
        },
    });
  });

$(document).on('click', '.edit', function(){  
        var id_kandang = $(this).attr("id");  
        $.ajax({  
            url:"data/query_kandang.php",  
            method:"POST",  
            data:{id_kandang:id_kandang},  
            dataType:"json",  
            success:function(data){  
                  $('#id_kandang_ed').val(data.id_kandang);
                  $('#kapasitas_ed').val(data.kapasitas);
                  $('#jml_ayam_ed').val(data.jml_ayam);
                  $('#editModal').modal('show');  
            }  
        });  
  });  
});

$(document).on('click', '.hapus', function(){  
        var id_kandang = $(this).attr("id");  
        $.ajax({  
            url:"data/query_kandang.php",  
            method:"POST",  
            data:{id_kandang:id_kandang},  
            dataType:"json",  
            success:function(data){  
                  $('#hapus_id').val(data.id_kandang);
                  document.getElementById("id_kdg").innerHTML = data.id_kandang;
                  document.getElementById("id_kdg2").innerHTML = data.id_kandang;
                  $('#deleteModal').modal('show');
            }  
        });  
  });
</script>