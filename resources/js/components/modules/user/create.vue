<template>
        <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Formulario de Usuario</h1>
            </div>
        </div>
    </div>

    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <router-link class="btn btn-info btn-sm" :to="'/user'">
                        <i class="fas fa-arrow-left">   Regresar</i>
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Registrar usera</h3>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Nombre *</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Nombre" v-model="fillCreateUser.name" @keyup.enter="setRegisterUser" required> 
                                <div class="invalid-feedback">
                                    Debe ingresar un nombre.
                                </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Documento *</label>
                                <input type="number" class="form-control" id="validationCustom02" placeholder="Documento" v-model="fillCreateUser.document" @keyup.enter="setRegisterUser" required>
                                <div class="invalid-feedback">
                                    Debe ingresar un número de documento.
                                </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Correo electrónico *</label>
                                    <input type="email" class="form-control" id="validationCustom03" placeholder="Correo electrónico" v-model="fillCreateUser.email" @keyup.enter="setRegisterUser" required>
                                    <div class="invalid-feedback">
                                        Debe ingresar un correo electrónico.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">Teléfono *</label>
                                    <!-- <el-input placeholder="Ingrese una contraseña" id="validationCustom04" required v-model="fillCreateUser.password"  @keyup.enter="setRegisterUser"></el-input> -->
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="Teléfono" v-model="fillCreateUser.phone" @keyup.enter="setRegisterUser" required>
                    
                                    <div class="invalid-feedback">
                                        Debe ingresar un número de teléfono.
                                    </div>
                                </div>
                               
                            </div>
                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Username *</label>
                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Username" v-model="fillCreateUser.username" @keyup.enter="setRegisterUser" required>
                                    <div class="invalid-feedback">
                                        Debe ingresar un username.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">Contraseña *</label>
                                    <!-- <el-input placeholder="Ingrese una contraseña" id="validationCustom04" required v-model="fillCreateUser.password"  @keyup.enter="setRegisterUser"></el-input> -->
                                    <input type="password" class="form-control" id="validationCustom04" placeholder="Contraseña" v-model="fillCreateUser.password" @keyup.enter="setRegisterUser" required>
                    
                                    <div class="invalid-feedback">
                                        Debe ingresar una contraseña.
                                    </div>
                                </div>
                               
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-flat btn-secondary btnWidth"  @click="cancel"><i class="fa-solid fa-xmark"></i>  Cancelar</button>
                                <button class="btn btn-flat btn-info btnWidth" @click="setRegisterUser"><i class="fa-solid fa-chek"></i>Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
export default {
    data(){
        return {
            fillCreateUser: {
                name: '',
                document: '',
                email: '',
                phone: '',
                username: '',
                password: ''
            },
            listUser: [],
        }
    },
    computed: {
        
    },
    methods: {
       setRegisterUser(){
          
            const params = {
                name: this.fillCreateUser.name,
                document: this.fillCreateUser.document,
                email: this.fillCreateUser.email,
                phone: this.fillCreateUser.phone,
                username: this.fillCreateUser.username,
                password: this.fillCreateUser.password,
            }
            
             if(this.fillCreateUser.name.trim() != '' && this.fillCreateUser.document.trim() != '' 
                && this.fillCreateUser.email.trim() != '' && this.fillCreateUser.phone.trim() != '' && this.fillCreateUser.username.trim() != ''
                 && this.fillCreateUser.password.trim() != '' && this.validateEmail() > 0){
               
                 axios.post('/administration/user/setCreateUser', params)
                    .then(res => {
                    this.listUser.push(res.data)
                      Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        showConfirmButton: false,
                        timer: 5000
                    })
                })
            }
       },
       validateEmail(){
           return this.fillCreateUser.email.indexOf('@');
       },
       cancel(){
           this.$router.push('/user')
       }
    }
}
</script>

<style>

</style>