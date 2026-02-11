<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Carrinho Smart')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        :root {
            --header-height: 56px;
        }

        body {
            padding-top: var(--header-height);
            padding-bottom: 80px;
            background-color: #f5f7fa;
        }

        /* Header fixo */
        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            height: var(--header-height);
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .navbar-fixed .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.15rem;
            color: #198754 !important;
            text-decoration: none;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Botões touch-friendly */
        .btn-touch {
            min-width: 44px;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Rodapé fixo */
        .total-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            border-top: 2px solid #198754;
            padding: 12px 16px;
            box-shadow: 0 -4px 12px rgba(0,0,0,0.1);
            z-index: 1020;
        }

        /* Cards de item */
        .item-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e8e8e8;
            padding: 14px;
            margin-bottom: 10px;
            transition: box-shadow 0.2s;
        }
        .item-card:active {
            box-shadow: 0 0 0 2px rgba(25,135,84,0.25);
        }

        /* Botões +/- */
        .btn-qty {
            width: 38px;
            height: 38px;
            padding: 0;
            border-radius: 50%;
            font-size: 18px;
            font-weight: 700;
            line-height: 38px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Input quantidade */
        .qty-input {
            width: 52px;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            background: transparent;
            -moz-appearance: textfield;
        }
        .qty-input::-webkit-inner-spin-button,
        .qty-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Input preço */
        .preco-input {
            font-weight: 600;
            font-size: 1rem;
            text-align: right;
            -moz-appearance: textfield;
        }
        .preco-input::-webkit-inner-spin-button,
        .preco-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Badge contagem */
        .badge-count {
            font-size: 0.7rem;
            padding: 2px 6px;
        }

        /* Animação remove */
        .item-removing {
            animation: fadeOut 0.3s ease forwards;
        }
        @keyframes fadeOut {
            to { opacity: 0; transform: translateX(100px); height: 0; padding: 0; margin: 0; overflow: hidden; }
        }

        /* SweetAlert custom */
        .swal2-input, .swal2-select {
            font-size: 16px !important;
        }

        [x-cloak] { display: none !important; }
    </style>
    
    @stack('styles')
</head>
<body>
    @if(auth()->check())
        <nav class="navbar-fixed">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">🛒 Carrinho Smart</a>
                <div class="navbar-actions">
                    @yield('header-actions')
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary btn-touch" title="Sair">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    @endif

    <main class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Máscara de preço global -->
    <script>
    function mascaraPreco(input) {
        let v = input.value.replace(/\D/g, '');
        if (v === '') { input.value = ''; return; }
        v = (parseInt(v) / 100).toFixed(2);
        input.value = v;
    }
    </script>
    
    @stack('scripts')
</body>
</html>
