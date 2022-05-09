<template>
    <div class="content-header">
    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <!-- <router-link class="btn btn-info btn-sm" :to="'/user/create'">
                        <span><i class="fa-solid fa-circle-plus"></i> Nuevo</span>
                    </router-link> -->
                    <div>
                           <b-button class="btn btn-info btn-sm" @click="openModal('modal-form-client')">
                               <i class="fa-solid fa-circle-plus"></i> Nuevo</b-button>
                                       <b-modal
                                            class="modal"
                                            id="modal-form-client"
                                            ref="modal"
                                            size="lg"
                                            title="Nuevo Cliente"
                                    ><Form @closeModal="closeModal('modal-form-client')"/></b-modal>
                    </div>  
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                     <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Clientes</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <template v-if="listClients.length">
                                    <table class="table table-hover table-head-fixed text-nowrap projects">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Documento</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Acciones</th>
                                    </tr> 
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listClientsPaginated" :key="index">
                                        
                                        <td v-text="item.name"></td>
                                        <td v-text="item.document"></td>
                                        <td v-text="item.email"></td>
                                        <td v-text="item.phone"></td>
                                        <td v-text="item.address"></td>
                                       
                                        <td>
                                            <router-link class="btn btn-info btn-sm" :to="{ name: 'client.edit', params: {id: item.id}}">
                                               <i class="fa-solid fa-pen-to-square"></i>
                                            </router-link >
                                            <b-button class="btn btn-danger btn-sm" @click="deleteMeet(item.id)">
                                                    <i class="fa-solid fa-building-circle-xmark"></i></b-button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item" v-if="pageNumber > 0">
                                        <a href="" class="page-link" @click.prevent="prevPage">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="(page, index) in pageList" :key="index"
                                        :class="[page == pageNumber ? 'active' : '']">
                                        <a href="" class="page-link" @click.prevent="selectPage(page)"> {{page+1}}</a>
                                    </li>
                                    <li class="page-item" v-if="pageNumber < pageCount - 1">
                                        <a href="" class="page-link" @click.prevent="nextPage">Post</a>
                                    </li>
                                </ul>

                            </div>
                         </template>
                        <template v-else>
                            <div class="callout callout-info">
                                <h5>No se encontraron resultados...</h5>
                            </div>
                        </template>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Form from './Form.vue'
export default {
    
    data(){
        return {
            listClients: [],
            pageNumber: 0,
            perPage: 5,
            showModal: false
        }
    },

    mounted(){
        this.getListClients();
    },

    components: {
        Form
    },
    
    computed: {
        //Obtener número de páginas
        pageCount() {
            let a = this.listClients.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        //Obtener registros paginados
        listClientsPaginated(){
            let start = this.pageNumber * this.perPage,
                end = start + this.perPage;
            return this.listClients.slice(start, end);
        },

        pageList(){
            let a = this.listClients.length,
                b = this.perPage;
            let pageCount = Math.ceil(a / b);
            let count = 0,
                pagesArray = [];

            while(count <pageCount) {
                pagesArray.push(count);
                count++;
            }
            return pagesArray;
        }
    },

    methods: {

        getListClients(){
            axios.get('/administration/client/getListClients')
            .then(res => {
                this.listClients = res.data;
            })
        },

        deleteMeet(id){
            Swal.fire({
                title: '¿Estás seguro de eliminar el cliente?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/administration/client/deleteClient/${id}`)
                            .then(()=>{
                                this.getListClients();
                            }).catch(error => {
                                console.log(error)
                            })
                        Swal.fire(
                        'Eliminado!',
                        'El cliente ha sido eliminado.',
                        'success'
                        )
                }
            }) 
        },

        nextPage() {
            this.pageNumber++;
        },

        prevPage(){
            this.pageNumber--;
        },

        selectPage(page) {
            this.pageNumber = page;
        },

        inicializarPaginacion(){
            this.pageNumber = 0;
        },

        openModal(modalId) {
            if (!modalId) return
            this.$bvModal.show(modalId)
        },

        closeModal(modalId) {
            this.$bvModal.hide(modalId)
             this.getListClients();
        }
       
    }
}
</script>

<style>

</style>