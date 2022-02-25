<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Paket</title>
   
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-dark">
<?php
    // menyambungkan dengan database
    include("Navbar.php");
    ?>
    <div class="container mt-5">
        <div class="card bg-dark">
            <div class="card-header bg-dark ">
                <h4 class="text-light text-center">Daftar Paket Laundry</h4>
                <a href="form-member.php">
                    
                </a>
            </div> 

<div class="container">
            <div class="card-body bg-dark">
                <form action="list-paket.php" method ="get">
                    <input type="text" name="search" class="form-control btn-outline-info bg-dark mb-3 text-light"
                    placeholder="Masukkan Keyword Pencarian" />
                </form>

                <ul class="list-group">
                    <?php
                    include "connection.php";
                    if (isset($_GET["search"])) {
                        $search = $_GET["search"];
                        $sql = "select * from paket 
                        where jenis like '%$search%' 
                        or harga like '%$search%' 
                        or id_paket like '%$search%'";
                    }else {
                        $sql = "select * from paket"; 
                    }
                    # eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);
                    while ($paket = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item btn-outline-info bg-dark">
                            <div class="row">
                                <div class="col-lg-8">
                                    <!-- untuk deskripsi paket -->
                                    <h5><?=$paket["jenis"]?></h5>
                                    <h6>ID paket : <?=$paket["id_paket"]?></h6>
                                    <h6>Harga : <?=$paket["harga"]?></h6>
                                </div>
                                <div class="col-lg-4">
                                    <a href="form-paket.php?id_paket=<?=$paket["id_paket"]?>">
                                        <button class="btn btn-info btn-block mb-2">
                                         Edit
                                         </button>
                                    </a>

                                    <a href="process-member.php?id=<?=$member["id"]?>">
                                    <button class="btn btn-block btn-danger"
                                    onclick="return confirm('Apakah anda yakin?')">
                                        Remove
                                    </button>
                                    </a>
                                    
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

            <div class="card-footer">
                <a href="form-paket.php"> 
                    <button class="btn btn-outline-info">
                        Tambah Data paket
                    </button>
                </a>
            </div>

        </div>
    </div>
</body>
</html>