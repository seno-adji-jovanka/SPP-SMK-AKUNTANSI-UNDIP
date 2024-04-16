<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="<?php echo e(asset('assets/img/logosmk.png')); ?>" class="img" width="55" alt="">
      <a href="<?php echo e(url('dashboard')); ?>"><b>SPP SMKIU</b></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo e(url('dashboard')); ?>">PS</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('dashboard')); ?>" class="nav-link"><i class="fas fa-school"></i><span>Dashboard</span></a>
        </li>
        
        <li class="menu-header">Data Master</li>
        <li class="nav-item <?php echo e(Request::is('data-siswa') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('data-siswa')); ?>"><i class="fas fa-users"></i> <span>Data Siswa</span></a></li>
        <li class="nav-item <?php echo e(Request::is('data-kelas') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('data-kelas')); ?>"><i class="fas fa-layer-group"></i> <span>Data Kelas</span></a></li>
        <li class="nav-item <?php echo e(Request::is('data-spp') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('data-spp')); ?>"><i class="fas fa-receipt"></i> <span>Data SPP</span></a></li>
        <li class="nav-item <?php echo e(Request::is('data-petugas') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('data-petugas')); ?>"><i class="fas fa-users-cog"></i> <span>Data Admin</span></a></li>
        

        <li class="menu-header">Transaksi   </li>
        <li class="nav-item <?php echo e(Request::is('pembayaran') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('pembayaran')); ?>"><i class="fas fa-money-bill-wave"></i> <span>Pembayaran</span></a></li>
        <li class="nav-item <?php echo e(Request::is('histori-pembayaran') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('histori-pembayaran')); ?>"><i class="fas fa-history"></i> <span>Riwayat Pembayaran</span></a></li>

        
        <li class="menu-header">Ekstrak</li>
        <li class="nav-item <?php echo e(Request::is('laporan') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('laporan')); ?>"><i class="fas fa-file-invoice"></i> <span>Laporan</span></a></li>
  

      </ul>
  </aside>
</div>
<?php /**PATH C:\Users\shata\OneDrive\Documents\pengkodean\pembayaran-spp\resources\views/includes/sidebar.blade.php ENDPATH**/ ?>