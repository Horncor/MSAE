let imgGraphBase64 = "";

//Init document ready
$(document).ready(function () {
    inputSelector();
});

// Incializar el selector de decimales.
const inputSelector = () => {
    const price = document.querySelector("#decimals");
    const output = document.querySelector(".decimals-output");
    output.textContent = price.value;
    price.addEventListener("input", function () {
        output.textContent = price.value;
    });
};

let iterationData = []; // Arreglo para almacenar los datos de cada iteración
let originalFunction = "";
let iterativeFunction = "";
let initialValue = "";
let initialTolerance = "";

function fixedPointIteration(initialGuess, tolerance) {
    iterationData = [];
    originalFunction = $("#originalFunction").val();
    iterativeFunction = $("#func").val();
    initialValue = initialGuess;
    initialTolerance = tolerance;
    let currentApproximation = initialGuess;
    let previousApproximation;
    let error = tolerance + 1;
    let iterations = 0;

    while (error > tolerance && iterations < 1000) {
        previousApproximation = currentApproximation;
        currentApproximation = fixedPointFunction(previousApproximation);
        error =
            Math.abs(
                (currentApproximation - previousApproximation) /
                    currentApproximation
            ) * 100;
        iterations++;

        // Almacenar los datos de cada iteración
        iterationData.push({
            iterations: iterations,
            initialGuess: previousApproximation.toFixed(
                parseFloat($("#decimals").val())
            ),
            approximation: currentApproximation.toFixed(
                parseFloat($("#decimals").val())
            ),
            error: error.toFixed($("#decimals").val()) + "%",
        });
    }
    renderTable();
    generateGraph();
    alertGeneratePDF();
}

/*
 Función para evaluar la función iterativa
 Descripcion: se encarga de procesar la funcion iterativa para evaluarla con el valor de x,
 remplaza las funciones trigonometricas por sus equivalentes en javascript.
 @param x = valor de x a evaluar
 */
const obtainFuncIterative = (x) => {
    try {
        let ecuacion = $("#func").val();

        let formularAux = ecuacion;

        // Reemplazar "Raiz" por la función de raíz cuadrada (Math.sqrt)
        formularAux = formularAux.replace(/\bRaiz\b/g, `Math.sqrt`);

        // Reemplazar "tan(" por la función tangente (Math.tan(
        formularAux = formularAux.replace(/tan\(/g, `Math.tan(`);

        // Reemplazar "sin(" por la función seno (Math.sin(
        formularAux = formularAux.replace(/sin\(/g, `Math.sin(`);

        // Reemplazar "cos(" por la función coseno (Math.cos(
        formularAux = formularAux.replace(/cos\(/g, `Math.cos(`);

        // Reemplazar "sec(" por la función secante (1 / Math.cos(
        formularAux = formularAux.replace(/sec\(/g, `(1 / Math.cos(`);

        // Reemplazar "cosec(" por la función cosecante (1 / Math.sin(
        formularAux = formularAux.replace(/cosec\(/g, `(1 / Math.sin(`);

        // Reemplazar "cot(" por la función cotangente (1 / Math.tan(
        formularAux = formularAux.replace(/cot\(/g, `(1 / Math.tan(`);

        // Reemplazar "ln(" por la función logaritmo natural (Math.log(
        formularAux = formularAux.replace(/ln\(/g, `Math.log(`);

        // Reemplazar "e" por la constante de Euler (Math.E)
        formularAux = formularAux.replace(/\be\b/g, Math.E);

        // Reemplazar "PI" por su valor numérico
        formularAux = formularAux.replace(/\bPI\b/g, Math.PI);

        // Reemplazar "PI" por su valor numérico
        formularAux = formularAux.replace(/\bpi\b/g, Math.PI);

        // Reemplazar X y x con el valor de x
        formularAux = formularAux.replaceAll("X", x).replaceAll("x", x);

        // Reemplazar ^ por **
        formularAux = formularAux.replaceAll("^", "**");

        // Reemplazar , por .
        formularAux = formularAux.replaceAll(",", ".");

        return eval(formularAux);
    } catch (e) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Valida que la funcion iterativa sea correcta.",
            showConfirmButton: false,
            timer: 1500,
        });
        console.log(e);
    }
};

/*
   Función para calcular el valor de la función iterativa
   Descripcion: se encarga de evaluar la función iterativa con el valor de x.
   @param x = valor de x a evaluar
   return = valor de la función evaluada en x
 */
function fixedPointFunction(x) {
    try {
        return eval(obtainFuncIterative(x));
    } catch (e) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Valida que la funcion sea correcta.",
            showConfirmButton: false,
            timer: 1500,
        });
        console.log(e);
    }
}

function validFormulaOrignal() {
    try {
        let ecuacion = $("#originalFunction").val();

        let formularAux = ecuacion;

        // Reemplazar "Raiz" por la función de raíz cuadrada (Math.sqrt)
        formularAux = formularAux.replace(/\bRaiz\b/g, `sqrt`);

        // Reemplazar "tan(" por la función tangente (Math.tan(
        formularAux = formularAux.replace(/tan\(/g, `tan(`);

        // Reemplazar "sin(" por la función seno (Math.sin(
        formularAux = formularAux.replace(/sin\(/g, `sin(`);

        // Reemplazar "cos(" por la función coseno (Math.cos(
        formularAux = formularAux.replace(/cos\(/g, `cos(`);

        // Reemplazar "sec(" por la función secante (1 / Math.cos(
        formularAux = formularAux.replace(/sec\(/g, `(1 / cos(`);

        // Reemplazar "cosec(" por la función cosecante (1 / Math.sin(
        formularAux = formularAux.replace(/cosec\(/g, `(1 / sin(`);

        // Reemplazar "cot(" por la función cotangente (1 / Math.tan(
        formularAux = formularAux.replace(/cot\(/g, `(1 / tan(`);

        // Reemplazar "ln(" por la función logaritmo natural (Math.log(
        formularAux = formularAux.replace(/ln\(/g, `log(`);

        // Reemplazar "e" por la constante de Euler (Math.E)
        formularAux = formularAux.replace(/\be\b/g, Math.E);

        // Reemplazar "PI" por su valor numérico
        formularAux = formularAux.replace(/\bPI\b/g, Math.PI);

        // Reemplazar "PI" por su valor numérico
        formularAux = formularAux.replace(/\bpi\b/g, Math.PI);

        // Reemplazar ^ por **
        formularAux = formularAux.replaceAll("^", "**");

        // Reemplazar , por .
        formularAux = formularAux.replaceAll(",", ".");

        return formularAux;
    } catch (e) {
        console.log(e);
    }
}

/*
   Funcion para generar el grafico de la funcion original
    Descripcion: se encarga de generar el grafico de la funcion original
    @param: no recibe parametros
    return: append del grafico en el div con id graphDiv
 */
function generateGraph() {
    let parameters = {
        appname: "graphing",
        id: "ggbApplet",
        width: 1200,
        height: 600,
        showToolBar: false,
        borderColor: null,
        showMenuBar: false,
        allowStyleBar: false,
        showAlgebraInput: true,
        enableLabelDrags: false,
        enableShiftDragZoom: true,
        capturingThreshold: null,
        showToolBarHelp: false,
        errorDialogsActive: false,
        showTutorialLink: false,
        showLogging: false,
        useBrowserForJS: false,
        disableAutoScale: false,
        perspective: "1",
        appletOnLoad: function () {
            let applet = document.ggbApplet;
            applet.evalCommand("f(x) =" + validFormulaOrignal());
            applet.evalCommand("ZoomFit");
        },
    };

    $("#append-title").empty()
        .append(`<div class="d-flex justify-content-center pb-2">
                                        <p class="fs-5">Grafico de geogebra</p>
                                    </div>`);

    let applet = new GGBApplet(parameters, "5.0", "graphDiv");
    applet.inject("graphDiv");
}

const validateFunc = () => {
    // Obtener los valores de los campos de entrada
    let ecuacion = $("#func").val();
    let ecuacionOriginal = $("#originalFunction").val();
    let valueXI = parseFloat($("#valueXI").val());
    let tolerancia = parseFloat($("#tolerancia").val());

    if (ecuacionOriginal == "") {
        $("#valor1Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#originalFunction")
            .removeClass()
            .addClass("form-control is-invalid");
        return;
    } else {
        $("#valor1Help").removeClass().addClass("form-text text-success");
        $("#originalFunction").removeClass().addClass("form-control is-valid");
    }

    if (ecuacion == "") {
        $("#valor2Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#func").removeClass().addClass("form-control is-invalid");
        return;
    } else {
        $("#valor2Help").removeClass().addClass("form-text text-success");
        $("#func").removeClass().addClass("form-control is-valid");
    }

    if (isNaN(valueXI)) {
        $("#valor3Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#valueXI").removeClass().addClass("form-control is-invalid");
        return;
    } else {
        $("#valor3Help").removeClass().addClass("form-text text-success");
        $("#valueXI").removeClass().addClass("form-control is-valid");
    }

    if (isNaN(tolerancia)) {
        $("#valor4Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#tolerancia").removeClass().addClass("form-control is-invalid");
        return;
    } else {
        $("#valor4Help").removeClass().addClass("form-text text-success");
        $("#tolerancia").removeClass().addClass("form-control is-valid");
    }

    try {
        fixedPointIteration(valueXI, tolerancia);
    } catch (error) {
        console.log(error);
        // Capturar errores de sintaxis u otros errores durante la evaluación
        return false;
    }
};

const renderTable = () => {
    htmlBody = ``;
    iterationData.forEach((obj) => {
        htmlBody +=
            `<tr>
                        <td>` +
            obj.iterations +
            `</td>
            <td>` +
            obj.initialGuess +
            `</td>
                        <td>` +
            obj.approximation +
            `</td>
                        <td>` +
            obj.error +
            `</td>
                    </tr>`;
    });

    htmlTable =
        `<table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">N° I</th>
                        <th scope="col">Valor inicial</th>
                        <th scope="col">Iteración</th>
                        <th scope="col">Error(%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    ` +
        htmlBody +
        `
                    </tbody>
                </table>`;

    $("#table-result-operation").empty().append(htmlTable);
};

const alertGeneratePDF = () => {
    Swal.fire({
        title: "¿Descargar PDF?",
        icon: "question",
        html: "Deseas descargar un PDF, Donde estaran todos tus resultados",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Generar",
        cancelButtonText: "Cerrar",
    }).then((result) => {
        if (result.isConfirmed) {
            GeneratePDF(iterationData);
        }
    });
};

const ApplyBolzano = () => {
    const verifyFuncOriginal = obtainFuncOrignalMath();
    const interval = findInterval(obtainFuncOrignalMath);
    if (interval.length > 0) {
        let valueInitial = interval[0] + interval[1] / 2;
        console.log(valueInitial);
        $("#valueXI").val(valueInitial);
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: `Se han encontrado el intervalo con bolzano [${interval}] `,
            showConfirmButton: false,
            timer: 2500,
        });
    } else {
    }
};

const obtainFuncOrignalMath = (x) => {
    try {
        let ecuacion = $("#originalFunction").val();

        // Reemplazar "Raiz" por la función de raíz cuadrada (Math.sqrt)
        ecuacion = ecuacion.replace(/\bRaiz\b/g, `Math.sqrt`);

        // Reemplazar "tan(" por la función tangente (Math.tan(
        ecuacion = ecuacion.replace(/tan\(/g, `Math.tan(`);

        // Reemplazar "sin(" por la función seno (Math.sin(
        ecuacion = ecuacion.replace(/sin\(/g, `Math.sin(`);

        // Reemplazar "cos(" por la función coseno (Math.cos(
        ecuacion = ecuacion.replace(/cos\(/g, `Math.cos(`);

        // Reemplazar "sec(" por la función secante (1 / Math.cos(
        ecuacion = ecuacion.replace(/sec\(/g, `(1 / Math.cos(`);

        // Reemplazar "cosec(" por la función cosecante (1 / Math.sin(
        ecuacion = ecuacion.replace(/cosec\(/g, `(1 / Math.sin(`);

        // Reemplazar "cot(" por la función cotangente (1 / Math.tan(
        ecuacion = ecuacion.replace(/cot\(/g, `(1 / Math.tan(`);

        // Reemplazar "ln(" por la función logaritmo natural (Math.log(
        ecuacion = ecuacion.replace(/ln\(/g, `Math.log(`);

        // Reemplazar "e" por la constante de Euler (Math.E)
        ecuacion = ecuacion.replace(/\be\b/g, Math.E);

        // Reemplazar "PI" por su valor numérico
        ecuacion = ecuacion.replace(/\bPI\b/g, Math.PI);

        // Reemplazar "PI" por su valor numérico
        ecuacion = ecuacion.replace(/\bpi\b/g, Math.PI);

        // Reemplazar X y x con el valor de x
        ecuacion = ecuacion.replaceAll("X", x).replaceAll("x", x);

        // Reemplazar ^ por **
        ecuacion = ecuacion.replaceAll("^", "**");

        // Reemplazar , por .
        ecuacion = ecuacion.replaceAll(",", ".");

        return eval(ecuacion);
    } catch (error) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Valida que la funcion orinal sea correcta.",
            showConfirmButton: false,
            timer: 1500,
        });
    }
};
