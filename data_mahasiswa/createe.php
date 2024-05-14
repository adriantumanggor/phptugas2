<?php
// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi ke database
    include '../config.php';

    // Ambil nilai input dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nrp = $_POST['nrp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $asal_sma = $_POST['asal_sma'];
    $mata_kuliah_favorit = $_POST['mata_kuliah_favorit'];


    // Buat query untuk menyimpan data ke dalam database
    $query = "INSERT INTO anggota (nama, email, nrp, jenis_kelamin, jurusan, alamat, no_hp, asal_sma, mata_kuliah_favorit) 
              VALUES ('$nama', '$email', '$nrp', '$jenis_kelamin', '$jurusan', '$alamat', '$no_hp', '$asal_sma', '$mata_kuliah_favorit')";

    // Jalankan query
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    header("Location: index.php");
    exit;
}
?>
