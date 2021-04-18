import collect from 'collect.js'
export default {
    state : {
        main_categories : [],
        categories : null,
    },
    actions  :{
        /**
         * Devuelve las principales categorías de ML
         * @param {*} context 
         */
        fetchMainCategories(context, token){
            /**
             * Desde el objeto context accedemos a todo el estado
             */
            window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
            return axios.post('/api/categories/fetch_main_categories')
            .then((result) => {
                context.commit('ADD_MAIN_CATEGORIES', result.data.body);
            }).catch((err) => {
                console.log(err);
            });
        },
        
        /**
         * Devuelve las categorías hijas de ML
         * @param {*} context 
         */
       

        /**
         * Estas son las categorías que solamente tienen productos para mostrar
         * @param {*} context 
         */
        fetchCategories(context){
            /**
             * Desde el objeto context accedemos a todo el estado
             */
            return axios.post('/get_categories')
            .then((result) => {
                context.commit('ADD_CATEGORIES', result.data);
            }).catch((err) => {
                console.log(err);
            });
        },

        
    },
    mutations :{
        ADD_CATEGORIES(state, categories){
            state.categories = categories;
        },


        ADD_MAIN_CATEGORIES(state, main_categories){
            state.main_categories = main_categories;
        },

        SHOW_ALL_CATEGORY_FILTER(state){
            
            let categories = collect(state.categories);

            categories.each((cat, index) => {
                
                cat.show = true;
                    
            });

        },
        
        SHOW_CATEGORY(state, category_id){
            let categories = collect(state.categories);

            categories.each((cat, index) => {
                
                if (cat.id == category_id) {

                    cat.show = true;
                    
                }
            });
        }

/*         ADD(state, value){
            state.main_categories = value;
        } */
    },

    getters : {
        Categories(state){
            if (state.categories != null) {
                return state.categories;
            }
            return []
        }
    }
}