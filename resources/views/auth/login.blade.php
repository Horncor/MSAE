<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de session</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    @include('layouts.style')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed"
        style="background: #4e73df;
        background: linear-gradient(90deg,#4e73df 30%, #36b9cc 60%);
        background: -webkit-linear-gradient(90deg,#4e73df 30%, #36b9cc 60%);
        background: -moz-linear-gradient(90deg,#4e73df 30%, #36b9cc 60%);">
                @include('layouts.navbar')
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="mb-0">
                            <div class="card card-body"
                                style="border: 10px inset #ff6550; border-radius: 25px;
                                -moz-border-radius: 10px 10px 10px 10px; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
                                -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
                                -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
                                <div class="row text-nowrap text-center w-50 mx-auto my-auto mb-4">
                                    <img src="{{ asset('assets/images/logos/logo.png') }}" width="40px"
                                        alt="MSAE">
                                </div>
                                <form action="/login/authenticate" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="user" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" id="user" name="NOMBRE"
                                            aria-describedby="textHelp" maxlength="60">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" maxlength="12">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Recuerdame en este dispositivo
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="./index.html">olvidaste la contraseña
                                            ?</a>
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Iniciar
                                        sesión</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">No tienes una cuenta aún?</p>
                                        <a class="text-primary fw-bold ms-2" href="/register">Crear cuenta</a>
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
    @include('layouts.script')
</body>

</html>
