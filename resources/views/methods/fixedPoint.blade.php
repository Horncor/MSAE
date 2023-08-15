<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSAE | Punto Fijo</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    @include('layouts.style')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('layouts.navbar')
        <div class="body-wrapper">
            @include('layouts.header')
            <div class="container-fluid mb-4">
                <div class="row" style="border: 10px outset #ff6550;border-radius: 19px 19px 19px 19px;
                -webkit-border-radius: 19px 19px 19px 19px;
                -moz-border-radius: 19px 19px 19px 19px;box-shadow: 10px 10px 14px -2px rgba(0,0,0,0.44);
                -webkit-box-shadow: 10px 10px 14px -2px rgba(0,0,0,0.44);
                -moz-box-shadow: 10px 10px 14px -2px rgba(0,0,0,0.44);">
                    <div class="d-flex justify-content-end pb-2">
                        <h4 class="fw-bolder">Metodo de Punto Fijo</h4>
                    </div>
                    <div class="d-flex justify-content-between pb-2">
                        <p class="fs-5">Rellena los campos necesarios</p>
                        <p class="text-danger fs-5">Todos los campos son requeridos</p>
                    </div>
                    <div class="container pb-4">
                        <div class="row px-2 pb-1">
                            <div class="col-md has-validation">
                                <label for="originalFunction" class="form-label">Función original</label>
                                <input type="text" class="form-control" onblur="ApplyBolzano()" id="originalFunction"
                                    aria-describedby="valor1Help">
                                <div id="valor1Help" class="form-text">Ingrese una función original.</div>
                            </div>
                            <div class="col-md has-validation">
                                <label for="func" class="form-label">Función iterativa</label>
                                <input type="text" class="form-control" id="func" aria-describedby="valor2Help">
                                <div id="valor2Help" class="form-text">Ingrese una función iterativa.</div>
                            </div>
                            <div class="col-md">
                                <label for="valueXI" class="form-label">Valor Inicial</label>
                                <input type="number" class="form-control" id="valueXI" aria-describedby="valor3Help">
                                <div id="valor3Help" class="form-text">Unicamente se permiten numeros.</div>
                            </div>
                            <div class="col-md">
                                <label for="tolerancia" class="form-label">Tolerancia</label>
                                <input type="number" class="form-control" id="tolerancia" aria-describedby="valor4Help">
                                <div id="valor4Help" class="form-text">Unicamente se permiten numeros.</div>
                            </div>
                            <div class="col-md">
                                <label class="form-label" for="decimals">Decimales:
                                    <output class="decimals-output" for="decimals">9</output>
                                </label>
                                <input type="range" class="form-range" name="decimals" id="decimals" min="1"
                                    max="13" step="1" value="9" aria-describedby="decimals" />
                                <div id="decimals" class="form-text">Selecciona la cantidad de decimales.</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between pb-2">
                        <p class="fs-5">Resultados de la operacion</p>
                        <button type="button" onclick="validateFunc()" class="btn btn-primary">Realizar
                            Calculo</button>
                    </div>
                </div>
            </div>
            <br>
            <div id="table-result-operation">

            </div>
            <div class="row text-center m-auto">
                <div class="col-md">
                    <div id='append-title'>

                    </div>
                        <div id="graphDiv"  style="width:100%; height: 400px;">

                    </div>
                </div>
            </div>
        </div>
        @include('layouts.script')
        <script src="{{ asset('assets/js/methodfixedPoint.js') }}"></script>
        <script src="{{ asset('assets/js/PDF_FIXED_POINT.js') }}"></script>
</body>

</html>
