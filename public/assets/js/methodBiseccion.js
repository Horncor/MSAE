let jsonResults = [];

$(document).ready(function () {
    ValidExitsData();
});

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
