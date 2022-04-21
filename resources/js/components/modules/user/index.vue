<template>
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Usuarios</h1>
            </div>
        </div>
    </div>

    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <router-link class="btn btn-info btn-sm" :to="'/person/create'">
                        <i class="fas fa-plus-square">   Nuevo Usuario</i>
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Criterios de búsqueda</h3>
                        </div>
                        <div class="card-body">
                            <form role="form">
                                <div class="row">
                                     <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="validationCustom03" v-model="fillBsqPerson.name" @keyup.enter="getlistPersons" required>
                                        <div class="invalid-feedback">
                                        Por favor ingrese un nombre.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Documento</label>
                                        <input type="document" class="form-control" id="validationCustom03" v-model="fillBsqPerson.document" @keyup.enter="getlistPersons" required>
                                        <div class="invalid-feedback">
                                        Por favor ingrese un número de documento.
                                        </div>
                                    </div>
                                   <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="validationCustom03" v-model="fillBsqPerson.email" @keyup.enter="getlistPersons" required>
                                        <div class="invalid-feedback">
                                        Por favor ingrese un email.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="validationCustom03" v-model="fillBsqPerson.phone" @keyup.enter="getlistPersons" required>
                                        <div class="invalid-feedback">
                                        Por favor ingrese un número de teléfono.
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-9 offset-9">
                                    <button class="btn btn-flat btn-secondary btnWidth" @click.prevent="cleanCriteriaSearch"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getlistPersons"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Bandeja de resultados</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <template v-if="listPersons.length">
                                    <table class="table table-hover table-head-fixed text-nowrap projects">
                                <thead>
                                    <tr>
                                        <th>Fotografía</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr> 
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listPersonsPaginated" :key="index">
                                        <td>
                                            <li class="user-block">
                                                <img src="/img/avatar.png" :alt="item.username" class="profile-avatar-img img-fluid img-circle">
                                            </li>
                                        </td>
                                        <td v-text="item.name"></td>
                                        <td v-text="item.email"></td>
                                        <td>
                                            <template v-if="item.state == 'A'">                                                                            
                                                <span class="badge badge-success">Activo</span>
                                            </template>
                                            
                                            <template v-else>                                                                            
                                                <span class="badge badge-danger">Inactivo</span>
                                            </template>
                                        </td>
                                       
                                        <td>
                                            <router-link class="btn btn-primary btn-sm" :to="'/'">
                                                <i class="fas fa-folder"></i> Ver
                                            </router-link >
                                            <router-link class="btn btn-info btn-sm" :to="{name:'person.edit', params:{id: item.id}}">
                                               <i class="fas fa-pencil-alt"></i> Editar
                                            </router-link >
                                            <router-link class="btn btn-success btn-sm" :to="'/'">
                                                <i class="fas fa-key"></i> Permiso
                                            </router-link >
                                            <router-link class="btn btn-danger btn-sm" :to="'/'">
                                                 <i class="fas fa-trash"></i> Desactivar
                                            </router-link >
                                            <router-link class="btn btn-success btn-sm" :to="'/'">
                                               <i class="fas fa-check"></i> Activar
                                            </router-link >
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
export default {
    data(){
        return {
            fillBsqPerson: {
                name: '',
                document: '',
                email: '',
                phone: ''
            },
            listPersons: [],
            listStates: [
                {value: 'A', label: 'Activo'},
                {value: 'I', label: 'Inactivo'}
            ],
            pageNumber: 0,
            perPage: 5
        }
    },
    mounted(){
        this.getlistPersons();
    },
    computed: {
        //Obtener número de páginas
        pageCount() {
            let a = this.listPersons.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        //Obtener registros paginados
        listPersonsPaginated(){
            let start = this.pageNumber * this.perPage,
                end = start + this.perPage;
            return this.listPersons.slice(start, end);
        },
        pageList(){
            let a = this.listPersons.length,
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
        cleanCriteriaSearch() {
            this.fillBsqPerson.name = '';
            this.fillBsqPerson.document = '';
            this.fillBsqPerson.email = '';
            this.fillBsqPerson.phone = '';
        },
        cleanUsersTray(){
            this.listPersons = [];
        },
        getlistPersons(){
            axios.get('/administration/person/getListPersons')
            .then(res => {
                this.listPersons = res.data;
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
        }
    }
}
</script>

<style>

</style>