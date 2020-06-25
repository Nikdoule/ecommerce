<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Liste des utilisateurs</div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users"
            :key="user.id">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.email}}</td>
                
               
                <td><a :href="'users/'+user.id+'/edit'"><button class="btn btn-primary">Editer</button></a></td>
                <td>
                    <button @click="onDelete" type="submit" class="btn btn-success">Supprimer</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["users"],
  methods: {
        onDelete(){
          alert('http://ecommerce.test/admin/users/'+this.user.id)
        }
  },
  mounted() {
     console.log(this.users.id);
  }
  
};
</script>
