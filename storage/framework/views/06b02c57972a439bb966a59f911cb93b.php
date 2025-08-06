<?php $__env->startSection('title', 'Aset Alatukur'); ?>
<?php $__env->startSection('page_title', 'Aset Alatukur'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
            <div class="button-wrapper" style="margin-top: 20px;">
                <button class="btn btn-primary mb-3" onclick="openModal('modalTambahAlatukur')">+ Tambah Alatukur</button>
                <button type="button" class="btn btn-primary mb-3" onclick="openModal('importModal')">Impor Data Alatukur</button>
                <button type="button" class="btn btn-primary mb-3" onclick="openModal('exportModal')">Ekspor Data Alatukur</button>
            </div>

            <form method="GET" action="<?php echo e(route('alatukur.index')); ?>" id="filterForm">
                <div class="filter-container" style="margin-top: 20px;">
                    <select name="kode_region[]" class="select2" multiple data-placeholder="Pilih Region" onchange="document.getElementById('filterForm').submit()">
                        <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($region->kode_region); ?>" <?php echo e(in_array($region->kode_region, request('kode_region', [])) ? 'selected' : ''); ?>>
                                <?php echo e($region->nama_region); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <select name="kode_alatukur[]" class="select2" multiple data-placeholder="Pilih Alatukur" onchange="document.getElementById('filterForm').submit()">
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->kode_alatukur); ?>" <?php echo e(in_array($type->kode_alatukur, request('kode_alatukur', [])) ? 'selected' : ''); ?>>
                                <?php echo e($type->nama_alatukur); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </form>
        <?php endif; ?>

        <div class="table-responsive" style="margin-top: 20px;">
            <table id="alatukurTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Region</th>
                        <th>Alatukur</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Serial Number</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $dataalatukur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alatukur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($alatukur->region->nama_region); ?></td>
                            <td><?php echo e($alatukur->jenisalatukur->nama_alatukur); ?></td>
                            <td><?php echo e(optional($alatukur->brandalatukur)->nama_brand); ?></td>
                            <td><?php echo e($alatukur->type); ?></td>
                            <td><?php echo e($alatukur->serialnumber); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-eye btn-sm mb-1" onclick="openModal('modalViewAlatukur<?php echo e($alatukur->id_alatukur); ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
                                        <button class="btn btn-edit btn-sm mb-1" onclick="openModal('modalEditAlatukur<?php echo e($alatukur->id_alatukur); ?>')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-delete btn-sm" onclick="confirmDelete(<?php echo e($alatukur->id_alatukur); ?>)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <form id="delete-form-<?php echo e($alatukur->id_alatukur); ?>" action="<?php echo e(route('alatukur.destroy', $alatukur->id_alatukur)); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>

                        <div id="modalViewAlatukur<?php echo e($alatukur->id_alatukur); ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('modalViewAlatukur<?php echo e($alatukur->id_alatukur); ?>')">×</span>
                                <h5>Detail Alatukur</h5>
                                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                    <div style="width: 48%;">
                                        <label>Region</label>
                                        <input type="text" value="<?php echo e($alatukur->region->nama_region); ?>" readonly class="form-control">
                                        <label>Jenis</label>
                                        <input type="text" value="<?php echo e($alatukur->jenisalatukur->nama_alatukur); ?>" readonly class="form-control">
                                        <label>Type</label>
                                        <input type="text" value="<?php echo e($alatukur->type); ?>" readonly class="form-control">
                                        <label>Kondisi</label>
                                        <input type="text" value="<?php echo e($alatukur->kondisi); ?>" readonly class="form-control">                                 
                                        <label>Keterangan</label>
                                        <input type="text" value="<?php echo e($alatukur->keterangan); ?>" readonly class="form-control">
                                    </div>
                                    <div style="width: 48%;">
                                        <label>Milik</label>
                                        <input type="text" value="<?php echo e(optional($alatukur->user)->name); ?>" readonly class="form-control">
                                        <label>Brand</label>
                                        <input type="text" value="<?php echo e(optional($alatukur->brandalatukur)->nama_brand); ?>" readonly class="form-control">
                                        <label>Serial Number</label>
                                        <input type="text" value="<?php echo e($alatukur->serialnumber); ?>" readonly class="form-control">
                                        <label>Tahun Perolehan</label>
                                        <input type="text" value="<?php echo e($alatukur->tahunperolehan); ?>" readonly class="form-control">
                                        <label>Alatukur ke-</label>
                                        <input type="text" value="<?php echo e($alatukur->alatukur_ke); ?>" readonly class="form-control">   
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="modalEditAlatukur<?php echo e($alatukur->id_alatukur); ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('modalEditAlatukur<?php echo e($alatukur->id_alatukur); ?>')">×</span>
                                <h5>Edit Alatukur</h5>
                                <form action="<?php echo e(route('alatukur.update', $alatukur->id_alatukur)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                        <div style="width: 48%;">
                                            <label>Region</label>
                                            <select name="kode_region" class="form-control regionSelectEdit" data-id="<?php echo e($alatukur->id_alatukur); ?>" required>
                                                <option value="">Pilih Region</option>
                                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($region->kode_region); ?>" <?php echo e($alatukur->kode_region == $region->kode_region ? 'selected' : ''); ?>>
                                                        <?php echo e($region->nama_region); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label>Jenis</label>
                                            <select name="kode_alatukur" class="form-control" required>
                                                <option value="">Pilih Alatukur</option>
                                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenisalatukur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($jenisalatukur->kode_alatukur); ?>" <?php echo e($alatukur->kode_alatukur == $jenisalatukur->kode_alatukur ? 'selected' : ''); ?>>
                                                        <?php echo e($jenisalatukur->nama_alatukur); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label>Type</label>
                                            <input type="text" name="type" class="form-control" value="<?php echo e($alatukur->type ?? ''); ?>">
                                            <label>Kondisi</label>
                                            <input type="text" name="kondisi" class="form-control" value="<?php echo e($alatukur->kondisi ?? ''); ?>">
                                            <label>Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control" value="<?php echo e($alatukur->keterangan ?? ''); ?>">
                                        </div>
                                        <div style="width: 48%;">
                                            <label>Milik</label>
                                            <select name="milik" class="form-control" required>
                                                <option value="">Pilih Kepemilikan</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($milik->id); ?>" <?php echo e($alatukur->milik == $milik->id ? 'selected' : ''); ?>>
                                                        <?php echo e($milik->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label>Brand</label>
                                            <select name="kode_brand" class="form-control">
                                                <option value="">Pilih Brand</option>
                                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandalatukur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($brandalatukur->kode_brand); ?>" <?php echo e($alatukur->kode_brand == $brandalatukur->kode_brand ? 'selected' : ''); ?>>
                                                        <?php echo e($brandalatukur->nama_brand); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label>Serial Number</label>
                                            <input type="text" name="serialnumber" class="form-control" value="<?php echo e($alatukur->serialnumber ?? ''); ?>">
                                            <label>Tahun Perolehan</label>
                                            <input type="text" name="tahunperolehan" class="form-control" value="<?php echo e($alatukur->tahunperolehan ?? ''); ?>">
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

        <div id="importModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('importModal')">×</span>
                <h5>Impor Data Alatukur</h5>
                <form action="<?php echo e(route('import.alatukur')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="file">Pilih File (XLSX)</label>
                        <input type="file" class="form-control" name="file" accept=".xlsx,.xls,.csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Impor Data</button>
                </form>
            </div>
        </div>

        <div id="exportModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('exportModal')">×</span>
                <h5>Ekspor Data Alatukur</h5>
                <form id="exportForm" action="<?php echo e(url('export/alatukur')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="regions">Pilih Region:</label>
                        <div id="regions">
                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="regions[]" value="<?php echo e($region->kode_region); ?>" id="region-<?php echo e($loop->index); ?>">
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

        <div id="modalTambahAlatukur" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modalTambahAlatukur')">×</span>
                <h5>Tambah Alatukur</h5>
                <form action="<?php echo e(route('alatukur.store')); ?>" method="POST" id="formTambahAlatukur">
                    <?php echo csrf_field(); ?>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <div style="width: 48%;">
                            <label>Region</label>
                            <select id="regionSelectTambah" name="kode_region" class="form-control" required>
                                <option value="">Pilih Region</option>
                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($region->kode_region); ?>"><?php echo e($region->nama_region); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label>Jenis</label>
                            <select name="kode_alatukur" class="form-control" required>
                                <option value="">Pilih Alatukur</option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenisalatukur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jenisalatukur->kode_alatukur); ?>"><?php echo e($jenisalatukur->nama_alatukur); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" value="">
                            <label>Kondisi</label>
                            <input type="text" name="kondisi" class="form-control" value="">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="">
                        </div>
                        <div style="width: 48%;">
                            <label>Milik</label>
                            <select name="milik" class="form-control" required>
                                <option value="">Pilih Kepemilikan</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label>Brand</label>
                            <select name="kode_brand" class="form-control">
                                <option value="">Pilih Brand</option>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandalatukur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($brandalatukur->kode_brand); ?>"><?php echo e($brandalatukur->nama_brand); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label>Serial Number</label>
                            <input type="text" name="serialnumber" class="form-control" value="">
                            <label>Tahun Perolehan</label>
                            <input type="text" name="tahunperolehan" class="form-control" value="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
   <script>
        $(document).ready(function () {
            // Initialize Select2
            $('.select2').select2({
                width: '100%',
                placeholder: function () {
                    return $(this).data('placeholder');
                },
                allowClear: true
            });

            $('select[name="kode_region[]"], select[name="kode_alatukur[]"]').on('change', function () {
                $('#filterForm').submit();
            });

            $('select[name="kode_fasilitas[]"]').on('change', function() {
                    $('#filterForm').submit();
                });

            $('#alatukurTable').DataTable({
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
                columnDefs: [
                    { targets: [6], orderable: false }
                ]
            });

            document.getElementById('exportForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal ekspor data!');
                        }
                        return response.blob();
                    })
                    .then(blob => {
                        closeModal('exportModal');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil diekspor!',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        const format = formData.get('format');
                        a.download = `dataalatukur.${format === 'pdf' ? 'pdf' : 'xlsx'}`;
                        a.click();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: error.message
                        });
                    });
            });

            document.getElementById('formTambahAlatukur').addEventListener('submit', function (event) {
                const tahunPerolehan = this.querySelector('input[name="tahunperolehan"]').value;
                const serialNumber = this.querySelector('input[name="serialnumber"]').value;

                if (tahunPerolehan && !/^\d{4}$/.test(tahunPerolehan)) {
                    alert('Tahun Perolehan harus berupa 4 digit angka.');
                    event.preventDefault();
                    return;
                }

                if (serialNumber && serialNumber.length > 50) {
                    alert('Serial Number tidak boleh lebih dari 50 karakter.');
                    event.preventDefault();
                    return;
                }
            });

            document.querySelectorAll('form[action*="alatukur/update"]').forEach(form => {
                form.addEventListener('submit', function (event) {
                    const tahunPerolehan = this.querySelector('input[name="tahunperolehan"]').value;
                    const serialNumber = this.querySelector('input[name="serialnumber"]').value;

                    if (tahunPerolehan && !/^\d{4}$/.test(tahunPerolehan)) {
                        alert('Tahun Perolehan harus berupa 4 digit angka.');
                        event.preventDefault();
                        return;
                    }

                    if (serialNumber && serialNumber.length > 50) {
                        alert('Serial Number tidak boleh lebih dari 50 karakter.');
                        event.preventDefault();
                        return;
                    }
                });
            });

            function closeModal(id) {
                const modal = document.getElementById(id);
                if (modal) {
                    modal.style.display = 'none';
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/aset/alatukur.blade.php ENDPATH**/ ?>