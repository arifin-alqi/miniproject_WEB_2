<?php
include 'conn.php';

$type = $_GET['type'] ?? 'cert';
$id   = (int)($_GET['id'] ?? 0);

if ($type === 'profile') {
    $result = mysqli_query($conn, "SELECT foto, foto_type FROM profile WHERE id = $id");
    $row    = mysqli_fetch_assoc($result);
    $data   = $row['foto'];
    $mime   = $row['foto_type'] ?? 'image/jpeg';
} else {
    $result = mysqli_query($conn, "SELECT gambar, gambar_type FROM certificates WHERE id = $id");
    $row    = mysqli_fetch_assoc($result);
    $data   = $row['gambar'];
    $mime   = $row['gambar_type'] ?? 'image/jpeg';
}

header("Content-Type: " . $mime);
echo $data;
?>