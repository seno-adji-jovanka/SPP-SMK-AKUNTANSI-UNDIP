
<?php $__env->startSection('title', 'Laporan'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Laporan</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                      <h5>Filter Data</h5>
                    </div>
                    <div class="card-body p-0">
                        <form action="<?php echo e(url('getlaporan')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group px-3">
                                <label>Kelas</label>
                                <select name="kelas" class="custom-select <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php echo e(count($kelas) == 0 ? 'disabled' : ''); ?>>
                                    <?php if(count($kelas) == 0): ?>
                                       <option>Pilihan tidak ada</option>
                                    <?php else: ?>
                                       <option value="">Silahkan Pilih</option>
                                          <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kls): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($kls->id_kelas); ?>"><?php echo e($kls->nama_kelas); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                              </div>
                              <hr style="border-color: #f9f9f9 !important;">
                              <div class="form-group px-3">
                                  <label for="">Rentang Tanggal</label>
                                <input type="text" name="date_from" class="form-control" placeholder="Tanggal Awal"
                                    onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="<?php echo e($from ?? ''); ?>">
                                </div>
                                <div class="form-group px-3">
                                    <input type="text" name="date_to" class="form-control" placeholder="Tanggal Akhir"
                                        onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="<?php echo e($to ?? ''); ?>">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cari Data</button>
                                </div>
                                <p class="text-muted px-2">*Jika ingin mengeksport semua data abaikan form diatas, dan langsung klik cari data.</p>
                        </form>
                    </div>
                  </div>
            </div>
            <div class="col-8">
                <div class="card">
                   <div class="row">
                       <div class="col">
                        <div class="card-header">
                            <h5>Hasil Filter</h5>
                          </div>
                       </div>
                       <div class="col">
                        <div class="float-right pt-3 pr-3">
                        <?php if($pembayaran ?? ''): ?>
                          <form action="<?php echo e(url('laporan/export')); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="kelas" value="<?php echo e($kelass); ?>">
                              <input type="hidden" name="date_from" value="<?php echo e($from); ?>">
                              <input type="hidden" name="date_to" value="<?php echo e($to); ?>">
                              <button type="submit" class="btn btn-info">EXPORT PDF</button>
                          </form>
                          <?php endif; ?>
                      </div>
                    </div>
                   </div>
                    <div class="card-body p-0">
                        <div class="table-responsive p-3">
                            <?php if($pembayaran ?? ''): ?>
                        <table class="table" id="pembayaranTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>Petugas</th> -->
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>SPP Bulan</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($k += 1); ?></td>
                                    <!-- <td><?php echo e($v->user->name); ?></td> -->
                                    <td><?php echo e($v->siswa->nama); ?></td>
                                    <td><?php echo e($v->siswa->kelas->nama_kelas); ?></td>
                                    <td><?php echo e(ucfirst($v->bulan_bayar)); ?></td>
                                    <td><?php echo e("Rp. " . number_format($v->jumlah_bayar, 0, '', '.')); ?></td>
                                    <td><?php echo e($v->tanggal_bayar); ?></td>
                                    <td><?php echo e($v->status); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div class="text-center">
                            Tidak ada data
                        </div>
                        <?php endif; ?>
                        </div>

                    </div>
                  </div>
            </div>
        </div>
      </div>
    </section>
  </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('addon-script'); ?>
    <?php if($pembayaran ?? ''): ?>
        <?php if($kelass != null): ?>
        <script>
            $(document).ready(function() {
                $('#<?php echo e($kelass); ?>').prop('checked', true);
            });
        </script>
        <?php endif; ?>
    <?php endif; ?>
    <script>
         $(document).ready(function() {
        $('#pembayaranTable').DataTable();
    } );
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shata\OneDrive\Documents\pengkodean\pembayaran-spp\resources\views/pages/admin/laporan/index.blade.php ENDPATH**/ ?>