<template>
  <div>
    <div >
      <a class="height-cart" v-if=" getTotal > 0" :href="hrefcart">
      </a>
      <img class="svg" src="/images/shopping-cart.svg" alt="cart" />
      <span class="badge badge-pill badge-dark">{{ getTotal }}</span>
    </div>
  </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex'
export default {
    data() {
        return {
          hrefcart:'/cart',
          hrefHome:'/',
        }
    },
    created() {
      this.$store.dispatch("allCartFromDatabase");
    },
    computed: mapState({
    getCarts: state => state.carts,
      
    ...mapGetters([
      'getTotal'
    ])
  }),

};
</script>

<style lang="scss" scoped>
</style>