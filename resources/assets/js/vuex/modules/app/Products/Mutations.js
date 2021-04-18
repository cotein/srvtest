import collect from 'collect.js';
import { updateField } from 'vuex-map-fields';

const mutations = {

    updateField,

    CLEAN_OTHER_ATTRIBURES(state){
        
        let others_attributes = collect(state.product.others_attributes);

        let oa = others_attributes.map((attr) => {
            if (attr.id != null) {
                return attr;
            }
        }).toArray();

        state.product.others_attributes = oa;

    },

    SET_LOADING_PRODUCTS(state, value){
        state.loading_products = value
    },

    ADD_PRIORITY(state, value){
        state.product.priority = value
    },

    ADD_SUPPLIER(state, value){
        state.product.supplier = value
    },

    ADD_PRODUCT_BRAND(state, value){
        state.product.brand = value
    },

    ADD_SKU_CODE(state, value){
        state.product.code = value;    
    },

    ADD_PATH_FROM_ROOT(state, value){
        state.product.path_from_root = value;
    },

    UPDATE_SUBMITTED(state, value){
        state.submitted = value;
    },

    ADD_OTHER_ATTRIBUTE(state, attr){
        let index = collect(state.product.others_attributes).count();
        Vue.set(state.product.others_attributes, index, attr);
    },

    UPDATE_VARIATION_PRICE(state, value){
        state.product.variation.price = value;
    },

    ADD_VARIATION_ATTRIBUTE(state, attr){
        let index = collect(state.product.variation.attributes).count();
        Vue.set(state.product.variation.attributes, index, attr);
        //state.product.variation.attributes.push(attr);
    },

    INCREMENT(state, index){
        //Vue.set(state.product.variations, data_obj.index, { available_quantity : data_obj.count})
        state.product.variations[index].available_quantity++;
    },

    DECREMENT(state, index){
        if (!(state.product.variations[index].available_quantity == 0)) {
            state.product.variations[index].available_quantity--;
        }
        
    },

    ADD_VARIATION(state){
        let index = collect(state.product.variations).count();
        Vue.set(state.product.variations, index, 
            { 
                color : null,
                price : null,
                available_quantity : 1
            }
        );
    },

    ADD_ROW(state, value){
        state.product.vs.push(value);
    },

    VMODEL_COLOR(state, value){
        state.product.variation.attribute_combinations.color = value;
    },  

    VMODEL_SIZE(state, value){
        state.product.variation.attribute_combinations.size = value;
    },

    ADD_ALLOW_VARIATION_ATTRIBUTE(state, value){
        let index = collect(state.product.variation.attribute_combinations).count();
        //Vue.set(state.product.variation.attribute_combinations, index, value);
        //Object.assign(state.product.variation.attribute_combinations, value)
        state.product.variation.attribute_combinations.push(value)
    },

    REMOVE_VARIATION (state, index) {
        //console.log('index: '+state.product.variations.indexOf(variation));
        //let index = state.product.variations.indexOf(variation);
        //state.product.variations.splice(index, 1);
        Vue.delete(state.product.variations, index);
        //state.product.variations[index].exist = false;
        state.product.variations = Object.assign([],  state.product.variations);
    },

    ADD_PRODUCTS(state, products){
        state.products = products;
    },
    ADD_PRODUCT_TO_PRODUCT_QUICK_VIEW(state, product){
        state.product_quick_view = product;
    },
    PRODUCTS_LOADING_TOGGLE(state, value){
        state.products_loading = value
        /* if(state.products_loading == false){
            state.products_loading = true;
        }else{
            state.products_loading = false;
        } */
    },
    UPDATE_IVA_VALUE (state, value) {
        state.product.iva = value
    },

    UPDATE_MONEY_VALUE (state, value) {
        state.product.money = value
    },

    UPDATE_BUYING_MODE_VALUE (state, value) {
        state.product.buying_mode = value
    },

    UPDATE_CATEGORY_VALUE (state, value) {
        state.product.category = value
    },

    UPDATE_SUBCATEGORY_VALUE (state, value) {
        state.product.children_categories = value
        //Vue.set(state.product, 'children_categories', value);
    },

    UPDATE_SUBCATEGORY_LEVEL_2_VALUE (state, value) {
        state.product.children_categories_level_2 = value
        //Vue.set(state.product, 'children_categories_level_2', value);
    },

    UPDATE_LISTING_TYPES_VALUE (state, value) {
        state.product.listing_type = value
    },

    UPDATE_ATTR_ITEM_CONDITION(state, value){
        state.product.attr_item_condition = value
    },

    ADD_COLOR_VARIATION (state, value) {
        state.product.variations.push(value)
    },

    ADD_SUBCATEGORY (state, value){
        state.product.sub_category = value;
    },

    UPDATE_LIST_PRODUCTS(state, value){
        state.list_products = value
    },

    SET_AVAILABLE_QUANTITY(state, value)
    {
        state.product.available_quantity = value;
    },

    SET_AVAILABLE_TOTAL(state, value)
    {
        state.product.available_total = value;
    },

    SET_NEW_PRODUCT_NAME(state, value)
    {
        state.product.name = value;
    },

    SET_NEW_PRODUCT_CODE(state, value)
    {
        state.product.code = value;
    },

    SET_NEW_PRODUCT_STOCK(state, value)
    {
        state.product.stock = value;
    },

    SET_NEW_PRODUCT_ORIGINAL_PRICE(state, value)
    {
        state.product.original_price = value;
    },

    SET_NEW_PRODUCT_SALE_PRICE(state, value)
    {
        state.product.sale_price = value;
    },

    SET_NEW_PRODUCT_SIZE(state, value)
    {
        state.product.size = value;
    },

    SET_NEW_PRODUCT_DESCRIPTION(state, value)
    {
        state.product.description = value;
    },

    SET_PRICE_LIST(state, value)
    {
        state.product.price_list = value;
    }
}

export default mutations;