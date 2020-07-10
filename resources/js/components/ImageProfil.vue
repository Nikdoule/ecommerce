<template>
  <div>
    <div class="col-md-3" v-if="profilUser.image">
      <img :src="profilUser.image" alt="client-avatar" class="user-img" />
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: mapState(['profilUser'])
};
</script>

<style lang="scss" scoped>
</style>