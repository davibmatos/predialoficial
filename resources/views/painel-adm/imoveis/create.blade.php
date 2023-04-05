@extends('templates.painel-adm')
@section('title', 'Inserir Inquilinos')
@section('content')
<h6 class="mb-4"><i>CADASTRO DE IMÓVEIS</i></h6><hr>
<form method="POST" action="{{route('imoveis.insert')}}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="matricula">Matrícula</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero">
                </div>
            </div>
            <div class="col-md-4"><div class="form-group">
                <label for="exampleInputEmail1">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro">
            </div>                
            </div>            
        </div>    
          
    
        <p align="left">
        <button type="submit" class="btn btn-primary">Salvar</button>
        </p>
    </form>
@endsection
