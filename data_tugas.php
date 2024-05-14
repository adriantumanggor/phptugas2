<?php
include 'auth.php';
include 'config.php';

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

// Proses pengunggahan file
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $uploadDir = "uploads/data_tugas/"; // Direktori penyimpanan file yang diunggah
    $uploadFile = $uploadDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
        // Simpan informasi file ke dalam database
        $fileName = basename($_FILES["file"]["name"]);
        $filePath = $uploadFile;
        $sql = "INSERT INTO uploaded_files (file_name, file_path) VALUES ('$fileName', '$filePath')";

        if ($conn->query($sql) === TRUE) {
            echo "File berhasil diunggah.";
            echo "<script>
                alert('File berhasil diunggah.');
                window.location.href = 'data_tugas.php';
              </script>";
            exit;
        } else {
            echo "Terjadi kesalahan saat menyimpan informasi file.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
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
                    $sql = "SELECT * FROM uploaded_files";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['file_name'] . "</td>";
                            echo "<td>" . filesize($row['file_path']) . " bytes</td>";
                            echo "<td><a href='data_tugas.php?file=" . urlencode($row['file_name']) . "'>Download</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada file diunggah.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
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
        </div>
    </section>
</body>

</html>

<?php
$conn->close();
?>
