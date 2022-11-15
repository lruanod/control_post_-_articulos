<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Add New Ariculo Data</h5>
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


            <form @submit.prevent="addArticulo" >
                <div class="form-group mb-2">
                    <label>Descripcion</label><span class="text-danger"> *</span>
                    <textarea class="form-control" rows="3" v-model="descripcion" placeholder="Enter Artiuclo description"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label>Precio</label><span class="text-danger"> *</span>
                    <input type="number" class="form-control" v-model="precio" placeholder="Enter precio name">
                </div>
                <div class="form-group mb-2">
                    <label>Stock</label><span class="text-danger"> *</span>
                    <input type="number" class="form-control" v-model="stock" placeholder="Enter stock name">
                </div>


                <button type="submit" class="btn btn-primary mt-4 mb-4"> Add Articulo</button>

            </form>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            descripcion: '',
            precio: '',
            stock: '',
            strSuccess: '',
            strError: ''
        }
    },
    methods: {
        addArticulo(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const formData = new FormData();
                formData.append('descripcion', this.descripcion);
                formData.append('precio', this.precio);
                formData.append('stock', this.stock);

                this.$axios.post('/api/articulos/add', formData)
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

