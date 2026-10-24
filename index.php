
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
    <?php include "components/header.php"; ?>

    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <?php include "components/sidebar.php"; ?>

            <!-- MAIN CONTENT -->
            <?php
            $page = $_GET['page'] ?? 'dashboard';

              if (isset($page)) {
                include "pages/" . $page . ".php";
            } else {
                echo '<h4>Halaman tidak ditemukan</h4>';
            }
            ?>

        </div>
    </div>

    <!-- BOOTSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
