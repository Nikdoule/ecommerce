<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
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
                <div class="col-md-3" v-if="form.image">
                  <img :src="form.image" class="img-responsive" height="50%" width="50%">
                </div>

                <div class="form-group row">
                  <label :for="form.image" class="col-md-4 col-form-label text-md-right">unique Image</label>
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
                <!-- <div class="form-group row">
                  <label :for="form.multipleImages" class="col-md-4 col-form-label text-md-right">Multiple Images</label>
                  <div class="col-md-6">
                    <input
                      accept="image/*"
                      @change="uploadMultipleImages"
                      type="file"
                      class="form-control"
                      name="multipleImages"
                      id="multipleImages"
                      multiple
                    />
                    <label class="custom-file-label" for="image">Choose file</label>
                  </div>
                </div> -->
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
      checked: true,
      form: {
        categories: [],
        image:'',
        multipleImages: ''

      }
    };
  },
  created() {
    this.$store.dispatch("editProductFromDatabase");
  },
  computed: {
    getChecked() {
      this.form.categories = this.$store.state.categoriesProduct;
      return this.$store.getters.getCategoriesProductFromGetters;
    },
    ...mapState(["product", "categories", "categoriesProduct"])
  },
  methods: {
    uploadImage(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      reader.readAsDataURL(file);
      
      reader.onload = e => {
        this.form.image = e.target.result;
      };
    },
    onPatch() {
      this.product.image = this.form.image;
      this.product.categories = this.form.categories;
      axios
        .patch("/api/getProduct/" + this.product.id, this.product)
        .then(console.log("ok"));
    }
  }
};
</script>

<style lang="scss" scoped>
</style>