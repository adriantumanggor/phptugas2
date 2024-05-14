<?php

function check_login() {
    // Mulai sesi
    session_start();

    // Jika variabel sesi 'username' belum diset, arahkan pengguna ke halaman login
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
}
