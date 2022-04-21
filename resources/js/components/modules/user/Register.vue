<template>
        <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Formulario de usuario</h1>
            </div>
        </div>
    </div>

    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <router-link class="btn btn-info btn-sm" :to="'/person'">
                        <i class="fas fa-arrow-left">   Regresar</i>
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Registrar usuario</h3>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Nombre *</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Nombre" v-model="fillCreatePerson.name" @keyup.enter="setRegisterPerson" required> 
                                <div class="invalid-feedback">
                                    Debe ingresar un nombre.
                                </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Apellido *</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Apellido" v-model="fillCreatePerson.lastname" @keyup.enter="setRegisterPerson" required> 
                                <div class="invalid-feedback">
                                    Debe ingresar un número de documento.
                                </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Correo electrónico *</label>
                                    <input type="email" class="form-control" id="validationCustom03" placeholder="Correo electrónico" v-model="fillCreatePerson.email" @keyup.enter="setRegisterPerson" required>
                                    <div class="invalid-feedback">
                                        Debe ingresar un correo electrónico.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">Username *</label>
                                    <!-- <el-input placeholder="Ingrese una contraseña" id="validationCustom04" required v-model="fillCreatePerson.password"  @keyup.enter="setRegisterPerson"></el-input> -->
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="Teléfono" v-model="fillCreatePerson.username" @keyup.enter="setRegisterPerson" required>
                    
                                    <div class="invalid-feedback">
                                        Debe ingresar un número de teléfono.
                                    </div>
                                </div>
                                   <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">Contraseña *</label>
                                    <!-- <el-input placeholder="Ingrese una contraseña" id="validationCustom04" required v-model="fillCreatePerson.password"  @keyup.enter="setRegisterPerson"></el-input> -->
                                    <input type="password" class="form-control" id="validationCustom04" placeholder="Teléfono" v-model="fillCreatePerson.password" @keyup.enter="setRegisterPerson" required>
                    
                                    <div class="invalid-feedback">
                                        Debe ingresar un número de teléfono.
                                    </div>
                                </div>
                               
                            </div>
                            <button class="btn btn-flat btn-secondary btnWidth"  @click="cancel"><i class="fa-solid fa-xmark"></i>  Cancelar</button>
                            <button class="btn btn-flat btn-info btnWidth" @click="setRegisterPerson"><i class="fa-solid fa-chek"></i>Registrar</button>
                           
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
            fillCreatePerson: {
                name: '',
                lastname: '',
                email: '',
                username: '',
                password: ''
            },
            listPerson: [],
        }
    },
    computed: {
        
    },
    methods: {
       setRegisterPerson(){
          
            const params = {
                name: this.fillCreatePerson.name,
                lastname: this.fillCreatePerson.lastname,
                email: this.fillCreatePerson.email,
                username: this.fillCreatePerson.username,
                password: this.fillCreatePerson.password,
            }
            
             if(this.fillCreatePerson.name.trim() != '' && this.fillCreatePerson.lastname.trim() != '' 
                && this.fillCreatePerson.email.trim() != '' && this.fillCreatePerson.username.trim() != '' && this.fillCreatePerson.password.trim() != '' && this.validateEmail() > 0){
               
                 axios.post('/administration/user/setCreateUser', params)
                    .then(res => {
                        console.log(res.data)
                    this.listPerson.push(res.data)
                      Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        showConfirmButton: false,
                        timer: 50000
                    })
                })
            }
       },
       validateEmail(){
           return this.fillCreatePerson.email.indexOf('@');
       },
       cancel(){
           this.$router.push('/')
       }
    }
}
</script>

<style>

</style>