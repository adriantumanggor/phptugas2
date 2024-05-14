<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Include file koneksi ke database
include 'config.php';

// Mengecek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query SQL untuk mendapatkan informasi admin berdasarkan username
    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Jika username ditemukan, verifikasi password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Jika password benar, buat sesi login dan arahkan ke halaman utama
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            // Jika password salah, tampilkan pesan kesalahan
            $error_message = "Username atau password salah.";
        }
    } else {
        // Jika username tidak ditemukan, tampilkan pesan kesalahan
        $error_message = "Username tidak terdaftar, silahkan daftar";
    }

    // Menutup koneksi database
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <h1 class="title has-text-centered">Login</h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="field">
                            <label class="label">Username</label>
                            <div class="control">
                                <input class="input" type="text" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input" type="password" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <?php if(isset($error_message)) { ?>
                            <p class="has-text-danger"><?php echo $error_message; ?></p>
                        <?php } ?>
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary is-fullwidth">Login</button>
                            </div>
                        </div>
                    </form>
                    <p class="has-text-centered">
                        Tidak punya akun? <a href="register.php">Daftar disini</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
