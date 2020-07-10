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
        todos: [{
                id: 1,
                text: '...',
                done: true
            },
            {
                id: 2,
                text: '...',
                done: false
            }
        ]
    },

    getters: {
        getTotal: state => {
            let cTotal = Object.values(state.carts).reduce(
                (t, {
                    qty
                }) => t + Number(qty),
                0
            );

            return cTotal;
        },
        getProfilUserFromGetters(state) {

            return state.profilUser
        },
        //Roles_user
        getRolesUserFromGetters(state) {

            return state.rolesUser
        },
        //Roles
        getRolesFromGetters(state) {

            return state.roles
        },
        //Auth
        getAuthFromGetters(state) {

            return state.rolesAuth
        },
        //User
        getUserFromGetters(state) {

            return state.user
        },
        //Users
        getUsersFromGetters(state) {

            return state.users
        },
        //Carts
        getCartFromGetters(state) {

            return state.carts
        },
        //Products
        getProductsFromGetters(state) {

            return state.products
        },
        //Product
        getProductFromGetters(state) {

            return state.product
        },

    },
    mutations: {
        profilUser(state, data) {
            return state.profilUser = data
        },
        //Roles_user
        rolesUser(state, data) {
            return state.rolesUser = data
        },
        //Roles
        roles(state, data) {
            return state.roles = data
        },
        //User
        auth(state, data) {
            return state.rolesAuth = data
        },
        //User
        user(state, data) {
            return state.user = data
        },
        users(state, data) {
            return state.users = data
        },
        //Carts
        carts(state, data) {
            return state.carts = data
        },
        //Products
        products(state, data) {
            return state.products = data
        },
        //Product
        product(state, data) {
            return state.product = data
        },
    },

    actions: {
        async allProfilFromDatabase(context) {
            let data = (await axios.get("getProfil")).data;
            context.commit("profilUser", data.user)
        },
        //User Roles Roles_user
        async allEditFromDatabase(context) {
            let data = (await axios.get("/admin/getUsers/" + window.location.href.substr(34))).data;
            context.commit("user", data.user)
            context.commit("roles", data.roles)
            context.commit("rolesUser", data.rolesUser)
            context.commit("auth", data.auth)
        },
        //Users
        async allUsersFromDatabase(context) {
            let data = (await axios.get("getUsers")).data;
            context.commit("users", data.users)
            context.commit("auth", data.auth)
        },
        //Carts
        async allCartFromDatabase(context) {
            let data = (await axios.get("/getCarts")).data;
            context.commit("carts", data.carts)
        },
        //Products
        async allProductsFromDatabase(context) {
            let data = (await axios.get('getProducts')).data;
            context.commit('products', data.products)
        },
        //Product
        async allProductFromDatabase(context) {
            let currentUrl = window.location.pathname;
            let data = (await axios.get('/getProduct/' + currentUrl.substr(9))).data;
            context.commit('product', data.product)
        },
    },

}
