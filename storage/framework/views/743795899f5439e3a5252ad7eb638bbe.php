<?php $__env->startSection('title', 'Data Jaringan'); ?>
<?php $__env->startSection('page_title', 'Data Jaringan'); ?>


<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
            <button class="btn btn-primary" onclick="openModal('modalTambahTipeJaringan')">+ Tambah Tipe Jaringan</button>
            <h3 style="margin: 0;">Data Tipe Jaringan</h3>
        </div>

        <div class="table-responsive" style="margin-top: 20px;">
            <table id="tipeJaringanTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Tipe Jaringan</th>
                        <th>Nama Tipe Jaringan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $tipeJaringan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($tj->kode_tipejaringan); ?></td>
                            <td><?php echo e($tj->nama_tipejaringan); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit btn-sm mb-1"
                                        onclick="openModal('modalEditTipeJaringan<?php echo e($tj->kode_tipejaringan); ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-delete btn-sm" onclick="confirmDelete('<?php echo e($tj->kode_tipejaringan); ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form id="delete-form-<?php echo e($tj->kode_tipejaringan); ?>"
                                        action="<?php echo e(route('tipejaringan.destroy', $tj->kode_tipejaringan)); ?>" method="POST"
                                        style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div id="modalEditTipeJaringan<?php echo e($tj->kode_tipejaringan); ?>" class="modal">
                            <div class="modal-content">
                                <span class="close"
                                    onclick="closeModal('modalEditTipeJaringan<?php echo e($tj->kode_tipejaringan); ?>')">&times;</span>
                                <h5>Edit Tipe Jaringan</h5>
                                <form action="<?php echo e(route('tipejaringan.update', $tj->kode_tipejaringan)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <label>Kode Tipe Jaringan</label>
                                    <input type="text" name="kode_tipejaringan"
                                        value="<?php echo e(old('kode_tipejaringan', $tj->kode_tipejaringan)); ?>" class="form-control"
                                        required>

                                    <label>Nama Tipe Jaringan</label>
                                    <input type="text" name="nama_tipejaringan"
                                        value="<?php echo e(old('nama_tipejaringan', $tj->nama_tipejaringan)); ?>" class="form-control"
                                        required>

                                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div id="modalTambahTipeJaringan" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modalTambahTipeJaringan')">&times;</span>
                <h5>Tambah Tipe Jaringan</h5>
                <form action="<?php echo e(route('tipejaringan.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <label>Kode Tipe Jaringan</label>
                    <input type="text" name="kode_tipejaringan" class="form-control" required>

                    <label>Nama Tipe Jaringan</label>
                    <input type="text" name="nama_tipejaringan" class="form-control" required>

                    <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startSection('scripts'); ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#tipeJaringanTable').DataTable({
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
                            "targets": 3,
                            "orderable": false
                        }
                    ]
                });
            });

            function openModal(modalId) {
                document.getElementById(modalId).style.display = "block";
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = "none";
            }

            window.onclick = function (event) {
                if (event.target.className === 'modal') {
                    event.target.style.display = "none";
                }
            }
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/menu/data/datajaringan.blade.php ENDPATH**/ ?>