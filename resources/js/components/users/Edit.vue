<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div v-show="changeOk" class="alert alert-success mt-3">Les modifications sont un succès!</div>
          <div class="card mt-5">
            <div class="card-header">
              <p>Edit {{ profilUser.name }} {{ profilUser.last_name }}</p>
            </div>
            <div class="card-body">
              <form @submit.prevent="onSubmit">
                <div class="form-group row">
                  <label for="email" class="col-md-6 col-form-label">Adresse email</label>
                  <div class="col-md-12">
                    <input
                      :id="profilUser.email"
                      type="email"
                      class="form-control"
                      :name="profilUser.email"
                      v-model="profilUser.email"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-md-6 col-form-label">First name</label>
                  <div class="col-md-12">
                    <input
                      :id="profilUser.name"
                      type="text"
                      class="form-control"
                      :name="profilUser.name"
                      v-model="profilUser.name"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="last_name" class="col-md-6 col-form-label">Last name</label>
                  <div class="col-md-12">
                    <input
                      :id="profilUser.last_name"
                      type="text"
                      class="form-control"
                      :name="profilUser.last_name"
                      v-model="profilUser.last_name"
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
                      :checked=" checked ? profilUser.civility == 'm' : ''"
                    />
                    <label class="ml-2 form-check-label" for="exampleRadios1">Masculin</label>
                    <input
                      id="civility"
                      type="radio"
                      class="ml-4 @error('civility') is-invalid @enderror"
                      name="civility"
                      v-model="profilUser.civility"
                      :value="'f'"
                      :checked=" checked ? profilUser.civility == 'f' : ''"
                    />
                    <label class="ml-2 form-check-label" for="exampleRadios1">Feminin</label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="adress" class="col-md-4 col-form-label text-md-right">Adress</label>
                  <div class="col-md-6">
                    <input
                      :id="profilUser.adress"
                      type="text"
                      class="form-control"
                      :name="profilUser.adress"
                      v-model="profilUser.adress"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="zip_code" class="col-md-4 col-form-label text-md-right">Zip code</label>
                  <div class="col-md-6">
                    <input
                      :id="profilUser.zip_code"
                      type="text"
                      class="form-control"
                      :name="profilUser.zip_code"
                      v-model="profilUser.zip_code"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                  <div class="col-md-6">
                    <input
                      :id="profilUser.city"
                      type="text"
                      class="form-control"
                      :name="profilUser.city"
                      v-model="profilUser.city"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone" class="col-md-6 col-form-label">Phone</label>
                  <div class="col-md-12">
                    <input
                      :id="profilUser.phone"
                      type="text"
                      class="form-control"
                      :name="profilUser.phone"
                      v-model="profilUser.phone"
                      required
                      autofocus
                    />
                  </div>
                </div>
                <div class="col-md-3" v-if="profilUser.image">
                  <img :src="profilUser.image" class="img-responsive" height="50%" width="50%">
                </div>

                <div class="form-group row">
                  <label :for="profilUser.image" class="col-md-4 col-form-label text-md-right">Image</label>
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
import { mapState } from "vuex";
export default {
  data() {
    return {
      changeOk: false,
      checked: true,
      picked: "",
      image:"",
    };
  },
  created() {
    this.$store.dispatch("profilFromDatabase");
  },
  computed: {
    ...mapState(["profilUser"]),
    
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
        this.profilUser.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    onSubmit() {
      
      axios.patch("/edit/users/" + this.profilUser.id, this.profilUser).then(
        this.changeOk = true
      );
    }
  },
  
};
</script>

<style lang="scss" scoped>
</style>