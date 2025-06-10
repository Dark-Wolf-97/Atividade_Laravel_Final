<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funerária Eternity - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #212529;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
        }
        .sidebar .nav-link:hover {
            color: white;
        }
        .sidebar .nav-link.active {
            color: white;
            font-weight: 600;
        }
        .main-content {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4">
                    <h4 class="text-white mb-4">Funerária Laravel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link @if(request()->routeIs('home')) active @endif">
                                <i class="bi bi-house-door me-2"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('finado.index') }}" class="nav-link @if(request()->routeIs('finados.*')) active @endif"> <!--Adicionar Rota Finados-->
                                <i class="bi bi-person-vcard me-2"></i> Finados
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(name: 'urna.index') }}" class="nav-link @if(request()->routeIs('urna.*')) active @endif"> <!--Adicionar Rota Urnas-->
                                <i class="bi bi-box-seam me-2"></i> Urnas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(name: 'velorio.index') }}" class="nav-link @if(request()->routeIs('velorios.*')) active @endif"> <!--Adicionar Rota Velorios-->
                                <i class="bi bi-building me-2"></i> Velórios
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light w-100">
                                <i class="bi bi-box-arrow-right me-2"></i> Sair
                            </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title')</h1>
                </div>
                
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>