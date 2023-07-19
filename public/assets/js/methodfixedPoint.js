$(document).ready(function () {
    prevImputFunc();
});

let jsonResults = [];

function calcularPuntoFijo(iteraciones, tolerancia, XI) {
    let Ea = 100; // Error aproximado inicial

    let valuePrv = XI;
    for (let i = 1; i <= iteraciones && Ea > tolerancia; i++) {
        const XINuevo = g(XI); // Calcula el nuevo valor de XI utilizando la función g(x)
        const XIPrevio = XI; // Almacena el valor previo de XI
        XI = XINuevo; // Actualiza el valor de XI
        Ea = diferenciaPorcentual(XI, XIPrevio); // Calcula el error aproximado

        jsonResults.push({
            iteracion: i,
            x: valuePrv.toFixed(5),
            xi: XINuevo.toFixed(5),
            ea: Ea.toFixed(5),
        });
        valuePrv = XI;
    }
    renderTable();
}

function g(XI) {
    let ecuacion = $("#func").val();

    let formularAux = ecuacion
        .replaceAll("X", XI)
        .replaceAll("^", "**")
        .replaceAll(",", ".");

    return eval(formularAux);
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

    if (isNaN(interaciones)) {
        $("#valor3Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#interaciones").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor3Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#interaciones").removeClass().addClass("form-control is-valid");
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
        ecuacion = ecuacion
            .replaceAll("X", 0)
            .replaceAll("^", "**")
            .replaceAll(",", ".");
        // Intentar evaluar la función
        eval("var resultado = " + ecuacion);

        // Verificar si el resultado es un número
        if (typeof resultado !== "number") {
            alert("Funcion invalida");
            return false;
        }
        calcularPuntoFijo(interaciones, tolerancia, valueXI);
    } catch (error) {
        alert("Funcion invalida");
        // Capturar errores de sintaxis u otros errores durante la evaluación
        return false;
    }
};

const prevImputFunc = () => {
    // Obtener el elemento de entrada
    var funcInput = document.getElementById("func");

    // Agregar el evento "input" al campo de entrada
    funcInput.addEventListener("input", function (event) {
        // Obtener el valor actual del campo de entrada
        var valor = event.target.value;

        // Aplicar la expresión regular para validar el valor actual
        let patron = /^[X0-9+\-*/^().\s]+$/;

        if (!patron.test(valor)) {
            // Si el valor no cumple con el patrón, eliminar el último carácter ingresado
            $("#valor1Help")
                .text("Caracter no permitido")
                .removeClass()
                .addClass("form-text text-danger");
            $("#func").removeClass().addClass("form-control is-invalid");
            event.target.value = valor.slice(0, -1);
        } else {
            $("#func").removeClass().addClass("form-control is-valid");
            $("#valor1Help")
                .text("Funcion valida")
                .removeClass()
                .addClass("form-text text-success");
        }
    });
};

//    openModal('Probando','Si funciona')
const openModal = (title, content) => {
    $("#myModal").modal("show");
    $("#TitleModal").text(title);
    $("#ModalContent").text(content);
};

const renderTable = () => {
    htmlBody = ``;
    jsonResults.forEach((obj) => {
        htmlBody +=
            `<tr>
                        <td>` +
            obj.iteracion +
            `</td>
            <td>` +
            obj.x +
            `</td>
                        <td>` +
            obj.xi +
            `</td>
                        <td>` +
            obj.ea +
            `</td>
                    </tr>`;
    });

    htmlTable =
        `<table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Iteracion</th>
                        <th scope="col">x</th>
                        <th scope="col">Xi</th>
                        <th scope="col">Et(%)</th>
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
