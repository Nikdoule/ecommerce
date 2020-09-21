<template>
  <div>
    <div class="pb-5 pt-5">
      <div class="container" v-show="invisibleBody">
        <div class="row">
          <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
            <!-- Shopping cart table -->
            <div class="table-responsive">
              <p
                class="ml-auto mr-auto col-md-6 text-center danger"
                v-if="form.qty > 5"
              >La quantité ne peut dépasser 5</p>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">Product</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Price</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Quantity</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Remove</div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cart in carts" :key="cart.id">
                    <th scope="row" class="border-0">
                      <div class="p-2">
                        <img
                          :src="cart.model.image"
                          alt
                          width="70"
                          class="img-fluid rounded shadow-sm"
                        />
                        <div class="ml-3 d-inline-block align-middle">
                          <h5 class="mb-0">
                            <a
                              href="#"
                              class="text-dark d-inline-block align-middle"
                            >{{ cart.model.title }}</a>
                          </h5>
                          <span class="text-muted font-weight-normal font-italic d-block">Category:</span>
                        </div>
                      </div>
                    </th>
                    <td class="border-0 align-middle">
                      <strong>{{ cart.subtotal = cart.model.price / 100 * cart.qty }}€</strong>
                    </td>
                    <td class="border-0 align-middle">
                      <select
                        v-model="cart.qty"
                        @change.prevent="onChange($event, rowId = cart.rowId)"
                        name="qty"
                        id="qty"
                        class="custom-select"
                      >
                        <option
                          v-for="count in counts"
                          :key="count.id"
                          :value="count"
                          :selected="count == cart.qty"
                        >{{ count }}</option>
                      </select>
                    </td>
                    <td class="border-0 align-middle">
                      <form @submit.prevent="onDelete(cart.rowId)">
                        <button type="submit">
                          <img class="svg" :src="'../images/delete.svg'" alt />
                        </button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- End -->
          </div>
        </div>
        <div class="row py-5 p-4 bg-white rounded shadow-sm">
          <div class="col-lg-6">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
            <div class="p-4">
              <p
                class="font-italic mb-4"
              >If you have a coupon code, please enter it in the box below</p>
              <form @submit.prevent="onCode">
                <div class="input-group mb-4 border rounded-pill p-2">
                  <input
                    type="text"
                    v-model="tab.code"
                    placeholder="Apply coupon"
                    aria-describedby="button-addon3"
                    class="form-control border-0"
                  />
                  <div class="input-group-append border-0">
                    <button id="button-addon3" type="submit" class="btn btn-dark px-4 rounded-pill">
                      <i class="fa fa-gift mr-2"></i>
                      Valider
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <div
              class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
            >Instructions for seller</div>
            <div class="p-4">
              <p
                class="font-italic mb-4"
              >If you have some information for the seller you can leave them in the box below</p>
              <textarea name cols="30" rows="2" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-lg-6">
            <div
              class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
            >order detail</div>
            <div class="p-4">
              <p
                class="font-italic mb-4"
              >Shipping and additional costs are calculated based on values you have entered.</p>
              <ul class="list-unstyled mb-4">
                <li v-if="verifCode" class="d-flex justify-content-between py-3 border-bottom">
                  <strong class="text-muted">Réduction</strong>
                  <strong>{{ code.discount }}%</strong>
                </li>
                <li v-if="verifCode" class="d-flex justify-content-between py-3 border-bottom">
                  <strong class="text-muted">Subtotal</strong>
                  <strong>{{ (subTotal * code.discount / 100).toFixed(2) }}€</strong>
                </li>
                <li v-else class="d-flex justify-content-between py-3 border-bottom">
                  <strong class="text-muted">Subtotal</strong>
                  <strong>{{ (subTotal).toFixed(2) }}€</strong>
                </li>
                <li v-if="verifCode" class="d-flex justify-content-between py-3 border-bottom">
                  <strong class="text-muted">Tax</strong>
                  <strong>{{ ((0.2 * subTotal) * code.discount / 100).toFixed(2) }}€</strong>
                </li>
                <li v-else class="d-flex justify-content-between py-3 border-bottom">
                  <strong class="text-muted">Tax</strong>
                  <strong>{{ (0.2 * subTotal).toFixed(2) }}€</strong>
                </li>
                <li class="d-flex justify-content-between py-3 border-bottom">
                  <strong class="text-muted">Total</strong>

                  <h5 v-if="verifCode" class="font-weight-bold">{{ total }}€</h5>

                  <h5 v-else class="font-weight-bold">{{ total }}€</h5>
                </li>
              </ul>
              <a href="/payment" class="btn btn-dark rounded-pill py-2 btn-block">Pay</a>
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
      reduction: "",
      invisibleBody: true,
      selected: false,
      counts: 5,
      form: {
        qty: "",
        code: "",
      },
      tab: {
        name: '',
        code: ''
      }
    };
  },
  created() {
    this.$store.dispatch("allCartFromDatabase");
  },
  computed: {
    ...mapState(["carts", "code", "toto"]),
    subTotal: function () {
      let sum = Object.values(this.carts).reduce(
        (t, { subtotal }) => t + subtotal,
        0
      );
      return parseFloat(sum);
    },
    total: function () {
      let sum = this.subTotal + 0.2 * this.subTotal;

      if (this.verifCode) {
        let discount = (sum * this.code.discount) / 100;

        sum = sum - discount;
       
        return sum.toFixed(2);
      } else {
        return sum.toFixed(2);
      }
    },
    verifCode: function () {
      let goodCode = false;
      if (this.code.name == this.reduction) {
        goodCode = true;

        return goodCode;
      } else {
        return goodCode;
      }
    },
  },
  methods: {
    onCode() {
      axios.post("/getCode", this.tab).then(({ data }) => {
        if (this.code.name == this.tab.code) {
          this.reduction = this.tab.code;
          console.log("ok");
        } else {
            console.log("not ok");
          }
      });
    },
    onChange(event, rowId) {
      this.form.qty = event.target.value;
      axios.patch("/cart/" + this.rowId, this.form).then(({ data }) => {});
    },
    onDelete(index) {
      axios.delete("/cart/" + index, index).then(({ data }) => {
        Vue.delete(this.carts, index);
        if (Object.keys(this.carts).length == 0) {
          location.href = "/";
          this.invisibleBody = false;
        }
      });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>