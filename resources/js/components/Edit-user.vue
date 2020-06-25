<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div v-show="changeOk" class="alert alert-success mt-3">Les modifications sont un succès!</div>
        <div class="card mt-3">
          <div class="card-header">Edit user {{ user.name }}</div>
          <div class="card-body">
            <form @submit.prevent="updateSubmit">
              <label :for="user.name" class="form-check-label">Name</label>
              <input class="form-control" id="name" type="text" v-model="form.name">
              <label :for="user.name" class="form-check-label">Email</label>
              <input class="form-control" id="email" type="email" v-model="form.email">
              <div class="form-group forme-check" v-for="role in roles" :key="role.index">
                  <input
                    class="form-check-input ml-1"
                    type="checkbox"
                    name="roles[]"
                    :id="role.id"
                    :value="role.id"
                    v-model="form.roles"
                    @change="check($event)"
                  />
                <label :for="role.id" class="form-check-label ml-5">{{ role.name }}</label>
              </div>
              <button type="submit" class="btn btn-primary">Change informations</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user", "roles", 'rolesUser'],
  data(){
      return{
          changeOk: false,
          checked: true,
          form: {
            name: this.user.name,
            email: this.user.email,
            roles: this.rolesUser,
          },
      }
  },
  computed: {
    getRolesUser() {
      var getRoles = []

      for (const property in this.rolesUser) {

        getRoles.push(this.rolesUser[property].id)
        this.tab.roles = getRoles
      }
      return getRoles
    },
    
  },
  methods: {
    updateSubmit() {
      axios
        .patch("/admin/users/"+this.user.id, this.form)
        .then(({ data }) => {
          this.changeOk = true
        });
    },
    check: function(e) {
		console.log(this.tab.roles)
    }
  }
};
</script>

<style lang="scss" scoped>
</style>