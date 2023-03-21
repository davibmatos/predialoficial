<?php $__env->startSection('title', 'Painel Administrativo'); ?>
<?php $__env->startSection('content'); ?>
<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] != 'admin'){ 
  echo "<script language='javascript'> window.location='./' </script>";
}
?>
Home do Administrador
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.painel-adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\predial\resources\views/painel-adm/index.blade.php ENDPATH**/ ?>