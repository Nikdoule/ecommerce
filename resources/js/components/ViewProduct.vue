<template>
  <div>
    <div class="row mb-2 justify-content-center">
      <div class="col-md-6">
        <div v-show="duplicate" class="alert alert-success">vous avez déjà ajouté cette article au panier!</div>
        <div v-show="addProduct" class="alert alert-success">L'article vient d'être ajouté au panier!</div>
        <div
          class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
        >
          <div class="col p-4 d-flex flex-column position-static">
            <img :src="getProduct.image" alt />
            <strong class="d-inline-block mb-2 text-primary">World</strong>
            <h5 class="mb-0">{{ getProduct.title }}</h5>
            <div class="mb-1 text-muted">{{ getProduct.subtitle }}</div>
            <p class="card-text mb-auto">{{ getProduct.price / 100 }} €</p>
            <form @submit.prevent="onSubmit">
              <button
                @click="form.product_id = getProduct.id, activeDuplicate"
                type="submit"
                class="btn btn-success"
              >Ajouter au panier</button>
              <a :href="cart" type="submit" class="btn btn-success">
                <img class="svg" src="/images/shopping-cart.svg" alt="cart" />
                <span class="badge badge-pill badge-dark">{{counTotalplusCompteur}}</span>
              </a>
              <a :href="home" type="submit" class="btn btn-success">
                <span>Continuer mes achats</span>
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      duplicate: false,
      addProduct: false,
      cart: "/cart",
      home: '/',
      compteur: 0,
      form: {
        product_id: ""
      }
    };
  },
  mounted() {
    
  },
  created() {
    this.$store.dispatch("allProductFromDatabase");
  },
  computed: {
    getProduct() {
      return this.$store.getters.getProductFromGetters;
    },
    getCarts() {
      return this.$store.getters.getCartFromGetters;
    },
    countTotal() {
      let cTotal = Object.values(this.getCarts).reduce(
        (t, { qty }) => t + Number(qty),
        0
      );

      return cTotal;
    },

    counTotalplusCompteur() {
      let newCount = this.countTotal + this.compteur;
      return newCount;
    },
    activeDuplicate() {
      for(const property in this.getCarts){
          //console.log(this.getCarts[property].id);
        if(this.getCarts[property].id == this.getProduct.id){
          this.duplicate = true
        }
      }

    },
    
  },
  methods: {
    onSubmit() {
      axios
        .post("http://ecommerce.test/cart/add", this.form)
        .then(({ data }) => {
          if (this.compteur < 1 && this.duplicate == false) {
            this.compteur++;
            this.addProduct = true
          }
        });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>