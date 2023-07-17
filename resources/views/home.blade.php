<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSAE</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    @include('layouts.style')
</head>

<body>
    <style>
        .cards-wrapper {
            display: flex;
            justify-content: center;
        }

        .card img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.navbar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-md">
                        <h1>Bienvenidos a MSAE</h1>
                    </div>
                </div>
                <div class="p-3">
                    {{-- information on numerical methods --}}
                    <div class="card container__info">
                        <div class="card-body ">
                            <h4 class="card-title fw-bolder fs-6">¿Qué son los Métodos Numéricos?</h4>
                            <p class="card-text">Los métodos numéricos son una serie de operaciones matemáticas
                                utilizadas para encontrar una
                                solución numérica aproximada a un problema. Son esenciales en el campo de la simulación
                                de
                                procesos y proporcionan una respuesta rápida cuando una solución analítica se vuelve
                                compleja. En general, los métodos numéricos se utilizan en ordenadores, dispositivos
                                electrónicos o programas informáticos especializados de ingeniería cuyos algoritmos de
                                análisis ya incorporan métodos numéricos.</p>
                        </div>
                    </div>
                    {{-- bisection method information --}}
                    <div class="card container__info">
                        <div class="card-body ">
                            <h4 class="card-title fw-bolder fs-6">El método de bisección</h4>
                            <p class="card-text">El método de bisección es un algoritmo de búsqueda de raíces que se
                                aplica a funciones continuas para las cuales se conocen dos valores con signos opuestos.
                                El método consiste en dividir repetidamente el intervalo definido por estos valores y
                                seleccionar el subintervalo en el cual la función cambia de signo, y por lo tanto debe
                                contener una raíz. Es un método cerrado, lo que significa que requiere un intervalo en
                                el cual se encuentre una raíz. El método de bisección es el más elemental y antiguo para
                                determinar las raíces de una ecuación. Está basado directamente en el teorema de
                                Bolzano.</p>
                            <!-- Button trigger modal bisection Method-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#bisectionMethod">
                                Más información!
                            </button>

                            <!-- Modal Bisection Method-->
                            <div class="modal modal-xl fade" id="bisectionMethod" tabindex="-1"
                                aria-labelledby="bisectionMethodLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="margin-bottom: -25px">
                                            <h5 class="modal-title fw-bolder" id="bisectionMethodLabel">El método de
                                                bisección</h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p> El algoritmo del método de bisección se puede esquematizar de la
                                                siguiente manera:
                                            </p>
                                            <p>
                                                <strong>1.</strong> Se suministra al programa el número máximo de
                                                iteraciones, la tolerancia
                                                que representa las cifras significativas con las que se desea obtener la
                                                solución y dos valores de la variable independiente, x0 y x1, tales que
                                                cumplan la relación f(x0)f(x1) 0.
                                            </p>
                                            <p>
                                                <strong>2.</strong> Se comprueba que el intervalo de partida es
                                                adecuado, dividiéndolo en
                                                dos subintervalos y determinando en qué subintervalo se encuentra la
                                                raíz (comprobando de nuevo el producto de las funciones).
                                            </p>
                                            <p>
                                                <strong>3.</strong> Se repite el proceso hasta alcanzar la convergencia
                                                (hasta que la
                                                tolerancia sea menor que el error absoluto) o bien hasta que se exceda
                                                el número de iteraciones permitidas.
                                            </p>
                                            <p>
                                                El método de bisección es menos eficiente que otros métodos como el
                                                método de Newton, pero es mucho más seguro para garantizar la
                                                convergencia. Si una función es continua en un intervalo [a, b],
                                                entonces este método converge a la raíz de la función. Además, se puede
                                                calcular una cota del error absoluto cometido tras realizar iteraciones
                                                del método de bisección. En resumen, el método de bisección es un método
                                                numérico para encontrar raíces de funciones continuas que se basa en la
                                                división de un intervalo en dos partes y la selección del subintervalo
                                                que contiene la raíz. Es un método cerrado y relativamente lento, pero
                                                es muy seguro y garantiza la convergencia.
                                            </p>
                                            <div class="row">
                                                <div class="col-md mb-2">
                                                    <img src="{{ asset('assets/images/foto1.png') }}" width="100%"
                                                        class="container__img" alt="">
                                                </div>
                                                <div class="col-md">
                                                    <h5>Áreas en las que se utiliza este método</h5>
                                                    <p><strong>1. Economía:</strong> En la economía, el método de
                                                        bisección se utiliza para resolver problemas de análisis
                                                        financiero y de optimización. Por ejemplo, se puede utilizar
                                                        para encontrar la tasa de interés que iguala el valor presente y
                                                        el valor futuro de un flujo de efectivo.</p>
                                                    <p><strong>2. Ingeniería:</strong> En la ingeniería, el método de
                                                        bisección se utiliza para resolver problemas de diseño y
                                                        análisis de sistemas. Por ejemplo, se puede utilizar para
                                                        encontrar la raíz de una ecuación que modele el comportamiento
                                                        de un sistema físico, como un circuito eléctrico o un sistema
                                                        mecánico.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- fixed point information  --}}
                    <div class="card container__info">
                        <div class="card-body ">
                            <h4 class="card-title fw-bolder fs-6">Punto fijo</h4>
                            <p class="card-text">El método del punto fijo es un método numérico utilizado para
                                encontrar soluciones a ecuaciones no lineales. Este método se basa en la idea de que si
                                tenemos una función g(x), entonces la solución a la ecuación f(x) = 0 puede encontrarse
                                al hallar un punto fijo de la función g(x). Un punto fijo de una función g(x) es un
                                valor x tal que g(x) = x.</p>
                            <!-- Button trigger modal Fixed Point -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#fixedPoint">
                                Más información!
                            </button>

                            <!-- Modal Fixed Point -->
                            <div class="modal modal-xl fade" id="fixedPoint" tabindex="-1"
                                aria-labelledby="fixedPointLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="margin-bottom: -25px">
                                            <h5 class="modal-title fw-bolder" id="fixedPointLabel">Punto fijo</h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                El método del punto fijo comienza con una estimación inicial x0 y luego
                                                utiliza la función g(x) para generar una secuencia de valores x1, x2,
                                                x3, ... que se espera que converjan a un punto fijo de la función. La
                                                secuencia se genera mediante la iteración de la función g(x), es decir,
                                                xn+1 = g(xn) para n = 0, 1, 2, .... Para que el método del punto fijo
                                                converja, se deben cumplir ciertos criterios de convergencia. Uno de los
                                                criterios más comunes es que la magnitud de la derivada de la función
                                                g(x) en el punto fijo sea menor que 1. Además, la función g(x) debe ser
                                                continua en el intervalo de interés.
                                            </p>
                                            <p>
                                                En resumen, el método del punto fijo es un método iterativo utilizado
                                                para encontrar una solución a una ecuación no lineal mediante la
                                                búsqueda de un punto fijo de una función relacionada. El método comienza
                                                con una estimación inicial y utiliza la iteración de la función para
                                                generar una secuencia de valores que se espera que converjan a un punto
                                                fijo de la función.
                                            </p>
                                            <div class="row">
                                                <div class="col-md mb-2">
                                                    <img src="{{ asset('assets/images/foto2.png') }}" width="100%"
                                                        class="container__img" alt="">
                                                </div>
                                                <div class="col-md">
                                                    <h5>El método del punto fijo también tiene aplicaciones en otras
                                                        áreas, como:</h5>
                                                    <p>
                                                        <strong>1. Geometría:</strong> Se utiliza en la geometría para
                                                        encontrar puntos fijos de transformaciones geométricas, como
                                                        reflexiones, rotaciones y traslaciones.
                                                    </p>
                                                    <p>
                                                        <strong>2. Topología:</strong> Se utiliza en la topología para
                                                        demostrar teoremas importantes, como el teorema de Brouwer.
                                                    </p>
                                                    <p>
                                                        <strong>3. Biología:</strong> Se utiliza en la biología para
                                                        modelar la dinámica de poblaciones y la evolución de especies.
                                                    </p>
                                                    <p>
                                                        <strong>4. Química</strong> Se utiliza en la química para
                                                        modelar
                                                        reacciones químicas y la cinética de las mismas.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="card container__info">
                        <div class="card-body ">
                            <h4 class="card-title fw-bolder fs-6">Meta de la applicación</h4>
                            <p class="card-text">
                                Basado en la información recopilada en el curso de Métodos Numéricos
                                impartido en la Universidad Técnica Nacional de Cañas, Costa Rica, se podrán poner en
                                práctica los conocimientos adquiridos en cursos anteriores de desarrollo. Esto nos
                                demuestra una vez más que la carrera de Ingeniería en Tecnologías de la Información se
                                puede combinar con materias elementales y otros campos de estudio distintos.
                            </p>
                            <p class="card-text">
                                Esto se ve reflejado en apliacion x que tiene como fin, poner de manera grafica los
                                metodos de bisección y punto fijo
                            </p>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="card container__info">
                        <h2 class="text-center mb-2">Responsables</h2>
                        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <div class="cards-wrapper">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_m.png') }}"
                                                class="card-img-top" alt="Adriel">
                                            <div class="card-body">
                                                <h5 class="card-title">Adriel</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_f.png') }}"
                                                class="card-img-top" alt="Susan">
                                            <div class="card-body">
                                                <h5 class="card-title">Susan</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="10000">
                                    <div class="cards-wrapper">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_m.png') }}"
                                                class="card-img-top" alt="Marvin">
                                            <div class="card-body">
                                                <h5 class="card-title">Marvin</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_f.png') }}"
                                                class="card-img-top" alt="Wilmara">
                                            <div class="card-body">
                                                <h5 class="card-title">Wilmara</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="10000">
                                    <div class="cards-wrapper">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_m.png') }}"
                                                class="card-img-top" alt="Steven">
                                            <div class="card-body">
                                                <h5 class="card-title">Steven</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_f.png') }}"
                                                class="card-img-top" alt="Nathaly">
                                            <div class="card-body">
                                                <h5 class="card-title">Nathaly</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="10000">
                                    <div class="cards-wrapper">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_m.png') }}"
                                                class="card-img-top" alt="Sahir">
                                            <div class="card-body">
                                                <h5 class="card-title">Sahir</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_m.png') }}"
                                                class="card-img-top" alt="Fabian">
                                            <div class="card-body">
                                                <h5 class="card-title">Fabian</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="10000">
                                    <div class="cards-wrapper">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('assets/images/logos/user_m.png') }}"
                                                class="card-img-top" alt="Jose Vega">
                                            <div class="card-body">
                                                <h5 class="card-title">Jose Vega</h5>
                                                <p class="card-text">Some quick example text to build on the card title
                                                    and
                                                    make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.script')
</body>

</html>
