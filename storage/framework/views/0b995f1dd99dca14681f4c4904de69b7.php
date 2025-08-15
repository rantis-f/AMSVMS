

<?php $__env->startSection('title', 'Data POP'); ?>
<?php $__env->startSection('page_title', $pageTitle ?? 'Data POP'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <div style="display: flex; gap: 10px; margin-top: 20px; margin-bottom: 20px;"></div>
        <div class="card-grid">
            <?php
                $filterJenis = request()->query('jenis') ? strtolower(request()->query('jenis')) : null;
            ?>

            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // Filter sites sesuai jenis
                    $filteredSites = collect($region->sites)->filter(function ($site) use ($filterJenis) {
                        if (!$filterJenis) {
                            return true; // tidak ada filter → semua tampil
                        }
                        if ($filterJenis === 'pop') {
                            return in_array(strtolower($site->jenis_site), ['pop', 'collocation']);
                        }
                        return strtolower($site->jenis_site) === $filterJenis;
                    });

                    // Skip region kalau tidak ada site yang sesuai filter
                    if ($filteredSites->isEmpty()) {
                        continue;
                    }
                ?>

                <div class="toggle">
                    <div class="card-item">
                        <div class="card-content">
                            <h4><?php echo e($region->nama_region); ?></h4>
                            <p><?php echo e($region->email); ?></p>
                            <p><?php echo e($region->alamat); ?></p>
                            <p><?php echo e($region->koordinat); ?></p>

                            <div class="action-buttons">
                                <button class="btn btn-eye mb-3" onclick="toggleSites('<?php echo e($region->kode_region); ?>')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-edit mb-3"
                                    onclick="openModal('modalEditRegion<?php echo e($region->id_region); ?>')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-delete btn-sm" onclick="confirmDelete(<?php echo e($region->id_region); ?>)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <form id="delete-form-<?php echo e($region->id_region); ?>"
                                    action="<?php echo e(route('region.destroy', $region->id_region)); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form>
                                <button class="btn btn-primary mb-3" style="width:125px"
                                    onclick="openModal('modalTambahSite<?php echo e($region->id_region); ?>')">+ Tambah Site</button>
                            </div>
                        </div>
                        <div class="card-bigicon">
                            <i class="fa-solid fa-earth-americas"></i>
                        </div>
                    </div>
                    <div class="tables-container show">
                        <div id="sites<?php echo e($region->kode_region); ?>" style="display: none;">
                            <div class="table-responsive scroll-sites">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Site</th>
                                            <th>Kode Site</th>
                                            <th>Jenis Site</th>
                                            <th>Kode Region</th>
                                            <th>Jumlah Rack</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $filteredSites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($site->nama_site); ?></td>
                                                <td><?php echo e($site->kode_site); ?></td>
                                                <td><?php echo e($site->jenis_site); ?></td>
                                                <td><?php echo e($site->kode_region); ?></td>
                                                <td><?php echo e($site->jml_rack); ?></td>
                                                <td>
                                                    <button class="btn btn-edit"
                                                        onclick="openModal('modalEditSite<?php echo e($site->id_site); ?>')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-delete btn-sm"
                                                        onclick="confirmDelete(<?php echo e($site->id_site); ?>)">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                    <form id="delete-form-<?php echo e($site->id_site); ?>"
                                                        action="<?php echo e(route('site.destroy', $site->id_site)); ?>" method="POST"
                                                        style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div id="modalTambahSite<?php echo e($region->id_region); ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('modalTambahSite<?php echo e($region->id_region); ?>')">&times;</span>
                            <h5>Tambah Site untuk Region <?php echo e($region->nama_region); ?></h5>
                            <form action="<?php echo e(route('site.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label>Nama Site</label>
                                    <input type="text" name="nama_site" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Kode Site</label>
                                    <input type="text" name="kode_site" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Jenis Site</label>
                                    <select name="jenis_site" class="form-control" required>
                                        <option value="POP">POP</option>
                                        <option value="Collocation">Collocation</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Kode Region</label>
                                    <input type="text" name="kode_region" class="form-control"
                                        value="<?php echo e($region->kode_region); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Jumlah Rack</label>
                                    <input type="number" name="jml_rack" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>

                    
                    <?php $__currentLoopData = $region->sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div id="modalEditSite<?php echo e($site->id_site); ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('modalEditSite<?php echo e($site->id_site); ?>')">&times;</span>
                                <h5>Edit Site</h5>
                                <form action="<?php echo e(route('site.update', $site->id_site)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="mb-3">
                                        <label>Nama Site</label>
                                        <input type="text" name="nama_site" class="form-control" value="<?php echo e($site->nama_site); ?>"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kode Site</label>
                                        <input type="text" name="kode_site" class="form-control" value="<?php echo e($site->kode_site); ?>"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jenis Site</label>
                                        <select name="jenis_site" class="form-control" required>
                                            <option value="POP" <?php echo e(strtolower($site->jenis_site) == 'pop' ? 'selected' : ''); ?>>POP
                                            </option>
                                            <option value="POC" <?php echo e(strtolower($site->jenis_site) == 'poc' ? 'selected' : ''); ?>>POC
                                            </option>
                                            <option value="Collocation" <?php echo e(strtolower($site->jenis_site) == 'collocation' ? 'selected' : ''); ?>>Collocation</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kode Region</label>
                                        <input type="text" name="kode_region" class="form-control" value="<?php echo e($site->kode_region); ?>"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jumlah Rack</label>
                                        <input type="number" name="jml_rack" class="form-control" value="<?php echo e($site->jml_rack); ?>"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div id="modalTambahRegion" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modalTambahRegion')">&times;</span>
                <h5>Tambah Region</h5>
                <form action="<?php echo e(route('region.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label>Nama Region</label>
                        <input type="text" name="nama_region" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kode Region</label>
                        <input type="text" name="kode_region" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Koordinat</label>
                        <input type="text" name="koordinat" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>

        
        <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div id="modalEditRegion<?php echo e($region->id_region); ?>" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('modalEditRegion<?php echo e($region->id_region); ?>')">&times;</span>
                    <h5>Edit Region</h5>
                    <form action="<?php echo e(route('region.update', $region->id_region)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label>Nama Region</label>
                            <input type="text" name="nama_region" class="form-control" value="<?php echo e($region->nama_region); ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Kode Region</label>
                            <input type="text" name="kode_region" class="form-control" value="<?php echo e($region->kode_region); ?>"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo e($region->email); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?php echo e($region->alamat); ?>">
                        </div>
                        <div class="mb-3">
                            <label>Koordinat</label>
                            <input type="text" name="koordinat" class="form-control" value="<?php echo e($region->koordinat); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <script>
        function toggleSites(regionCode) {
            const table = document.getElementById('sites' + regionCode);
            table.style.display = (table.style.display === "none" || table.style.display === "") ? "block" : "none";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }
    </script>

    <style>
        .scroll-sites {
            max-height: 300px;
            /* cukup untuk 3-4 baris */
            overflow-y: auto;
        }

        /* Biar header table tetap kelihatan */
        .scroll-sites table thead th {
            position: sticky;
            top: 0;
            background: white;
            z-index: 1;
        }
    </style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ex\gitpull\resources\views/menu/data/dataregionpop.blade.php ENDPATH**/ ?>