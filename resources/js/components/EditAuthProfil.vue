<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card mt-5">
            <div class="card-header">Edit {{ getProfil.name }}</div>
            <div class="card-body">
              <form @submit.prevent="onSubmit">
                <div class="form-group row">
                  <label for="email" class="col-md-6 col-form-label">Adresse email</label>
                  <div class="col-md-12">
                    <input
                      :id="getProfil.email"
                      type="email"
                      class="form-control"
                      :name="getProfil.email"
                      v-model="form.email"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-md-6 col-form-label">First name</label>
                  <div class="col-md-12">
                    <input
                      :id="getProfil.name"
                      type="text"
                      class="form-control"
                      :name="getProfil.name"
                      v-model="form.name"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="last_name" class="col-md-6 col-form-label">Last name</label>
                  <div class="col-md-12">
                    <input
                      :id="getProfil.last_name"
                      type="text"
                      class="form-control"
                      :name="getProfil.last_name"
                      v-model="form.last_name"
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="civility" class="col-md-4 col-form-label text-md-right">Civility</label>
                  <div class="col-md-6 d-flex">
                    <input
                      id="civility"
                      type="radio"
                      class="@error('civility') is-invalid @enderror"
                      name="civility"
                      v-model="picked"
                      :value="'m'"
                      :checked=" checked ? getProfil.civility == 'm' : ''"
                    />
                    <label class="ml-2 form-check-label" for="exampleRadios1">Masculin</label>
                    <input
                      id="civility"
                      type="radio"
                      class="ml-4 @error('civility') is-invalid @enderror"
                      name="civility"
                      v-model="form.civility"
                      :value="'f'"
                      :checked=" checked ? getProfil.civility == 'f' : ''"
                    />
                    <label class="ml-2 form-check-label" for="exampleRadios1">Feminin</label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="adress" class="col-md-4 col-form-label text-md-right">Adress</label>
                  <div class="col-md-6">
                    <input
                      :id="getProfil.adress"
                      type="text"
                      class="form-control"
                      :name="getProfil.adress"
                      v-model="form.adress"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="zip_code" class="col-md-4 col-form-label text-md-right">Zip code</label>
                  <div class="col-md-6">
                    <input
                      :id="getProfil.zip_code"
                      type="text"
                      class="form-control"
                      :name="getProfil.zip_code"
                      v-model="form.zip_code"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                  <div class="col-md-6">
                    <input
                      :id="getProfil.city"
                      type="text"
                      class="form-control"
                      :name="getProfil.city"
                      v-model="form.city"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone" class="col-md-6 col-form-label">Phone</label>
                  <div class="col-md-12">
                    <input
                      :id="getProfil.phone"
                      type="text"
                      class="form-control"
                      :name="getProfil.phone"
                      v-model="form.phone"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-md-3" v-if="form.image">
                  <img :src="form.image" class="img-responsive" height="50%" width="50%">
                </div>

                <div class="form-group row">
                  <label :for="form.image" class="col-md-4 col-form-label text-md-right">Image</label>
                  <div class="col-md-6">
                    <input
                      accept="image/*"
                      @change="uploadImage"
                      type="file"
                      class="form-control"
                      name="image"
                      id="image"
                    />
                    <label class="custom-file-label" for="image">Choose file</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Update informations</button>
              </form>
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
      checked: true,
      picked: "",
      
      form: {
        id: "",
        adress: "",
        city: "",
        civility: "",
        email: "",
        last_name: "",
        name: "",
        phone: "",
        zip_code: "",
        image: ""
      }
    };
  },
  created() {
    this.$store.dispatch("allProfilFromDatabase");
  },
  computed: {
    getProfil: function() {
      this.form = this.$store.state.profilUser;
      return this.$store.getters.getProfilUserFromGetters;
    },
    getCarts() {
      return this.$store.getters.getCartFromGetters;
    },
  },
  methods: {
    uploadImage(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = e => {
        vm.form.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    onSubmit() {
      axios.patch("/edit/users/" + this.form.id, this.form).then(
        function(result) {
          console.log(result);
        },
        function(error) {
          console.log(error);
        }
      );
    }
  },
  
};
</script>

<style lang="scss" scoped>
</style>