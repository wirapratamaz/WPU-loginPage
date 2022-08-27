<?php
session_start();

//cek user tidak berhasil login
if( !isset($_SESSION["login"]) ){ //tidak berhasil login
    header("Location: login.php");
    exit;
}

require 'functions.php';

//tangkap id 
$id = $_GET["id"];

if( hapus($id) > 0){
    echo "
            <script>
                alert('data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
}
?>