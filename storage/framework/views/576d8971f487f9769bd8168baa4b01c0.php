<?php $__env->startSection('title', 'Profil'); ?>
<?php $__env->startSection('page_title', 'Profil'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main" style="padding-top: 20px;">
        <div class="section">
            <header class="header-profile">
                <h2><?php echo e(__('Informasi Profil')); ?></h2>
                <p style="color: rgba(0, 0, 0, 0.5);"><?php echo e(__("Perbarui informasi profil akun Anda.")); ?></p>
            </header>

            <div class="form-group" style="margin-bottom: 10px; padding-top: 20px;">
                <label for="name">Nama</label>
                <input id="name" type="text" class="form-control" value="<?php echo e(auth()->user()->name); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" value="<?php echo e(auth()->user()->email); ?>" readonly>
            </div>

            <div class="button-wrapper">
                <button onclick="openModal('viewProfileModal')" class="btn btn-eye" style="font-size: 14px">Lihat
                    Profil</button>
                <button onclick="openModal('editProfileModal')" class="btn btn-primary">Edit Profil</button>
            </div>
        </div>

        <div class="modal" id="viewProfileModal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('viewProfileModal')">&times;</span>
                <h5>Lihat Profil</h5>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <div style="width: 48%;">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="<?php echo e(auth()->user()->name); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="<?php echo e(auth()->user()->email); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <input type="text" class="form-control" value="<?php echo e(auth()->user()->perusahaan); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Bagian</label>
                            <input type="text" class="form-control" value="<?php echo e(auth()->user()->bagian); ?>" readonly>
                        </div>
                    </div>
                    <div style="width: 48%;">
                        <div class="form-group">
                            <label>Region</label>
                            <input type="text" class="form-control" value="<?php echo e(auth()->user()->region); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>No. KTP</label>
                            <input type="text" class="form-control" value="<?php echo e(auth()->user()->noktp); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control" value="<?php echo e(auth()->user()->mobile_number); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="<?php echo e(auth()->user()->alamat); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="editProfileModal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('editProfileModal')">&times;</span>
                <h5>Edit Profil</h5>
                <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <div style="width: 48%;">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="<?php echo e(old('name', auth()->user()->name)); ?>" required>

                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="<?php echo e(old('email', auth()->user()->email)); ?>" required>

                            <label for="perusahaan">Perusahaan</label>
                            <input type="text" id="perusahaan" name="perusahaan" class="form-control"
                                value="<?php echo e(old('perusahaan', auth()->user()->perusahaan)); ?>">

                            <label for="bagian">Bagian</label>
                            <input type="text" id="bagian" name="bagian" class="form-control"
                                value="<?php echo e(old('bagian', auth()->user()->bagian)); ?>">
                        </div>
                        <div style="width: 48%;">
                            <label for="region">Region</label>
                            <select id="region" name="region" class="form-control">
                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($nama); ?>" <?php echo e(old('region', auth()->user()->region) == $nama ? 'selected' : ''); ?>>
                                        <?php echo e($nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label for="noktp">No. KTP</label>
                            <input type="text" id="noktp" name="noktp" class="form-control"
                                value="<?php echo e(old('noktp', auth()->user()->noktp)); ?>">

                            <label for="mobile_number">Nomor HP</label>
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control"
                                value="<?php echo e(old('mobile_number', auth()->user()->mobile_number)); ?>">

                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control"
                                value="<?php echo e(old('alamat', auth()->user()->alamat)); ?>">

                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>            

        <?php if(auth()->user()->role == 1): ?>
            <div class="section">
                <header class="header-profile">
                    <h2><?php echo e(__('Tanda Tangan')); ?></h2>
                    <p style="color: rgba(0, 0, 0, 0.5);"><?php echo e(__('Unggah tanda tangan digital Anda di sini.')); ?></p>
                </header>

                <form action="<?php echo e(route('users.signature.upload')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="file" name="signature" accept="image/*" class="form-control">
                    <?php if($errors->has('signature')): ?>
                        <div class="error"><?php echo e($errors->first('signature')); ?></div>
                    <?php endif; ?>
                    <button type="submit" class="btn-primary"><?php echo e(__('Unggah')); ?></button>
                </form>

                <?php if(auth()->user()->signature): ?>
                    <div style="padding-top: 20px;">
                        <p><?php echo e(__('Pratinjau tanda tangan Anda:')); ?></p>
                        <img src="<?php echo e(asset('storage/' . auth()->user()->signature)); ?>" alt="Signature" class="signature-preview"
                            style="max-width: 200px; height: auto;">
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="section">
            <header class="header-profile">
                <h2><?php echo e(__('Perbarui Kata Sandi')); ?></h2>
                <p style="color: rgba(0, 0, 0, 0.5);">
                    <?php echo e(__('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.')); ?>

                </p>
            </header>

            <form method="POST" action="<?php echo e(route('password.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div>
                    <label for="current_password"><?php echo e(__('Kata Sandi Saat Ini')); ?></label>
                    <input id="current_password" name="current_password" type="password" class="form-control"
                        autocomplete="current-password">
                    <?php if($errors->updatePassword->has('current_password')): ?>
                        <p class="error"><?php echo e($errors->updatePassword->first('current_password')); ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password"><?php echo e(__('Kata Sandi Baru')); ?></label>
                    <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                    <?php if($errors->updatePassword->has('password')): ?>
                        <p class="error"><?php echo e($errors->updatePassword->first('password')); ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password_confirmation"><?php echo e(__('Konfirmasi Kata Sandi')); ?></label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                        autocomplete="new-password">
                    <?php if($errors->updatePassword->has('password_confirmation')): ?>
                        <p class="error"><?php echo e($errors->updatePassword->first('password_confirmation')); ?></p>
                    <?php endif; ?>
                </div>

                <div style="text-align: right;">
                    <a href="<?php echo e(route('password.request')); ?>"
                        style="font-size: 16px; color: #4f52ba; text-decoration: underline;">
                        <?php echo e(__('Lupa kata sandi?')); ?>

                    </a>
                </div>

                <div>
                    <button type="submit" class="btn-primary"><?php echo e(__('Simpan')); ?></button>
                </div>
            </form>
        </div>

        <div class="section">
            <header class="header-profile">
                <h2><?php echo e(__('Hapus Akun')); ?></h2>
                <p style="color: rgba(0, 0, 0, 0.5);">
                    <?php echo e(__('Setelah akun Anda dihapus, semua data dan sumber daya terkait akan dihapus secara permanen.')); ?>

                </p>
            </header>

            <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="btn-primary" style="margin-top: 20px;">
                <?php echo e(__('Hapus Akun')); ?>

            </button>

            <div x-data="{ show: <?php echo e($errors->userDeletion->isNotEmpty() ? 'true' : 'false'); ?> }" x-show="show" x-transition
                class="modal">
                <div class="modal-content">
                    <span class="modal-close" x-on:click="$dispatch('close'); show = false">×</span>
                    <form method="POST" action="<?php echo e(route('profile.destroy')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <h2><?php echo e(__('Apakah Anda yakin ingin menghapus akun?')); ?></h2>
                        <p><?php echo e(__('Setelah akun dihapus, data Anda tidak bisa dipulihkan.')); ?></p>

                        <label for="password_delete"><?php echo e(__('Masukkan kata sandi Anda untuk konfirmasi')); ?></label>
                        <input id="password_delete" name="password_delete" type="password" class="form-control" required>
                        <?php if($errors->userDeletion->has('password_delete')): ?>
                            <p class="error"><?php echo e($errors->userDeletion->first('password_delete')); ?></p>
                        <?php endif; ?>

                        <div style="margin-top: 20px; text-align: right;">
                            <button type="button" x-on:click="$dispatch('close'); show = false"
                                class="btn-secondary"><?php echo e(__('Batal')); ?></button>
                            <button type="submit" class="btn-danger"><?php echo e(__('Hapus Akun')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/menu/profile.blade.php ENDPATH**/ ?>