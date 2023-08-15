const Gerate_PDF_Biseccion = (iterationData) => {
    try {
        let doc = new jsPDF({lineHeight: 1.5});

        doc.setProperties({title: `METODO DE PUNTO FIJO`});

        doc.addImage(img, "png", 170, 15, 30, 15);

        doc.autoTable({
            body: [
                [
                    {
                        content: `METODO DE BISECCION`,
                        styles: {
                            halign: "left",
                            fontSize: 15,
                            font: "Helvetica",
                            fontStyle: "Bold",
                            cellPadding: {top: 4},
                            textColor: "#000000",
                        },
                    },
                ],
            ],
            theme: "plain",
        });

        doc.autoTable({
            body: [
                ["Universidad Tecnica Nacional | Recinto Corobicí."],
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
                    cellPadding: {top: 0, right: 2, bottom: 1, left: 0},
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
                obj.iteration,
                obj.interval_a,
                obj.interval_b,
                obj.value_a,
                obj["f(a)"],
                obj.value_b,
                obj["f(b)"],
                obj.midpoint,
                obj["f(midpoint)"],
                obj.error
            ]);
        });

        doc.autoTable({
            head: [["Iteraciones", "Intervalo A", "Intervalo B", "Valor A", "F imagen de(A)", "Valor B", "F imagen de(B)", "Punto Medio", "F imagen de punto medio(X)", "Error"]],
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

       // doc.save("Metodo_PDF_Biseccion.pdf");
        // Capturar el contenido completo de la gráfica como imagen
        html2canvas(document.getElementById("graphDiv"), { scale: 2 })
        .then((canvas) => {
            const imgData = canvas.toDataURL("image/jpeg", 1.0);
            doc.addImage(imgData, "JPEG", 10, doc.lastAutoTable.finalY + 20, 190, 100); // Ajusta las dimensiones y la posición según tus necesidades
            doc.save("Metodo_PDF_Biseccion.pdf"); // Nombre del archivo PDF
        })
        .catch((error) => {
            console.error("Error al capturar la gráfica:", error);
        });
    } catch (e) {
        console.log(e);
    }
};
