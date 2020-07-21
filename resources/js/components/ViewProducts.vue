<template>
  <div>
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="form-row">
            <div class="col-row">
              <input type="text" class="form-control" @keyup="searchProduct" v-model="q" placeholder="Rechercher un produit">
            </div>
            
            <a class="text-muted" href="#" aria-label="Search">
              
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="mx-3"
                role="img"
                viewBox="0 0 24 24"
                focusable="false"
              >
                <title>Search</title>
                <circle cx="10.5" cy="10.5" r="7.5" />
                <path d="M21 21l-5.2-5.2" />
              </svg>
            </a>
          </div>
        </div>
      </header>
      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between" >
          <a v-for="category in categories" :key="category.id" class="p-2 text-muted" :href="'category/'+category.slug">{{ category.name }}</a>
        </nav>
      </div>
      <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
          <p
            class="lead my-3"
          >Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
          <p class="lead mb-0">
            <a href="#" class="text-white font-weight-bold">Continue reading...</a>
          </p>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6" v-for="(product, i) in products.data" :key="i">
          <div
            class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
          >
            <div class="col p-4 d-flex flex-column position-static">
              <img :src="product.image" alt />
              <strong class="d-inline-block mb-2 text-primary" v-for="(category, i) in product.categories" :key="i">{{category.name}}</strong>
              <h5 class="mb-0">{{ product.title }}</h5>
              <div class="mb-1 text-muted">{{ product.subtitle }}</div>
              <p class="card-text mb-auto">{{ product.price / 100 }} €</p>
              <a :href="'product/'+product.slug" class="stretched-link btn btn-info">En savoir plus</a>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <pagination :data="products" @pagination-change-page="getResults" class="mt-5 justify-content-center"></pagination>
  </div>
</template>

<script>
import { mapState } from "vuex"
export default {
  data() {
    return {
      slug: "",
      tableau: [],
      products:{},
      q:''
    };
  },
  created() {
    this.$store.dispatch("allProductsFromDatabase");
    axios.get('/api/getProduct')
				.then(response => {
					this.products = response.data.products;
				});
  },
  computed: mapState(['categories']),
  methods: {
   getResults(page = 1) {
			axios.get('/api/getProduct?page=' + page)
				.then(response => {
					this.products = response.data.products;
				});
    },
    searchProduct() {
      axios.get('/api/getProduct?q=' + this.q)
				.then(response => {
					this.products = response.data.products;
				});
    }
  },
  
  // getAllSlug() {
  //   return this.$store.getters.getSlugFromGetters
  // }
};
</script>

<style lang="scss" scoped>
.bd-placeholder-img {
  font-size: 1.125rem;
  text-anchor: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

@media (min-width: 768px) {
  .bd-placeholder-img-lg {
    font-size: 3.5rem;
  }
}
</style>