<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
class BisectionController extends Controller
{
      public function index() {
        return view('bisection');
    }

    public function calculate(Request $request) {
        // Se llama a los campos de texto ingresados por el usuario en la interfaz gráfica
        $function = $request->input('function');
        $a = $request->input('a');
        $b = $request->input('b');
        $tolerance = $request->input( 'tolerance' );

        // Asignamos los valores a la función para que realice el cálculo de bisección
        $results = $this->bisectionMethod($function, $a, $b, $tolerance);
        // Retorno una vista con los resultados
        return view('bisection', compact('results') );
    }

    public function evaluateFunction($function, $x) {
        try {
            // Validación de entrada
            if ( empty( $function ) || $x === null || $x === '' ) {
                throw new \InvalidArgumentException( 'La función y el valor de x son requeridos.' );
            }

            // Reemplazar 'x' por el valor de $x en la función
            $expression = str_replace( 'x', $x, $function );
            
            $language = new ExpressionLanguage();

            // Define las variables y constantes matemáticas que deseas utilizar
            $variables = [
                'e' => exp( 1 ), // Constante matemática 'e'
                'pi' => pi(), // Constante matemática 'pi'
            ];

            // Evaluar la expresión utilizando ExpressionLanguage
            $result = $language->evaluate( $expression, $variables );
            //dd($result);
            return $result;
        } catch ( \InvalidArgumentException $ex ) {
            return 'Error: ' . $ex->getMessage();
        } catch ( \Symfony\Component\ExpressionLanguage\SyntaxError $ex ) {
            return 'Error de sintaxis en la función: ' . $ex->getMessage();
        } catch ( \Symfony\Component\ExpressionLanguage\RuntimeException $ex ) {
            return 'Error al evaluar la función: ' . $ex->getMessage();
        } catch ( \Throwable $th ) {
            return 'Error desconocido: ' . $th->getMessage();
        }
    }

    // Método donde se realiza la bisección -
    //Observación: hay que solucionar para realizar el cálculo más exacto, tiene error al calcular

    public function bisectionMethod($function, $a, $b, $tolerance) {
        try {
            $results = [];
            $maxIterations = 1000;
            $iteration = 1;
            $error = $tolerance + 1;
            
            while ( $iteration <= $maxIterations) {
                //Calculamos C
                $midpoint = ($a + $b) / 2;
                
                // Calcula los valores de $fa, $fb y $fc después de actualizar los valores de $a, $b y $midpoint
                $fa = $this->evaluateFunction($function, $a);
                if ($fa === null) {
                    return $results;
                }
                
                $fb = $this->evaluateFunction($function, $b);
                if ($fb === null) {
                    return $results;
                }
                
                $fc = $this->evaluateFunction($function, $midpoint);
                if ($fc === null) {
                    return $results;
                }
            
                if ($fc == 0) {
                    break;
                }
                //verificamos si hay cambio de signo negativo o positivo y se asigna un nuevo valor
                if ($fa * $fc < 0) {
                    $b = $midpoint;
                } else {
                    $a = $midpoint;
                }
    
                $error = abs(($b - $a) / $b) * 100;
    
                if($error >= $tolerance){
                    break;
                }
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
