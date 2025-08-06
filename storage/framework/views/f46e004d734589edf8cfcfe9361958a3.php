<?php $__env->startSection('title', 'DCAF'); ?>
<?php $__env->startSection('page_title', 'DCAF'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <div class="container">
            <button class="btn btn-primary" style="margin-top: 20px; margin-bottom: 10px;"
                onclick="window.location.href='<?php echo e(route('pendaftarandcaf')); ?>'">Ajukan DCAF
            </button>

            <div class="table-responsive">
                <table id="dcafTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Upload</th>
                            <th>Status NDA</th>
                            <th>Masa Berlaku NDA</th>
                            <th>Status DCAF</th>
                            <th>Masa Berlaku DCAF</th>
                            <th>NDA</th>
                            <th>DCAF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $dcafs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dcaf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><?php echo e($dcaf->created_at->format('d/m/Y H:i')); ?></td>
                                <td>
                                    <span style="display: inline-flex; align-items: center;">
                                    <span style="width: 10px; height: 10px; border-radius: 3px; margin-right: 8px; background-color: 
                                        <?php echo e($dcaf->nda->status == 'pending' ? '#ffc107' :
                                        ($dcaf->nda->status == 'diterima' ? '#28a745' : '#dc3545')); ?>;">
                                    </span>
                                        <?php echo e(ucfirst($dcaf->nda->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php echo e($dcaf->nda->masaberlaku 
                                        ? \Carbon\Carbon::parse($dcaf->nda->masaberlaku)->translatedFormat('j F Y H:i') 
                                        : '-'); ?>

                                </td>
                                <td>
                                    <span style="display: inline-flex; align-items: center;">
                                    <span style="width: 10px; height: 10px; border-radius: 3px; margin-right: 8px; background-color: 
                                        <?php echo e($dcaf->status == 'pending' ? '#ffc107' :
                                        ($dcaf->status == 'diterima' ? '#28a745' :
                                        ($dcaf->status == 'ditolak' ? '#dc3545' : '#ffc107'))); ?>;">
                                    </span>
                                        <?php echo e(ucfirst($dcaf->status)); ?>

                                    </span>
                                </td>
                                <td><?php echo e($dcaf->masaberlaku 
                                        ? \Carbon\Carbon::parse($dcaf->masaberlaku)->translatedFormat('j F Y H:i') 
                                        : '-'); ?>

                                </td>
                                <td>
                                    <?php if($dcaf->nda->status == 'diterima'): ?>
                                        <a href="<?php echo e(asset($dcaf->nda->file_path)); ?>" target="_blank" class="btn btn-sm btn-info">Lihat NDA</a>
                                    <?php else: ?>
                                        <span class="text-muted">Belum dapat diakses</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($dcaf->status == 'diterima'): ?>
                                        <a href="<?php echo e(asset($dcaf->file_path)); ?>" target="_blank" class="btn btn-sm btn-info">Lihat DCAF</a>
                                    <?php else: ?>
                                    <span class="text-muted">Belum dapat diakses</span> <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#dcafTable').DataTable({
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
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
            order: [],
            columnDefs: [
                { targets: [6, 7], orderable: false }
            ]
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/VMS/user/pendaftarankunjungan.blade.php ENDPATH**/ ?>