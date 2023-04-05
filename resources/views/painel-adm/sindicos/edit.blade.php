
@extends('templates.painel-adm')
@section('title', 'Editar Instrutores')
@section('content')
<h6 class="mb-4"><i>EDIÇÃO DE INSTRUTORES</i></h6><hr>
<form method="POST" action="{{route('sindicos.editar', $item)}}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input value="{{$item->nome}}" type="text" class="form-control" id="" name="nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input value="{{$item->email}}" type="email" class="form-control" id="" name="email">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">CPF</label>
                    <input value="{{$item->cpf}}" type="text" class="form-control" id="cpf" name="cpf">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input value="{{$item->telefone}}" type="text" class="form-control" id="telefone" name="telefone">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Credencial</label>
                    <input value="{{$item->credencial}}" type="text" class="form-control" id="" name="credencial">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Vencimento Credencial</label>
                    <input value="{{$item->data}}" type="date" class="form-control" id="data" name="data">
                </div>
            </div>
        </div>
    
        <p align="left">
        <input value="{{$item->credencial}}" type="hidden"  name="oldcredencial">
        <input value="{{$item->cpf}}" type="hidden"  name="oldcpf">
        <input value="{{$item->email}}" type="hidden"  name="oldemail">
        <button type="submit" class="btn btn-primary">Salvar</button>
        </p>
    </form>
@endsection