<template>
   <div class="content-header">
    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <router-link class="btn btn-info btn-sm" :to="'/user/create'">
                        <span><i class="fa-solid fa-file-circle-plus"></i> Nuevo</span>
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                     <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Actividades</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <template v-if="listActivities.length">
                                    <table class="table table-hover table-head-fixed text-nowrap projects">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <th>Responsable</th>
                                        <th>Acciones</th>
                                    </tr> 
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listActivitiesPaginated" :key="index">
                                        
                                        <td v-text="item.name"></td>
                                        <td v-text="item.estimated_date"></td>
                                        <td v-text="item.username"></td>
                                        
                                        <td>
                                            <router-link class="btn btn-info btn-sm" :to="{name:'user.edit', params:{id: item.id}}">
                                               <i class="fa-solid fa-file-pen"></i>
                                            </router-link >
                                            <router-link class="btn btn-danger btn-sm" :to="'/user'">
                                                <i class="fa-solid fa-file-circle-xmark"></i>
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
            listActivities: [],
            pageNumber: 0,
            perPage: 5
        }
    },
    mounted(){
        this.getListActivities();
    },
    computed: {
        //Obtener número de páginas
        pageCount() {
            let a = this.listActivities.length,
                b = this.perPage;
            return Math.ceil(a / b);
        },
        //Obtener registros paginados
        listActivitiesPaginated(){
            let start = this.pageNumber * this.perPage,
                end = start + this.perPage;
            return this.listActivities.slice(start, end);
        },
        pageList(){
            let a = this.listActivities.length,
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
        getListActivities(){
            axios.get('/administration/activity/getListActivities')
            .then(res => {
                this.listActivities = res.data;
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