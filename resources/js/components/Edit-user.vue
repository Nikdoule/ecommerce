<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div v-show="changeOk" class="alert alert-success mt-3">Les modifications sont un succès!</div>
        <div class="card mt-3">
          <div class="card-header">Edit user {{ getUser.name }}</div>
          <div class="card-body">
            <form @submit.prevent="updateSubmit" :role="deleteRole">
              <label :for="getUser.name" class="form-check-label">Name</label>
              <input class="form-control" id="name" type="text" v-model="form.name" />
              <label :for="getUser.name" class="form-check-label">Email</label>
              <input class="form-control" id="email" type="email" v-model="form.email" />
              <div class="form-group forme-check" v-for="role in getRoles"  :key="role.index">
                <input
                  class="form-check-input ml-1"
                  type="checkbox"
                  :name="role.name"
                  :id="role.id"
                  :value="role.id"
                  v-model="form.roles"
                  :checked=" checked ? role.id == getRolesUser : ''"
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
  data() {
    return {
      changeOk: false,
      checked: true,
      form: {
        name: "",
        email: "",
        roles: []
      }
    };
  },
  created() {
    this.$store.dispatch("editFromDatabase");
  },
  computed: {
    getUser() {
      this.form.name = this.$store.state.user.name;
      this.form.email = this.$store.state.user.email;
      return this.$store.getters.getUserFromGetters;
    },
    getRoles() {
      return this.$store.getters.getRolesFromGetters;
    },
    getRolesUser() {
      this.form.roles = this.$store.state.rolesUser;
      return this.$store.getters.getRolesUserFromGetters;
    },
    deleteRole() {
      for (const property in this.getRoleAuth) {
        if (this.getRoleAuth[0] !== 'super-admin') {
          this.getRoles.splice(0, 1)
          return this.getRolesUser
        }
      }
    },
    getRoleAuth: function() {
        return this.$store.getters.getAuthFromGetters;
    },
  },
  methods: {
    updateSubmit() {
      axios
        .patch("/admin/getUsers/" + this.getUser.id, this.form)
        .then(({ data }) => {
          this.changeOk = true;
        });
    }
    // check: function(e) {
    // console.log(this.form.roles)
    // }
  }
};
</script>

<style lang="scss" scoped>
</style>