<template>
  <div>
    <div >
      <a class="height-cart" v-if=" countTotal > 0" :href="hrefcart">
      </a>
      <img class="svg" src="/images/shopping-cart.svg" alt="cart" />
      <span v-if="countTotal > 0" class="badge badge-pill badge-dark">{{ countTotal }}</span>
      <span v-if="countTotal < 1" class="badge badge-pill badge-dark">{{ carts }}</span>
    </div>
  </div>
</template>
<script>
export default {
  props:['carts'],
    data() {
        return {
          hrefcart:'/cart',
          hrefHome:'/',
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
        0
      );

      return this.cTotal;
    },
  },

};
</script>

<style lang="scss" scoped>
</style>