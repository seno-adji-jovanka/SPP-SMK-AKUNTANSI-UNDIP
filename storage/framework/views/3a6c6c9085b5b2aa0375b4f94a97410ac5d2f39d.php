
<?php $__env->startSection('title', 'Data Pengguna'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Admin</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="<?php echo e(route('data-petugas.create')); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Admin</a>
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
                    <table id="kelasTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Admin</th>
                              <th>Username</th>
                              <th>Email</th>
                              <!-- <th>Level</th> -->
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $__currentLoopData = $petugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i += 1); ?></td>
                                <td><?php echo e($p->name); ?></td>
                                <td><?php echo e($p->username); ?></td>
                                <td><?php echo e($p->email); ?></td>
                                <!-- <td><?php echo e($p->level); ?></td> -->
                                <td>
                                    <a href="<?php echo e(route('data-petugas.edit', $p->id)); ?>" class="btn btn-warning">Edit</a>
                                   <form action="<?php echo e(url('data-petugas', $p->id)); ?>" class="d-inline" id="delete<?php echo e($p->id); ?>" method="POST">
                                       <?php echo csrf_field(); ?>
                                       <?php echo method_field('delete'); ?>
                                    <button type="button" class="btn btn-danger" onclick="deleteData(<?php echo e($p->id); ?>)">Hapus</button>
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
            $('#kelasTable').DataTable();
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         function deleteData(id){
            Swal.fire({
                    title: 'PERINGATAN!',
                    text: "Yakin ingin menghapus data petugas?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.value) {
                            $('#delete'+id).submit();
                        }
                    })
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shata\OneDrive\Documents\pengkodean\pembayaran-spp\resources\views/pages/admin/petugas/index.blade.php ENDPATH**/ ?>