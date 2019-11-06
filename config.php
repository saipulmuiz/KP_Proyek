<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_peternakan";
$koneksi = new mysqli($host,$user,$pass,$db);
if(mysqli_connect_errno()){
    trigger_error('Koneksi Gagal!' . mysqli_connect_error(), E_USER_ERROR);
}
 ?>