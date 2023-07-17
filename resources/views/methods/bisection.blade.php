<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSAE | Bisección</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    @include('layouts.style')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('layouts.navbar')
        <div id="myModal" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 id="TitleModal" class="modal-title">Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="ModalContent" class="modal-body">
                    <!-- Contenido del modal -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
        <div class="body-wrapper">
            @include('layouts.header')
            <div class="container-fluid">
                <div class="d-flex justify-content-end pb-2">
                    <h4 class="fw-bolder">Metodo de Bisección</h4>
                </div>
                <div class="d-flex justify-content-between pb-2">
                    <p class="fs-5">Rellena los campos necesarios</p>
                    <p class="text-danger fs-5">Todos los campos son requeridos</p>
                </div>
                <div class="container pb-4">
                    <div class="row px-2 pb-1">
                         <div class="col-sm-6 col-md-6 col-lg has-validation">
                            <label for="func" class="form-label">Ecuacion</label>
                            <input type="text" class="form-control" id="func" aria-describedby="valor1Help">
                            <div id="valor1Help" class="form-text">Ingrese una funcion valida.</div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg">
                            <label for="valorA" class="form-label">Intervalo A</label>
                            <input type="number" class="form-control" id="valorA" aria-describedby="valor2Help">
                            <div id="valor2Help" class="form-text">Unicamente se permiten numeros.</div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg">
                            <label for="valorB" class="form-label">Intervalo B</label>
                            <input type="number" class="form-control" id="valorB" aria-describedby="valor3Help">
                            <div id="valor3Help" class="form-text">Unicamente se permiten numeros.</div>
                        </div>  
                        <div class="col-sm-6 col-md-6 col-lg">
                            <label for="tolerancia" class="form-label">Tolerancia</label>
                            <input type="number" class="form-control" id="tolerancia" aria-describedby="valor4Help">
                            <div id="valor4Help" class="form-text">Unicamente se permiten numeros.</div>
                        </div>           
                    </div>
                </div>
                <div class="d-flex justify-content-between pb-2">
                    <p class="fs-5">Resultados de la operacion</p>
                    <button type="button" onclick="validateFunc()" class="btn btn-primary">Realizar Calculo</button>
                </div>
                <div id="table-result-operation">
                    
                </div>
            </div>
        </div>
        @include('layouts.script')
    <script src="{{ asset('assets/js/methodBiseccion.js') }}"></script>
</body>

</html>
