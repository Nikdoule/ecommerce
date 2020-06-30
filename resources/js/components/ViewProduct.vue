<template>
  <div>
    <div class="row mb-2 mt-5 justify-content-center">
      <div class="col-md-6">
        <div v-show="duplicate" class="alert alert-success">L'article vient d'être ajouté au panier!</div>
        <div
          class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
        >
          <div class="col p-4 d-flex flex-column position-static">
            <img :src="getProduct.image" alt />
            <strong class="d-inline-block mb-2 text-primary">World</strong>
            <h5 class="mb-0">{{ getProduct.title }}</h5>
            <div class="mb-1 text-muted">{{ getProduct.subtitle }}</div>
            <div class="mb-1 text-muted">{{ getProduct.subtitle }}</div>
            <p class="card-text mb-auto">{{ getProduct.price / 100 * form.product_qty }} €</p>
            <form @submit.prevent="onSubmit">
              <div class="d-flex col-4 pl-0">
                <button
                  v-show="addProductCart"
                  @click="form.product_id = getProduct.id"
                  type="submit"
                  class="btn btn-success col-10"
                >Ajouter au panier {{ activeDuplicate }}</button>
                <select
                  @change.prevent="onChange($event)"
                  v-model="form.product_qty"
                  name="qty"
                  id="qty"
                  class="custom-select"
                >
                  <option
                    placeholder="choissez votre quantité"
                    v-for="count in counts"
                    :key="count.id"
                    :value="count"
                    :selected="count == form.product_qty"
                  >{{ count }}</option>
                </select>
              </div>
              <div class="d-flex col-4 pl-0 mt-3">
                <a :href="home" type="submit" class="btn btn-success">
                  <span>Continuer mes achats</span>
                </a>
              </div>
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
      addProductCart: true,
      duplicate: false,
      counts: 5,
      cart: "/cart",
      home: "/",
      rowId: "",
      form: {
        product_id: "",
        product_qty: 1
      }
    };
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
    activeDuplicate() {
      for (const property in this.getCarts) {
        if (this.getCarts[property].id == this.getProduct.id) {
          this.duplicate = true;
          this.addProductCart = false;
          this.form.product_qty = this.getCarts[property].qty;
        }
      }
    }
  },
  methods: {
    onChange(event, rowId) {
      this.form.qty = event.target.value;
      for (const property in this.getCarts) {
        if (this.getCarts[property].id == this.getProduct.id) {
          this.rowId = this.getCarts[property].rowId;
          this.getCarts[property].qty = this.form.product_qty;
        }
      }
      axios
        .patch("/cart/" + this.rowId, this.form)
        .then(({ data }) => {});
    },
    onSubmit() {
      axios
        .post("/cart/add", this.form)
        .then(({ data }) => {
          this.tab = data;
          Vue.set(this.getCarts, "name", this.tab);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>