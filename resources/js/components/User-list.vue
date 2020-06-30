<template>
  <div class="container">
    <div>
      <div>
        <div class="card mt-5">
          <div class="card-header">Users list</div>
          <div class="card-body">
            <table class="table-user col-md-10">
              <tbody v-for="(user,index) in getAllUsers" :key="user.id" class="d-flex justify-content-between">
                <tr class="d-flex flex-column mb-5">
                  <td class="text-uppercase">
                    <img
                      v-show="showImg ? user.image !== null : hiddenImg"
                      :src="'../storage/'+user.image"
                      alt
                      class="user-img"
                    />
                    {{ user.name }}
                  </td>
                  <td>
                    <em class="text-muted">{{ user.email }}</em>
                  </td>
                  <div class="d-flex">
                    <td
                      class="text-success d-inline"
                      v-for="roles in user.roles"
                      :key="roles.id"
                    ><button class="btn btn-success">{{ roles.name }}</button></td>
                  </div>
                </tr>
                <td class="d-flex mt-4">
                  <a class="mr-1" :href="'/admin/users/'+user.id+'/edit'">
                    <img class="svg" :src="'../images/edit.svg'" alt="bouton editer" />
                  </a>
                  <form @submit.prevent="onDelete(user.id, index)" class="d-inline">
                    <button v-show="showButton" type="submit" class="button-delete">
                      {{activeCan}}
                      <img class="svg" :src="'../images/delete.svg'" alt="bouton supprimer" />
                    </button>
                  </form>
                </td>
              </tbody>
            </table>
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
      showButton: false,
      showImg: true,
      hiddenImg: false,
    };
  },
  created() {
    this.$store.dispatch("allUsersFromDatabase")
  },
  methods: {
    onDelete(userId, index) {
      axios
        .delete("getUsers/" + userId, userId)
        .then(({ data }) => {
          Vue.delete(this.getAllUsers, index);
        });
    }
  },
  computed:{
    getAllUsers: function() {
        return this.$store.getters.getUsersFromGetters;
      },
    getRoleAuth: function() {
        return this.$store.getters.getAuthFromGetters;

      },
    activeCan() {
      for (const property in this.getRoleAuth) {
        if (this.getRoleAuth[property] == "super-admin") {
          this.showButton = true
        }
      }
    }
  }
};
</script>
