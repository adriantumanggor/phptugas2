<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Include file koneksi ke database
include 'config.php';

// Mendapatkan informasi profil pengguna dari database
$username = $_SESSION['username'];
$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Tentukan sumber gambar profil
$profile_picture = $row['pic_path'] ? $row['pic_path'] : 'account.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="title profile-picture-container has-text-centered">
                <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-picture">
            </div>
            <div class="columns is-centered">
                <div class="column is-half">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <p><strong>Name:</strong> <?php echo $row['nama']; ?></p>
                                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                                <p><strong>Phone Number:</strong> <?php echo $row['no_hp']; ?></p>
                                <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
