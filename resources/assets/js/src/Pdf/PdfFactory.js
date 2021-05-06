import Comanda from './Comanda';
import InvoiceA from './Invoices/InvoiceA';
import InvoiceB from './Invoices/InvoiceB';
import PedidoClientePdf from './PedidoClientePdf';

const PDF = {
    Comanda,
    InvoiceA,
    InvoiceB,
    PedidoClientePdf
}


class PdfFactory {

    constructor(){

    }

    createInstance(nombrePdf)
    {
        let pdfConstructor = PDF[nombrePdf];
        let pdf = null;
        if (pdfConstructor) {
            pdf = new pdfConstructor();
        }

        return pdf;
    }
}

export default PdfFactory;