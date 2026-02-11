<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Carrinho Smart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7fa; min-height: 100vh; display: flex; align-items: center; }
        .login-card { border-radius: 16px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-8 col-md-5 col-lg-4">
                <div class="card login-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="fs-1">🛒</div>
                            <h4 class="fw-bold text-success">Carrinho Smart</h4>
                            <p class="text-muted mb-0">Entre na sua conta</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required autofocus
                                       inputmode="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Senha</label>
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Lembrar de mim</label>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100 mb-3">Entrar</button>

                            <div class="text-center">
                                <p class="mb-0">Não tem conta? <a href="{{ route('register') }}" class="text-success fw-bold">Criar conta</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
