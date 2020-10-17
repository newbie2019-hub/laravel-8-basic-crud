<template>
  <div class="container" style="height: 100vh">
    <h3 class="text-center mt-5">Hello Master! </h3>
    <div class="row justify-content-center align-items-center">
      <div class="col-12 col-sm-12 col-md-10 mb-3 mt-3">
        <form ref="productForm">
          <div class="row">
            <div class="col">
              <input
                type="text"
                v-model="data.name"
                class="form-control"
                placeholder="Product Name"
              />
            </div>
            <div class="col">
              <input
                type="text"
                v-model="data.qty"
                class="form-control"
                placeholder="Quantity"
              />
            </div>
            <div class="col">
              <button
                @click.prevent="storeData"
                class="btn btn-block btn-primary"
                :disabled="isSaving"
              >
                {{ isSaving ? "Saving ..." : "Save" }}
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-12 col-sm-12 col-md-10">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(prod, i) in products" :key="i">
              <th scope="row">{{ prod.id }}</th>
              <td>{{ prod.name }}</td>
              <td>{{ prod.qty }}</td>
              <td>
                <button
                  @click.prevent="editData(prod)"
                  class="btn btn-sm btn-primary mr-2"
                >
                  Edit</button
                ><button
                  @click.prevent="deleteData(prod.id)"
                  class="btn btn-sm btn-primary"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row justify-content-end mr-2">
            <pagination :data="objdata"  @pagination-change-page="getData"></pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: "",
      data: {
        id: "",
        name: "",
        qty: "",
      },
      isSaving: false,
      status: "save",
      links: '',
      objdata: [],
    };
  },
  methods: {
    storeData: function () {
      switch (this.status) {
        case "save":
          axios
            .post("/crud/store", this.data)
            .then((res) => {
              this.items = res.data;
              this.getData();
              this.data.name = "";
              this.data.id = "";
              this.data.qty = "";
            })
            .catch((err) => {
              console.error(err);
            });
          break;
        case "update":
          axios
            .put("/crud/update", this.data)
            .then((res) => {
              this.items = res.data;
              this.getData();
              this.data.name = "";
              this.data.id = "";
              this.data.qty = "";
              this.status = 'save';
            })
            .catch((err) => {
              console.error(err);
            });
          break;
        default:
          console.log("error");
      }
    },
    getData: function (page) {
      axios
        .get(`/crud/index?page=` + page)
        .then((res) => {
          console.log(res.data)
          this.products = res.data.data;
          this.objdata =  res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
    deleteData: function (id) {
      axios
        .delete(`/crud/delete?id=${id}`)
        .then((res) => {
          this.products = res.data;
          this.getData();
        })
        .catch((err) => {
          console.error(err);
        });
    },
    editData: function (prod) {
      this.status = "update";
      this.data.name = prod.name;
      this.data.qty = prod.qty;
      this.data.id = prod.id;
    },
  },
  mounted() {
    this.getData();
  },
};
</script>

<style>
li {
  list-style: none;
}
</style>
