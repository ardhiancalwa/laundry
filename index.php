
<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg user
if (!isset($_SESSION["user"])) {
    header("location:login.php");
}
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <h1>
        <div>
            <img width="100%" src="background.gif" alt="foto">
        </div>
    </h1>
</body>
</html>

