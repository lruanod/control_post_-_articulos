<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Update Articulo Data</h5>
                <div>
                    <router-link :to="{name: 'articulos'}" class="btn btn-success">Go Back</router-link>
                </div>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strSuccess}}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strError}}</strong>
            </div>


            <form @submit.prevent="update" >

                <div class="form-group mb-2">
                    <label>Description</label><span class="text-danger"> *</span>
                    <textarea class="form-control" rows="3" v-model="descripcion" placeholder="Enter post description"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label>precio</label><span class="text-danger"> *</span>
                    <input type="number" class="form-control" v-model="precio" placeholder="Enter articulos precio">
                </div>
                <div class="form-group mb-2">
                    <label>Stock</label><span class="text-danger"> *</span>
                    <input type="number" class="form-control" v-model="stock" placeholder="Enter articulos stock">
                </div>


                <button type="submit" class="btn btn-primary mt-4 mb-4"> Update Articulo</button>

            </form>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id:'',
            descripcion: '',
            precio: '',
            stock: '',
            strSuccess: '',
            strError: '',
        }
    },

    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/articulos/edit/${this.$route.params.id}`)
                .then(response => {
                    this.descripcion = response.data['descripcion'];
                    this.precio = response.data['precio'];
                    this.stock = response.data['stock'];

                })
                .catch(function(error) {
                    console.log(error);
                });
        })
    },
    methods: {
        update(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('descripcion', this.descripcion);
                formData.append('precio', this.precio);
                formData.append('stock', this.stock);

                this.$axios.post(`/api/articulos/update/${this.$route.params.id}`, formData)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                    })
                    .catch(function(error) {
                        existingObj.strSuccess ="";
                        existingObj.strError = error.response.data.message;
                    });
            });
        }

    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>


