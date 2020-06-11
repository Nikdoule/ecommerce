<template>
  <div>
    <div class="row mb-2 justify-content-center">
      <div class="col-md-6">
        <div
          class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
        >
          <div class="col p-4 d-flex flex-column position-static">
            <img :src="product.image" alt />
            <strong class="d-inline-block mb-2 text-primary">World</strong>
            <h5 class="mb-0">{{ product.title }}</h5>
            <div class="mb-1 text-muted">{{ product.subtitle }}</div>
            <p class="card-text mb-auto">{{ product.price / 100 }} €</p>
            <form @submit.prevent="onSubmit">
                <button type="submit" class="btn btn-success">Ajouter au panier</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["product"],
  data() {
      return {
          form: {
              product_id: this.product.id,
          }
      }
  },
  methods: {
      onSubmit() {
          axios.post("http://ecommerce.test/cart/add", this.form)
          .then(({ data }) =>{
              location.href = '/';
          })
      }
  }
};
</script>

<style lang="scss" scoped>
</style>