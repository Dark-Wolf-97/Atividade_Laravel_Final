@extends('layout')

@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Bem-vindo ao Sistema!</h4>
                
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card bg-dark text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Finados</h5>
                               <a href="{{ route('finado.index') }}" class="btn btn-light">Acessar</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card bg-dark text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Urnas</h5>
                                <a href="{{ route('urna.index') }}" class="btn btn-light">Acessar</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card bg-dark text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Velórios</h5>
                                <a href="{{ route('velorio.index') }}" class="btn btn-light">Acessar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection