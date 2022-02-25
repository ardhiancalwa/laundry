<?php
include("connection.php");
if (isset($_POST["simpan_paket"])) {
    # proses insert new data
    // tampung data input paket dari user
    $id_paket = $_POST["id_paket"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

    // membuat perintah SQL utk insert data ke tbl paket
    $sql = "insert into paket values ('$id_paket',
    '$jenis','$harga')";

    // eksekusi perintah / menjalankan perintah SQL
    mysqli_query($connect, $sql);

    // direct / dikembalikan ke halaman list paket
    header("location:list-paket.php");
}

if (isset($_POST["update_paket"])) {
    # tampung data yg akan diupdate
    $id_paket = $_POST["id_paket"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

    # perintah SQL update ke table paket
    $sql = "update paket set jenis='$jenis',
    harga='$harga' where id_paket='$id_paket'";

    # eksekusi perintah SQL
    mysqli_query($connect, $sql);

    # direct / dikembalikan ke halaman list paket
    header("location:list-paket.php");
}
elseif (isset($_GET["id_paket"])) {
    $id_paket = $_GET["id_paket"];
    
    # hapus data yg ada di tabel buku
    $sql = "delete from paket where id_paket='$id_paket'";
    if (mysqli_query($connect, $sql)) {
        header("location:list-paket.php");
    } else {
        echo mysqli_error($connect);
    }
}
?>