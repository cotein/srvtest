export default {
    state : {
        vouchers : []
    },

    mutations : {

        SET_VOUCHERS(state, value){
            state.vouchers = value
        },
    },

    actions : {

        getVouchers(context, token){

            return new Promise((resolve, reject) => {
                
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

                axios.get('/api/vouchers/index').then((result) => {
                    resolve(result);
                }).catch((err) => {
                    reject(err);
                });

            })
        }
    },

    getters : {

        Vouchers(state){
            return state.vouchers;
        }
    }

}