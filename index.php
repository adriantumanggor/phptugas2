<?php
include 'auth.php';

// Panggil fungsi pemeriksaan login di setiap halaman yang memerlukan autentikasi
check_login();

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar is-link" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <p class="navbar-item">ADMIN</p>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <a href="logout.php" style="color: black;"><strong>Logout</strong></a>
            </div>
        </div>
    </nav>
    <!-- Content -->
    <div class="columns">
        <div class="column is-one-quarter">
            <ul class="menu-list custom-menu">
                <li><a href="#" class="is-active" onclick="loadPage('home.php')">Home</a></li>
                <li><a href="#" onclick="loadPage('profile.php')">Profile User</a></li>
                <li><a href="#" onclick="loadPage('./data_mahasiswa/table.php')">Data Mahasiswa</a></li>
                <li><a href="#" onclick="loadPage('./data_mahasiswa/input.php')">Input Mahasiswa</a></li>
                <li><a href="#" onclick="loadPage('./data_mahasiswa/update.php')">Update Mahasiswa</a></li>
                <li><a href="#" onclick="loadPage('./data_mahasiswa/hapus.php')">Musnahkan Mahasiswa</a></li>
                <li><a href="#" onclick="loadPage('data_tugas.php')">Unduh data</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="right column">
            <div id="content"></div>
        </div>
    </div>
    <script src="load.js"></script>
    <script>
        const menuItems = document.querySelectorAll(".custom-menu li a");
        menuItems.forEach((item) => {
            item.addEventListener("click", (event) => {
                menuItems.forEach((menuItem) => {
                    menuItem.classList.remove("is-active");
                });
                event.target.classList.add("is-active");
            });
        });
    </script>
</body>

</html>