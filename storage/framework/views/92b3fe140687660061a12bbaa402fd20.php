<?php $__env->startSection('title', 'Histori Fasilitas'); ?>
<?php $__env->startSection('page_title', 'Histori Fasilitas'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main" style="padding-top: 10px">
        <div class="table-responsive">
            <table id="historiFasilitasTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Region</th>
                        <th>Site</th>
                        <th>No Rack</th>
                        <th>Fasilitas</th>
                        <th>Fasilitas ke</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>U Awal</th>
                        <th>U Akhir</th>
                        <th>Aksi</th>
                        <th>Tanggal Perubahan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $historifasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->region->nama_region); ?></td>
                            <td><?php echo e($item->site->nama_site); ?></td>
                            <td><?php echo e($item->no_rack); ?></td>
                            <td><?php echo e($item->jenisfasilitas->nama_fasilitas); ?></td>
                            <td><?php echo e($item->fasilitas_ke); ?></td>
                            <td><?php echo e(optional($item->brandfasilitas)->nama_brand); ?></td>
                            <td><?php echo e($item->type); ?></td>
                            <td><?php echo e($item->uawal); ?></td>
                            <td><?php echo e($item->uakhir); ?></td>
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
                $('#historiFasilitasTable').DataTable({
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/menu/histori/historifasilitas.blade.php ENDPATH**/ ?>