<?php
include_once("config/koneksi.php");

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM kategori WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: kategori.php?pesan=gagal"));
    }

    header("Location: kategori.php?pesan=hapus_sukses");
    exit();
}

if (!isset($_POST["simpan"])) {
    die(header("Location: kategori.php?pesan=gagal"));
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$kategori = $_POST['kategori'];
$deskripsi = $_POST['deskripsi'];

if (!empty($id)) {
    $sql = "UPDATE kategori SET kategori='$kategori', deskripsi='$deskripsi' WHERE id='$id'";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: kategori.php?pesan=gagal"));
    }

    header("Location: kategori.php?pesan=edit_sukses");
} else {
    $sql = "INSERT INTO kategori (kategori, deskripsi) 
            VALUES ('$kategori', '$deskripsi')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: kategori.php?pesan=gagal"));
    }

    header("Location: kategori.php?pesan=sukses");
}

exit();
?>