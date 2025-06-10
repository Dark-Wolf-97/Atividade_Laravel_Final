@extends('layout')

@section('title', 'Urnas')

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
            <h4 class="card-title">Lista de Urnas</h4>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createUrnaModal">
                <i class="bi bi-plus-circle me-2"></i>Nova Urna
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Material</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($urnas as $urna)
                    <tr>
                        <td>{{ $urna->id }}</td>
                        <td>{{ $urna->urna_nome }}</td>
                        <td>{{ $urna->urna_tipo }}</td>
                        <td>{{ $urna->urna_material }}</td>
                        <td>R$ {{ number_format($urna->urna_preco, 2, ',', '.') }}</td>
                        <td>
                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#editUrnaModal"
                                onclick="loadEditData({{ $urna->id }}, '{{ addslashes($urna->urna_nome) }}', 
                                '{{ $urna->urna_tipo }}', '{{ $urna->urna_material }}', {{ $urna->urna_preco }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            
                            <form action="{{ route('urna.destroy', $urna->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Tem certeza que deseja excluir esta urna?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Nenhum registro encontrado</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="createUrnaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Urna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('urna.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="urna_nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="urna_nome" name="urna_nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="urna_tipo" class="form-label">Tipo</label>
                        <select class="form-select" id="urna_tipo" name="urna_tipo" required>
                            <option value="Caixão">Caixão</option>
                            <option value="Urna">Urna</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="urna_material" class="form-label">Material</label>
                        <select class="form-select" id="urna_material" name="urna_material" required>
                            <option value="Madeira">Madeira</option>
                            <option value="Metal">Metal</option>
                            <option value="Mármore">Mármore</option>
                            <option value="Bronze">Bronze</option>
                            <option value="Aço">Aço</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="urna_preco" class="form-label">Preço (R$)</label>
                        <input type="number" step="0.01" min="1" class="form-control" 
                            id="urna_preco" name="urna_preco" required>
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


<div class="modal fade" id="editUrnaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Urna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editUrnaForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_urna_nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="edit_urna_nome" name="urna_nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_urna_tipo" class="form-label">Tipo</label>
                        <select class="form-select" id="edit_urna_tipo" name="urna_tipo" required>
                            <option value="Caixão">Caixão</option>
                            <option value="Urna">Urna</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_urna_material" class="form-label">Material</label>
                        <select class="form-select" id="edit_urna_material" name="urna_material" required>
                            <option value="Madeira">Madeira</option>
                            <option value="Metal">Metal</option>
                            <option value="Mármore">Mármore</option>
                            <option value="Bronze">Bronze</option>
                            <option value="Aço">Aço</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_urna_preco" class="form-label">Preço (R$)</label>
                        <input type="number" step="0.01" min="1" class="form-control" 
                            id="edit_urna_preco" name="urna_preco" required>
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
function loadEditData(id, nome, tipo, material, preco) {
    const form = document.getElementById('editUrnaForm');
    form.action = `/urna/${id}`;
    
    document.getElementById('edit_urna_nome').value = nome;
    document.getElementById('edit_urna_tipo').value = tipo;
    document.getElementById('edit_urna_material').value = material;
    document.getElementById('edit_urna_preco').value = preco;
}
</script>
@endpush