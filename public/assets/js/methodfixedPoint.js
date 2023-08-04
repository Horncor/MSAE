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
    generateChart();
    alertGeneratePDF();
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

        // Reemplazar "PI" por su valor numérico
        formularAux = formularAux.replace(/\bPI\b/g, Math.PI);

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

const validateFunc = () => {
    // Obtener los valores de los campos de entrada
    let ecuacion = $("#func").val();
    let valueXI = parseFloat($("#valueXI").val());
    let tolerancia = parseFloat($("#tolerancia").val());

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

// Función para generar el gráfico
function generateChart() {
    const iterations = iterationData.map((data) => data.iterations);
    const errors = iterationData.map((data) => parseFloat(data.error));

    const ctx = document.getElementById("chartCanvas").getContext("2d");
    const myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: iterations,
            datasets: [
                {
                    label: "Error (%)",
                    data: errors,
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 2,
                    fill: false,
                },
            ],
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: "Iterations",
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: "Error (%)",
                    },
                },
            },
        },
    });
}

const alertGeneratePDF = () => {
    Swal.fire({
        title: "¿Generar PDF?",
        icon: "question",
        html: "Deseas genearar un PDF, Donde estaran todos tus resultados",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Generar",
        cancelButtonText: "Cerrar",
    }).then((result) => {
        if (result.isConfirmed) {
            GeneratePDF();
        }
    });
};

const img =
    "data:image/png;base64,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";

const GeneratePDF = () => {
    console.log("Generar PDF");
    let doc = new jsPDF({ lineHeight: 1.5 });

    doc.setProperties({ title: `METODO DE PUNTO FIJO` });

    doc.addImage(img, "png", 170, 15, 30, 15);

    doc.autoTable({
        body: [
            [
                {
                    content: `METODO DE PUNTO FIJO`,
                    styles: {
                        halign: "left",
                        fontSize: 15,
                        font: "Helvetica",
                        fontStyle: "Bold",
                        cellPadding: { top: 4 },
                        textColor: "#000000",
                    },
                },
            ],
        ],
        theme: "plain",
    });

    doc.autoTable({
        body: [
            ["Universidad Tecnica Nacional | Recinto Corobicí"],
            [
                "Cañas, Guanacaste, 200 mts noreste del Liceo Miguel Araya de Cañas.",
            ],
        ],
        theme: "plain",
        tableWidth: "auto",
        columnStyles: {
            0: {
                halign: "left",
                cellWidth: "wrap",
                cellPadding: { top: 0, right: 2, bottom: 1, left: 0 },
            },
        },
        bodyStyles: {
            textColor: "#000000",
            halign: "right",
            fontSize: 8,
        },
        startY: doc.lastAutoTable.finalY + 1,
    });

    dataOBJ = [];

    iterationData.map((obj) => {
        dataOBJ.push([
            obj.iterations,
            obj.initialGuess,
            obj.approximation,
            obj.error,
        ]);
    });

    doc.autoTable({
        head: [["N° I", "Valor inicial", "Iteración", "Error %"]],
        body: dataOBJ,
        headStyles: {
            fillColor: "#FFFFFF",
            textColor: "#000000",
            halign: "left",
            fontSize: 10,
            font: "Helvetica",
            fontStyle: "Bold",
        },
        bodyStyles: {
            textColor: "#000000",
            halign: "left",
            fontSize: 8,
            lineColor: "#6b7280",
        },
        theme: "striped",
        tableLineColor: [255, 255, 255],
        tableLineWidth: 0.4,
        cellPadding: 0,
        startY: doc.lastAutoTable.finalY + 3,
    });

    doc.output("dataurlnewwindow");
};
