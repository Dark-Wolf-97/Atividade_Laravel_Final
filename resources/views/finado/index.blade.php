@extends('layout')

@section('title', 'Finados')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <h4 class="card-title">Lista de Finados</h4>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createFinadoModal">
                <i class="bi bi-plus-circle me-2"></i>Novo Finado
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Certidão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($finados as $finado)
                    <tr>
                        <td>{{ $finado->id }}</td>
                        <td>{{ $finado->finado_nome }}</td>
                        <td>{{ $finado->finado_certidao }}</td>
                        <td>
                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#editFinadoModal"
                                onclick="loadEditData({{ $finado->id }}, '{{ addslashes($finado->finado_nome) }}', '{{ $finado->finado_certidao }}')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('finado.destroy', ['finado' => $finado->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Tem certeza que deseja excluir este finado?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Nenhum registro encontrado</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="createFinadoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Finado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('finado.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="finado_nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="finado_nome" name="finado_nome" 
                            required oninput="this.value = this.value.replace(/[0-9]/g, '')">
                    </div>
                    <div class="mb-3">
                        <label for="finado_certidao" class="form-label">Certidão</label>
                        <input type="number" min="1" class="form-control" id="finado_certidao" 
                            name="finado_certidao" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-dark">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editFinadoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Finado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editFinadoForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_finado_nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="edit_finado_nome" name="finado_nome" 
                            required oninput="this.value = this.value.replace(/[0-9]/g, '')">
                    </div>
                    <div class="mb-3">
                        <label for="edit_finado_certidao" class="form-label">Certidão</label>
                        <input type="number" min="1" class="form-control" id="edit_finado_certidao" 
                            name="finado_certidao" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-dark">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function loadEditData(id, nome, certidao) {
    const form = document.getElementById('editFinadoForm');
    form.action = `/finado/${id}`;
    
    document.getElementById('edit_finado_nome').value = nome;
    document.getElementById('edit_finado_certidao').value = certidao;
}
</script>
@endpush