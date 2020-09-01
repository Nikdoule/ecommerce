<template>
  <div class="container">
    <div>
      <div>
        <div class="card mt-5">
          <div class="card-header">Users list</div>
          <div class="card-body">
            <table class="table-user col-md-10">
              <tbody
                v-for="(user,index) in users"
                :key="user.id"
                class="d-flex justify-content-between"
              >
                <tr class="d-flex flex-column mb-5">
                  <td class="text-uppercase">
                    <img
                      v-show="showImg ? user.image !== null : hiddenImg"
                      :src="user.image"
                      alt
                      class="user-img"
                    />
                    {{ user.name }}
                  </td>
                  <td>
                    <em class="text-muted">{{ user.email }}</em>
                  </td>
                  <div class="d-flex">
                    <td class="text-success d-inline" v-for="roles in user.roles" :key="roles.id">
                      <button class="btn btn-success">{{ roles.name }}</button>
                    </td>
                  </div>
                </tr>
                <td class="d-flex mt-4">
                  <a class="mr-1" :href="'/admin/users/'+user.id+'/edit'">
                    <img class="svg" :src="'../images/edit.svg'" alt="bouton editer" />
                  </a>
                  <form @submit.prevent="onDelete(user.id, index)" class="d-inline">
                    <button v-show="activeCan" type="submit" class="button-delete">
                      <img
                        class="svg"
                        :src="'../images/delete.svg'"
                        alt="bouton supprimer"
                      />
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
import { mapState } from "vuex";
export default {
  data() {
    return {
      showImg: true,
      hiddenImg: false
    };
  },
  created() {
    this.$store.dispatch("allUsersFromDatabase");
  },
  computed: {
    ...mapState(["users", "rolesAuth"]),
    activeCan() {
      let showButton = false
      for (const property in this.rolesAuth) {
        if (this.rolesAuth[property] == "super-admin") {
          this.showButton = true;
        }
      }
      return this.showButton
    }
    
  },
  methods: {
    onDelete(userId, index) {
      axios.delete("getUsers/" + userId, userId).then(({ data }) => {
        console.log(this.users)
        Vue.delete(this.users, index);
      });
    }
  }
};
</script>
