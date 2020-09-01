<template>
  <div>
    <div class="container">
      <header class="blog-header py-3">
        <div class="column flex-nowrap justify-content-between align-items-center">
          <div class="form-row">
            <div class="col-row">
              <input
                type="text"
                class="form-control"
                @keyup="searchProduct"
                v-model="q"
                placeholder="Rechercher un produit"
              />
            </div>
            <button
              @click="searchProduct"
              class="btn btn-outline-success my-sm-0"
              type="submit"
            >Search</button>
          </div>
          <div class="d-flex">
            <select
              v-model="selected"
              class="custom-select my-1 mr-sm-2"
              id="inlineFormCustomSelectPref"
            >
              <option
                @click="onTrie"
                v-for="option in options"
                :key="option.id"
                :value="option.value"
              >{{ option.text }}</option>
            </select>
          </div>
        </div>
      </header>
      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a
            v-for="category in categories"
            :key="category.id"
            class="p-2 text-muted"
            :href="'category/'+category.slug"
          >{{ category.name }}</a>
        </nav>
      </div>
      <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-5 text-center font-italic">Title longer</h1>
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
              <a v-show="activeCan" :href="'product/'+product.slug+'/edit'">
                <img class="svg" :src="'../images/edit.svg'" alt="bouton editer" />
              </a>

              <form @submit.prevent="onDelete(product.id, i)" class="d-inline">
                <button v-show="activeCan" type="submit" class="button-delete">
                  <img class="svg" :src="'../images/delete.svg'" alt="bouton supprimer" />
                </button>
              </form>
              <img :src="product.image" />
              <h6>
                Categories :
                <span
                  v-for="(category, i) in product.categories"
                  :key="i"
                  class="d-inline-block mb-2 mr-2 text-primary"
                >{{category.name}}</span>
              </h6>
              <h5 class="mb-0">{{ product.title }}</h5>
              <p class="card-text mb-auto">{{ product.price / 100 }} €</p>
              <a :href="'product/'+product.slug" class="btn btn-info">En savoir plus</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pagina ">
      <pagination
        :data="products"
        @pagination-change-page="getResults"
        class=""
      ></pagination>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      selected: "",
      options: [
        { text: "Trier par", value: "" },
        { text: "Prix croissant", value: "a" },
        { text: "Prix décroissant", value: "b" },
      ],
      slug: "",
      tableau: [],
      q: "",
    };
  },
  mounted() {},
  created() {
    this.$store.dispatch("allProductsFromDatabase");
  },
  computed: {
    ...mapState(["categories", "rolesAuth", "products"]),
    activeCan() {
      let showButton = false;

      for (const property in this.rolesAuth) {
        if (
          this.rolesAuth[property] == "super-admin" ||
          this.rolesAuth[property] == "admin"
        ) {
          this.showButton = true;
        }
      }
      return this.showButton;
    },
  },
  methods: {
    onDelete(productId, i) {
      axios.delete("getProduct/" + productId, productId).then(({ data }) => {
        return location.reload();
      });
    },
    getResults(page = 1) {
      axios.get("/getProduct?page=" + page).then((response) => {
        this.$store.state.products = response.data.products;
      });
    },
    searchProduct() {
      axios.get("/getProduct?q=" + this.q).then((response) => {
        this.$store.state.products = response.data.products;
      });
    },
    onTrie() {
      axios.get("/getProduct?selected=" + this.selected).then((response) => {
        this.$store.state.products = response.data.products;
      });
    },
  },
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