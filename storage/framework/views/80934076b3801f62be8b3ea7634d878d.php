<?php $__env->startSection('title', 'Dasbor'); ?> 
<?php $__env->startSection('page_title', 'Dasbor'); ?> 
<?php $__env->startSection('content'); ?>
    <div class="main">
    <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
        <div class="card-section" style="margin-top: 20px;">
            <div class="card-item" <?php if(auth()->user()->role == '1'): ?>
            onclick="window.location='<?php echo e(route('data.region.index')); ?>'" style="cursor: pointer;" <?php endif; ?>>
                <div class="card-icon"><i class="fa-solid fa-earth-americas"></i></div>
                <div class="card-content">
                    <h4>Region</h4>
                    <p><?php echo e($jumlahRegion); ?> data</p>
                </div>
            </div>

            <div class="card-item" <?php if(auth()->user()->role == '1'): ?>
            onclick="window.location='<?php echo e(route('data.pop.index')); ?>'" style="cursor: pointer;" <?php endif; ?>>
                <div class="card-icon"><i class="fa-solid fa-building"></i></div>
                <div class="card-content">
                    <h4>POP</h4>
                    <p><?php echo e($jumlahJenisSite['POP'] ?? 0); ?> data</p>
                </div>
            </div>
            <div class="card-item" <?php if(auth()->user()->role == '1'): ?>
            onclick="window.location='<?php echo e(route('data.poc.index')); ?>'" style="cursor: pointer;" <?php endif; ?>>
                <div class="card-icon"><i class="fa-solid fa-building-user"></i></div>
                <div class="card-content">
                    <h4>POC</h4>
                    <p><?php echo e($jumlahJenisSite['POC'] ?? 0); ?> data</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="card-section" style="margin-top: 20px;">
        <div class="card-item" onclick="window.location='<?php echo e(route('perangkat.index')); ?>'" style="cursor: pointer;">
            <div class="card-icon"><i class="fas fa-tools"></i></div>
            <div class="card-content">
                <h4>Perangkat</h4>
                <p><?php echo e($jumlahPerangkat); ?> data</p>
            </div>
        </div>

        <div class="card-item" onclick="window.location='<?php echo e(route('fasilitas.index')); ?>'" style="cursor: pointer;">
            <div class="card-icon"><i class="fas fa-warehouse"></i></div>
            <div class="card-content">
                <h4>Fasilitas</h4>
                <p><?php echo e($jumlahFasilitas); ?> data</p>
            </div>
        </div>

        <div class="card-item" onclick="window.location='<?php echo e(route('alatukur.index')); ?>'" style="cursor: pointer;">
            <div class="card-icon"><i class="fas fa-ruler"></i></div>
            <div class="card-content">
                <h4>Alat Ukur</h4>
                <p><?php echo e($jumlahAlatUkur); ?> data</p>
            </div>
        </div>

        <div class="card-item" onclick="window.location='<?php echo e(route('jaringan.index')); ?>'" style="cursor: pointer;">
            <div class="card-icon"><i class="fas fa-project-diagram"></i></div>
            <div class="card-content">
                <h4>Jaringan</h4>
                <p><?php echo e($jumlahJaringan); ?> data</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ex\gitpull\resources\views/home.blade.php ENDPATH**/ ?>