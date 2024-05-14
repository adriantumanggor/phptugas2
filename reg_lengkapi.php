<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    // Set default value untuk pic_path
    $pic_path = "";

    // Jika ada gambar yang diunggah
    if (!empty($_FILES["pic_path"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pic_path"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Periksa apakah file gambar yang diunggah adalah gambar yang valid
        $check = getimagesize($_FILES["pic_path"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Periksa ukuran file
        if ($_FILES["pic_path"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Izinkan hanya format file gambar tertentu
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Jika semua validasi berhasil, lanjutkan dengan mengunggah file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["pic_path"]["tmp_name"], $target_file)) {
                $pic_path = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query SQL untuk menyimpan data admin baru ke dalam database
    $sql = "INSERT INTO admin (nama, email, no_hp, username, password, pic_path) VALUES ('$nama', '$email', '$no_hp', '$username', '$hashed_password', '$pic_path')";

    // Menjalankan query
    if (mysqli_query($conn, $sql)) {
        // Hapus semua variabel sesi
        session_unset();
        session_destroy();

        // Redirect ke halaman login
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <h1 class="title has-text-centered">Register</h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="field">
                            <label class="label">Profile Picture</label>
                            <div class="control profile-picture-container">
                                <label for="profile-picture-upload" class="profile-picture-overlay">
                                    <i class="fas fa-camera"></i> Choose Image
                                </label>
                                <input id="profile-picture-upload" type="file" name="pic_path" accept="image/*" onchange="previewImage(event)">
                                <img id="preview" class="profile-picture" src="account.png" alt="">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" name="nama" placeholder="Name" value="<?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : ''; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="email" name="email" placeholder="Email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Phone Number</label>
                            <div class="control">
                                <input class="input" type="text" name="no_hp" placeholder="Phone Number" value="<?php echo isset($_SESSION['no_hp']) ? $_SESSION['no_hp'] : ''; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary is-fullwidth">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
