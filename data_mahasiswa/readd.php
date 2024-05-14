<?php
include 'configg.php';
$sql = "SELECT * FROM anggota";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td class='has-text-centered'>" . $row["id"] . "</td>";
    echo "<td class='has-text-centered'>" . $row["nrp"] . "</td>";
    echo "<td class='has-text-centered'>" . $row["nama"] . "</td>";
    echo "<td class='has-text-centered'>" . $row["email"] . "</td>";
    echo "<td class='has-text-centered'>" . $row["jenis_kelamin"] . "</td>";
    echo "</tr>";
}

// Menutup koneksi
mysqli_close($conn);