@extends('templates.painel-adm')
@section('title', 'Painel Administrativo')
@section('content')
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
        <p class="card-text">{{ $totalImoveis }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Imóveis Disponíveis</h5>
        <p class="card-text">{{ $imoveisDisponiveis }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Imóveis Locados</h5>
        <p class="card-text">{{ $imoveisLocados }}</p>
      </div>
    </div>
  </div>
</div>

@endsection