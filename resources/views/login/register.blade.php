<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de usuario</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed"
        style="background: #4e73df;
        background: linear-gradient(90deg,#4e73df 30%, #36b9cc 60%);
        background: -webkit-linear-gradient(90deg,#4e73df 30%, #36b9cc 60%);
        background: -moz-linear-gradient(90deg,#4e73df 30%, #36b9cc 60%);">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="mb-0">
                            <div class="card card-body"
                                style="border: 10px inset #ff6550; border-radius: 25px; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
                                -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
                                -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
                                <div class="row text-nowrap text-center w-50 mx-auto my-auto mb-4">
                                    <img src="{{ asset('assets/images/logos/logo.png') }}" width="40px"
                                        alt="MSAE">
                                </div>
                                <form method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md">
                                            <label for="cedula" class="form-label">Cédula</label>
                                            <input type="text" class="form-control" name="cedula" id="cedula"
                                                aria-describedby="textHelp" required maxlength="12">
                                        </div>
                                        <div class="mb-3 col-md">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre"
                                                aria-describedby="textHelp" required maxlength="60">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md">
                                            <label for="apellido1" class="form-label">Primer apellido</label>
                                            <input type="text" class="form-control" name="apellido1" id="apellido1"
                                                aria-describedby="textHelp" maxlength="50">
                                        </div>
                                        <div class="mb-3 col-md">
                                            <label for="apellido2" class="form-label">Segundo apellido</label>
                                            <input type="text" class="form-control" name="apellido2" id="apellido2"
                                                aria-describedby="textHelp" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md">
                                            <label for="fechaDeNacimiento" class="form-label">Fecha de
                                                nacimiento</label>
                                            <input type="date" class="form-control" name="fechaDeNacimiento"
                                                id="fechaDeNacimiento" aria-describedby="textHelp" required>
                                        </div>
                                        <div class="mb-3 col-md">
                                            <label for="telefono" class="form-label">Telefono</label>
                                            <input type="number" class="form-control" name="telefono" id="telefono"
                                                aria-describedby="textHelp" maxlength="12">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md">
                                            <label for="tipoUsuario" class="form-label">Tipo de usuario</label>
                                            <select class="form-control" name="tipoUsuario" id="tipoUsuario" required
                                                aria-describedby="textHelp">
                                                <option value="">---Seleccione el tipo de usuario--</option>
                                                <option value="1">Profesor</option>
                                                <option value="2">Estudiante</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md">
                                            <label for="correo" class="form-label">Correo
                                                electronico</label>
                                            <input type="email" class="form-control" name="correo" id="correo"
                                                aria-describedby="emailHelp" required maxlength="120">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md">
                                            <label for="usuario" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" name="usuario" id="usuario"
                                                aria-describedby="textHelp" required maxlength="60">
                                        </div>
                                        <div class="mb-3 col-md">
                                            <label for="contrasena" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="contrasena"
                                                id="contrasena" required maxlength="12">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Registrar</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Ya tienes una cuenta?</p>
                                        <a class="text-primary fw-bold ms-2" href="/login">Inicia session</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
