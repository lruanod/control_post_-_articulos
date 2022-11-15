
<template>
    <div class="card" >
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">All Ariculos Data</h5>
                <div>
                    <button class="btn btn-success" type="button" @click="this.$router.push('/articulos/add')">New Articulo</button>
                </div>
            </div>

            <table class="table table-hover table-sm" id="element-to-convert">
                <thead class="bg-dark text-light">
                <tr>
                    <th width="50" class="text-center">#</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th class="text-center" width="120">Stock</th>
                    <th class="text-center" width="200">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(articulo, index) in articulos" :key="articulo.id">
                    <td class="text-center">{{index+1}}.</td>
                    <td>{{articulo.descripcion}}</td>
                    <td>{{articulo.precio}}</td>
                    <td>{{articulo.stock}}</td>

                    <td class="text-center">
                        <router-link :to="{name:'editarticulo', params: {id:articulo.id}}" class="btn btn-warning">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteArticulo(articulo.id)">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            articulos: [],
            strSuccess: '',
            strError: ''
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/articulos')
                .then(response => {
                    this.articulos = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    },
    methods: {
        deleteArticulo(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;

                if(confirm("Do you really want to delete this data?")) {
                    this.$axios.delete(`/api/articulos/delete/${id}`)
                        .then(response => {

                            let i = this.articulos.map(item => item.id).indexOf(id); // find index of your object
                            this.articulos.splice(i, 1);
                            existingObj.strError = "";
                            existingObj.strSuccess = response.data.success;

                        })
                        .catch(function(error) {
                            existingObj.strError = "";
                            existingObj.strSuccess = error.response.data.message;
                        });
                }
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


