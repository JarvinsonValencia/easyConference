<template>
    <div>
          <!-- Navbar -->
        <Navbar :ruta="ruta"></Navbar>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
        <Sidebar :ruta="ruta" :user="user"></Sidebar>

  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <transition name="slide-fade" mode="out-in">
           <router-view></router-view>
         </transition>
      </div>
  <!-- /.content-wrapper -->
        <Footer></Footer>
  <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
  <!-- /.control-sidebar -->
   </div>
</template>

<script>

import Navbar from './template/Navbar.vue'
import Sidebar from './template/Sidebar.vue'
import Footer from './template/Footer.vue'

    export default {
      props: ['ruta', 'user'],
      components: {Navbar, Sidebar, Footer }
        
    }
</script>

<style>

</style>