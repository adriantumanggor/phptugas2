<?php
include 'auth.php';

// Panggil fungsi pemeriksaan login di setiap halaman yang memerlukan autentikasi
check_login();

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Proses pengunggahan file
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $uploadDir = "uploads/data_tugas/"; // Direktori penyimpanan file yang diunggah
    $uploadFile = $uploadDir . basename($_FILES["file"]["name"]);

if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
        echo "File berhasil diunggah.";
        echo "<script>
                alert('File berhasil diunggah.');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
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
            <h1 class="title has-text-centered">Welcome <?php echo $_SESSION['username']; ?>.</h1>
            <p class="has-text-centered">
                You are logged in as <?php echo $_SESSION['username']; ?>. <a href="logout.php">Logout</a>
            </p>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <h1 class="title">Data Tugas</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                enctype="multipart/form-data">
                <div class="field">
                    <label class="label">Pilih File:</label>
                    <div class="control ml-5">
                        <input type="file" name="file" id="file">
                    </div>
                </div>
                <div class="field">
                    <div class="control mt-9">
                        <button class="button is-primary" type="submit" name="submit">Unggah File</button>
                    </div>
                </div>
            </form>

            <h2 class="subtitle mt-5 mb-5">Daftar File:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama File</th>
                        <th>Ukuran</th>
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
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>