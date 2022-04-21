<template>
    <div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
        <img :src="ruta + '/img/AdminLTELogo.png'"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Easy Conference</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img :src="ruta + '/img/avatar.png'" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block"  >
            <!-- :to="{name: 'user.ver', params:{id: user.id}}" -->
                 {{user.name}}
                </a>
            
            </div>
        </div>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block" @click.prevent="logout" v-loading.fullscreen.lock="fullscreenLoading">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
                
                <router-link class="nav-link" :to="'/'">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <i class="right fas fa-angle-left"></i>
                </p>
                
                </router-link>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../../index.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index2.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v3</p>
                    </a>
                </li>
                </ul>

            <li class="nav-header">OPERACIONES</li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/jitsi'">
                <i class="fa-solid fa-video"></i>
                <p>
                    Jitsi
                    <span class="badge badge-info right">2</span>
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/person'">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                    Usuarios
                </p>
                </router-link>
            </li>
            
            <li class="nav-header">CONFIGURACION</li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/category'">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>Categorias</p>
                </router-link>
            </li>
            
            <li class="nav-item">
                <router-link class="nav-link" :to="'/product'">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>Productos</p>
                </router-link>
            </li>

            <li class="nav-header">ADMINISTRACIÓN</li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/user/create'">
                <i class="nav-icon fas fa-users"></i>
                <p>Usuarios</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/role'">
                <i class="nav-icon fas fa-unlock-alt"></i>
                <p>Roles</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/permission'">
                <i class="nav-icon far fa-key"></i>
                <p>Permisos</p>
                </router-link>
            </li>

               <li class="nav-header">REPORTES</li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/report'">
                <i class="nav-icon fas fa-file-export"></i>
                <p>Productos</p>
                </router-link>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
         </aside>
    </div>
</template>

<script>
export default {
    props: ['ruta', 'user'],
     data() {
            return {
                fullscreenLoading: false
            }
    },
    methods: {
        logout(){
            this.fullscreenLoading = true;
                var url = '/authenticate/logout'
                axios.post(url).then(response => {
                    if (response.data.code == 204) {
                        this.$router.push({name: 'login'})
                        location.reload();
                        sessionStorage.clear();
                        this.fullscreenLoading = false;
                    }
                }).catch(error => {
                    if (error.response.status == 401) {
                        this.$router.push({name: 'login'})
                        location.reload();
                        sessionStorage.clear();
                        this.fullscreenLoading = false;
                    }
            })
        }
    },
}
</script>

<style>

</style>