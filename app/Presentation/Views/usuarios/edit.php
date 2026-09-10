<div class="container pt-5 mt-4 pb-4 mb-3">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-dark">
                <i class="bi bi-pencil-square me-2" aria-hidden="true"></i>Editar Usuario
            </h1>
        </div>
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 justify-content-md-end">
                    <li class="breadcrumb-item"><a href="<?= e(app_url('/')); ?>" class="text-decoration-none"><i class="bi bi-house-door-fill" aria-hidden="true"></i> Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= e(app_url('/usuarios')); ?>" class="text-decoration-none"><i class="bi bi-people-fill" aria-hidden="true"></i> Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="<?= e(app_url('/usuarios/editar')); ?>" method="post">
                <input type="hidden" name="_token" value="<?= e(\Core\Csrf::token()); ?>">
                <input type="hidden" name="id" value="<?= e($vm->usuario->id); ?>">
                <?php
                $hasError = !empty($vm->error);
                $errorAttrs = $hasError ? ' aria-invalid="true" aria-describedby="form-error-alert"' : '';
                ?>
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-bold text-primary">
                            <i class="bi bi-person-gear me-2" aria-hidden="true"></i>Modificar Registro
                        </h5>
                        <span class="badge bg-light text-primary-emphasis border px-3 py-2">ID: <?= e($vm->usuario->id); ?></span>
                    </div>
                    <div class="card-body p-4">
                        <?php if ($hasError) : ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert" id="form-error-alert" tabindex="-1">
                                <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                                <div><?= e($vm->error); ?></div>
                            </div>
                        <?php endif; ?>



                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label fw-bold text-muted small text-uppercase">Nombres</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person" aria-hidden="true"></i></span>
                                    <input type="text" value="<?= e($vm->usuario->nombres); ?>" class="form-control" name="nombres" id="nombres" required<?= $errorAttrs; ?>>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label fw-bold text-muted small text-uppercase">Apellidos</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person" aria-hidden="true"></i></span>
                                    <input type="text" value="<?= e($vm->usuario->apellidos); ?>" class="form-control" name="apellidos" id="apellidos" required<?= $errorAttrs; ?>>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="usuario" class="form-label fw-bold text-muted small text-uppercase">Nombre de Usuario</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-at" aria-hidden="true"></i></span>
                                    <input type="text" value="<?= e($vm->usuario->usuario); ?>" class="form-control" name="usuario" id="usuario" required<?= $errorAttrs; ?>>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="clave" class="form-label fw-bold text-muted small text-uppercase">Nueva Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-key" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="clave" id="clave" placeholder="Dejar vacío para conservar"<?= $errorAttrs; ?>>
                                </div>
                                <div class="form-text small">Solo rellena este campo si deseas cambiar la contraseña actual.</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="correo" class="form-label fw-bold text-muted small text-uppercase">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope" aria-hidden="true"></i></span>
                                <input type="email" value="<?= e($vm->usuario->correo); ?>" class="form-control" name="correo" id="correo" required<?= $errorAttrs; ?>>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                <a class="btn btn-light border shadow-sm w-100" href="<?= e(app_url('/usuarios')); ?>" role="button">
                                    <i class="bi bi-x-circle" aria-hidden="true"></i> Cancelar
                                </a>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <button type="submit" class="btn btn-success shadow-sm w-100 text-white">
                                    <i class="bi bi-save" aria-hidden="true"></i> Actualizar Cambios
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        var alertEl = document.getElementById('form-error-alert');
        if (alertEl) {
            alertEl.focus();
        }
    })();
</script>