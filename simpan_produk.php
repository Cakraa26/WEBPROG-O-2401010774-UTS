<?php
include_once("config/koneksi.php");

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM produk WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: produk.php?pesan=gagal"));
    }

    header("Location: produk.php?pesan=hapus_sukses");
    exit();
}

if (!isset($_POST["simpan"])) {
    die(header("Location: produk.php?pesan=gagal"));
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$nm = $_POST['nm'];
$kategori = $_POST['kategori'];
$harga_pokok = $_POST['harga_pokok'];
$deskripsi = $_POST['deskripsi'];

if (!empty($id)) {
    $sql = "UPDATE produk SET nm='$nm', kategori='$kategori', harga_pokok='$harga_pokok', deskripsi='$deskripsi' WHERE id='$id'";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: produk.php?pesan=gagal"));
    }

    header("Location: produk.php?pesan=edit_sukses");
} else {
    $sql = "INSERT INTO produk (nm, kategori, harga_pokok, deskripsi) 
            VALUES ('$nm', '$kategori', '$harga_pokok', '$deskripsi')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: produk.php?pesan=gagal"));
    }

    header("Location: produk.php?pesan=sukses");
}

exit();
?>