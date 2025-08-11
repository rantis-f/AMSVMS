<?php $__env->startSection('title', 'Data User'); ?>
<?php $__env->startSection('page_title', 'Data User'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main">
        <button class="btn btn-primary mb-3" onclick="openModal('modalTambahUser')" style="margin-top: 20px;">
            + Tambah User
        </button>

        <div class="table-responsive" style="margin-top: 20px;">
            <table id="userTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Region</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <span id="password-<?php echo e($user->id); ?>" class="masked-password">••••••••</span>
                                <button type="button" class="btn btn-eye btn-secondary"
                                    onclick="togglePassword('<?php echo e($user->id); ?>', '<?php echo e($user->password); ?>')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                            <td>
                                <?php if($user->role == 1): ?>
                                    Superadmin
                                <?php elseif($user->role == 2): ?>
                                    Admin
                                <?php elseif($user->role == 3): ?>
                                    User Internal
                                <?php elseif($user->role == 4): ?>
                                    User Eksternal
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($user->region ?? '-'); ?></td>
                            <td><?php echo e($user->mobile_number); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit btn-sm mb-1"
                                        onclick="openModal('modalEditUser<?php echo e($user->id); ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-delete btn-sm" onclick="confirmDelete(<?php echo e($user->id); ?>)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <form id="delete-form-<?php echo e($user->id); ?>" action="<?php echo e(route('user.destroy', $user->id)); ?>"
                                        method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div id="modalEditUser<?php echo e($user->id); ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('modalEditUser<?php echo e($user->id); ?>')">&times;</span>
                                <h5>Edit User</h5>
                                <form action="<?php echo e(route('user.update', $user->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div style="display: flex; gap: 20px;">
                                        <div style="width: 48%;">
                                            <label>Nama</label>
                                            <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>"
                                                class="form-control" required>

                                            <label>Region</label>
                                            <select name="region" class="form-control" required>
                                                <option value="">Pilih Region</option>
                                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($region->kode_region); ?>" <?php echo e(old('region', $user->region) == $region->kode_region ? 'selected' : ''); ?>>
                                                        <?php echo e($region->nama_region); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control">

                                            <label>Perusahaan</label>
                                            <input type="text" name="perusahaan"
                                                value="<?php echo e(old('perusahaan', $user->perusahaan)); ?>" class="form-control"
                                                required>

                                            <label>No KTP</label>
                                            <input type="text" name="noktp" value="<?php echo e(old('noktp', $user->noktp ?? '')); ?>"
                                                maxlength="16" class="form-control" required>
                                        </div>
                                        <div style="width: 48%;">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>"
                                                class="form-control" required>

                                            <label>Role</label>
                                            <select name="role" class="form-control" required>
                                                <option value="" disabled <?php echo e(old('role', $user->role) ? '' : 'selected'); ?>>
                                                    Pilih Role
                                                </option>
                                                <option value="1" <?php echo e(old('role', $user->role) == 1 ? 'selected' : ''); ?>>Admin
                                                </option>
                                                <option value="2" <?php echo e(old('role', $user->role) == 2 ? 'selected' : ''); ?>>Operator
                                                    Aset</option>
                                                <option value="3" <?php echo e(old('role', $user->role) == 3 ? 'selected' : ''); ?>>Pengguna
                                                    Region</option>
                                                <option value="4" <?php echo e(old('role', $user->role) == 4 ? 'selected' : ''); ?>>Pengguna
                                                    Internal</option>
                                                <option value="5" <?php echo e(old('role', $user->role) == 5 ? 'selected' : ''); ?>>Pengguna
                                                    Eksternal</option>
                                            </select>

                                            <label>Alamat</label>
                                            <input type="text" name="alamat" value="<?php echo e(old('alamat', $user->alamat)); ?>"
                                                class="form-control" required>

                                            <label>Bagian</label>
                                            <input type="text" name="bagian" value="<?php echo e(old('bagian', $user->bagian)); ?>"
                                                class="form-control" required>

                                            <label>No Telepon</label>
                                            <input type="tel" name="mobile_number"
                                                value="<?php echo e(old('mobile_number', $user->mobile_number)); ?>" class="form-control"
                                                required>
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

        <div id="modalTambahUser" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modalTambahUser')">&times;</span>
                <h5>Tambah User</h5>
                <form action="<?php echo e(route('user.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div style="display: flex; gap: 20px;">
                        <div style="width: 48%;">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>

                            <label>Region</label>
                            <select name="region" class="form-control" required>
                                <option value="">Pilih Region</option>
                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($region->kode_region); ?>"><?php echo e($region->nama_region); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>

                            <label>Perusahaan</label>
                            <input type="text" name="perusahaan" class="form-control" required>

                            <label>No KTP</label>
                            <input type="text" name="noktp" maxlength="16" class="form-control"
                                required>
                        </div>
                        <div style="width: 48%;">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>

                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Operator Aset</option>
                                <option value="3">Pengguna Region</option>
                                <option value="4">Pengguna Internal</option>
                                <option value="5">Pengguna Eksternal</option>
                            </select>

                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>

                            <label>Bagian</label>
                            <input type="text" name="bagian" class="form-control" required>

                            <label>No Telepon</label>
                            <input type="tel" name="mobile_number" class="form-control" required>
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
            $('#userTable').DataTable({
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
                        "targets": 7,
                        "orderable": false
                    }
                ]
            });
        });

        function togglePassword(userId, actualPassword) {
            const passwordSpan = document.getElementById('password-' + userId);
            const currentValue = passwordSpan.textContent;

            if (currentValue === '••••••••') {
                passwordSpan.textContent = actualPassword;
            } else {
                passwordSpan.textContent = '••••••••';
            }
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ex\gitpull\resources\views/menu/data/datauser.blade.php ENDPATH**/ ?>