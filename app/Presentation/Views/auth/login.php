<!doctype html>
<html lang="es">

<head>
    <title>Sistema de Gestión · Iniciar sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?= e(app_url('/img/compras.png')); ?>" rel="shortcut icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= e(app_url('/css/style.css')); ?>">
</head>

<body>
    <div class="snow" aria-hidden="true">
        <div class="flake"> ❅ </div>
        <div class="flake"> ❅ </div>
        <div class="flake"> ❆ </div>
        <div class="flake"> ❅ </div>
        <div class="flake"> ❅ </div>
        <div class="flake"> ❆ </div>
        <div class="flake"> ❅ </div>
        <div class="flake"> ❅ </div>
        <div class="flake"> ❆ </div>
        <div class="flake"> ❅ </div>
    </div>
    <div class="container login-form">
        <div class="login-content">
            <form method="post" action="<?= e(app_url('/login')); ?>">
                <input type="hidden" name="_token" value="<?= e(\Core\Csrf::token()); ?>">
                <?php $hasError = !empty($vm->mensaje); ?>
                <img src="<?= e(app_url('/img/avatar.svg')); ?>" alt="Imagen Usuario">
                <h1 class="title">BIENVENIDO</h1>
                <?php if ($hasError) { ?>
                    <div class="alert alert-danger" role="alert" id="login-error">
                        <strong><?= e($vm->mensaje); ?></strong>
                    </div>
                <?php } ?>
                <div class="input-div one">
                    <div class="i">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                    </div>
                    <div class="div">
                        <label for="usuario">Usuario</label>
                        <input id="usuario" type="text" class="input" name="usuario" title="Usuario" autocomplete="username" required <?= $hasError ? 'aria-invalid="true" aria-describedby="login-error"' : '' ?>>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                        </svg>
                    </div>
                    <div class="div">
                        <label for="contrasena">Contraseña</label>
                        <input type="password" id="contrasena" class="input" name="password" title="Contraseña" autocomplete="current-password" required <?= $hasError ? 'aria-invalid="true" aria-describedby="login-error"' : '' ?>>
                    </div>
                </div>
                <div class="view">
                    <button type="button" id="verPassword" class="verPassword" aria-label="Mostrar contraseña" aria-pressed="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="icon-eye" viewBox="0 0 16 16" aria-hidden="true">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="icon-eye-slash" viewBox="0 0 16 16" aria-hidden="true">
                            <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                        </svg>
                    </button>
                </div>
                <?php if (filter_var($_ENV['REMEMBER_ME_ENABLED'] ?? true, FILTER_VALIDATE_BOOLEAN)) : ?>
                    <div class="remember-me">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <label for="remember">Recuérdame</label>
                        </div>
                    </div>
                <?php endif; ?>
                <button name="btningresar" class="btn" type="submit">INICIAR SESIÓN</button>
            </form>
        </div>
    </div>

    <script src="<?= e(app_url('/js/main.js')); ?>"></script>
    <script src="<?= e(app_url('/js/main2.js')); ?>"></script>
</body>

</html>