
<?php $__env->startSection('title', 'Data Siswa'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Siswa</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="<?php echo e(route('data-siswa.create')); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Siswa</a>
                  <!-- <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div> -->
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive px-3">
                    <table id="siswaTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>NISN</th>
                              <th>NIS</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>No Telp</th>
                              <th>Jenis Kelamin</th>
                              <th>Alamat</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $sis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i += 1); ?></td>
                                <td><?php echo e($sis->nisn); ?></td>
                                <td><?php echo e($sis->nis); ?></td>
                                <td><?php echo e($sis->nama); ?></td>
                                <td><?php echo e($sis->kelas->nama_kelas); ?></td>
                                <td><?php echo e($sis->no_telp); ?></td>
                                <td><?php echo e($sis->jenkel); ?></td>
                                <td><?php echo e($sis->alamat); ?></td>
                                <td>
                                    <a href="<?php echo e(route('data-siswa.edit', $sis->nisn)); ?>" class="btn btn-warning">Edit</a>
                                   <form action="<?php echo e(url('data-siswa', $sis->nisn)); ?>" class="d-inline" id="delete<?php echo e($sis->nisn); ?>" method="POST">
                                       <?php echo csrf_field(); ?>
                                       <?php echo method_field('delete'); ?>
                                    <button type="button" class="btn btn-danger" onclick="deleteData(<?php echo e($sis->nisn); ?>)">Hapus</button>
                                   </form>
                                </td>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shata\OneDrive\Documents\pengkodean\pembayaran-spp\resources\views/pages/admin/siswa/index.blade.php ENDPATH**/ ?>