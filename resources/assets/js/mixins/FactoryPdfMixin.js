import PdfFactory from './../src/Pdf/'
export default {

    data(){
        return {
            PdfFactory : null,
        }
    },

    mounted() {
        this.PdfFactory = new PdfFactory();
    },
}