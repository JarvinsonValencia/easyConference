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

            <li class="nav-header">MENÚ</li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'meet', params: {user: user }}">
                <i class="fa-solid fa-video"></i>
                <p>
                    Reuniones
                    <span class="badge badge-info right"></span>
                </p>
                </router-link>
            </li>
             <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'activity', params: {user: user }}">
                <i class="fa-solid fa-list-check"></i>
                <p>
                    Actividades
                    <span class="badge badge-info right"></span>
                </p>
                </router-link>
            </li>
             <li class="nav-item" v-if="user.role_id === 1">
                <router-link class="nav-link" :to="{ name: 'user', params: {user: user }}">
               <i class="fa-solid fa-people-group"></i>
                <p>
                    Usuarios
                </p>
                </router-link>
            </li>
              <li class="nav-item" v-if="user.role_id === 1">
                <router-link class="nav-link" :to="'/client'">
               <i class="fa-solid fa-city"></i>
                <p>
                    Clientes
                </p>
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