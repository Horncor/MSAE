<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSAE | Bisección</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    @include('layouts.style')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('layouts.navbar')
        <div class="body-wrapper">
            @include('layouts.header')
            <div class="container-fluid">
                <div class="row"
                    style="border: 10px outset #ff6550;border-radius: 19px 19px 19px 19px;
                    -webkit-border-radius: 19px 19px 19px 19px;
                    -moz-border-radius: 19px 19px 19px 19px;box-shadow: 10px 10px 14px -2px rgba(0,0,0,0.44);
                    -webkit-box-shadow: 10px 10px 14px -2px rgba(0,0,0,0.44);
                    -moz-box-shadow: 10px 10px 14px -2px rgba(0,0,0,0.44);">
                    <h3>Metodo Bisección</h3>
                    <form action="{{ route('bisection.calculate') }}" class="formulario-biseccion" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md mb-3">
                                <label for="function" class="form-label">Función</label>
                                <input type="text" class="form-control" name="function" id="function" />
                            </div>
                            <div class="col-md mb-3">
                                <label for="a" class="form-label">Intervalo-A</label>
                                <input type="number" class="form-control" name="a" id="a"
                                    step="any" />
                            </div>
                            <div class="col-md mb-3">
                                <label for="b" class="form-label">Intervalo-B</label>
                                <input type="number" class="form-control" name="b" id="b"
                                    step="any" />
                            </div>
                            <div class="col-md mb-3">
                                <label for="tolerance" class="form-label">Tolerancia</label>
                                <input type="number" class="form-control" name="tolerance" id="tolerance"
                                    step="any" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mb-3">
                                <label for="Ecuaciones" class="form-label">Ecuaciones</label>
                                <button type="submit" name="action" id="action" value="calcule_ecuacion"
                                class="btn btn-primary w-100">Calcular</button>
                            </div>
                            <div class="col-md mb-3">
                                <label for="bisection" class="form-label">Trigonometricas</label>
                                <button type="submit" name="action" id="action" value="calcule_biseccion"
                                        class="btn btn-primary w-100">Calcular</button>
                            </div>
                            <div class="col-md mb-3">
                                <label for="Intervalos" class="form-label">Intervalos</label>
                                <button type="submit" name="action" id="action" value="calculate_intervalos"
                                class="btn btn-primary w-100">Calcular</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid text-center">
                <div class="row">
                    <H3>Resultados de la Biseccion</H3>
                </div>
                <div class="row" style="overflow: scroll">
                    @isset($results)
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Iteraciones</th>
                                    <th>Intervalo A</th>
                                    <th>Intervalo B</th>
                                    <th>Valor A</th>
                                    <th>F imagen de(A)</th>
                                    <th>Valor B</th>
                                    <th>F imagen de(B)</th>
                                    <th>Punto Medio</th>
                                    <th>F imagen de punto medio(X)</th>
                                    <th>Error</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result1)
                                    <tr>
                                        <td>{{ $result1['iteration'] }}</td>
                                        <td>{{ $result1['interval_a'] }}</td>
                                        <td>{{ $result1['interval_b'] }}</td>
                                        <td>{{ $result1['value_a'] }}</td>
                                        <td>{{ $result1['f(a)'] }}</td>
                                        <td>{{ $result1['value_b'] }}</td>
                                        <td>{{ $result1['f(b)'] }}</td>
                                        <td>{{ $result1['midpoint'] }}</td>
                                        <td>{{ $result1['f(midpoint)'] }}</td>
                                        <td>{{ $result1['error'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid p-5 m-auto text-center">
        <div class="row">
            <H3>Resultados de la Biseccion</H3>
        </div>
        <div class="row">
            @isset($results)
            <script>let results2 = {!! json_encode($results) !!}</script>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Iteraciones</th>
                            <th>Intervalo A</th>
                            <th>Intervalo B</th>
                            <th>Valor A</th>
                            <th>F imagen de(A)</th>
                            <th>Valor B</th>
                            <th>F imagen de(B)</th>
                            <th>Punto Medio</th>
                            <th>F imagen de punto medio(X)</th>
                            <th>Error</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result1)
                            <tr>
                                <td>{{ $result1['iteration'] }}</td>
                                <td>{{ $result1['interval_a'] }}</td>
                                <td>{{ $result1['interval_b'] }}</td>
                                <td>{{ $result1['value_a'] }}</td>
                                <td>{{ $result1['f(a)'] }}</td>
                                <td>{{ $result1['value_b'] }}</td>
                                <td>{{ $result1['f(b)'] }}</td>
                                <td>{{ $result1['midpoint'] }}</td>
                                <td>{{ $result1['f(midpoint)'] }}</td>
                                <td>{{ $result1['error'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endisset
        </div>
    </div>
    @include('layouts.script')
    <script src="{{ asset('assets/js/methodBiseccion.js') }}"></script>
    <script src="{{ asset('assets/js/PDF_FIXED_POINT.js') }}"></script>
    <script src="{{ asset('assets/js/PDF_BISECCION.js') }}"></script>
</body>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

    * {
        font-family: "Ubuntu", sans-serif;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .body-principal {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        z-index: -1;
        background: #2BC0E4;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #EAECC6, #2BC0E4);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #EAECC6, #2BC0E4);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    .main-principal {
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 25px;
    }

    .section-formulario {
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-table {
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
    }

    .container-formulario {
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        width: 800px;
    }

    .container-table {
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        width: 800px;
    }

</body>

@include('layouts.script')

</html>
