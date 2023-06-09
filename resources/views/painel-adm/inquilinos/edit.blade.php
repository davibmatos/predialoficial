@extends('templates.painel-adm')
@section('title', 'Editar Inquilinos')
@section('content')

<div class="container">
    <h6 class="mb-4"><i>EDIÇÃO DE INQUILINOS</i></h6>
    <hr>
    <form method="POST" action="{{route('inquilinos.editar', $item)}}">
        @csrf
        @method('put')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input value="{{$item->nome}}" type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="{{$item->email}}" type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input value="{{$item->cpf}}" type="text" class="form-control" id="cpf" name="cpf">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rg">RG</label>
                    <input value="{{$item->rg}}" type="text" class="form-control" id="rg" name="rg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input value="{{$item->telefone}}" type="text" class="form-control" id="telefone" name="telefone">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="3">{{$item->observacoes}}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-left">
                <input value="{{$item->cpf}}" type="hidden" name="oldcpf">
                <input value="{{$item->email}}" type="hidden" name="oldemail">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
</div>

@endsection