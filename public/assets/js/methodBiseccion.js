let jsonResults = [];

$(document).ready(function () {
    ValidExitsData();
    GenerateGraphBisecion();
});

const onclickBiseccion = () => {
    console.log('entro a onclickBiseccion');
    let funcionValue = $("#function").val()

    // Guardar un valor en el localStorage
    localStorage.setItem('func', funcionValue);
}


function ValidExitsData() {
    // Verificar si la variable 'results2' está definida
    if (typeof results2 !== 'undefined') {
        // Ahora puedes utilizar la variable 'results2' en JavaScript
        console.log(results2); // Aquí puedes hacer lo que necesites con 'results2'
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
                Gerate_PDF_Biseccion(results2);
            }
        });
    } else {
        console.log("La variable 'results2' no está definida o es nula.");
    }
}


function validFormulaBiseccion() {
    console.log('entro a validFormulaBiseccion');
    try {
        // Obtener un valor del localStorage
        let funcLocal = localStorage.getItem('func');

        let formularAux = funcLocal;

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
    } finally {
        localStorage.removeItem('func');
    }
}

function GenerateGraphBisecion() {
    let funcLocal = localStorage.getItem('func');
    if (funcLocal !== null) {
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
                applet.evalCommand(validFormulaBiseccion());
                applet.evalCommand("ZoomFit");
            },
        };

        $('#append-title').empty().append(`<div class="d-flex justify-content-center pb-2">
                                        <p class="fs-5">Grafico de geogebra</p>
                                    </div>`);

        let applet = new GGBApplet(parameters, "5.0", "graphDiv");
        applet.inject("graphDiv");
    }
}
