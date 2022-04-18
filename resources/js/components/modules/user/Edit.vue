<template>
        <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Formulario Persona</h1>
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
                            <h3 class="card-title">Editar Persona</h3>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                                 <div class="form-row">
                                <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Nombre *</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Nombre" v-model="fillEditPerson.name" @keyup.enter="editUserbyId" required> 
                                <div class="invalid-feedback">
                                    Debe ingresar un nombre.
                                </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Documento *</label>
                                <input type="number" class="form-control" id="validationCustom02" placeholder="Documento" v-model="fillEditPerson.document" @keyup.enter="editUserbyId" required>
                                <div class="invalid-feedback">
                                    Debe ingresar un número de documento.
                                </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Correo electrónico *</label>
                                    <input type="email" class="form-control" id="validationCustom03" placeholder="Correo electrónico" v-model="fillEditPerson.email" @keyup.enter="editUserbyId" required>
                                    <div class="invalid-feedback">
                                        Debe ingresar un correo electrónico.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">Teléfono *</label>
                                    <!-- <el-input placeholder="Ingrese una contraseña" id="validationCustom04" required v-model="fillEditPerson.password"  @keyup.enter="editUserbyId"></el-input> -->
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="Teléfono" v-model="fillEditPerson.phone" @keyup.enter="editUserbyId" required>
                    
                                    <div class="invalid-feedback">
                                        Debe ingresar un número de teléfono.
                                    </div>
                                </div>
                               
                            </div>
                                <button class="btn btn-flat btn-secondary btnWidth"  @click="cancel"><i class="fa-solid fa-xmark"></i>  Cancelar</button>
                                 <button class="btn btn-flat btn-info btnWidth"  @click="editUserbyId"><i class="fa-solid fa-pen"></i> Editar</button>
                
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
            fillEditPerson: {},
        }
    },
    mounted(){
        this.getUsers();
    },
    methods: {
        editUserbyId(){
             axios.post( `/administration/person/editPerson/${this.$route.params.id}`, this.fillEditPerson)
            .then(res => {
                    
            })
            this.$router.push('/person')
        },
         getUsers() {
              axios.get( `/administration/person/getPerson/${this.$route.params.id}`)
            .then(res => {
                    this.fillEditPerson = res.data;
            })
        },
        cancel() {
            this.$router.push('/person');
        }
    }
}
</script>

<style>

</style>