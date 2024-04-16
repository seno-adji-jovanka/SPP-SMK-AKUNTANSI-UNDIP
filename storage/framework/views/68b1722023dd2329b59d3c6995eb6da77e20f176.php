
<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="" class="text-decoration-none"><?php echo e(now()->format('l, d F Y')); ?></a></div>
          </div>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Uang Masuk</h4>
                  </div>
                  <div class="card-body">
                    <?php echo e(number_format($total, 0, '', '.')); ?>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Transaksi</h4>
                  </div>
                  <div class="card-body">
                    <?php echo e($trx); ?>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Siswa</h4>
                  </div>
                  <div class="card-body">
                    <?php echo e($siswa); ?>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-layer-group"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Kelas</h4>
                  </div>
                  <div class="card-body">
                    <?php echo e($kelas); ?>

                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                      <h4>Selamat Datang, <?php echo e(Auth::user()->name); ?>!</h4>
                    </div>
                    <form action="<?php echo e(route('pembayaran.index')); ?>" method="GET">
                        <div class="card-body">
                            <p>Silahkan masukan NISN siswa untuk melakukan transaksi SPP.</p>
                          <div class="form-group">
                            <div class="input-group mb-3">
                              <input type="text" class="form-control <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="nisn" id="nisn" value="<?php echo e(old('nisn')); ?>" placeholder="Masukan NISN disini!" required>
                              <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                  </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Riwayat Pembayaran</h4>
                        <div class="card-header-action">
                          <a href="<?php echo e(url('histori-pembayaran')); ?>" class="btn btn-primary">
                            Lihat Semua
                          </a>
                        </div>
                      </div>
                        <div class="card-body">
                            <div class="table-responsive p-3">
                                <table id="siswaTable" class="table table-striped" >
                                  <thead>
                                      <tr>
                                          <!-- <th>Petugas</th> -->
                                          <th>NISN</th>
                                          <th>Nama</th>
                                          <th>Tanggal Bayar</th>
                                          <th>SPP Bulan</th>
                                          <th>SPP Tahun</th>
                                          <th>Jumlah Bayar</th>
                                          <th>Status</th>
                                          <!-- <th>Action</th> -->
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <!-- <td><?php echo e($pay->user->name); ?></td> -->
                                            <td><?php echo e($pay->nisn); ?></td>
                                            <td><?php echo e($pay->siswa->nama); ?></td>
                                            <td><?php echo e(Carbon\Carbon::parse($pay->tanggal_bayar)->format('d-m-Y')); ?></td>
                                            <td><?php echo e(ucfirst($pay->bulan_bayar)); ?></td>
                                            <td><?php echo e($pay->tahun_bayar); ?></td>
                                            <td><?php echo e("Rp. " . number_format($pay->jumlah_bayar, 0, '', '.')); ?></td>
                                            <td><?php echo e($pay->status); ?></td>

                                        </tr>

                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
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
<script>
    $(document).ready(function() {
        $('#siswaTable').DataTable();
    } );
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shata\OneDrive\Documents\seno\pembayaran-spp\resources\views/pages/admin/dashboard.blade.php ENDPATH**/ ?>