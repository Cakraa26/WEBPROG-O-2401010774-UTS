<?php
include_once("config/koneksi.php");

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM pesanan WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: pesanan.php?pesan=gagal"));
    }

    header("Location: pesanan.php?pesan=hapus_sukses");
    exit();
}

if (!isset($_POST["simpan"])) {
    die(header("Location: pesanan.php?pesan=gagal"));
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$kd = $_POST['kd'];
$nmpelanggan = $_POST['nmpelanggan'];
$tlp = $_POST['tlp'];
$tgl = $_POST['tgl'];
$total_harga = $_POST['total_harga'];
$status = $_POST['status'];
$ctn = $_POST['ctn'];

if (!empty($id)) {
    $sql = "UPDATE pesanan SET kd='$kd', nmpelanggan='$nmpelanggan', tlp='$tlp', tgl='$tgl', total_harga='$total_harga', status='$status', ctn='$ctn' WHERE id='$id'";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: pesanan.php?pesan=gagal"));
    }

    header("Location: pesanan.php?pesan=edit_sukses");
} else {
    $sql = "INSERT INTO pesanan (kd, nmpelanggan, tlp, tgl, total_harga, status, ctn) 
            VALUES ('$kd', '$nmpelanggan', '$tlp', '$tgl', '$total_harga', '$status', '$ctn')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die(header("Location: pesanan.php?pesan=gagal"));
    }

    header("Location: pesanan.php?pesan=sukses");
}

exit();
?>