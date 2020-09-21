<template>
  <div>
    <div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div
              v-show="createOk"
              class="alert alert-success mt-3"
            >La création du code est un succès!</div>
            <div class="card mt-3">
              <div class="card-header">Création d'un code</div>
              <div class="card-body">
                <form @submit.prevent="onSubmit">
                  <label :for="form.name" class="form-check-label">Code</label>
                  <input :for="form.discount" class="form-control" id="name" type="text" v-model="form.name"/>

                  <label class="form-check-label">Discount</label>
                  <input class="form-control" id="number" type="text" v-model="form.discount"/>

                  <button type="submit" class="btn btn-primary mt-3">Create code</button>
                </form>
              </div>
            </div>
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
      createOk: false,
      form: {
          name: '',
          discount: ''  
      }
    };
  },
  methods: {
    onSubmit() {
      axios.post("/getCode", this.form).then(({ data }) => {
        this.changeOk = true;
      });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>