<template>
  <div>
    <div class="row mb-2 mt-5 justify-content-center">
      <div class="col-md-6">
        <div v-show="duplicate" class="alert alert-success">L'article vient d'être ajouté au panier!</div>
        <div
          class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
        >
          <div class="col p-4 d-flex flex-column position-static" :duplicate="activeDuplicate">
            <img :src="product.image" alt />
            
            <div class="d-flex justify-content-between">
              <img
                id="pair"
                v-for="item in formatSerialize"
                :key="item.index"
                :src="item"
                class="d-flex mt-3"
                alt
              />
            </div>
            <strong class="d-inline-block mb-2 text-primary">World</strong>
            <h5 class="mb-0">{{ product.title }}</h5>
            <div class="mb-1 text-muted">
              <p>{{ product.subtitle }}</p>
            </div>
            <div>
              <p>{{ product.description }}</p>
            </div>
            <p class="card-text mb-auto">{{ product.price / 100 * form.product_qty }} €</p>
            <form @submit.prevent="onSubmit">
              <div class="d-flex col-12 pl-0">
                <button
                  v-show="addProductCart"
                  @click="form.product_id = product.id"
                  type="submit"
                  class="btn btn-success"
                >Ajouter au panier</button>
                <select
                  v-show="duplicate"
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
              <div class="d-flex col-12 pl-0 mt-3">
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
import { mapState, mapGetters } from "vuex";
export default {
  data() {
    return {
      unSerialize: [],
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
    this.$store.dispatch("productFromDatabase");
  },
  computed: {
    formatSerialize() {
      for (const property in this.product) {
        this.unSerialize = this.product.images.split('"');
      }
      for (var i = 0; i < this.unSerialize.length; i++) {
        this.unSerialize.splice(i, 1);
      }
      return this.unSerialize;
    },
    ...mapState(["product", "carts"]),

    ...mapGetters(["getTotal"]),

    activeDuplicate(state) {
      for (const property in this.carts) {
        if (this.carts[property].id == this.product.id) {
          this.duplicate = true;
          this.addProductCart = false;
          this.form.product_qty = this.carts[property].qty;
        }
      }
    }
  },
  methods: {
    onChange(event) {
      this.form.qty = event.target.value;
      for (const property in this.carts) {
        if (this.carts[property].id == this.product.id) {
          this.rowId = this.carts[property].rowId;
          this.carts[property].qty = this.form.product_qty;
        }
      }
      axios.patch("/cart/" + this.rowId, this.form).then(({ data }) => {});
    },
    onSubmit() {
      axios.post("/cart/add", this.form).then(({ data }) => {
        Vue.set(this.carts, "rowId", data);
      });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>