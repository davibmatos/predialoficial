<?php $__env->startSection('title', 'Painel Administrativo'); ?>
<?php $__env->startSection('content'); ?>
<?php
@session_start();
if (@$_SESSION['nivel_usuario'] != 'admin') {
    echo "<script language='javascript'> window.location='./' </script>";
}
?>

<style>
  .card {
    border: 1px solid #d1d1d1;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }

  .card-body {
    padding: 20px;
  }

  .card-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .card-text {
    font-size: 24px;
    color: #333;
    font-weight: bold;
  }
</style>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total de Imóveis</h5>
        <p class="card-text"><?php echo e($totalImoveis); ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Imóveis Disponíveis</h5>
        <p class="card-text"><?php echo e($imoveisDisponiveis); ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Imóveis Locados</h5>
        <p class="card-text"><?php echo e($imoveisLocados); ?></p>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.painel-adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\predial\resources\views/painel-adm/index.blade.php ENDPATH**/ ?>