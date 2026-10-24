
<?php
$products = $pdo->query(
    "SELECT id, nama_barang, harga, stok
     FROM products
     ORDER BY id DESC"
)->fetchAll();
?>

<main class="col-md-10 main-content p-4">
    <h2 class="h3 pb-2 border-bottom">Data Produk</h2>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= e($product['id']) ?></td>
                            <td><?= e($product['nama_barang']) ?></td>
                            <td>Rp <?= number_format(
                                (float)$product['harga'], 0, ',', '.'
                            ) ?></td>
                            <td><?= e($product['stok']) ?></td>
                            <td>
                                <button type="button"
                                    class="btn btn-warning btn-sm"
                                    disabled>
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>

                                <button type="button"
                                    class="btn btn-danger btn-sm"
                                    disabled>
                                    <i class="bi bi-trash"></i>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada produk.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
