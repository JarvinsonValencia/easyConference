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
                           <b-button class="btn btn-info btn-sm" @click="openModal('modal-form-meet')">
                               <i class="fa-solid fa-circle-plus"></i> Nuevo</b-button>
                                    <b-modal
                                        class="modal"
                                        id="modal-form-meet"
                                        ref="modal"
                                        size="lg"
                                        title="Nueva Reunión"

                                    > <Form :user="user" @closeModal="closeModal('modal-form-meet')"></Form>
                                    </b-modal>
                    </div> 
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                     <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Reuniones</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <template v-if="listMeetings.length">
                                    <table class="table table-hover table-head-fixed text-nowrap projects">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Reunión</th>
                                        <th>Propósito</th>
                                        <th>Fecha</th>
                                    </tr> 
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listMeetingsPaginated" :key="index">
                                        
                                        <td v-text="item.id"></td>
                                        <td v-text="item.title"></td>
                                        <td v-text="item.purpose"></td>
                                        <td v-text="item.date"></td>
                                       
                                        <td>
                                            <router-link class="btn btn-info btn-sm" :to="{ name: 'meet.edit', params: {id: item.id}}">
                                               <i class="fa-solid fa-pen-to-square"></i>
                                            </router-link >
                                            <router-link class="btn btn-info btn-sm" :name="item.title" :to="{ name: 'meeting', params: {user: user }}">
                                               <i class="fa-solid fa-arrow-right"></i>
                                            </router-link >
                                            <b-button class="btn btn-danger btn-sm" @click="deleteMeet(item.id)">
                                                    <i class="fa-solid fa-circle-xmark"></i></b-button>
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
            listMeetings: [],
            pageNumber: 0,
            perPage: 5,
            showModal: false,
        }
    },

    mounted(){
        this.getListMeetings(this.user.role_id, this.user.client_id);
    },

    props: ['user'],
    
    components: {
        Form,
    },

    computed: {
        //Obtener número de páginas
        pageCount() {
            let a = this.listMeetings.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        //Obtener registros paginados
        listMeetingsPaginated(){
            let start = this.pageNumber * this.perPage,
                end = start + this.perPage;
            return this.listMeetings.slice(start, end);
        },
        pageList(){
            let a = this.listMeetings.length,
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

        getListMeetings(role_id, client_id){
        
            axios.get(`/administration/meet/getListMeetings/${role_id}/${client_id}`)
            .then(res => {
                this.listMeetings = res.data; 
            })
        },

        deleteMeet(id){
            Swal.fire({
                title: '¿Estás seguro de eliminar la reunión?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/administration/meet/deleteMeet/${id}`)
                            .then(()=>{
                                this.$router.go(this.$router.currentRoute)
                            }).catch(error => {
                                console.log(error)
                            })
                        Swal.fire(
                        'Eliminado!',
                        'La reunión ha sido eliminada.',
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
            this.$bvModal.hide(modalId);
            this.getListMeetings(this.user.client_id);
        }
       
    }
}
</script>

<style>
  .modal-backdrop {
      background-color: #f5efef30;
  }
</style>