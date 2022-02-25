<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg user
if (!isset($_SESSION["user"])) {
    header("Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-dark mt-5">
<?php include("navbar.php")?>
<div class="container">
        <div class="card bg-dark">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Form Transaksi Laundry
                </h4>
            </div>

            <div class="card-body text-light">
                <?php
                if (isset($_GET["id_transaksi"])) {
                    include "connection.php";
                    $id_transaksi = $_GET["id_transaksi"];
                    $sql = "select * from transaksi where id_transaksi='$id_transaksi'";
                    # eksekusi perintah SQL
                    $hasil = mysqli_query($connect, $sql);
                    # konversi ke bentuk array
                    $transaksi = mysqli_fetch_array($hasil);
                ?>
                <form action="process-transaksi.php" method="post">
                    <!-- input kode transaksi -->
                    ID Transaksi
                      <input type="text" name="id_transaksi" class="form-control mb-2 btn-outline-info bg-dark text-light" required
                      value="<?=$transaksi["id_transaksi"];?>" readonly>
                      
                    Status
                    <select name="status" class="form-control mb-2 btn-outline-info bg-dark text-light" required
                    value="<?=$transaksi["status"];?>">
                        <option value="baru">baru</option>
                        <option value="proses">proses</option>
                        <option value="selesai">selesai</option>
                        <option value="diambil">diambil</option>
                    </select>

                    Status Pembayaran
                    <select name="dibayar" class="form-control mb-2 btn-outline-info bg-dark text-light" required
                    value="<?=$transaksi["dibayar"];?>">
                        <option value="sudah_dibayar">dibayar</option>
                        <option value="belum_dibayar">belum bayar</option>
                    </select>
               
                <button type="submit "class="btn btn-block btn-info" name="edit_status">
                    Edit
                </button>
                </form>

                <?php
                }else{
                ?>
                <form action="process-transaksi.php" method="post">
                    <!-- input kode transaksi -->
                    ID Transaksi
                      <input type="text" name="id_transaksi" class="form-control mb-2 btn-outline-info bg-dark text-light" required>

                    Pilih Data Member
                    <select name="id_member" class="form-control mb-2 btn-outline-info bg-dark text-light" required>
                        <?php
                        include "connection.php";
                        $sql = "select * from member";
                        $hasil = mysqli_query($connect, $sql);
                        while ($member = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?=($member["id_member"])?>">
                            <?=($member["nama"])?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>

                    <!-- transaksi ambil dari data login -->
                    <input type="hidden" name="id_user" 
                    value="<?=($_SESSION["user"]["id_user"])?>">
                
                    User
                    <input type="text" name="nama_user" 
                    class="form-control mb-2 btn-outline-info bg-dark text-light" readonly
                    value="<?=($_SESSION["user"]["nama_user"])?>">
                    <!-- tgl_pinjam dibuat otomatis -->

                    <?php
                     date_default_timezone_set('Asia/Jakarta');
                    ?>
                    Tanggal Laundry
                    <input type="text" name="tgl" class="form-control mb-2 btn-outline-info bg-dark text-light" 
                    readonly value="<?=(date("Y-m-d"))?>">

                    Tanggal Ambil
                    <input type="date" name="batas_waktu" class="form-control mb-2 btn-outline-info bg-dark text-light" required>
                
                    Tanggal bayar
                    <input type="date" name="tgl_bayar" class="form-control mb-2 btn-outline-info bg-dark text-light" required>

                    Status
                    <select name="status" class="form-control mb-2 btn-outline-info bg-dark text-light" required>
                        <option value="baru">baru</option>
                        <option value="proses">proses</option>
                        <option value="selesai">selesai</option>
                        <option value="diambil">diambil</option>
                    </select>

                    Status Pembayaran
                    <select name="dibayar" class="form-control mb-2 btn-outline-info bg-dark text-light" required>
                        <option value="sudah_dibayar">dibayar</option>
                        <option value="belum_dibayar">belum bayar</option>
                    </select>

                <!-- tampilkan pilihan paket yg akan dipinjam -->
                Pilih paket yang akan di transaksi
                <select name="id_paket" class="form-control mb-2 btn-outline-info bg-dark text-light" 
                required>
                    <?php
                    $sql = " select * from paket";
                    $hasil = mysqli_query($connect, $sql);
                    while ($paket = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?=($paket["id_paket"])?>">
                           <?=($paket["jenis"])?>
                           <?=($paket["harga"] .  " /kg")?>
                        </option>
                        <?php
                    }
                    ?>
                </select>

                Jumlah Laundry...Kg
                <input type="number" name="qty" 
                class="form-control mb-2 btn-outline-info bg-dark text-light" >
               
                <button type="submit "class="btn btn-block btn-info" name="simpan_transaksi">
                    Transaksi
                </button>
                </form>
                <?php
                }?>
            </div>
        </div>
    </div>
</body>
</html>