export default {
    state: {
        carts: {},
        products: {},
        product: {},
        users: {},
        user: {},
        rolesAuth: {},
        roles: {},
        rolesUser: [],
        profilUser: {},
        categories: [],
        productsCategories:{},
        categoriesProduct:[]
    },

    getters: {
        getTotal: state => {
            let cTotal = Object.values(state.carts).reduce(
                (t, {qty}) => t + Number(qty),0
            );

            return cTotal;
        },
        //CategoriesProduct
        getCategoriesProductFromGetters: state => state.categoriesProduct,

        //ProductCategories
        getProductsCategoriesFromGetters: state => state.productsCategories,

        //Categories
        getCategoriesFromGetters: state => state.categories,

        //Profil_user
        getProfilUserFromGetters: state => state.profilUser,

        //Roles_user
        getRolesUserFromGetters: state => state.rolesUser,

        //Roles
        getRolesFromGetters: state => state.roles,

        //Auth
        getAuthFromGetters: state => state.rolesAuth,

        //User
        getUserFromGetters: state => state.user,

        //Users
        getUsersFromGetters: state => state.users,

        //Carts
        getCartFromGetters: state => state.carts,

        //Products
        getProductsFromGetters: state => state.products,

        //Product
        getProductFromGetters: state => state.product,

    },
    mutations: {
        //CategoriesProduct
        categoriesProduct : (state, data) => state.categoriesProduct = data,

        //ProductsCategories
        productsCategories : (state, data) => state.productsCategories = data,

        //Categories
        categories : (state, data) => state.categories = data,

        //Profil_user
        profilUser : (state, data) => state.profilUser = data,

        //Roles_user
        rolesUser : (state, data) => state.rolesUser = data,

        //Roles
        roles : (state, data) => state.roles = data,

        //Auth
        auth : (state, data) => state.rolesAuth = data,

        //User
        user: (state, data) => state.user = data,

        //Users
        users: (state, data) => state.users = data,

        //Carts
        carts: (state, data) => state.carts = data,

        //Products
        products: (state, data) => state.products = data,
        
        //Product
        product: (state, data) => state.product = data,
    },

    actions: {
        //Profil
        async profilFromDatabase({commit}) {
            await axios.get("getProfil")
            .then(({data}) => {
                commit("profilUser", data.user)
            })
            
        },
        //User Roles Roles_user
        async editUserFromDatabase({ commit }) {
            let currentUrl = window.location.pathname;
            await axios.get("/admin/getUsers/" + currentUrl.substr(13))
            .then(({ data }) => {
                commit("user", data.user)
                commit("roles", data.roles)
                commit("rolesUser", data.rolesUser)
                commit("auth", data.auth)
            })
            
        },
        //Users
        async allUsersFromDatabase({commit}) {
            await axios.get("getUsers")
            .then(({data}) => {
                commit("users", data.users)
                commit("auth", data.auth)
            })
            
        },
        //Carts
        async allCartFromDatabase({commit}) {
            await axios.get("/getCarts")
            .then(({data}) => {
                commit("carts", data.carts)
            })
            
        },
        //Products
        async allProductsFromDatabase({commit}) {
            await axios.get('/getProduct')
            .then(({data}) => {
                commit('products', data.products)
                commit('categories', data.categories)
                commit('auth', data.auth)
            })
            
        },
        //Product
        async productFromDatabase({commit}) {
            let currentUrl = window.location.pathname;
            await axios.get('/getProduct/add/' + currentUrl.substr(9))
            .then(({data}) => {
                commit('product', data.product) 
            })
            
        },
        async editProductFromDatabase({commit}) {
            let currentUrl = window.location.pathname;
            await axios.get('/getProduct/' + currentUrl.substr(9))
            .then(({data}) => {
                commit('product', data[1])
                commit('categories', data.categories)
                commit('categoriesProduct', data.categoriesProduct)
            })
            
        },
        async createProductFromDatabase({commit}) {
            await axios.get('/getProduct/create')
            .then(({data}) => {
                commit('categories', data.categories)
            })
            
        },
        //Category
        async categoryFromDatabase({commit}) {
            let currentUrl = window.location.pathname;
            await axios.get('/getCategory/' + currentUrl.substr(10))
            .then(({data}) => {
                commit('productsCategories', data.productByCategories)
                commit('categories', data.categories)
            })
            
        },
    },

}
