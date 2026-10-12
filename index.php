<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Satamart</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
  <nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand fs-6" href="#">Satamart</a>
  </nav>

  <div class="container-fluid">
    <div class="row">

      <aside class="col-md-2 sidebar p-8">
        <nav class="nav flex-column py-2">

          <a href="#" class="nav-link">
            <i class="bi bi-house-door me-2"></i>Dashboard
          </a>
          <a href="#" class="nav-link">
            <i class="bi bi-file-enmark me-2"></i>Orders
          </a>
          <a href="#" class="nav-link">
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

      <main class="col-md-10 main-content p-4">

        <h2 class="h3 pb-2 border-bottom">Dashboard</h2>
        <h3 class="h4 mt-3">Data Produk</h3>
        <button class="btn btn-secondary btn-sm mb-2">Add Product</button>
        <div class="table-responsive">
          <table class="table table-stripped table-sm align-middle">
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
              <tr><td>0,001</td>
              <td>random</td>
              <td>data</td>
              <td>placeholder</td>
              <td>
                <a href="#" class="text-dark">Edit</a>
                <a href="#" class="text-dark">Hapus</a>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>