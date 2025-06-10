@extends('layout')

@section('title', 'Velórios')

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
            <h4 class="card-title">Lista de Velórios</h4>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createVelorioModal">
                <i class="bi bi-plus-circle me-2"></i>Novo Velório
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Finado</th>
                    <th>Data Velório</th>
                    <th>Urna</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($velorios as $velorio)
                    <tr>
                        <td>{{ $velorio->id }}</td>
                        <td>{{ $velorio->finado->finado_nome }}</td>
                        <td>{{ \Carbon\Carbon::parse($velorio->velorio_data)->format('d/m/Y') }}</td>
                        <td>{{ $velorio->urna->urna_nome }}</td>
                        <td>
                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#editVelorioModal"
                                onclick="loadEditData({{ $velorio->id }}, '{{ $velorio->velorio_data }}', 
                                {{ $velorio->finado_id }}, {{ $velorio->urna_id }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            
                            <form action="{{ route('velorio.destroy', $velorio->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Tem certeza que deseja excluir este velório?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Nenhum registro encontrado</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="createVelorioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Velório</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('velorio.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Finado</label>
                        <select class="form-select" name="finado_id" id="finado_id" required>
                            @foreach($finados as $finado)
                                <option value="{{ $finado->id }}">{{ $finado->finado_nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urna</label>
                        <select class="form-select" name="urna_id" id="urna_id" required>
                            @foreach($urna as $item)
                                <option value="{{ $item->id }}">{{ $item->urna_nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data Velório</label>
                        <input type="date" class="form-control" name="velorio_data" id="velorio_data" required min="{{ \Carbon\Carbon::today()->toDateString() }}" >
                    </div>
                    <input type="hidden" name="usuario_id" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-dark">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editVelorioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Velório</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editVelorioForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Finado</label>
                        <select class="form-select" name="finado_id" id="edit_finado_id" required>
                            @foreach($finados as $finado)
                                <option value="{{ $finado->id }}">{{ $finado->finado_nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urna</label>
                        <select class="form-select" name="urna_id" id="edit_urna_id" required>
                            @foreach($urna as $item)
                                <option value="{{ $item->id }}">{{ $item->urna_nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data Velório</label>
                        <input type="date" class="form-control" name="velorio_data" id="edit_velorio_data" required>
                    </div>
                    <input type="hidden" name="usuario_id" value="1">
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
function loadEditData(id, dataVelorio, finadoId, urnaId) {
    const form = document.getElementById('editVelorioForm');
    form.action = `/velorio/${id}`;
    
    document.getElementById('edit_velorio_data').value = dataVelorio;
    document.getElementById('edit_finado_id').value = finadoId;
    document.getElementById('edit_urna_id').value = urnaId;
}
</script>
@endpush