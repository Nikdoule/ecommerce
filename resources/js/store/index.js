export default {
    state: {
        
        carts:[],
        products:[],
        product:[],

    },

    getters: {
        //carts
        getCartFromGetters(state) {

            return state.carts
        },
        //products
        getProductsFromGetters(state) {

            return state.products
        },
        getProductFromGetters(state) {

            return state.product
        },
        
    },
    mutations: {
        //carts
        carts(state, data) {
            return state.carts = data
        },
        //products
        products(state, data) {
            return state.products = data
        },
        product(state, data) {
            return state.product = data
        },
    },

    actions: {
        //carts
        async allCartFromDatabase(context) {
            let data = (await axios.get("getCarts")).data;
            context.commit("carts", data.carts)
               
        },
        //Products
        async allProductsFromDatabase(context) {
            let data = (await axios.get('getProducts')).data;
            context.commit('products', data)
        },
        //Product
        async allProductFromDatabase(context) {
            let data = (await axios.get('getProduct/'+window.location.href.substr(30))).data;
            context.commit('product', data.product)
            context.commit('carts', data.carts)
        },
    },

}
