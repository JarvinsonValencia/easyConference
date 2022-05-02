<template>
    <div class="content-header">
    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div>
                           <b-button class="btn btn-info btn-sm" @click="openModal('modal-form-user')">
                               <i class="fa-solid fa-user-plus"></i> Nuevo</b-button>
                                                    <b-modal
                                                        class="modal"
                                                        id="modal-form-user"
                                                        ref="modal"
                                                        size="lg"
                                                        for="form"
                                                        title="Nuevo Usuario"
                                                        @ok="this.$refs.userform.onSubmit()"
                                                        cancel-disable
                                                    ><Form ref="userform" v-model="showModal"
                                                            />
                                                    </b-modal>
                                            
                                             <!-- <router-link class="btn btn-info btn-sm" :to="'/user/create'">
                                                <span><i class="fas fa-arrow-left"></i>Nuevo</span>
                                            </router-link> -->
                                   
                    </div>  
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                     <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <template v-if="listUsers.length">
                                    <table class="table table-hover table-head-fixed text-nowrap projects">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr> 
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listUsersPaginated" :key="index">
                                        
                                        <td v-text="item.name"></td>
                                        <td v-text="item.role_id"></td>
                                        <td v-text="item.username"></td>
                                        <td v-text="item.email"></td>
                                       
                                        <td>
                                            <!-- <div>
                                                <b-button class="btn btn-info btn-sm" @click="openModal('modal-edit-user')">
                                                    <i class="fa-solid fa-user-pen"></i></b-button>
                                                         <div v-if="showModal">
                                                             <EditForm v-model="showModal"
                                                                id="modal-edit-user"/> 
                                                         </div>
                                                </div> -->
                                                
                                            <b-button class="btn btn-danger btn-sm" @click="deleteUser(item.id)">
                                                    <i class="fa-solid fa-user-xmark"></i></b-button>
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
import EditForm from './EditForm.vue'
export default {
    data(){
        return {
            listUsers: [],
            pageNumber: 0,
            perPage: 5,
            showModal: false
        }
    },
    mounted(){
        this.getlistUsers();
    },
    components: {
        Form,
        // EditForm
    },
    computed: {
        //Obtener número de páginas
        pageCount() {
            let a = this.listUsers.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        //Obtener registros paginados
        listUsersPaginated(){
            let start = this.pageNumber * this.perPage,
                end = start + this.perPage;
            return this.listUsers.slice(start, end);
        },
        pageList(){
            let a = this.listUsers.length,
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
        getlistUsers(){
            axios.get('/administration/user/getListUsers')
            .then(res => {
                console.log(res.data)
                this.listUsers = res.data;
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
        deleteUser(id){
            Swal.fire({
                title: '¿Estás seguro de eliminar el usuario?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/administration/user/deleteUser/${id}`)
                            .then(res =>{
                                this.$router.go(this.$router.currentRoute)
                            }).catch(error => {
                                reject(error)
                            })
                        Swal.fire(
                        'Eliminado!',
                        'El usuario ha sido eliminado.',
                        'success'
                        )
                }
            }) 
        },
        openModal(modalId) {
            this.showModal = true;
            if (!modalId) return
            this.$bvModal.show(modalId)   
        },
       
    }
}
</script>

<style>

</style>