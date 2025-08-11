<?php if($racks->isEmpty()): ?>
    <div class="no-data-message" style="text-align: center; padding: 20px;">
        <i class="fas fa-info-circle" style="color: #4f52ba; font-size: 24px;"></i>
        <p style="color: #4f52ba; margin-top: 10px;">Tidak ada rack yang ditemukan</p>
    </div>
<?php else: ?>
    <div class="card-grid" style="margin-top: 20px;">
        <?php $__currentLoopData = $racks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $chartId = "pieChart-{$rack->kode_region}-{$rack->kode_site}-{$rack->no_rack}";
                $tableId = "table-{$rack->kode_region}-{$rack->kode_site}-{$rack->no_rack}";
            ?>
            <div class="toggle">
                <div class="card-item primary">
                    <div class="icon-wrapper-chart">
                        <canvas id="<?php echo e($chartId); ?>" style="width: 150px; height: 150px;"></canvas>
                    </div>
                    <div class="card-content">
                        <h4>Rack <?php echo e($rack->no_rack); ?></h4>
                        <p><?php echo e($rack->site->nama_site); ?>, <?php echo e($rack->region->nama_region); ?></p>
                        <p>Jumlah Perangkat: <?php echo e($rack->device_count); ?> | Jumlah Fasilitas: <?php echo e($rack->facility_count); ?></p>
                        <div class="action-buttons left-align">
                            <button class="btn btn-eye" style="margin-top:10px;" onclick="toggleTable('<?php echo e($tableId); ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <?php if(auth()->user()->role == '1'): ?>
                                <button class="btn btn-delete" style="margin-top:10px;"
                                    onclick="confirmDeleteRack('<?php echo e($rack->kode_region); ?>', '<?php echo e($rack->kode_site); ?>', '<?php echo e($rack->no_rack); ?>')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div id="<?php echo e($tableId); ?>" class="tables-container">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID U</th>
                                    <th>ID Perangkat/Fasilitas</th>
                                    <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rack->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $deviceInfo = 'IDLE';
                                        $isUserPosition = auth()->user()->role == 1 || auth()->user()->role == 2 || $detail->milik == auth()->user()->id || $detail->kode_region == auth()->user()->region;

                                        if ($isUserPosition) {
                                            if ($detail->id_perangkat && $detail->listperangkat) {
                                                $deviceCode = [
                                                    $detail->listperangkat->kode_region,
                                                    $detail->listperangkat->kode_site,
                                                    $detail->listperangkat->no_rack,
                                                    $detail->listperangkat->kode_perangkat,
                                                    $detail->listperangkat->perangkat_ke,
                                                    $detail->listperangkat->kode_brand,
                                                    $detail->listperangkat->type
                                                ];
                                                $deviceInfo = implode('-', array_filter($deviceCode)) ?: $detail->id_perangkat;
                                            } elseif ($detail->id_fasilitas && $detail->listfasilitas) {
                                                $facilityCode = [
                                                    $detail->listfasilitas->kode_region,
                                                    $detail->listfasilitas->kode_site,
                                                    $detail->listfasilitas->no_rack,
                                                    $detail->listfasilitas->kode_fasilitas,
                                                    $detail->listfasilitas->perangkat_ke,
                                                    $detail->listfasilitas->kode_brand,
                                                    $detail->listfasilitas->type
                                                ];
                                                $deviceInfo = implode('-', array_filter($facilityCode)) ?: $detail->id_fasilitas;
                                            }
                                        }
                                        $showDeleteButton = $isUserPosition;
                                    ?>
                                    <tr>
                                        <td><?php echo e($detail->u); ?></td>
                                        <td><?php echo e($deviceInfo); ?></td>
                                        <?php if(auth()->user()->role == '1' || auth()->user()->role == '2'): ?>
                                            <td>
                                                <?php if($showDeleteButton): ?>
                                                    <button class="btn btn-delete"
                                                        onclick="confirmDeleteU('<?php echo e($rack->kode_region); ?>', '<?php echo e($rack->kode_site); ?>', '<?php echo e($rack->no_rack); ?>', '<?php echo e($detail->u); ?>')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?><?php /**PATH C:\laragon\www\test\AMSVMS\resources\views/partials/racks.blade.php ENDPATH**/ ?>