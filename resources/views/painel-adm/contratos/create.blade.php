@extends('templates.painel-adm')
@section('title', 'Inserir Contratos')
@section('content')

    <h6 class="mb-4"><i>CADASTRO DE CONTRATOS</i></h6>
    <hr>
    <form method="POST" action="{{ route('contratos.insert') }}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                    <input type="hidden" id="inquilino_id" name="inquilino_id">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="edificio">Edifício</label>
                    <select class="form-control" id="edificio" name="edificio" required>
                        <option value="" selected disabled>Selecione um edifício</option>
                        @foreach ($edificios as $edificio)
                            <option value="{{ $edificio->edificio }}">{{ $edificio->edificio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="apartamento">Apartamento</label>
                    <select class="form-control" id="apartamento" name="apartamento_id" disabled>
                        <option value="" selected disabled>Selecione um apartamento</option>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Data do Vencimento</label>
                    <input type="date" class="form-control" id="vencimento" name="vencimento">
                </div>
            </div>
        </div>

        <p align="right">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </p>
        <button type="button" id="debugButton">Debug</button>
    </form>
    <script>
        window.inquilinosPorCpfUrl = "{{ url('/inquilinos/por-cpf') }}";
    </script>

@endsection

@section('scripts')
    <script>
        document.getElementById('cpf').addEventListener('change', async function() {
    const cpf = this.value;
    try {
        const response = await fetch('/predial/public/inquilinos/por-cpf/' + cpf);
        if (response.ok) {
            const inquilino = await response.json();
            if (inquilino) {
                console.log(inquilino.nome);
                document.getElementById('nome').value = inquilino.nome;
                document.getElementById('telefone').value = inquilino.telefone;
                document.getElementById('inquilino_id').value = inquilino.id; 
            } else {
                document.getElementById('nome').value = '';
                document.getElementById('telefone').value = '';
                document.getElementById('inquilino_id').value = '';
                alert('Inquilino não encontrado');
            }
        } else {
            throw new Error('Erro ao buscar inquilino');
        }
    } catch (error) {
        console.error(error);
    }
});

        document.getElementById('edificio').addEventListener('change', async function() {
            const edificio = this.value;
            const apartamentosPorEdificioUrl =
                `/predial/public/imoveis/${encodeURIComponent(edificio)}/apartamentos`;
            console.log(apartamentosPorEdificioUrl);

            try {
                const response = await fetch(apartamentosPorEdificioUrl);
                if (response.ok) {
                    const apartamentos = await response.json();
                    console.log('Apartamentos:', apartamentos);
                    const apartamentoSelect = document.getElementById('apartamento');
                    apartamentoSelect.innerHTML =
                        '<option value="" selected disabled>Selecione um apartamento</option>';
                    apartamentos.forEach(apartamento => {
                        const option = document.createElement('option');
                        option.value = apartamento.id;
                        option.text = apartamento.numero;
                        option.dataset.valor = apartamento.valor; // Adicione o atributo data-valor
                        apartamentoSelect.add(option);
                    });
                    apartamentoSelect.disabled = false;
                } else {
                    throw new Error('Erro ao buscar apartamentos');
                }
            } catch (error) {
                console.error(error);
            }
        });

        document.getElementById('apartamento').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const valor = selectedOption.dataset.valor; 
            document.getElementById('valor').value = valor;
        });
        document.getElementById('debugButton').addEventListener('click', function() {
    console.log('CPF:', document.getElementById('cpf').value);
    console.log('Nome:', document.getElementById('nome').value);
    console.log('Telefone:', document.getElementById('telefone').value);
    console.log('Inquilino ID:', document.getElementById('inquilino_id').value);
});
    </script>
@endsection
