@extends('templates.painel-adm')
@section('title', 'Contratos vencidos')
@section('content')
<html>
<head></head>
<body>
    <h1>Lista de contratos vencidos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Inquilino</th>
                <th>Edificio</th>
                <th>Apartamento</th>
                <th>Vencimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expiredContracts as $contract)
                <tr>
                    <td>{{ $contract->id }}</td>
                    <td>{{ $contract->inquilino->nome }}</td>
                    <td>{{ $contract->apartamento->imovel->edificio }}</td>
                    <td>{{ $contract->apartamento->numero }}</td>
                    <td>{{ $contract->vencimento }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>