<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class BisectionController extends Controller
{

    public function index()
    {
        return view('bisection');
    }

    public function calculate(Request $request)
    {
        // Validar entrada
        $request->validate([
            'function' => 'required',
            'a' => 'required|numeric',
            'b' => 'required|numeric',
            'tolerance' => 'required|numeric',
            'action' => 'required|in:calcule_ecuacion,calcule_biseccion,calculate_intervalos',
        ]);

        // Se llama a los campos de texto ingresados por el usuario en la interfaz gráfica
        $function = $request->input('function');
        $a = $request->input('a');
        $b = $request->input('b');
        $tolerance = $request->input('tolerance');
        $action = $request->input('action'); // Obtener el valor de $action del objeto $request
     
        // Asignamos los valores a la función para que realice el cálculo de bisección

        if ($action === 'calcule_biseccion') {
            // Retorno una vista con los resultados
            $results = $this->bisectionMethod($function, $a, $b, $tolerance);
            return view('bisection', compact('results'));
        } elseif ($action === 'calcule_ecuacion') {
            // Retorno una vista con los resultados
            $results = $this->bisectionMethodE($function, $a, $b, $tolerance);
            return view('bisection', compact('results'));
        }elseif($action === 'calculate_intervalos'){
            // Retorno una vista con los resultados
            $results = $this->calcularValoresContinuidad($function);
            
            return view('bisection', compact('results'));
        } 
    }


    private function evaluateExpression($expression, $x)
    {
        try {
            $language = new ExpressionLanguage();

            // Definimos algunas constantes útiles
            $pi = pi();
            $e = exp(1);

            // Definimos las funciones trigonométricas personalizadas que manejan la conversión de grados a radianes
            $sin = function ($angle) {
                return sin(deg2rad($angle));
            };

            $cos = function ($angle) {
                return cos(deg2rad($angle));
            };

            $tan = function ($angle) {
                return tan(deg2rad($angle));
            };

            $asin = function ($value) {
                return rad2deg(asin($value));
            };

            $acos = function ($value) {
                return rad2deg(acos($value));
            };

            $atan = function ($value) {
                return rad2deg(atan($value));
            };

            // Definimos la función de raíz cuadrada
            $sqrt = function ($value) {
                return sqrt($value);
            };

            // Definimos la función de fracción
            $frac = function ($numerator, $denominator) {
                return $numerator / $denominator;
            };

            // Definimos las variables y constantes matemáticas que deseas utilizar
            $variables = [
                'x' => $x,
                'e' => $e,
                'pi' => $pi,
                'sin' => $sin,
                'cos' => $cos,
                'tan' => $tan,
                'asin' => $asin,
                'acos' => $acos,
                'atan' => $atan,
                'sqrt' => $sqrt,
                'frac' => $frac,
            ];

            // Evaluamos la expresión
            $result = $language->evaluate($expression, $variables);

            // Retornamos el resultado
            return $result;
        } catch (\Throwable $th) {
            return -9999;
        }
    }

    private function calcularValoresContinuidad($ecuacion)
    {
        $resultado = [];

        // Modificamos el intervalo del bucle for para que sea más amplio y pueda detectar los intervalos de continuidad correctamente.
        for ($number = -1000; $number <= 1000; $number++) {
            $valor = $this->evaluateExpression($ecuacion, $number);

            if ($valor === 0) {
                continue; // Si el valor es cero, seguimos buscando.
            }

            if ($valor < 0) {
                if (!isset($resultado['a'])) {
                    $resultado['a'] = $number;
                } else {
                    $resultado['b'] = $number;
                    break;
                }
            } else {
                if (!isset($resultado['a'])) {
                    $resultado['a'] = $number;
                } else {
                    $resultado['b'] = $number;
                    break;
                }
            }
        }

        return $resultado;
    }



/////////////////////////trigonometricas////////////////////////////////////////
    public function evaluateFunction($function, $x)
    {
        try {
            // Validación de entrada
            if (empty($function) || $x === null || $x === '') {
                return ['error_code' => 1, 'message' => 'La función y el valor de x son requeridos.'];
            }

            // Reemplazar 'x' por el valor de $x en la función
            $expression = str_replace('x', $x, $function);

            // Definimos algunas constantes útiles
            $pi = pi();
            $e = exp(1);

            // Definimos las funciones trigonométricas personalizadas que manejan la conversión de grados a radianes
            $sin = function ($angle) {
                return sin(deg2rad($angle));
            };

            $cos = function ($angle) {
                return cos(deg2rad($angle));
            };

            $tan = function ($angle) {
                return tan(deg2rad($angle));
            };

            $asin = function ($value) {
                return rad2deg(asin($value));
            };

            $acos = function ($value) {
                return rad2deg(acos($value));
            };

            $atan = function ($value) {
                return rad2deg(atan($value));
            };

            // Definimos la función de raíz cuadrada
            $sqrt = function ($value) {
                return sqrt($value);
            };

            // Definimos la función de fracción
            $frac = function ($numerator, $denominator) {
                return $numerator / $denominator;
            };

            // Evaluamos la expresión
            $result = eval('return ' . $expression . ';');

            // Retorno el resultado
            return ['error_code' => 0, 'result' => $result];
        } catch (\Throwable $th) {
            return ['error_code' => 2, 'message' => 'Error al evaluar la función: ' . $th->getMessage()];
        }
    }

    // Método donde se realiza la bisección
    public function bisectionMethod($function, $a, $b, $tolerance)
    {
        try {
            $results = [];
            $maxIterations = 1000;
            $iteration = 1;
            $error = $tolerance + 1;

            while ($iteration <= $maxIterations) {
                $midpoint = ($a + $b) / 2;

                // Evaluamos la función en los puntos a, b y el punto medio (midpoint)
                $fa = $this->evaluateFunction($function, $a)['result'];
                $fb = $this->evaluateFunction($function, $b)['result'];
                $fc = $this->evaluateFunction($function, $midpoint)['result'];

                if ($fc == 0) {
                    break;
                }

                if ($fa * $fc < 0) {
                    $b = $midpoint;
                } else {
                    $a = $midpoint;
                }

                $error = abs(($b - $a) / $midpoint) * 100;

                $currentResult = [
                    'iteration' => $iteration,
                    'interval_a' => $a,
                    'interval_b' => $b,
                    'value_a' => $a,
                    'f(a)' => $fa,
                    'value_b' => $b,
                    'f(b)' => $fb,
                    'midpoint' => $midpoint,
                    'f(midpoint)' => $fc,
                    'error' => $error,
                ];
                $results[] = $currentResult;

                if ($error < $tolerance) {
                    break;
                }

                $iteration++;
            }
        } catch (\Throwable $th) {
            return null;
        }

        return $results;
    }
////////////////////////Ecuaciones///////////////////////////////
    private function customEval($expression, $variables)
    {
        $language = new ExpressionLanguage();

        return $language->evaluate($expression, $variables);
    }

    public function evaluateFunctione($function, $x)
    {
        try {
            //sustituye ^ por **
            $function = str_replace('^', '**', $function);
            // Validación de entrada

            if (empty($function) || $x === null || $x === '') {
                return ['error_code' => 1, 'message' => 'La función y el valor de x son requeridos.'];
            }

            // Reemplazar 'x' por el valor de $x en la función
            $expression = str_replace('x', $x, $function);
            
            // Define las variables y constantes matemáticas que deseas utilizar
            $variables = [
                'e' => exp(1), // Constante matemática 'e'
                'pi' => pi(), // Constante matemática 'pi'
                'sin' => 'sin', // Función seno
                'cos' => 'cos', // Función coseno
                'tan' => 'tan', // Función tangente
                'asin' => 'asin', // Función arcoseno
                'acos' => 'acos', // Función arcocoseno
                'atan' => 'atan', // Función arcotangente
                'sqrt' => 'sqrt', // Función raíz cuadrada
                'frac' => function ($numerator, $denominator) {
                    return $numerator / $denominator;
                }, // Función fracción
            ];

            // Evaluamos la expresión utilizando nuestro nuevo método customEval
            $result = $this->customEval($expression, $variables);

            // Retorno el resultado
            return ['error_code' => 0, 'result' => $result];
        } catch (\Symfony\Component\ExpressionLanguage\SyntaxError $ex) {
            return ['error_code' => 2, 'message' => 'Error de sintaxis en la función: ' . $ex->getMessage()];
        } catch (\Symfony\Component\ExpressionLanguage\RuntimeException $ex) {
            return ['error_code' => 3, 'message' => 'Error al evaluar la función: ' . $ex->getMessage()];
        } catch (\Throwable $th) {
            return ['error_code' => 4, 'message' => 'Error desconocido: ' . $th->getMessage()];
        }
    }

    // Método donde se realiza la bisección
    public function bisectionMethode($function, $a, $b, $tolerance)
    {
        try {
            $results = [];
            $maxIterations = 1000;
            $iteration = 1;
            $error = $tolerance + 1;

            while ($iteration <= $maxIterations) {
                $midpoint = ($a + $b) / 2;

                // Evaluamos la función en los puntos a, b y el punto medio (midpoint)
                $fa = $this->evaluateFunctione($function, $a)['result'];
                $fb = $this->evaluateFunctione($function, $b)['result'];
                $fc = $this->evaluateFunctione($function, $midpoint)['result'];

                if ($fc == 0) {
                    break;
                }

                if ($fa * $fc < 0) {
                    $b = $midpoint;
                } else {
                    $a = $midpoint;
                }

                $error = abs(($b - $a) / $midpoint) * 100;

                $currentResult = [
                    'iteration' => $iteration,
                    'interval_a' => $a,
                    'interval_b' => $b,
                    'value_a' => $a,
                    'f(a)' => $fa,
                    'value_b' => $b,
                    'f(b)' => $fb,
                    'midpoint' => $midpoint,
                    'f(midpoint)' => $fc,
                    'error' => $error,
                ];
                $results[] = $currentResult;

                if ($error < $tolerance) {
                    break;
                }

                $iteration++;
            }
        } catch (\Throwable $th) {
            return null;
        }

        return $results;
    }
}
