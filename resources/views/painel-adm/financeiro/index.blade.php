@extends('templates.painel-adm')
@section('title', 'Painel Financeiro')
@section('content')

<style>
  .card {
    border: 1px solid #d1d1d1;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }

  .card-header {
    background-color: #f5f5f5;
    padding: 10px;
    border-bottom: 1px solid #d1d1d1;
    font-weight: bold;
    color: #333;
  }

  .card-body {
    padding: 20px;
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
      <div class="card-header">Valores Recebidos</div>
      <div class="card-body">
        <p class="card-text">R$ {{ number_format($valoresRecebidos, 2, ',', '.') }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">Valores a Receber</div>
      <div class="card-body">
        <p class="card-text">R$ {{ number_format($valoresAReceber, 2, ',', '.') }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">Valores Pendentes</div>
      <div class="card-body">
        <p class="card-text">R$ {{ number_format($valoresPendentes, 2, ',', '.') }}</p>
      </div>
    </div>
  </div>
</div>

@endsection