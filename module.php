<?php 
    if(isset($_GET['module'])) $module = $_GET['module'];
    else $module = "dashboard";

    if($module == "dashboard") include("./template/dashboard.php");
    elseif($module == "keluar") include("keluar.php");

    elseif($module == "petugas") include("./template/data_petugas.php");
    elseif($module == "kandang") include("./template/data_kandang.php");

    else echo "Modul Tidak Ada!";
 ?>