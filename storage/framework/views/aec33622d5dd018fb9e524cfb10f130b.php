<?php $__env->startSection('title', 'Aset Jaringan'); ?>
<?php $__env->startSection('page_title', 'Aset Jaringan'); ?>


<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
            <div class="button-wrapper" style="margin-top: 20px;">
                <button class="btn btn-primary mb-3" onclick="openModal('modalTambahJaringan')">+ Tambah Jaringan</button>
                <button type="button" class="btn btn-primary mb-3" onclick="openModal('importModal')">Impor Data Jaringan</button>
                <button type="button" class="btn btn-primary mb-3" onclick="openModal('exportModal')">Ekspor Data Jaringan</button>
            </div>

            <form method="GET" action="<?php echo e(route('jaringan.index')); ?>" id="filterForm">
                <div class="filter-container" style="margin-top: 20px;">
                    <select name="kode_region[]" class="select2" multiple data-placeholder="Pilih Region"
                        onchange="document.getElementById('filterForm').submit()">
                        <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($region->kode_region); ?>" <?php echo e(in_array($region->kode_region, request('kode_region', [])) ? 'selected' : ''); ?>>
                                <?php echo e($region->nama_region); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <select name="kode_tipejaringan[]" class="select2" multiple data-placeholder="Pilih Tipe Jaringan"
                        onchange="document.getElementById('filterForm').submit()">
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->kode_tipejaringan); ?>" <?php echo e(in_array($type->kode_tipejaringan, request('kode_tipejaringan', [])) ? 'selected' : ''); ?>>
                                <?php echo e($type->nama_tipejaringan); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </form>
        <?php endif; ?>

        <div class="table-responsive" style="margin-top: 20px;">
            <table id="jaringanTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Region</th>
                        <th>Tipe Jaringan</th>
                        <th>Segmen</th>
                        <th>Panjang</th>
                        <th>Jenis Kabel</th>
                        <th>Tipe Kabel</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $datajaringan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jaringan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($jaringan->region ? $jaringan->region->nama_region : 'Region Tidak Ditemukan'); ?></td>
                            <td><?php echo e($jaringan->tipejaringan ? $jaringan->tipejaringan->nama_tipejaringan : 'Tipe Tidak Ditemukan'); ?>

                            </td>
                            <td><?php echo e($jaringan->segmen); ?></td>
                            <td><?php echo e($jaringan->panjang); ?></td>
                            <td><?php echo e($jaringan->jenis_kabel); ?></td>
                            <td><?php echo e($jaringan->tipe_kabel); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-eye btn-sm mb-1"
                                        onclick="openModal('modalViewJaringan<?php echo e($jaringan->id_jaringan); ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
                                        <button class="btn btn-edit btn-sm mb-1"
                                            onclick="openModal('modalEditJaringan<?php echo e($jaringan->id_jaringan); ?>')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-delete btn-sm" onclick="confirmDelete(<?php echo e($jaringan->id_jaringan); ?>)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <form id="delete-form-<?php echo e($jaringan->id_jaringan); ?>"
                                            action="<?php echo e(route('jaringan.destroy', $jaringan->id_jaringan)); ?>" method="POST"
                                            style="display: none;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>

                        <div id="modalViewJaringan<?php echo e($jaringan->id_jaringan); ?>" class="modal">
                            <div class="modal-content jaringan">
                                <span class="close"
                                    onclick="closeModal('modalViewJaringan<?php echo e($jaringan->id_jaringan); ?>')">×</span>
                                <h5>Detail Jaringan</h5>
                                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                    <div style="display: flex; gap: 10px;">
                                        <div style="width: 32%;">
                                            <label>Region</label>
                                            <input type="text"
                                                value="<?php echo e($jaringan->region ? $jaringan->region->nama_region : 'N/A'); ?>"
                                                readonly class="form-control">
                                            <label>Kode Site Insan</label>
                                            <input type="text" value="<?php echo e($jaringan->kode_site_insan ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                            <label>Panjang</label>
                                            <input type="text" value="<?php echo e($jaringan->panjang ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                            <label>Tipe Kabel</label>
                                            <input type="text" value="<?php echo e($jaringan->tipe_kabel ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                            <label>DCI EQX</label>
                                            <input type="text" value="<?php echo e($jaringan->dci_eqx ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                        </div>

                                        <div style="width: 32.5%;">
                                            <label>Tipe Jaringan</label>
                                            <input type="text"
                                                value="<?php echo e($jaringan->tipejaringan ? $jaringan->tipejaringan->nama_tipejaringan : 'N/A'); ?>"
                                                readonly class="form-control">
                                            <label>Jartatup Jartaplok</label>
                                            <input type="text" value="<?php echo e($jaringan->jartatup_jartaplok ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                            <label>Panjang Drawing</label>
                                            <input type="text" value="<?php echo e($jaringan->panjang_drawing ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                            <label>Jenis Kabel</label>
                                            <input type="text" value="<?php echo e($jaringan->jenis_kabel ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                            <label>Status</label>
                                            <input type="text" value="<?php echo e($jaringan->status ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                        </div>

                                        <div style="width: 32%;">
                                            <label>Milik</label>
                                            <input type="text" value="<?php echo e($jaringan->milik ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                            <label>Segmen</label>
                                            <textarea readonly class="form-control"
                                                style="resize:none; max-height: 44.5px; padding: 5px; margin-bottom: 10.5px;"><?php echo e($jaringan->segmen ?? 'N/A'); ?></textarea>
                                            <label>Jumlah Core</label>
                                            <input type="text" value="<?php echo e($jaringan->jumlah_core ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                            <label>Keterangan</label>
                                            <input type="text" value="<?php echo e($jaringan->keterangan ?? 'N/A'); ?>" readonly
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit Jaringan -->
                        <div id="modalEditJaringan<?php echo e($jaringan->id_jaringan); ?>" class="modal">
                            <div class="modal-content jaringan">
                                <span class="close"
                                    onclick="closeModal('modalEditJaringan<?php echo e($jaringan->id_jaringan); ?>')">×</span>
                                <h5>Edit Jaringan</h5>
                                <form action="<?php echo e(route('jaringan.update', $jaringan->id_jaringan)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                        <div style="width: 32%;">
                                            <label>Kode Region</label>
                                            <select name="kode_region" class="form-control" required>
                                                <option value="">Pilih Region</option>
                                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($region->kode_region); ?>" <?php echo e($jaringan->kode_region == $region->kode_region ? 'selected' : ''); ?>>
                                                        <?php echo e($region->nama_region); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label>Kode Site Insan</label>
                                            <input type="text" name="kode_site_insan" class="form-control"
                                                value="<?php echo e($jaringan->kode_site_insan ?? ''); ?>">

                                            <label>Panjang</label>
                                            <input type="text" name="panjang" class="form-control"
                                                value="<?php echo e($jaringan->panjang ?? ''); ?>">

                                            <label>Tipe Kabel</label>
                                            <input type="text" name="tipe_kabel" class="form-control"
                                                value="<?php echo e($jaringan->tipe_kabel ?? ''); ?>">

                                            <label>DCI EQX</label>
                                            <input type="text" name="dci_eqx" class="form-control"
                                                value="<?php echo e($jaringan->dci_eqx ?? ''); ?>">
                                        </div>

                                        <div style="width: 32.5%;">
                                            <label>Kode Tipe Jaringan</label>
                                            <select name="kode_tipejaringan" class="form-control" required>
                                                <option value="">Pilih Tipe Jaringan</option>
                                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($type->kode_tipejaringan); ?>" <?php echo e($jaringan->kode_tipejaringan == $type->kode_tipejaringan ? 'selected' : ''); ?>>
                                                        <?php echo e($type->nama_tipejaringan); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label>Jartatup Jartaplok</label>
                                            <input type="text" name="jartatup_jartaplok" class="form-control"
                                                value="<?php echo e($jaringan->jartatup_jartaplok ?? ''); ?>">
                                            <label>Panjang Drawing</label>
                                            <input type="text" name="panjang_drawing" class="form-control"
                                                value="<?php echo e($jaringan->panjang_drawing ?? ''); ?>">
                                            <label>Jenis Kabel</label>
                                            <input type="text" name="jenis_kabel" class="form-control"
                                                value="<?php echo e($jaringan->jenis_kabel ?? ''); ?>">
                                            <label>Status</label>
                                            <input type="text" name="status" class="form-control"
                                                value="<?php echo e($jaringan->status ?? ''); ?>">
                                        </div>

                                        <div style="width: 32%;">
                                            <label>Milik</label>
                                            <select name="milik" class="form-control" required>
                                                <option value="">Pilih Kepemilikan</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($milik->id); ?>" <?php echo e($jaringan->milik == $milik->id ? 'selected' : ''); ?>>
                                                        <?php echo e($milik->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label>Segmen</label>
                                            <input type="text" name="segmen" class="form-control"
                                                value="<?php echo e($jaringan->segmen ?? ''); ?>">
                                            <label>Jumlah Core</label>
                                            <input type="text" name="jumlah_core" class="form-control"
                                                value="<?php echo e($jaringan->jumlah_core ?? ''); ?>">
                                            <label>Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control"
                                                value="<?php echo e($jaringan->keterangan ?? ''); ?>">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah Jaringan -->
        <div id="modalTambahJaringan" class="modal">
            <div class="modal-content jaringan">
                <span class="close" onclick="closeModal('modalTambahJaringan')">×</span>
                <h5>Tambah Jaringan</h5>
                <form action="<?php echo e(route('jaringan.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <div style="width: 32%;">
                            <label>Kode Region</label>
                            <select name="kode_region" class="form-control" required>
                                <option value="">Pilih Region</option>
                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($region->kode_region); ?>"><?php echo e($region->nama_region); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label>Kode Site Insan</label>
                            <input type="text" name="kode_site_insan" class="form-control">

                            <label>Panjang</label>
                            <input type="text" name="panjang" class="form-control">

                            <label>Tipe Kabel</label>
                            <input type="text" name="tipe_kabel" class="form-control">

                            <label>DCI EQX</label>
                            <input type="text" name="dci_eqx" class="form-control">
                        </div>

                        <div style="width: 32%;">

                            <label>Kode Tipe Jaringan</label>
                            <select name="kode_tipejaringan" class="form-control" required>
                                <option value="">Pilih Tipe Jaringan</option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->kode_tipejaringan); ?>"><?php echo e($type->nama_tipejaringan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label>Jartatup Jartaplok</label>
                            <input type="text" name="jartatup_jartaplok" class="form-control">

                            <label>Panjang Drawing</label>
                            <input type="text" name="panjang_drawing" class="form-control">

                            <label>Jenis Kabel</label>
                            <input type="text" name="jenis_kabel" class="form-control">

                            <label>Status</label>
                            <input type="text" name="status" class="form-control">
                        </div>

                        <div style="width: 32%;">
                            <label>Milik</label>
                            <select name="milik" class="form-control" required>
                                <option value="">Pilih Kepemilikan</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label>Segmen</label>
                            <input type="text" name="segmen" class="form-control" required>

                            <label>Jumlah Core</label>
                            <input type="text" name="jumlah_core" class="form-control">

                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                </form>
            </div>
        </div>

        <div id="importModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('importModal')">×</span>
                <h5>Impor Data Jaringan</h5>
                <form action="<?php echo e(route('import.jaringan')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="file">Pilih File (XLSX)</label>
                        <input type="file" class="form-control" name="file" accept=".xlsx,.xls,.csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Impor Data</button>
                </form>
            </div>
        </div>

        <!-- Modal Ekspor Data -->
        <div id="exportModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('exportModal')">×</span>
                <h5>Ekspor Data Jaringan</h5>
                <form id="exportForm" action="<?php echo e(url('export/jaringan')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="regions">Pilih Region:</label>
                        <div id="regions">
                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="regions[]"
                                        value="<?php echo e($region->kode_region); ?>" id="region-<?php echo e($loop->index); ?>">
                                    <label class="form-check-label" for="region-<?php echo e($loop->index); ?>">
                                        <?php echo e($region->nama_region); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="format">Pilih Format File:</label>
                            <select name="format" id="format" class="form-select" required>
                                <option value="excel">Excel (.xlsx)</option>
                                <option value="pdf">PDF (.pdf)</option>
                            </select>
                        </div>
                        <small class="text-muted">*Jika tidak memilih, semua data region akan diekspor.</small>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 15px;">Ekspor</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('#jaringanTable').DataTable({
                language: {
                    search: "Cari",
                    lengthMenu: "_MENU_",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "<i class='fas fa-arrow-right'></i>",
                        previous: "<i class='fas fa-arrow-left'></i>"
                    }
                },
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
                order: [],
                columnDefs: [
                    { targets: [7], orderable: false }
                ]
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/aset/jaringan.blade.php ENDPATH**/ ?>