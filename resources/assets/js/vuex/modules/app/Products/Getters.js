import { getField } from 'vuex-map-fields';

const getters = {

    getField,

    LoadingProducts(state){
        return state.loading_products;
    },

    GetVariations(state){
        return state.product.variations;
        /* return  state.product.variations.filter((v) =>{
            return v.exist    
        }); */
    },

    Submitted(state){
        return state.submitted;
    },

    ProductNameLength(state){
        if (state.product.name != null) {
            return state.product.name.length;
        }
        return 0
    },

    DescriptionLength(state){
        if (state.product.description != null) {
            return state.product.description.length;
        }
        return 0
    },

    ProductList(state){
        if (state.list_products.length > 0) {
            return state.list_products;
        }

        return [];
    },

    ProductAvailableQuantity(state)
    {
        return state.product.available_quantity;
    },

    ProductAvailableTotal(state)
    {
        return state.product.available_total;
    },

    ProductName(state)
    {
        return state.product.name;
    },

    ProductCode(state)
    {
        return state.product.code;
    },

    ProductStock(state)
    {
        return state.product.stock;
    },

    ProductOriginalPrice(state)
    {
        return state.product.original_price;
    },

    ProductSalePrice(state)
    {
        return state.product.sale_price;
    },

    ProductSize(state)
    {
        return state.product.size;
    },

    ProductDescription(state)
    {
        return state.product.description;
    }
}

export default getters;