<?php
include "connection.php";
if (isset($_POST["simpan_transaksi"])) {
# menampung data yg dikirim
$id_transaksi = $_POST["id_transaksi"];
$id_member = $_POST["id_member"];
$id_user = $_POST["id_user"];
$tgl = $_POST["tgl"];
$batas_waktu = $_POST["batas_waktu"];
$tgl_bayar = $_POST["tgl_bayar"];
$status = $_POST["status"];
$dibayar = $_POST["dibayar"];
$paket = $_POST["id_paket"]; 
$qty = $_POST["qty"];

# perintah SQL untuk insert ke tabel pinjam
$sql = "insert into transaksi values ('$id_transaksi','$id_member','$tgl', '$batas_waktu',
    '$tgl_bayar','$status','$dibayar','$id_user')";
echo $sql;

if (mysqli_query($connect, $sql)) {
    # jika berhasil insert ke tabel transaksi
    # insert ke tabel detail_transaksi
        $id_paket = $paket;
        print_r($id_paket);
        
        $sql = "insert into detail_transaksi values
        (' ','$id_transaksi','$id_paket','$qty')";
        if (mysqli_query($connect, $sql)) {
            # jika berhasil insert ke tabel detail_pinjam
            # yaudah lanjut
            header("location:list-transaksi.php");
        } else {
            # jika gagal insert ke tabel detail_pinjam
            echo mysqli_error($connect);
            exit;
        }
        
    
    header("location:list-transaksi.php");
} else {
    # jika gagal insert ke tabel pinjam
    echo mysqli_error($connect);
}
}

if (isset($_POST["edit_status"])) {
    $id_transaksi = $_POST["id_transaksi"];
    $status = $_POST["status"];
    $dibayar = $_POST["dibayar"];
    # perintah SQL untuk insert ke tabel pinjam
    $sql = "update transaksi set status='$status',
    dibayar='$dibayar' where
    id_transaksi='$id_transaksi'";

    if ( mysqli_query($connect, $sql)) {
        header("location:list-transaksi.php");
    } else {
        echo mysqli_error($connect);
    }
}
?>