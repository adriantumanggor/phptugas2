

<?php
include 'configg.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Periksa apakah data ditemukan sebelum memuat data untuk diupdate
    $query_check = "SELECT * FROM anggota WHERE id=$id";
    $result_check = mysqli_query($conn, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Data ditemukan, lanjutkan proses update
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $nrp = $_POST['nrp'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $jurusan = $_POST['jurusan'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $asal_sma = $_POST['asal_sma'];
            $mata_kuliah_favorit = $_POST['mata_kuliah_favorit'];

            $query = "UPDATE anggota SET nama='$nama', email='$email', nrp='$nrp', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan', alamat='$alamat', no_hp='$no_hp', asal_sma='$asal_sma', mata_kuliah_favorit='$mata_kuliah_favorit' WHERE id=$id";

            mysqli_query($conn, $query);
            header("Location: index.php");
            exit;
        }

        $query = "SELECT * FROM anggota WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);

        // Tampilkan formulir untuk mengupdate data
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Data Anggota</title>
            <link rel="stylesheet" href="style.css">
        </head>

        <body>
            <section id="input" class="section">
                <div class="container">
                    <h2 class="title">Update Daata Baru</h2>
                    <form action="" method="POST">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Nama</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="nama" value="<?php echo $data['nama']; ?>" />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Email</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="email" name="email" value="<?php echo $data['email']; ?>" />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">NRP</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="nrp" placeholder="Masukkan NRP"
                                            value="<?php echo $data['nrp']; ?>" />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Jenis Kelamin</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <label class="radio">
                                            <input type="radio" name="jenis_kelamin" value="Laki-laki" <?php if ($data['jenis_kelamin'] === 'Laki-laki')
                                                echo 'checked'; ?>>
                                            Laki-laki
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="jenis_kelamin" value="Perempuan" <?php if ($data['jenis_kelamin'] === 'Perempuan')
                                                echo 'checked'; ?>>
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Jurusan</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="jurusan"
                                            value="<?php echo $data['jurusan']; ?>" />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Alamat</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <textarea class="textarea" name="alamat"><?php echo $data['alamat']; ?></textarea>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">No HP</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="tel" name="no_hp" value="<?php echo $data['no_hp']; ?>" />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Asal SMA</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="asal_sma"
                                            value="<?php echo $data['asal_sma']; ?>" />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Mata Kuliah Favorit</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="mata_kuliah_favorit"
                                            value="<?php echo $data['mata_kuliah_favorit']; ?>" />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label"></div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <button class="button is-primary" type="submit" name="submit">Simpan</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>


        </body>

        </html>
        <?php
    } else {
        // Data tidak ditemukan, tampilkan pesan
        echo '<script>
                alert("Data dengan ID ' . $id . ' tidak ditemukan dalam tabel.");
                window.location.href = "update.php";
              </script>';
        exit;
    }
}
?>