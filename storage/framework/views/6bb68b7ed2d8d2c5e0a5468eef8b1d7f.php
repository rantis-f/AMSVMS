<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- Font dan Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Plugin CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Lokal -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldContent('styles'); ?> <!-- Menyertakan style khusus halaman -->

</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-title">
            <img src="<?php echo e(asset('img/pgncom.png')); ?>" alt="logo" />
            <h2>AMS</h2>
        </div>

        <ul class="sidebar-links">
            <h4><span>Menu</span>
                <div class="menu-separator"></div>
            </h4>
            <li><a href="<?php echo e(route('home')); ?>"><span class="icon"><i class="fas fa-tachometer-alt"></i></span><span
                        class="text">Dasbor</span></a></li>
            <?php if(auth()->user()->role == '1'): ?>
                <li><a href="<?php echo e(route('data')); ?>"><span class="icon"><i class="fas fa-database"></i></span><span
                            class="text">Data</span></a></li>
            <?php endif; ?>
            <li><a href="<?php echo e(route('rack.index')); ?>"><span class="icon"><i class="fas fa-server"></i></span><span
                        class="text">Rack</span></a></li>
            <li><a href="<?php echo e(route('histori.index')); ?>"><span class="icon"><i class="fas fa-history"></i></span><span
                        class="text">Histori</span></a></li>
            <?php if(auth()->user()->role == '1'): ?>
                <li><a href="<?php echo e(route('semantik')); ?>"><span class="icon"><i class="fas fa-image"></i></span><span
                            class="text">Semantik</span></a></li>
            <?php endif; ?>

            <h4><span>Aset</span>
                <div class="menu-separator"></div>
            </h4>
            <li><a href="<?php echo e(route('perangkat.index')); ?>"><span class="icon"><i class="fas fa-tools"></i></span><span
                        class="text">Perangkat</span></a></li>
            <li><a href="<?php echo e(route('fasilitas.index')); ?>"><span class="icon"><i class="fas fa-warehouse"></i></span><span
                        class="text">Fasilitas</span></a></li>
            <li><a href="<?php echo e(route('alatukur.index')); ?>"><span class="icon"><i class="fas fa-ruler"></i></span><span
                        class="text">Alat Ukur</span></a></li>
            <li><a href="<?php echo e(route('jaringan.index')); ?>"><span class="icon"><i
                            class="fas fa-project-diagram"></i></span><span class="text">Jaringan</span></a></li>

            <?php if(auth()->user()->role == '1' || auth()->user()->role == '4' || auth()->user()->role == '5'): ?>
            <h4><span>Portal VMS</span>
                <div class="menu-separator"></div>
            </h4>
            <?php endif; ?>
            <?php if(auth()->user()->role == '1'): ?>
                <li><a href="<?php echo e(route('verifikasi.superadmin.nda')); ?>"><span class="icon"><i
                                class="fas fa-paperclip"></i></span><span class="text">Verifikasi NDA</span></a></li>
                <li><a href="<?php echo e(route('verifikasi.superadmin.dcaf')); ?>"><span class="icon"><i
                                class="fas fa-file"></i></span><span class="text">Verifikasi DCAF</span></a></li>
            <?php endif; ?>

            <?php if(auth()->user()->role == '4' || auth()->user()->role == '5'): ?>
                <li><a href="<?php echo e(route('verifikasi.user.nda')); ?>"><span class="icon"><i
                                class="fas fa-paperclip"></i></span><span class="text">NDA</span></a></li>
                <li><a href="<?php echo e(route('verifikasi.user.dcaf')); ?>"><span class="icon"><i class="fas fa-file"></i></span><span
                            class="text">DCAF</span></a></li>
            <?php endif; ?>

            <h4><span>Akun</span>
                <div class="menu-separator"></div>
            </h4>
            <li><a href="<?php echo e(route('profile.show')); ?>"><span class="icon"><i class="fas fa-user-circle"></i></span><span
                        class="text">Profil</span></a></li>
            <li>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit">
                        <span class="icon"><i class="fas fa-sign-out-alt" style="margin-left:5px"></i></span>
                        <span class="text" style="margin-left:-2px">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>

        <!-- User Info -->
        <div class="user-account">
            <div class="user-profile">
                <img src="<?php echo e(asset('img/profile-default.png')); ?>" alt="Profile Image" />
                <div class="user-detail">
                    <h3><?php echo e(auth()->user()->name); ?></h3>
                    <?php
                        $roleText = [
                            1 => 'Admin',
                            2 => 'Operator Aset',
                            3 => 'Pengguna Region',
                            4 => 'Pengguna Internal',
                            5 => 'Pengguna Eksternal',
                        ][auth()->user()->role] ?? 'Unknown';
                    ?>
                    <span><?php echo e($roleText); ?></span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Header -->
    <header class="header">
        <h1><?php echo $__env->yieldContent('page_title'); ?></h1>
    </header>

    <!-- Main Content -->
    <main class="main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = "block";
        }

        function closeModal(id) {
            document.getElementById(id).style.display = "none";
        }

        window.onclick = function (event) {
            document.querySelectorAll(".modal").forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }

        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo e(session('success')); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        <?php elseif(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?php echo e(session('error')); ?>',
                showConfirmButton: true
            });
        <?php elseif(session('warning')): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: '<?php echo e(session('warning')); ?>',
                showConfirmButton: true
            });
        <?php endif; ?>

            function confirmDelete(id) {
                Swal.fire({
                    title: 'Yakin mau hapus?',
                    text: 'Data tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }

        function clearAllFilters() {
            $('.select2').val(null).trigger('change');
            document.getElementById('searchInput').value = '';
            document.getElementById('filterForm').submit();
        }

        $(document).ready(function () {
            $('select[name="region[]"]').select2({
                placeholder: "Pilih Region",
                allowClear: true
            });
            $('select[name="site[]"]').select2({
                placeholder: "Pilih Site",
                allowClear: true
            });
            $('select[name="kode_perangkat[]"]').select2({
                placeholder: "Pilih Perangkat",
                allowClear: true
            });
            $('select[name="brand[]"]').select2({
                placeholder: "Pilih Brand",
                allowClear: true
            });
        });

    </script>
    <?php if($errors->any()): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `<?php echo implode('<br>', $errors->all()); ?>`,
                showConfirmButton: true
            });
        </script>
    <?php endif; ?>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\laragon\www\CODE-AMSVMS\resources\views/layouts/app.blade.php ENDPATH**/ ?>