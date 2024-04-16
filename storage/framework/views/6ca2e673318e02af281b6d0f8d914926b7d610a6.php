
<?php $__env->startSection('title', 'Riwayat Pembayaran'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Riwayat  Pembayaran</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-body p-0">
                  <div class="table-responsive p-3">
                    <table id="siswaTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <!-- <th>Petugas</th> -->
                              <th>NISN</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>Jenis kelamin</th>
                              <th>Tanggal Bayar</th>
                              <th>SPP Bulan</th>
                              <th>SPP Tahun</th>
                              <th>Nominal</th>
                              <th>Status</th>

                              <!-- <th>Action</th> -->
                          </tr>
                      </thead>
                      <tbody>
                          <?php $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $spp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i += 1); ?></td>
                                <!-- <td><?php echo e($spp->user->name); ?></td> -->
                                <td><?php echo e($spp->nisn); ?></td>
                                <td><?php echo e($spp->siswa->nama); ?></td>
                                <td><?php echo e($spp->siswa->kelas->nama_kelas); ?></td>
                                <td><?php echo e($spp->siswa->jenkel); ?>

                                <td><?php echo e(Carbon\Carbon::parse($spp->tanggal_bayar)->format('d-m-Y')); ?></td>
                                <td><?php echo e(ucfirst($spp->bulan_bayar)); ?></td>
                                <td><?php echo e($spp->tahun_bayar); ?></td>
                                <td><?php echo e("Rp. " . number_format($spp->jumlah_bayar, 0, '', '.')); ?></td>
                                <td><?php echo e($spp->status); ?></td>
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
    <!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $('#siswaTable').DataTable();
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         function deleteData(nisn){
            Swal.fire({
                    title: 'PERINGATAN!',
                    text: "Yakin ingin menghapus data siswa? data pembayaran atas nama siswa ini pun akan dihapus jika ada.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.value) {
                            $('#delete'+nisn).submit();
                        }
                    })
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shata\OneDrive\Documents\pengkodean\pembayaran-spp\resources\views/pages/admin/history/index.blade.php ENDPATH**/ ?>