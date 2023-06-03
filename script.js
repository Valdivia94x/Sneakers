function pdf() {
    // Declarar variable
    let doc = new jsPDF();

    // Escribir texto
    doc.text(20, 20, "\n\n----------------------------");
    doc.text(20, 30, "Factura TenniShop!" + "\n\nNombre: Fabian Lopez" + "\n\nDireccion: Av Miguel Hidalgo 1 - Santiago de Queretaro" + "\n\nArticulos: 1 Nike Air BLANCA, 1 Tommy Hilfiger Azul" + "\n\nPrecio: 689 MXN" + "\n\nMedio de Pago: PAYPAL" + "\n\n¡GRACIAS POR SU COMPRA!");

    // Generar y guardar PDF
    doc.save('FACTURA.pdf');
};
