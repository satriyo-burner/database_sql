
<main class="col-md-10 main-content p-4">

    <h2 class="h3 pb-2 border-bottom">
        Dashboard
    </h2>

    <h3 class="h4 mt-3">Data Produk</h3>

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
                        <td colspan="4"
                            class="text-center text-muted py-3">
                            Belum ada produk.
                        </td>
                    </tr>

                <?php endif; ?>
            </tbody>

        </table>
    </div>

</main>
