export default {
    state: {
        carts:[],
        products:[],
        product:[],
        subTotal: '',
        slug: ''
    },

    getters: {
        //carts
        getCartFormGetters(state) {

            return state.carts
        },
        getSubTotalFormGetters(state) { //take parameter state

            return state.subTotal
        },
        //products
        getProductsFromGetters(state) {

            return state.products
        },
        getProductFromGetters(state) {

            return state.product
        },
        
    },

    actions: {
        //carts
        allCartFromDatabase(context) {
            axios.get("getCarts")
                .then((response) => {
                    
                    context.commit("carts", response.data.carts)
                })
                .catch(() => {

                    console.log("Error get carts")

                })
        },
        subTotalFromDatabase(context) {
            axios.get("getCarts")
            
            .then((response) => {
                context.commit('subTotal', response.data.subTotal)
            })
            .catch(()  => {
                console.log("Error get subTotal")
            })
        },
        //Products
        allProductsFromDatabase(context) {
            axios.get('getProducts')
                .then((response) => {
                    context.commit('products', response.data.products)
                    console.log(this.state.products)
                    
                })
                .catch(() => {

                    console.log("Error get products")

                })
        },
        //Product
        allProductFromDatabase(context) {
            axios.get('getProduct/'+window.location.href.substr(22))
                .then((response) => {
                    context.commit('product', response.data.product)
                    console.log(this.state.product)
                })
                .catch(() => {

                    console.log('getProduct/'+window.location.href.substr(30))

                })
        },
        clickIncrementSlug({ commit },message) {
            commit('increment', message)
          },
        
        
    },

    mutations: {
        //carts
        carts(state, data) {
            return state.carts = data
        },
        subTotal(state, data) {
            return state.subTotal = data
        },
        //products
        products(state, data) {
            return state.products = data
        },
        product(state, data) {
            return state.product = data
        },
        increment(state, message) {
            return state.slug = message;
        }
        
    }
}
