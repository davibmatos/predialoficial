@extends('templates.painel-adm')
@section('title', 'Inserir Inquilinos')
@section('content')

<div class="container">
    <h6 class="mb-4"><i>CADASTRO DE INQUILINOS</i></h6>
    <hr>
    <form method="POST" action="{{route('inquilinos.insert')}}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rg">RG</label>
                    <input type="text" class="form-control" id="rg" name="rg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="4"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-left">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
</div>
@endsection