<template>
  <div>
    <div>
      <a href="/cart">
        <img class="svg" src="/images/shopping-cart.svg" alt="cart" />
        <span class="badge badge-pill badge-dark">{{ countTotal }}</span>
      </a>
      
    </div>
  </div>
</template>
<script>
export default {
    data() {
        return {
          cTotal: ''
        }
    },
    mounted() {
      this.$store.dispatch("allCartFromDatabase")
    },
    computed: {
      getAllCart() {
        return this.$store.getters.getCartFormGetters
      },
      countTotal() {
      this.cTotal = Object.values(this.getAllCart).reduce(
        (t, { qty }) => t + Number(qty),
        null
      );

      return this.cTotal;
    },
  },

};
</script>

<style lang="scss" scoped>
</style>