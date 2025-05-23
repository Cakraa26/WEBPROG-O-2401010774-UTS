<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Konveksi Baju - Service</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">Reckles Bali</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                General Menu
            </div>

            <li class="nav-item">
                <a class="nav-link" href="kategori.php">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Kategori</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pesanan.php">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Pesanan</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="produk.php">
                    <i class="fas fa-fw fa-tag"></i>
                    <span>Produk</span></a>
            </li>

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Data Produk</h1>

                    <div class="row mb-3 justify-content-end">
                        <div class="col-auto">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i
                                    class="fas fa-plus mr-2"></i>Tambah</button>
                        </div>
                    </div>

                    <?php if (isset($_GET['pesan'])): ?>
                        <?php if ($_GET['pesan'] == 'sukses'): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Data berhasil ditambahkan!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php elseif ($_GET['pesan'] == 'edit_sukses'): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Data berhasil diperbarui!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php elseif ($_GET['pesan'] == 'hapus_sukses'): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Data berhasil dihapus!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php elseif ($_GET['pesan'] == 'gagal'): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Aksi gagal, silakan coba lagi.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga Pokok</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once("config/koneksi.php");
                                        $sql = "SELECT produk.*, kategori.kategori AS nama_kategori 
                                        FROM produk LEFT JOIN kategori ON produk.kategori = kategori.id";
                                        $res = mysqli_query($conn, $sql);
                                        $no = 0;
                                        while ($row = mysqli_fetch_array($res)) {
                                            $no++;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $row["nm"] ?></td>
                                                <td><?= $row["nama_kategori"] ?></td>
                                                <td><?= number_format($row["harga_pokok"], 0, ',', '.') ?></td>
                                                <td><?= $row["deskripsi"] ?></td>
                                                <td class="text-nowrap">
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#editModal<?= $row['id'] ?>">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <a href="simpan_produk.php?hapus=<?= $row["id"] ?>"
                                                        onclick="return confirm('Yakin ingin menghapus produk ini?');"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Reckles Bali 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="simpan_produk.php" method="POST">
                        <div class="form-group">
                            <label for="nm">Nama Produk</label>
                            <input type="text" class="form-control" id="nm" name="nm" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori" required>
                                <?php
                                $sql = "SELECT * FROM kategori";
                                $res = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['kategori']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga_pokok">Harga Pokok</label>
                            <input type="number" class="form-control" id="harga_pokok" name="harga_pokok" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <?php
    $sql = "SELECT * FROM produk";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
        ?>
        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="simpan_produk.php" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nm" value="<?= $row['nm'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" id="kategori" name="kategori" required>
                                    <?php
                                    $kategoriSql = "SELECT * FROM kategori";
                                    $kategoriRes = mysqli_query($conn, $kategoriSql);
                                    while ($kategoriRow = mysqli_fetch_array($kategoriRes)) {
                                        $selected = ($kategoriRow['id'] == $row['kategori']) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $kategoriRow['id'] ?>" <?= $selected ?>>
                                            <?= $kategoriRow['kategori'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga Pokok</label>
                                <input type="number" class="form-control" name="harga_pokok"
                                    value="<?= $row['harga_pokok'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi"><?= $row['deskripsi'] ?></textarea>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>