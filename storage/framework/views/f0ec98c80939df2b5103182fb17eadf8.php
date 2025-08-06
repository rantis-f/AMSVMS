<?php $__env->startSection('title', 'Verifikasi NDA'); ?>
<?php $__env->startSection('page_title', 'Verifikasi NDA'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <div class="title" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
            <h3>NDA yang Perlu Diverifikasi</h3>
        </div>
        <div class="table-responsive" style="margin-top: 20px;">
            <table id="pendingTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Tanggal Upload</th>
                        <th>Catatan</th>
                        <th>File NDA</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pendingNdas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $nda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($nda->user->name); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($nda->created_at)->translatedFormat('j F Y H:i')); ?></td>
                            </td>
                            <td><?php echo e($nda->catatan ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo e(asset($nda->file_path)); ?>" target="_blank" class="btn btn-sm btn-info">Lihat
                                    File</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="konfirmasiSetuju(<?php echo e($nda->id); ?>)">Terima</button>

                                <button type="button" class="btn btn-delete btn-sm" style="font-size: 14px;"
                                    onclick="konfirmasiTolak(<?php echo e($nda->id); ?>)">Tolak</button>

                                <form id="form-terima-<?php echo e($nda->id); ?>" action="<?php echo e(route('nda.update', $nda->id)); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="status" value="diterima">
                                </form>

                                <form id="form-tolak-<?php echo e($nda->id); ?>" action="<?php echo e(route('nda.update', $nda->id)); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="status" value="ditolak">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>


        <div class="title" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
            <h3>Data NDA yang Berlaku</h3>
        </div>
        <div class="table-responsive" style="margin-top: 20px;">
            <table id="activeTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Tanggal Upload</th>
                        <th>Tanggal Verifikasi</th>
                        <th>Masa Berlaku</th>
                        <th>Catatan</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $activeNdas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $nda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($nda->user->name); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($nda->created_at)->translatedFormat('j F Y H:i')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($nda->updated_at)->translatedFormat('j F Y H:i')); ?></td>
                            <td><?php echo e($nda->masaberlaku ? \Carbon\Carbon::parse($nda->masaberlaku)->translatedFormat('j F Y H:i') : '-'); ?>

                            </td>
                            <td><?php echo e($nda->catatan ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo e(asset($nda->file_path)); ?>" target="_blank" class="btn btn-sm btn-info">Lihat
                                    File</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="title" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
            <h3>Riwayat NDA yang Kadaluarsa</h3>
        </div>
        <div class="table-responsive" style="margin-top: 20px;">
            <table id="expiredTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Tanggal Upload</th>
                        <th>Tanggal Verifikasi</th>
                        <th>Masa Berlaku</th>
                        <th>Catatan</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $expiredNdas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $nda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($nda->user->name); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($nda->created_at)->translatedFormat('j F Y H:i')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($nda->updated_at)->translatedFormat('j F Y H:i')); ?></td>
                            <td><?php echo e($nda->masaberlaku ? \Carbon\Carbon::parse($nda->masaberlaku)->translatedFormat('j F Y H:i') : '-'); ?>

                            </td>
                            <td><?php echo e($nda->catatan ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo e(asset($nda->file_path)); ?>" target="_blank" class="btn btn-sm btn-info">Lihat
                                    File</a>
                            </td>
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
                $('#pendingTable').DataTable({
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
                        { targets: [4, 5], orderable: false }
                    ]
                });

                $('#activeTable').DataTable({
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
                        { targets: [6], orderable: false }
                    ]
                });

                $('#expiredTable').DataTable({
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
                        { targets: [6], orderable: false }
                    ]
                });
            });

            function konfirmasiSetuju(id) {
                Swal.fire({
                    title: 'Terima NDA?',
                    text: "NDA ini akan disetujui.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Terima',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-terima-' + id).submit();
                    }
                });
            }

            function konfirmasiTolak(id) {
                Swal.fire({
                    title: 'Yakin mau tolak?',
                    text: 'NDA ini akan ditolak.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Tolak!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-tolak-' + id).submit();
                    }
                });
            }
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/VMS/admin/verifikasi_nda.blade.php ENDPATH**/ ?>