<?php
include 'auth.php';

// Panggil fungsi pemeriksaan login di setiap halaman yang memerlukan autentikasi
check_login();

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Proses pengunduhan file
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = 'uploads/data_tugas/' . $file;

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "File tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tugas</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Data Tugas</h1>
            <h2 class="subtitle mt-5 mb-5">Daftar File:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama File</th>
                        <th>Ukuran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $files = scandir('uploads/data_tugas/');
                    foreach ($files as $file) {
                        if ($file !== '.' && $file !== '..') {
                            $filePath = 'uploads/data_tugas/' . $file;
                            $fileSize = filesize($filePath);
                            echo "<tr>";
                            echo "<td>$file</td>";
                            echo "<td>$fileSize bytes</td>";
                            echo "<td><a href='data_tugas.php?file=$file'>Download</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>