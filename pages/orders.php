
<?php
$sql = "SELECT
            orders.id,
            customers.nama AS nama_pelanggan,
            orders.tanggal,
            orders.total,
            orders.status
        FROM orders
        INNER JOIN customers
            ON orders.customer_id = customers.id
        ORDER BY orders.id DESC";

$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll();
?>

<main class="col-md-10 main-content p-4">
    <h2 class="h3 pb-2 border-bottom">Data Pesanan</h2>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= e($order['id']) ?></td>
                        <td><?= e($order['nama_pelanggan']) ?></td>
                        <td><?= e($order['tanggal']) ?></td>
                        <td>
                            Rp <?= number_format(
                                (float)$order['total'], 0, ',', '.'
                            ) ?>
                        </td>
                        <td><?= e($order['status']) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (count($orders) === 0): ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada pesanan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
