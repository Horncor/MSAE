let imgGraphBase64 = "";

//Init document ready
$(document).ready(function () {
    const price = document.querySelector("#decimals");
    const output = document.querySelector(".decimals-output");

    output.textContent = price.value;

    price.addEventListener("input", function () {
        output.textContent = price.value;
    });
});

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

        iterationData.push({
            iterations: iterations,
            initialGuess: previousApproximation.toFixed(
                parseFloat($("#decimals").val())
            ),
            approximation: currentApproximation.toFixed(
                parseFloat($("#decimals").val())
            ),
            error: error.toFixed(2) + "%",
        });
    }

    renderTable();
    generateGraph();
}

function fixedPointFunction(x) {
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

        console.log(formularAux);

        return eval(formularAux);
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

function diferenciaPorcentual(XINuevo, XI) {
    return (Math.abs(XI - XINuevo) / Math.abs(XI)) * 100;
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

        console.log("f(x) =" + formularAux);

        return "f(x) =" + formularAux;
    } catch (e) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "La funcion original no es valida para generar el grafico.",
            showConfirmButton: false,
            timer: 1500,
        });
        console.log(e);
    }
}

// Función para generar el gráfico
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
            applet.evalCommand(validFormulaOrignal());
            applet.evalCommand("ZoomFit");
        },
    };

    $('#append-title').empty().append(`<div class="d-flex justify-content-center pb-2">
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

    let exitsError = false;

    if (ecuacionOriginal == "") {
        $("#valor1Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#originalFunction")
            .removeClass()
            .addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor1Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#originalFunction").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (ecuacion == "") {
        $("#valor2Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#func").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor2Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#func").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (isNaN(valueXI)) {
        $("#valor3Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#valueXI").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor3Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#valueXI").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (isNaN(tolerancia)) {
        $("#valor4Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#tolerancia").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor4Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#tolerancia").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (exitsError === true) {
        return; // si existen error no pase a la validacion hasta que complete los campos
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
