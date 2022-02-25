<?php
include("connection.php");

# untuk insert pelanggan
if (isset($_POST["simpan_member"])) {
    // tampubg data input pelanggan dari user
    $id_member= $_POST["id_member"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tlp = $_POST["tlp"];

    // membuat perintah sql utk insert data ke tbl pelanggan
    $sql = "insert into member values ('$id_member', 
    '$nama','$alamat', '$jenis_kelamin', '$tlp')";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list pelanggan
    header("location: list-member.php");
}

# untuk edit pelanggan
else if (isset($_POST["edit_member"])) {
    // tampung data yg akan diupdate
    $id_member= $_POST["id_member"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tlp = $_POST["tlp"];

    // membuat perintah sql untuk update data
    $sql = "update member set nama='$nama',
    alamat='$alamat',
    jenis_kelamin='$jenis_kelamin',
    tlp='$tlp' where id_member='$id_member'";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list pelanggan
    header("location: list-member.php");
}

# untuk hapus pelanggan
else if (isset($_GET["id_member"])) {
    $id_member = $_GET['id_member'];
    $sql ="delete from member where id_member = '".$id_member."'" ;

    $result = mysqli_query($connect,$sql);

    if ($result) {
        header('Location:list-member.php');
    } else {
        printf('Gagal ya'.mysqli_error($connect));
        exit();
    }
}

?>