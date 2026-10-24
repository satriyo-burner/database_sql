
<?php
$stmt = $pdo->query("SELECT * FROM customers");
$customers = $stmt->fetchAll();
?>

<main class="col-md-10 main-content p-4">
    <h2 class="h3 pb-2 border-bottom">Data Pelanggan</h2>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= e($customer['id']) ?></td>
                        <td><?= e($customer['nama']) ?></td>
                        <td><?= e($customer['no_hp']) ?></td>
                        <td><?= e($customer['alamat']) ?></td>
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

                <?php if (count($customers) === 0): ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada pelanggan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
