<?php $__env->startSection('title', 'Data Perangkat'); ?>
<?php $__env->startSection('page_title', 'Data Perangkat'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="tables-container dua" style="margin-top: 20px;">
            <div class="table-column">
                <div class="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <button class="btn btn-primary mb-3" style="margin-bottom: 10px;"
                        onclick="openModal('modalTambahJenis')">+ Tambah Jenis</button>
                    <h3>Data Jenis</h3>
                </div>
                <div class="table-responsive">
                    <table id="jenisTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Perangkat</th>
                                <th>Kode Perangkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $jenisperangkat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($item->nama_perangkat); ?></td>
                                    <td><?php echo e($item->kode_perangkat); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-edit btn-sm mb-1"
                                                onclick="openModal('modalEditJenis<?php echo e($item->kode_perangkat); ?>')">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-delete btn-sm"
                                                onclick="confirmDelete('<?php echo e($item->kode_perangkat); ?>')">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>

                                            <form id="delete-form-<?php echo e($item->kode_perangkat); ?>"
                                                action="<?php echo e(route('jenisperangkat.destroy', $item->kode_perangkat)); ?>"
                                                method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <div id="modalEditJenis<?php echo e($item->kode_perangkat); ?>" class="modal">
                                    <div class="modal-content">
                                        <span class="close"
                                            onclick="closeModal('modalEditJenis<?php echo e($item->kode_perangkat); ?>')">&times;</span>
                                        <h5>Edit Jenis Perangkat</h5>
                                        <form action="<?php echo e(route('jenisperangkat.update', $item->kode_perangkat)); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="mb-3">
                                                <label>Nama Perangkat</label>
                                                <input type="text" name="nama_perangkat" class="form-control"
                                                    value="<?php echo e($item->nama_perangkat); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Kode Perangkat</label>
                                                <input type="text" name="kode_perangkat" class="form-control"
                                                    value="<?php echo e($item->kode_perangkat); ?>" readonly>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data jenis perangkat.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-column">
                <div class="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <button class="btn btn-primary" style="margin-bottom: 10px;" onclick="openModal('modalTambahBrand')">+
                        Tambah Brand</button>
                    <h3>Data Brand</h3>
                </div>
                <div class="table-responsive">
                    <table id="brandTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Brand</th>
                                <th>Kode Brand</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $brandperangkat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($item->nama_brand); ?></td>
                                    <td><?php echo e($item->kode_brand); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-edit btn-sm mb-1"
                                                onclick="openModal('modalEdit<?php echo e($item->kode_brand); ?>')">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-delete btn-sm"
                                                onclick="confirmDelete('<?php echo e($item->kode_brand); ?>')">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>

                                            <form id="delete-form-<?php echo e($item->kode_brand); ?>"
                                                action="<?php echo e(route('brandperangkat.destroy', $item->kode_brand)); ?>" method="POST"
                                                style="display: none;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <div id="modalEdit<?php echo e($item->kode_brand); ?>" class="modal">
                                    <div class="modal-content">
                                        <span class="close"
                                            onclick="closeModal('modalEdit<?php echo e($item->kode_brand); ?>')">&times;</span>
                                        <h5>Edit Brand Perangkat</h5>
                                        <form action="<?php echo e(route('brandperangkat.update', $item->kode_brand)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="mb-3">
                                                <label>Nama Brand</label>
                                                <input type="text" name="nama_brand" class="form-control"
                                                    value="<?php echo e($item->nama_brand); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Kode Brand</label>
                                                <input type="text" name="kode_brand" class="form-control"
                                                    value="<?php echo e($item->kode_brand); ?>" readonly>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data brand.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modalTambahJenis" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalTambahJenis')">&times;</span>
            <h5>Tambah Jenis Perangkat</h5>
            <form action="<?php echo e(route('jenisperangkat.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label>Nama Jenis</label>
                    <input type="text" name="nama_perangkat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kode Jenis</label>
                    <input type="text" name="kode_perangkat" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <div id="modalTambahBrand" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalTambahBrand')">&times;</span>
            <h5>Tambah Brand Perangkat</h5>
            <form action="<?php echo e(route('brandperangkat.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label>Nama Brand</label>
                    <input type="text" name="nama_brand" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kode Brand</label>
                    <input type="text" name="kode_brand" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <?php $__env->startSection('scripts'); ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#jenisTable').DataTable({
                    "language": {
                        "search": "Cari",
                        "lengthMenu": "_MENU_",
                        "zeroRecords": "Tidak ada data yang ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "<i class='fas fa-arrow-right'></i>",
                            "previous": "<i class='fas fa-arrow-left'></i>"
                        }
                    },
                    "pageLength": 10,
                    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
                    "columnDefs": [
                        {
                            "targets": 2, // Aksi column (index 2)
                            "orderable": false // Disable sorting for Aksi column
                        }
                    ]
                });

                $('#brandTable').DataTable({
                    "language": {
                        "search": "Cari",
                        "lengthMenu": "_MENU_",
                        "zeroRecords": "Tidak ada data yang ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "<i class='fas fa-arrow-right'></i>",
                            "previous": "<i class='fas fa-arrow-left'></i>"
                        }
                    },
                    "pageLength": 10,
                    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
                    "columnDefs": [
                        {
                            "targets": 2, // Aksi column (index 2)
                            "orderable": false // Disable sorting for Aksi column
                        }
                    ]
                });
            });

            function openModal(modalId) {
                document.getElementById(modalId).style.display = 'block';
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = 'none';
            }
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ex\gitpull\resources\views/menu/data/dataperangkat.blade.php ENDPATH**/ ?>