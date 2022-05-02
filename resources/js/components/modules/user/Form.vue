<template>
  <div>
  
    <b-form @submit.stop="onSubmit">
       <b-row>
          <b-col cols="12" md="6">
            <b-form-group id="example-input-group-1" label="Nombre *" label-for="example-input-1">
                  <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    v-model="$v.formUser.name.$model"
                    :state="validateState('name')"
                    aria-describedby="input-1-live-feedback"
                  ></b-form-input>

                  <b-form-invalid-feedback
                    id="input-1-live-feedback"
                  >Este campo debe tener al menos 3 caracteres.</b-form-invalid-feedback>
              </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
              <b-form-group id="example-input-group-1" label="Documento *" label-for="example-input-1">
                  <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    type="number"
                    v-model="$v.formUser.document.$model"
                    :state="validateState('document')"
                    aria-describedby="input-2-live-feedback"
                  ></b-form-input>

                  <b-form-invalid-feedback
                    id="input-2-live-feedback"
                  >Este campo es requerido.</b-form-invalid-feedback>
              </b-form-group>
          </b-col>
       </b-row>
         <b-row>
          <b-col cols="12" md="6">
            <b-form-group id="example-input-group-2" label="Correo electrónico " label-for="example-input-2">
                   <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    type="email"
                    v-model="$v.formUser.email.$model"
                    :state="validateState('email')"
                    aria-describedby="input-2-live-feedback"
                  ></b-form-input>

              <b-form-invalid-feedback id="input-3-live-feedback">Debe ingresar un email válido.</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group id="example-input-group-2" label="Usuario " label-for="example-input-2">
                   <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    v-model="$v.formUser.username.$model"
                    :state="validateState('username')"
                    aria-describedby="input-4-live-feedback"
                  ></b-form-input>

              <b-form-invalid-feedback id="input-4-live-feedback">Este campo debe tener al menos 3 caracteres.</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
       </b-row>
          <b-row>
          <b-col cols="12" md="6">
            <b-form-group id="example-input-group-1" label="Teléfono *" label-for="example-input-1">
                  <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    type="numeric"
                    v-model="$v.formUser.phone.$model"
                    :state="validateState('phone')"
                    aria-describedby="input-5-live-feedback"
                  ></b-form-input>

                  <b-form-invalid-feedback
                    id="input-5-live-feedback"
                  >Este campo es requerido.</b-form-invalid-feedback>
              </b-form-group>
          </b-col>
         <b-col cols="12" md="6">
            <b-form-group id="example-input-group-1" label="Contraseña *" label-for="example-input-1">
                  <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    type="password"
                    v-model="$v.formUser.password.$model"
                    :state="validateState('password')"
                    aria-describedby="input-6-live-feedback"
                  ></b-form-input>

                  <b-form-invalid-feedback
                    id="input-6-live-feedback"
                  >Este campo es requerido.</b-form-invalid-feedback>
              </b-form-group>
          </b-col>
          
       </b-row>
       <b-form-group id="example-input-group-2" label="Rol " label-for="example-input-2">
              <b-form-select
                id="example-input-2"
                name="example-input-2"
                v-model="$v.formUser.role_id.$model"
                :state="validateState('role_id')"
                aria-describedby="input-7-live-feedback"
              ><b-form-select-option v-for="(item, index) in listRol" :key="index" value= item.id>{{item.name}}</b-form-select-option>
              </b-form-select>

              <b-form-invalid-feedback id="input-7-live-feedback">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>
       
        <div class="btn-submit" >
            <b-button  class="btn btn-flat btn-secondary btnWidth"  @click="resetForm()"><i class="fa-solid fa-xmark"></i> Cancelar</b-button>
            <b-button class="btn btn-flat btn-info btnWidth" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</b-button>
        </div>
    </b-form>
         
  </div>
</template>
<script>

import { required, minLength, maxLength, email, numeric } from "vuelidate/lib/validators";
export default {
    data() {
        return {
        listRol: [],
        listUsers: [],
        showmodal: false,
        formUser: {
            name: null,
            food: null,
            document: null,
            email: null,
            phone: null,
            username: null,
            password: null,
            role_id: null
        }
        };
    },
    mounted(){
        this.getlistRol();
    },
    validations: {
        formUser: {
            role_id: {required},
            name: {required, minLength: minLength(3)},
            document: { required, numeric, minLength: minLength(4), maxLength: maxLength(12) },
            email: { required, email },
            phone: { required },
            password: {required},
            username: { required, minLength: minLength(3) }
        }
    },
    methods: {
        validateState(name) {
        const { $dirty, $error } = this.$v.formUser[name];
        
        return $dirty ? !$error : null;
    },

    resetForm() {
      this.formUser = {
        name: ' ',
        food: ' ',
        document: ' ',
        email: ' ',
        phone: '',
        username: '',
        password: '',
        role_id: ''
      };
      this.$router.go(this.$router.currentRoute)
      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    
    onSubmit(bvModalEvent) {
        
      bvModalEvent.preventDefault()
      this.$v.formUser.$touch();
      if (this.$v.formUser.$anyError) {
        return;
      }
        this.setRegisterUser()
         this.$router.go(this.$router.currentRoute)
        this.$nextTick(() => this.$bvModal.hide(modalId))
    },

    setRegisterUser(){
        const params = {
            name: this.formUser.name,
            document: this.formUser.document,
            email: this.formUser.email,
            phone: this.formUser.phone,
            username: this.formUser.username,
            role_id: parseInt(this.formUser.role_id)
        }
        axios.post('/administration/user/setCreateUser', params)
            .then(res => {
               this.listUsers.push(res.data)
               
          }).catch(error => {
            console.log(error)
          })
          Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    showConfirmButton: false,
                    timer: 5000
                })
          this.$nextTick(() => this.$bvModal.hide(modalId))
    },

    getlistRol(){
        axios.get('/administration/rol/getListRoles')
        .then(res => {
            this.listRol = res.data;
        })
    },

   
  }
}
</script>

<style>
    .modal-footer {
        display: none;
    }

    .btn-submit {
        text-align: right;
    }
</style>