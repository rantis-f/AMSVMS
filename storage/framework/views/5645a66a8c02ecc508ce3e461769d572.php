<?php $__env->startSection('title', 'Histori Jaringan'); ?>
<?php $__env->startSection('page_title', 'Histori Jaringan'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main" style="padding-top: 10px">
        <div class="table-responsive">
            <table id="historiJaringanTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Region</th>
                        <th>Kode Site Insan</th>
                        <th>Tipe Jaringan</th>
                        <th>Segmen</th>
                        <th>Jartatup Jartaplok</th>
                        <th>Panjang</th>
                        <th>Panjang Drawing</th>
                        <th>Jumlah Core</th>
                        <th>Jenis Kabel</th>
                        <th>Tipe Kabel</th>
                        <th>Aksi</th>
                        <th>Tanggal Perubahan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $historijaringan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->region->nama_region); ?></td>
                            <td><?php echo e($item->kode_site_insan); ?></td>
                            <td><?php echo e($item->tipejaringan->nama_tipejaringan); ?></td>
                            <td><?php echo e($item->segmen); ?></td>
                            <td><?php echo e($item->jartatup_jartaplok); ?></td>
                            <td><?php echo e($item->panjang); ?></td>
                            <td><?php echo e($item->panjang_drawing); ?></td>
                            <td><?php echo e($item->jumlah_core); ?></td>
                            <td><?php echo e($item->jenis_kabel); ?></td>
                            <td><?php echo e($item->tipe_kabel); ?></td>
                            <td><?php echo e($item->histori); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($item->tanggal_perubahan)->locale('id')->isoFormat('D MMMM YYYY, HH:mm')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php $__env->startSection('scripts'); ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#historiJaringanTable').DataTable({
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
                            "targets": [0, 8],
                            "orderable": false
                        }
                    ]
                });
            });
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/menu/histori/historijaringan.blade.php ENDPATH**/ ?>