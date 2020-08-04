<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div v-show="changeOk" class="alert alert-success mt-3">Les modifications sont un succès!</div>
          <div class="card mt-3">
            <div class="card-header">{{ product.title }}</div>
            <div class="card-body">
              <form @submit.prevent="onPatch">
                <label :for="product.title" class="form-check-label">Title</label>
                <input class="form-control" id="name" type="text" v-model="product.title" />
                <label :for="product.description" class="form-check-label">Description</label>
                <input class="form-control" id="title" type="text" v-model="product.description" />
                <label :for="product.price" class="form-check-label">Price</label>
                <input class="form-control" id="title" type="text" v-model="product.price" />
                <label :for="product.slug" class="form-check-label">Slug</label>
                <input class="form-control" id="title" type="text" v-model="product.slug" />
                <label :for="product.subtitle" class="form-check-label">Subtitle</label>
                <input class="form-control" id="subtitle" type="text" v-model="product.subtitle" />
                <div
                  class="form-group forme-check"
                  v-for="category in categories"
                  :key="category.id"
                >
                  <input
                    class="form-check-input ml-1"
                    type="checkbox"
                    :name="category.name"
                    :id="category.id"
                    :value="category.id"
                    v-model="form.categories"
                    :checked=" checked ? category.id == getChecked : ''"
                  />
                  <label :for="category.id" class="form-check-label ml-5">{{ category.name }}</label>
                </div>
                <div class="col-md-3" v-if="product.image">
                  <img :src="product.image" class="img-responsive" height="50%" width="50%">
                </div>
                <div class="form-group row">
                  <label :for="product.image" class="col-md-4 col-form-label text-md-right">Image</label>
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
                <div class="col-md-3" v-if="Array.isArray(product.images)">
                  <img v-for="image in product.images" :key="image.id" :src="image" class="img-responsive" height="50%" width="50%" />
                </div>
                <div class="col-md-3" v-else>
                  <img v-for="image in formatSerialize" :key="image.id" :src="image" class="img-responsive" height="50%" width="50%" />
                </div>
                <div class="form-group row">
                  <label :for="product.images" class="col-md-4 col-form-label text-md-right">Multiple Images</label>
                  <div class="col-md-6">
                    <input
                    @change="uploadImage"
                      accept="image/*"
                      type="file"
                      class="form-control"
                      name="multipleImages"
                      id="multipleImages"
                      multiple
                    />
                    <label class="custom-file-label" for="multipleImages">Choose file</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Change informations</button>
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
      unSerialize: [],
      checked: true,
      form: {
        categories: [],

      }
    };
  },
  created() {
    this.$store.dispatch("editProductFromDatabase");
  },
  computed: {
    ...mapState(["product", "categories", "categoriesProduct"]),

    formatSerialize() {
      for (const property in this.product) {
        this.unSerialize = this.product.images.split('"');
      }
      for (var i = 0; i < this.unSerialize.length; i++) {
        this.unSerialize.splice(i, 1);
      }
      
      return this.unSerialize;
    },
    getChecked() {
      this.form.categories = this.$store.state.categoriesProduct;
      return this.$store.getters.getCategoriesProductFromGetters;
    },
    
  },
  methods: {
    uploadImage(e) {

      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      if (files.length > 1) {

        this.createImage(files);

      } else {

        this.createImage(files[0]);
      }

    },
    createImage(file) {

      let multipleImage = [];

      if (file.length > 1) {
        
        for (var i = 0; i < file.length; i++) {

          let reader = new FileReader();
          reader.readAsDataURL(file[i]);
          reader.onload = e => {
            
            multipleImage.push(e.target.result);
          };
          
          this.product.images = multipleImage;
        }
      } else {

        let reader = new FileReader();
        reader.readAsDataURL(file);
        
        reader.onload = e => {
          this.product.image = e.target.result;
        };
      }
    },
    onPatch() {
      this.product.categories = this.form.categories;
      axios
        .patch("/getProduct/" + this.product.id, this.product)
        .then(
          this.changeOk = true
        );
    }
  }
};
</script>

<style lang="scss" scoped>
</style>