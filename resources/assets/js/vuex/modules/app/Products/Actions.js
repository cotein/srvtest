const actions = {
    fetchProducts(context, token){
        /**
            * Desde el objeto context accedemos a todo el estado
            */

        return new Promise((resolve, reject) => {
            window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
            axios.get('/api/products/index').then(result => {
                resolve(context.commit('UPDATE_LIST_PRODUCTS', result.data));
            }, error => {
                reject(console.log(error));
            })
        })
        /* return axios.post('/get_products')
        .then((result) => {
            context.commit('ADD_PRODUCTS', result.data);
        }).catch((err) => {
            console.log(err);
        }); */
    },
    fetchProductsByCategory(context, slug){
        return axios.post('/products_by_category', {'slug':slug})
        .then((result) => {
            context.commit('ADD_PRODUCTS', result.data);
        }).catch((err) => {
            console.log(err);
        });
    },

    updateIvaValueAction ({ commit }, value) {
        commit('UPDATE_IVA_VALUE', value)
    },

    updateMoneyValueAction ({ commit }, value) {
        commit('UPDATE_MONEY_VALUE', value)
    },

    updateBuyingModeValueAction ({ commit }, value) {
        commit('UPDATE_BUYING_MODE_VALUE', value)
    },

    updateCategoryValueAction ({ commit }, value) {
        commit('UPDATE_CATEGORY_VALUE', value)
    },

    updateSubCategoryValueAction ({ commit }, value) {
        commit('UPDATE_SUBCATEGORY_VALUE', value)
    },

    updateListingTypesValueAction ({ commit }, value) {
        commit('UPDATE_LISTING_TYPES_VALUE', value)
    },

    updateAttrItemCondition(context, value){
        context.commit('UPDATE_ATTR_ITEM_CONDITION', value);
    },

    deleteVariation(context, variation){
        context.commit('REMOVE_VARIATION', variation);
        },

    addVariation(context) {
        context.commit('ADD_VARIATION');
    },

    incrementQty(context, index){
        context.commit('INCREMENT', index);
    },

    decrementQty(context, index){
        context.commit('DECREMENT', index);
    },

    setPricelist(context, el){
        context.commit('SET_PRICE_LIST', el);
    },
}

export default actions;