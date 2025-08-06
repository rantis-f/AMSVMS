<?php $__env->startSection('title', 'Aset Fasilitas'); ?>
<?php $__env->startSection('page_title', 'Aset Fasilitas'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
            <div class="button-wrapper" style="margin-top: 20px;">
                <button class="btn btn-primary mb-3" onclick="openModal('modalTambahFasilitas')">+ Tambah Fasilitas</button>
                <button type="button" class="btn btn-primary mb-3" onclick="openModal('importModal')">Impor Data Fasilitas</button>
                <button type="button" class="btn btn-primary mb-3" onclick="openModal('exportModal')">Ekspor Data Fasilitas</button>
            </div>

        <form method="GET" action="<?php echo e(route('fasilitas.index')); ?>" id="filterForm">
            <div class="filter-container" style="margin-top: 20px;">
                <select name="kode_region[]" class="select2" multiple data-placeholder="Pilih Region" onchange="document.getElementById('filterForm').submit()">
                    <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($region->kode_region); ?>" <?php echo e(in_array($region->kode_region, request('kode_region', [])) ? 'selected' : ''); ?>>
                             <?php echo e($region->nama_region); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select name="kode_site[]" class="select2" multiple 
                        data-placeholder="Pilih Site"
                        <?php echo e(request()->filled('kode_region') ? '' : 'disabled'); ?>>
                    <?php $__currentLoopData = $filteredSites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($site->kode_site); ?>" 
                                <?php echo e(in_array($site->kode_site, request('kode_site', [])) ? 'selected' : ''); ?>>
                            <?php echo e($site->nama_site); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select name="kode_fasilitas[]" class="select2" multiple data-placeholder="Pilih Fasilitas" onchange="document.getElementById('filterForm').submit()">
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->kode_fasilitas); ?>" <?php echo e(in_array($type->kode_fasilitas, request('kode_fasilitas', [])) ? 'selected' : ''); ?>>
                            <?php echo e($type->nama_fasilitas); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </form>
        <?php endif; ?>

        <div class="table-responsive" style="margin-top: 20px;">
            <table id="fasilitasTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Hostname</th>
                        <th>Region</th>
                        <th>Site</th>
                        <th>No Rack</th>
                        <th>Fasilitas</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $datafasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fasilitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="status-box <?php echo e($fasilitas->no_rack ? 'bg-success' : 'bg-danger'); ?>"></div>
                            </td>
                            <td><?php echo e($loop->iteration); ?></td>
                                                        <td>
                                <?php echo e(implode('-', array_filter([
                                        $fasilitas->kode_region,
                                        $fasilitas->kode_site,
                                        $fasilitas->no_rack,
                                        $fasilitas->kode_fasilitas,
                                        $fasilitas->fasilitas_ke,
                                        $fasilitas->kode_brand,
                                        $fasilitas->type
                                    ]))); ?>

                            </td>
                            <td><?php echo e($fasilitas->region->nama_region); ?></td>
                            <td><?php echo e($fasilitas->site->nama_site); ?></td>
                            <td><?php echo e($fasilitas->no_rack); ?></td>
                            <td><?php echo e($fasilitas->jenisfasilitas->nama_fasilitas); ?></td>
                            <td><?php echo e(optional($fasilitas->brandfasilitas)->nama_brand); ?></td>
                            <td><?php echo e($fasilitas->type); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-eye btn-sm mb-1"
                                        onclick="openModal('modalViewFasilitas<?php echo e($fasilitas->id_fasilitas); ?>')">
                                        <i class="fas fa-eye"></i> 
                                    </button>
                                    <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
                                        <button class="btn btn-edit btn-sm mb-1"
                                            onclick="openModal('modalEditFasilitas<?php echo e($fasilitas->id_fasilitas); ?>')">
                                            <i class="fas fa-edit"></i> 
                                        </button>
                                        <button class="btn btn-delete btn-sm"
                                            onclick="confirmDelete(<?php echo e($fasilitas->id_fasilitas); ?>)">
                                            <i class="fas fa-trash-alt"></i> 
                                        </button>

                                        <form id="delete-form-<?php echo e($fasilitas->id_fasilitas); ?>"
                                            action="<?php echo e(route('fasilitas.destroy', $fasilitas->id_fasilitas)); ?>" method="POST"
                                            style="display: none;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <div id="modalViewFasilitas<?php echo e($fasilitas->id_fasilitas); ?>" class="modal">
                            <div class="modal-content">
                                <span class="close"
                                    onclick="closeModal('modalViewFasilitas<?php echo e($fasilitas->id_fasilitas); ?>')">&times;</span>
                                <h5>Detail Fasilitas</h5>

                                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                    <div style="width: 48%;">
                                        <label>Region</label>
                                        <input type="text" value="<?php echo e($fasilitas->region->nama_region); ?>" readonly
                                            class="form-control">

                                        <label>Jenis</label>
                                        <input type="text" value="<?php echo e($fasilitas->jenisfasilitas->nama_fasilitas); ?>" readonly
                                            class="form-control">

                                        <label>No Rack</label>
                                        <input type="text" value="<?php echo e($fasilitas->no_rack); ?>" readonly class="form-control">

                                        <label>U Awal - U Akhir</label>
                                        <input type="text" value="<?php echo e($fasilitas->uawal); ?> - <?php echo e($fasilitas->uakhir); ?>" readonly
                                            class="form-control">
                                        
                                        <label>Jumlah Fasilitas</label>
                                        <input type="text" value="<?php echo e($fasilitas->jml_fasilitas); ?>" readonly
                                            class="form-control">

                                        <label>Fasilitas ke-</label>
                                        <input type="text" value="<?php echo e($fasilitas->fasilitas_ke); ?>" readonly class="form-control">
                                    </div>

                                    <div style="width: 48%;">
                                        <label>Site</label>
                                        <input type="text" value="<?php echo e($fasilitas->site->nama_site); ?>" readonly class="form-control">

                                        <label>Brand</label>
                                        <input type="text" value="<?php echo e(optional($fasilitas->brandfasilitas)->nama_brand); ?>"
                                            readonly class="form-control">

                                        <label>Milik</label>
                                        <input type="text" value="<?php echo e($fasilitas->user?->name); ?>" readonly class="form-control">
                                        
                                        <label>Type</label>
                                        <input type="text" value="<?php echo e($fasilitas->type); ?>" readonly class="form-control">

                                        <label>Serial Number</label>
                                        <input type="text" value="<?php echo e($fasilitas->serialnumber); ?>" readonly class="form-control">

                                        <label>Status</label>
                                        <input type="text" value="<?php echo e($fasilitas->status); ?>" readonly class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="modalEditFasilitas<?php echo e($fasilitas->id_fasilitas); ?>" class="modal">
                            <div class="modal-content">
                                <span class="close"
                                    onclick="closeModal('modalEditFasilitas<?php echo e($fasilitas->id_fasilitas); ?>')">×</span>
                                <h5>Edit Fasilitas</h5>
                                <form action="<?php echo e(route('fasilitas.update', $fasilitas->id_fasilitas)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                        <div style="width: 48%;">
                                            <label>Region</label>
                                            <select name="kode_region" class="form-control regionSelectEdit"
                                                data-id="<?php echo e($fasilitas->id_fasilitas); ?>" required>
                                                <option value="">Pilih Region</option>
                                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($region->kode_region); ?>" <?php echo e($fasilitas->kode_region == $region->kode_region ? 'selected' : ''); ?>>
                                                        <?php echo e($region->nama_region); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label>Jenis</label>
                                            <select name="kode_fasilitas" class="form-control" required>
                                                <option value="">Pilih Fasilitas</option>
                                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenisfasilitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($jenisfasilitas->kode_fasilitas); ?>" <?php echo e($fasilitas->kode_fasilitas == $jenisfasilitas->kode_fasilitas ? 'selected' : ''); ?>>
                                                        <?php echo e($jenisfasilitas->nama_fasilitas); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label>No Rack</label>
                                            <select name="no_rack" class="form-control noRackSelectEdit"
                                                data-id="<?php echo e($fasilitas->id_fasilitas); ?>">
                                                <option value="">Pilih No Rack</option>
                                                <?php $__currentLoopData = $racks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($rack->kode_region == $fasilitas->kode_region && $rack->kode_site == $fasilitas->kode_site): ?>
                                                        <option value="<?php echo e($rack->no_rack); ?>" <?php echo e($fasilitas->no_rack == $rack->no_rack ? 'selected' : ''); ?>>
                                                            <?php echo e($rack->no_rack); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label>U Awal</label>
                                            <input type="number" name="uawal" class="form-control"
                                                value="<?php echo e($fasilitas->uawal ?? ''); ?>">

                                            <label>U Akhir</label>
                                            <input type="number" name="uakhir" class="form-control"
                                                value="<?php echo e($fasilitas->uakhir ?? ''); ?>">
                                            
                                            <label>Jumlah Fasilitas</label>
                                            <input type="text" name="jml_fasilitas" class="form-control"
                                                value="<?php echo e($fasilitas->jml_fasilitas ?? ''); ?>">
                                        </div>

                                        <div style="width: 48%;">
                                            <label>Site</label>
                                            <select name="kode_site" class="form-control siteSelectEdit"
                                                data-id="<?php echo e($fasilitas->id_fasilitas); ?>" required>
                                                <option value="">Pilih Site</option>
                                                <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($site->kode_region == $fasilitas->kode_region): ?>
                                                        <option value="<?php echo e($site->kode_site); ?>" <?php echo e($fasilitas->kode_site == $site->kode_site ? 'selected' : ''); ?>>
                                                            <?php echo e($site->nama_site); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label>Brand</label>
                                            <select name="kode_brand" class="form-control">
                                                <option value="">Pilih Brand</option>
                                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandfasilitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($brandfasilitas->kode_brand); ?>" <?php echo e($fasilitas->kode_brand == $brandfasilitas->kode_brand ? 'selected' : ''); ?>>
                                                        <?php echo e($brandfasilitas->nama_brand); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label>Milik</label>
                                            <select name="milik" class="form-control" required>
                                                <option value="">Pilih Kepemilikan</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($milik->id); ?>" <?php echo e($fasilitas->milik == $milik->id ? 'selected' : ''); ?>>
                                                        <?php echo e($milik->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label>Type</label>
                                            <input type="text" name="type" class="form-control"
                                                value="<?php echo e($fasilitas->type ?? ''); ?>">

                                            <label>Serial Number</label>
                                            <input type="text" name="serialnumber" class="form-control"
                                                value="<?php echo e($fasilitas->serialnumber ?? ''); ?>">

                                            <label>Status</label>
                                            <input type="text" name="status" class="form-control"
                                                value="<?php echo e($fasilitas->status ?? ''); ?>">                                       
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div id="importModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('importModal')">&times;</span>
                <h5>Impor Data Fasilitas</h5>
                <form action="<?php echo e(route('import.fasilitas')); ?>" method="POST" enctype="multipart/form-data">
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
                <span class="close" onclick="closeModal('exportModal')">&times;</span>
                <h5>Ekspor Data Fasilitas</h5>
                <form id="exportForm" action="<?php echo e(url('export/fasilitas')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="regions">Pilih Region:</label>
                        <div id="regions">
                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="regions[]"
                                        value="<?php echo e($region['kode_region']); ?>" id="region-<?php echo e($loop->index); ?>">
                                    <a class="form-check-label" for="region-<?php echo e($loop->index); ?>">
                                        <?php echo e($region['nama_region']); ?>

                                    </a>
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

        <div id="modalTambahFasilitas" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modalTambahFasilitas')">&times;</span>
                <h5>Tambah Fasilitas</h5>
                <form action="<?php echo e(route('fasilitas.store')); ?>" method="POST" id="formTambahFasilitas">
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
                            <select name="kode_fasilitas" class="form-control" required>
                                <option value="">Pilih Fasilitas</option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenisfasilitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jenisfasilitas->kode_fasilitas); ?>">
                                        <?php echo e($jenisfasilitas->nama_fasilitas); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <div class="mb-3">
                                <label>No Rack</label>
                                <select id="noRackSelectTambah" name="no_rack" class="form-control" disabled>
                                    <option value="">Pilih Rack</option>
                                </select>
                            </div>
                            
                            <label>U Awal</label>
                            <input type="number" name="uawal" class="form-control" value="" id="uawal">

                            <label>U Akhir</label>
                            <input type="number" name="uakhir" class="form-control" value="" id="uakhir">

                            <label>Jumlah Fasilitas</label>
                            <input type="text" name="jml_fasilitas" class="form-control" value="">
                        </div>

                        <div style="width: 48%;">
                            <div class="mb-3">
                                <label>Site</label>
                                <select id="siteSelectTambah" name="kode_site" class="form-control" required disabled>
                                    <option value="">Pilih Site</option>
                                </select>
                            </div>

                            <label>Brand</label>
                            <select name="kode_brand" class="form-control">
                                <option value="">Pilih Brand</option>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandfasilitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($brandfasilitas->kode_brand); ?>">
                                        <?php echo e($brandfasilitas->nama_brand); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <div class="mb-3">
                                <label>Milik</label>
                                <select name="milik" class="form-control" required>
                                    <option value="">Pilih Kepemilikan</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <label>Type</label>
                            <input type="text" name="type" class="form-control" value="">

                            <label>Serial Number</label>
                            <input type="text" name="serialnumber" class="form-control" value="">

                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    

    <?php $__env->startSection('scripts'); ?>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                    placeholder: function() {
                        return $(this).data('placeholder');
                    },
                    allowClear: true
                });

                $('select[name="kode_region[]"]').on('change', function() {
                    const selectedRegions = $(this).val();
                    const siteSelect = $('select[name="kode_site[]"]');
                    const currentlySelectedSites = siteSelect.val(); // Store current selections
                    
                    siteSelect.empty().prop('disabled', true);
                    
                    if (selectedRegions && selectedRegions.length > 0) {
                        siteSelect.prop('disabled', false);
                        
                        const sites = <?php echo json_encode($sites, 15, 512) ?>;
                        const filteredSites = sites.filter(site => 
                            selectedRegions.includes(site.kode_region)
                        );
                        
                        filteredSites.forEach(site => {
                            const option = new Option(site.nama_site, site.kode_site);
                            siteSelect.append(option);
                        });

                        if (currentlySelectedSites) {
                            const validSites = currentlySelectedSites.filter(site => 
                                filteredSites.some(fs => fs.kode_site === site)
                            );
                            siteSelect.val(validSites);
                        }
                    }
                    
                    siteSelect.select2({
                        width: '100%',
                        placeholder: 'Pilih Site',
                        allowClear: true
                    });

                    $('#filterForm').submit();
                });

                $('select[name="kode_site[]"]').on('change', function() {
                    $('#filterForm').submit();
                });

                $('select[name="kode_fasilitas[]"]').on('change', function() {
                    $('#filterForm').submit();
                });

                $('#fasilitasTable').DataTable({
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
                        { targets: [0, 9], orderable: false }
                    ]
                });
            });

            document.getElementById('regionSelectTambah').addEventListener('change', function () {
                const regionId = this.value;
                const siteSelect = document.getElementById('siteSelectTambah');

                siteSelect.innerHTML = '<option value="">Pilih Site</option>';
                siteSelect.disabled = true;

                if (regionId) {
                    siteSelect.disabled = false;
                    const sites = <?php echo json_encode($sites, 15, 512) ?>;
                    const filteredSites = sites.filter(site => site.kode_region == regionId);

                    filteredSites.forEach(site => {
                        const option = document.createElement('option');
                        option.value = site.kode_site;
                        option.textContent = site.nama_site;
                        siteSelect.appendChild(option);
                    });
                }
            });

            document.getElementById('siteSelectTambah').addEventListener('change', function () {
                const siteId = this.value;
                const regionId = document.getElementById('regionSelectTambah').value;
                const rackSelect = document.getElementById('noRackSelectTambah');

                rackSelect.innerHTML = '<option value="">Pilih Rack</option>';
                rackSelect.disabled = true;

                if (regionId && siteId) {
                    rackSelect.disabled = false;

                    const racks = <?php echo json_encode($racks, 15, 512) ?>; 
                    const filteredRacks = racks.filter(rack => rack.kode_region == regionId && rack.kode_site == siteId);

                    filteredRacks.forEach(rack => {
                        const option = document.createElement('option');
                        option.value = rack.no_rack;
                        option.textContent = rack.no_rack;
                        rackSelect.appendChild(option);
                    });
                }
            });

            document.querySelectorAll('.regionSelectEdit').forEach(select => {
                select.addEventListener('change', function () {
                    const regionId = this.value;
                    const fasilitasId = this.getAttribute('data-id');
                    const siteSelect = document.querySelector(`.siteSelectEdit[data-id="${fasilitasId}"]`);
                    const rackSelect = document.querySelector(`.noRackSelectEdit[data-id="${fasilitasId}"]`);

                    siteSelect.innerHTML = '<option value="">Pilih Site</option>';
                    rackSelect.innerHTML = '<option value="">Pilih No Rack</option>';
                    siteSelect.disabled = true;
                    rackSelect.disabled = true;

                    if (regionId) {
                        siteSelect.disabled = false;
                        const sites = <?php echo json_encode($sites, 15, 512) ?>;
                        const filteredSites = sites.filter(site => site.kode_region == regionId);

                        filteredSites.forEach(site => {
                            const option = document.createElement('option');
                            option.value = site.kode_site;
                            option.textContent = site.nama_site;
                            siteSelect.appendChild(option);
                        });
                    }
                });
            });

            document.querySelectorAll('.siteSelectEdit').forEach(select => {
                select.addEventListener('change', function () {
                    const siteId = this.value;
                    const fasilitasId = this.getAttribute('data-id');
                    const regionId = document.querySelector(`.regionSelectEdit[data-id="${fasilitasId}"]`).value;
                    const rackSelect = document.querySelector(`.noRackSelectEdit[data-id="${fasilitasId}"]`);

                    rackSelect.innerHTML = '<option value="">Pilih No Rack</option>';
                    rackSelect.disabled = true;

                    if (regionId && siteId) {
                        rackSelect.disabled = false;
                        const racks = <?php echo json_encode($racks, 15, 512) ?>;
                        const filteredRacks = racks.filter(rack => rack.kode_region == regionId && rack.kode_site == siteId);

                        filteredRacks.forEach(rack => {
                            const option = document.createElement('option');
                            option.value = rack.no_rack;
                            option.textContent = rack.no_rack;
                            rackSelect.appendChild(option);
                        });
                    }
                });
            });

            document.getElementById('no_rack').addEventListener('input', function () {
                const noRack = this.value;
                const uawalField = document.getElementById('uawal');
                const uakhirField = document.getElementById('uakhir');

                if (noRack) {
                    uawalField.setAttribute('required', 'required');
                    uakhirField.setAttribute('required', 'required');
                } else {
                    uawalField.removeAttribute('required');
                    uakhirField.removeAttribute('required');
                }
            });

            document.getElementById('formTambahFasilitas').addEventListener('submit', function (event) {
                const uawal = parseFloat(document.getElementById('uawal').value);
                const uakhir = parseFloat(document.getElementById('uakhir').value);

                if (uawal >= uakhir) {
                    alert('U Awal harus lebih kecil dari U Akhir.');
                    event.preventDefault();
                }

                if (uawal < 0 || uakhir < 0) {
                    alert('U Awal dan U Akhir tidak boleh bernilai negatif.');
                    event.preventDefault();
                }
            });

            document.querySelectorAll('form[action*="fasilitas/update"]').forEach(form => {
                form.addEventListener('submit', function (event) {
                    const uawal = parseFloat(this.querySelector('input[name="uawal"]').value);
                    const uakhir = parseFloat(this.querySelector('input[name="uakhir"]').value);
                    const noRack = this.querySelector('select[name="no_rack"]').value;

                    if (noRack && (!uawal || !uakhir)) {
                        alert('U Awal dan U Akhir wajib diisi jika No Rack diisi.');
                        event.preventDefault();
                        return;
                    }

                    if (uawal >= uakhir) {
                        alert('U Awal harus lebih kecil dari U Akhir.');
                        event.preventDefault();
                    }

                    if (uawal < 0 || uakhir < 0) {
                        alert('U Awal dan U Akhir tidak boleh bernilai negatif.');
                        event.preventDefault();
                    }
                });
            });

            document.getElementById('exportForm').addEventListener('submit', function (e) {
                e.preventDefault(); // Biar gak reload halaman

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
                        return response.blob(); // Misalnya kamu kirim file
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

                        // Kalau ingin langsung download file:
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        const format = formData.get('format');
                        a.download = `datafasilitas.${format === 'pdf' ? 'pdf' : 'xlsx'}`;
                        a.click();
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: error.message
                        });
                    });
            });

            function closeModal(id) {
                const modal = document.getElementById(id);
                if (modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/aset/fasilitas.blade.php ENDPATH**/ ?>