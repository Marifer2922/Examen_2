<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión - AGROVALLE Honduras</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('plantilla/assets/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:400,700,800" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" />

    <style>
        body {
            font-family: "Lato", sans-serif;
            background: linear-gradient(135deg, #14532d 0%, #1e6b34 55%, #2e8b47 100%);
        }
        .login-card {
            border: 0;
            border-radius: 1rem;
            overflow: hidden;
        }
        .login-encabezado {
            background-color: #14532d;
            border-bottom: 4px solid #f4b400;
        }
        .login-encabezado img {
            max-width: 220px;
        }
        .login-titulo {
            font-family: "Catamaran", sans-serif;
            font-weight: 800;
            color: #14532d;
        }
        .btn-agro {
            background-color: #1e6b34;
            border-color: #1e6b34;
            color: #fff;
            font-weight: 700;
        }
        .btn-agro:hover {
            background-color: #14532d;
            border-color: #14532d;
            color: #fff;
        }
        .form-check-input:checked {
            background-color: #1e6b34;
            border-color: #1e6b34;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-4">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                <div class="card login-card shadow-lg">
                    <div class="login-encabezado text-center py-4">
                        <img src="{{ asset('plantilla/assets/img/logo-agrovalle.svg') }}" alt="Logo AGROVALLE Honduras" class="img-fluid">
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <h1 class="h4 login-titulo text-center mb-1">Iniciar Sesión</h1>
                        <p class="text-muted text-center small mb-4">Sistema de Gestión Interna</p>

                        <form action="{{ route('login.post') }}" method="POST" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Correo institucional</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="usuario@agrovalle.hn" autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Use su correo con dominio @agrovalle.hn</div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Contraseña</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Ingrese su contraseña">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input type="checkbox" id="remember" name="remember" value="1" class="form-check-input">
                                <label for="remember" class="form-check-label">Recordar mi sesión</label>
                            </div>

                            <button type="submit" class="btn btn-agro w-100 py-2">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar al sistema
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
