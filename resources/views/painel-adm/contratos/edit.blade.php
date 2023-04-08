
@extends('templates.painel-adm')
@section('title', 'Editar Contratos')
@section('content')
<h6 class="mb-4"><i>EDIÇÃO DE CONTRATOS</i></h6><hr>
<form method="POST" action="{{route('contratos.editar', $item)}}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">CPF</label>
                    <input value="{{$item->cpf}}" type="text" class="form-control" id="" name="nome">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input value="{{$item->nome}}" type="email" class="form-control" id="" name="email" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Edifício</label>
                    <input value="{{$item->edificio}}" type="text" class="form-control" id="edificio" name="edificio" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input value="{{$item->telefone}}" type="text" class="form-control" id="telefone" name="telefone" disabled>
                </div>
            </div>   
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Data do vencimento</label>
                    <input value="{{$item->vencimento}}" type="text" class="form-control" id="vencimento" name="vencimento">

                </div>
            </div>         
        </div>
    
        <p align="left">
        <input value="{{$item->cpf}}" type="hidden"  name="oldcpf">
        <input value="{{$item->vencimento}}" type="hidden"  name="oldvencimento">
        <button type="submit" class="btn btn-primary">Salvar</button>
        </p>
    </form>
@endsection