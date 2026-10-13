
<?php
// DATABASE CONNECTION
$host = "localhost";
$dbname = "satamart";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed. Check your database settings.");
}

// HELPER: ESCAPE HTML OUTPUT
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

// HANDLE ADD PRODUCT FORM
$pesan = "";
$jenisPesan = "danger";

if ($_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["tambah_produk"])) {

    $nama = trim($_POST["nama_barang"] ?? "");
    $harga = trim($_POST["harga"] ?? "");
    $stok = trim($_POST["stok"] ?? "");

    if ($nama === "") {
        $pesan = "Nama barang harus diisi.";
    } elseif (
        $harga === "" ||
        !is_numeric($harga) ||
        !is_finite((float)$harga) ||
        (float)$harga < 0 ||
        (float)$harga > 9999999999.99
    ) {
        $pesan = "Harga harus berupa angka yang valid.";
    } elseif (
        $stok === "" ||
        !ctype_digit($stok) ||
        (float)$stok > 2147483647
    ) {
        $pesan = "Stok harus berupa bilangan bulat 0 atau lebih.";
    } else {
        $sql = "INSERT INTO products (nama_barang, harga, stok)
                VALUES (:nama, :harga, :stok)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nama" => $nama,
            ":harga" => $harga,
            ":stok" => (int)$stok
        ]);

        // Prevent duplicate submission after refreshing
        header("Location: index.php?success=1");
        exit;
    }
}

// SUCCESS MESSAGE
if (isset($_GET["success"])) {
    $pesan = "Produk berhasil ditambahkan!";
    $jenisPesan = "success";
}

// GET PRODUCTS FROM DATABASE
$stmt = $pdo->query(
    "SELECT id, nama_barang, harga, stok
     FROM products
     ORDER BY id DESC"
);

$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Satamart</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #fff;
        }

        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #f1f5f9;
            border-right: 1px solid #dee2e6;
        }

        .sidebar .nav-link {
            color: #0d6efd;
            font-size: 14px;
            padding: 10px 12px;
        }

        .sidebar .nav-link:hover {
            background-color: #e2e8f0;
        }

        .main-content {
            min-height: calc(100vh - 56px);
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark px-3">
        <a class="navbar-brand fs-6" href="index.php">
            Satamart
        </a>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <aside class="col-md-2 sidebar p-0">
                <nav class="nav flex-column py-2">

                    <a href="#" class="nav-link">
                        <i class="bi bi-house-door me-2"></i>Dashboard
                    </a>

                    <a href="#" class="nav-link">
                        <i class="bi bi-file-earmark me-2"></i>Orders
                    </a>

                    <a href="index.php" class="nav-link">
                        <i class="bi bi-cart me-2"></i>Products
                    </a>

                    <a href="#" class="nav-link">
                        <i class="bi bi-people me-2"></i>Customers
                    </a>

                    <a href="#" class="nav-link">
                        <i class="bi bi-graph-up me-2"></i>Reports
                    </a>

                    <a href="#" class="nav-link">
                        <i class="bi bi-gear me-2"></i>Integrations
                    </a>

                    <hr class="mx-3">

                    <a href="#" class="nav-link">
                        <i class="bi bi-box-arrow-left me-2"></i>Sign out
                    </a>

                </nav>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="col-md-10 main-content p-4">

                <h2 class="h3 pb-2 border-bottom">
                    Dashboard
                </h2>

                <h3 class="h4 mt-3">Data Produk</h3>

                <!-- NOTIFICATION -->
                <?php if ($pesan !== ""): ?>
                    <div class="alert alert-<?php echo e($jenisPesan); ?> alert-dismissible fade show"
                         role="alert">

                        <?php echo e($pesan); ?>

                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- ADD PRODUCT BUTTON -->
                <button type="button"
                        class="btn btn-secondary btn-sm mb-2"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambah">

                    <i class="bi bi-plus-lg"></i> Add Product
                </button>

                <!-- PRODUCT TABLE -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (count($products) > 0): ?>

                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td>
                                            <?php echo e($product["id"]); ?>
                                        </td>

                                        <td>
                                            <?php echo e($product["nama_barang"]); ?>
                                        </td>

                                        <td>
                                            Rp <?php echo number_format(
                                                (float)$product["harga"],
                                                0, ',', '.'
                                            ); ?>
                                        </td>

                                        <td>
                                            <?php echo e($product["stok"]); ?>
                                        </td>

                                        <td>
                                            <a href="#"
                                               class="text-dark">Edit</a>
                                            |
                                            <a href="#"
                                               class="text-dark">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="5"
                                        class="text-center text-muted py-3">
                                        Belum ada produk.
                                    </td>
                                </tr>

                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>

            </main>
        </div>
    </div>

    <!-- ADD PRODUCT MODAL -->
    <div class="modal fade" id="modalTambah"
         tabindex="-1" aria-labelledby="modalTambahLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="index.php">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">
                            Tambah Produk
                        </h5>

                        <button type="button" class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="nama_barang"
                                   class="form-label">
                                Nama Barang
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="nama_barang"
                                   name="nama_barang"
                                   maxlength="100"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">
                                Harga (Rp)
                            </label>

                            <input type="number"
                                   class="form-control"
                                   id="harga"
                                   name="harga"
                                   min="0"
                                   max="9999999999.99"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label">
                                Stok
                            </label>

                            <input type="number"
                                   class="form-control"
                                   id="stok"
                                   name="stok"
                                   min="0"
                                   step="1"
                                   required>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit"
                                name="tambah_produk"
                                value="1"
                                class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan Produk
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
