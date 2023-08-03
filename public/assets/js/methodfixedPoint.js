$(document).ready(function () {});

let jsonResults = [];

let iterationData = []; // Arreglo para almacenar los datos de cada iteración

function fixedPointIteration(initialGuess, tolerance) {
    iterationData = [];

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
}

function fixedPointFunction(x) {
    try {
        let ecuacion = $("#func").val();

        // Expresión regular para buscar funciones trigonométricas
        let regexTrig =
            /(sin|cos|tan|sec|csc|cot|asin|acos|atan|asec|acsc|acot)(?=\()/gi;

        // Reemplazar cada función trigonométrica encontrada por su valor evaluado con XI
        let formularAux = ecuacion.replace(regexTrig, (match) => {
            return Math[match](x);
        });

        // Reemplazar "Raiz" por la función de raíz cuadrada (sqrt)
        formularAux = formularAux.replace(/\bRaiz\b/g, `Math.sqrt`);

        // Reemplazar X y x con el valor de XI
        formularAux = formularAux.replaceAll("X", x).replaceAll("x", x);

        // Reemplazar ^ por **
        formularAux = formularAux.replaceAll("^", "**");

        // Reemplazar , por .
        formularAux = formularAux.replaceAll(",", ".");

        return eval(formularAux);
    } catch (e) {
        console.log(e);
    }
}

function diferenciaPorcentual(XINuevo, XI) {
    return (Math.abs(XI - XINuevo) / Math.abs(XI)) * 100;
}

const validateFunc = () => {
    // Obtener los valores de los campos de entrada
    let ecuacion = $("#func").val();
    let valueXI = parseFloat($("#valueXI").val());
    let tolerancia = parseFloat($("#tolerancia").val());
    let interaciones = parseFloat($("#interaciones").val());

    let exitsError = false;

    if (ecuacion == "") {
        $("#valor1Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#func").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor1Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#func").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (isNaN(valueXI)) {
        $("#valor2Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#valueXI").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor2Help")
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

//    openModal('Probando','Si funciona')
const openModal = (title, content) => {
    $("#myModal").modal("show");
    $("#TitleModal").text(title);
    $("#ModalContent").text(content);
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
        `<table class="table table-hover">
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
