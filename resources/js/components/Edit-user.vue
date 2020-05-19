<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Edit user {{ user.name }}</div>
          <div class="card-body">
            <form @submit.prevent="onSubmit">
              <div class="form-group forme-check" v-for="role in roles" :key="role.id">
                  <input
                    class="form-check-input ml-3"
                    type="checkbox"
                    :name="roles"
                    v-model="rolesTable"
                    :value="role.id"
                    :id="role.id"
                    
                  />
                <label :for="role.id" class="form-check-label ml-5">{{ role.name }}</label>
              </div>
              <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user", "roles", "role"],
  data(){
      return{
          checked: true,
          roleUserId: this.role,
          roles:[],
          rolesTable:[]
      }
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      axios
        .patch(
          "http://ecommerce.test/admin/users/" + this.user.id,this.rolesTable
        )
        .then(({ data }) => {
          alert(this.rolesTable);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>