<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $__env->yieldContent('title'); ?> | SPP SMKIU</title>
  <link rel="icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>" type="image/x-icon"/>


  <?php echo $__env->yieldPushContent('prepend-style'); ?>
  <?php echo $__env->make('includes.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldPushContent('addon-style'); ?>


</head>

<body>
    <div class="preloader">
        <div class="loading text-center">
          <img src="<?php echo e(asset('img/preloader2.gif')); ?>" width="150">
          <p>Harap Tunggu</p>
        </div>
      </div>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      <?php echo $__env->make('includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

      <?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

      <?php echo $__env->yieldContent('content'); ?>

      <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>

  <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldPushContent('prepend-script'); ?>
  <?php echo $__env->make('includes.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script>
    $(document).ready(function(){
    $(".preloader").delay(300).fadeOut();
    })
    </script>
  <?php echo $__env->yieldPushContent('addon-script'); ?>
</body>
</html>
<?php /**PATH C:\Users\shata\OneDrive\Documents\seno\pembayaran-spp\resources\views/layouts/master.blade.php ENDPATH**/ ?>