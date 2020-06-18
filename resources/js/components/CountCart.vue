<template>
  <div>
    <div >
      <a class="height-cart" v-if=" countTotal > 0" :href="hrefcart">
      </a>
      <img class="svg" src="/images/shopping-cart.svg" alt="cart" />
      <span class="badge badge-pill badge-dark">{{ countTotal }}</span>
    </div>
  </div>
</template>
<script>
export default {
    data() {
        return {
          hrefcart:'/cart',
          hrefHome:'/',

        }
    },
    created() {
      this.$store.dispatch("allCartFromDatabase")
    },
    computed: {
      getAllCart: function() {
        return this.$store.state.carts;
      },
      
      countTotal() {
      let cTotal = Object.values(this.getAllCart).reduce(
        (t, { qty }) => t + Number(qty),
        0
      );

      return cTotal;
    },
  },

};
</script>

<style lang="scss" scoped>
</style>