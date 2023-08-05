<!-- resources/views/bisection.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Metodo Bisección</title>
</head>

<body class="body-principal">
    <main class="main-principal">
        <section class="section-formulario">
            <div class="container-formulario">
                <h3>Metodo Bisección</h3>
                <form action="{{ route('bisection.calculate') }}" class="formulario-biseccion" method="POST">
                @csrf
                <div class="section-inputs">
                        <label for="function">
                            <span>Funcion</span>
                            <input type="text" name="function" id="function" />
                        </label>
                        <label for="Valor-a">
                            <span>Intervalo-A</span>
                            <input type="number" name="a" id="a"  step="any" />
                        </label>
                        <label for="Valor-b">
                            <span>Intervalo-B</span>
                            <input type="number" name="b" id="b"  step="any" />
                        </label>
                        <label for="Tolerancia">
                            <span>Tolerancia</span>
                            <input type="number" name="tolerance" id="tolerance"  step="any" />
                        </label>
                </div>
                <div class="btn-calcule">
                        <label for="Ecuaciones">
                            <span>Ecuaciones</span>
                            <button type="submit" name="action" id="action" value="calcule_ecuacion" class="btn-calculo">Calcular</button>
                        </label>
                        <label for="bisection">
                            <span>Trigonometricas</span>
                            <button type="submit" name="action" id="action" value="calcule_biseccion" class="btn-calculo">Calcular</button>
                        </label>

                        <label for="Intervalos">
                            <span>Intervalos</span>
                            <button type="submit" name="action" id="action" value="calculate_intervalos" class="btn-calculo">Calcular</button>
                        </label>
                </div>


                </form>
            </div>
        </section>
      
        <section class="section-table">

        <div>

        @if(isset($results2))
        
        <p>El resultado es: A = {{ $results2['a'] }}, B = {{ $results2['b'] }}</p>
    @endif
        
        <H3 >Resultados de la Biseccion</H3>
            <div class="container-table">

                @isset($results)
                    <table>
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
                            @foreach($results as $result1)
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
        </section>

        <section class="section-table">

            <div class="container-table">

                @isset($results2)
                    <table>
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
                            @foreach($results2 as $result)
                                <tr>
                                    <td>{{ $result['iteration'] }}</td>
                                    <td>{{ $result['interval_a'] }}</td>
                                    <td>{{ $result['interval_b'] }}</td>
                                    <td>{{ $result['value_a'] }}</td>
                                    <td>{{ $result['f(a)'] }}</td>
                                    <td>{{ $result['value_b'] }}</td>
                                    <td>{{ $result['f(b)'] }}</td>
                                    <td>{{ $result['midpoint'] }}</td>
                                    <td>{{ $result['f(midpoint)'] }}</td>
                                    <td>{{ $result['error'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endisset
            </div>
        </section>
    </main>


    <footer class="footer">
        <label for="footer">
            <span>Todos los derechos reservado ©Estudiantes-UTN-2023 </span>
        </label>
    </footer>
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
  background: #2BC0E4;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #EAECC6, #2BC0E4);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #EAECC6, #2BC0E4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

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

.section-inputs {
  display: flex;
  gap: 10px;
  width: 100%;
}

.btn-calcule {
  display: flex;
  gap: 15px;
  width: 100%;
}

.resultado-intervalos {
  display: flex;
  gap: 15px;
  width: 30%;
}

.formulario-biseccion {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  gap: 15px;
}

label {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

label span {
  font-weight: 800;
}

.section-inputs label input {
  width: 80%;
  background-color: #f3f3f4;
  border: none;
  padding: 10px 20px;
  border-radius: 10px;
  outline: none;
  cursor: pointer;
}

label input {
  width: 50%;
  background-color: #f3f3f4;
  border: none;
  padding: 10px 20px;
  border-radius: 10px;
  outline: none;
  font-size: 14pt;
  transition: background-color 0.2s, border 0.2s, box-shadow 0.2s;
}

label input:hover {
  background-color: white;
  border: solid 1px #f3f3f4;
  box-shadow: 0 0 4px #eb50ff4f;
}

label input:focus {
  background-color: white;
  border: solid 1px #f3f3f4;
  box-shadow: 0 0 4px #eb50ff4f;
}

.btn-calculo {
  background-color: #3791e6;
  color: white;
  font-weight: 500;
  font-size: 14pt;
  text-align: center;
  padding: 13px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
}

.btn-calculo {
  opacity: 0.95;
}

.buttons {
  align-self: flex-start;
  display: flex;
  gap: 20px;
}

.btn-calculo:hover {
  background-color: #363795;
}

table {
  border-collapse: collapse;
  width: 100%;
  background-color: white;
}

th,
td {
  border: 1px solid black;
  padding: 8px;
  text-align: center;
}

th {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #f5f5f5;
}

.footer {
  margin: auto;
  display: flex;
  align-items: center;
  justify-content: center;
}

</style>
</html>
