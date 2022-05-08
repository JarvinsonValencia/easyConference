<template>
    <div class="content-header">
   
    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools" >
                    <router-link class="btn btn-info btn-sm" :to="'/user'">
                        <span><i class="fas fa-arrow-left"></i>Regresar</span>
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Editar usuario</h3>
                        </div>
                        <div class="card-body">
    <b-form @submit.stop="onSubmit">
       <b-row>
          <b-col cols="12" md="6">
            <b-form-group id="example-input-group-1" label="Nombre *" label-for="example-input-1">
                 <div v-if="true" edit></div>
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
       <b-row>
         <b-col cols="12" md="6">
          <b-form-group id="example-input-group-2" label="Rol " label-for="example-input-2">
                  <b-form-select
                    id="example-input-2"
                    name="example-input-2"
                    v-model="$v.formUser.role_id.$model"
                    :state="validateState('role_id')"
                    aria-describedby="input-7-live-feedback"
                  ><b-form-select-option v-for="(item, index) in listRol" :key="index" :value= item.id>{{item.name}}</b-form-select-option>
                  </b-form-select>

                  <b-form-invalid-feedback id="input-7-live-feedback">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>
         </b-col>
          <b-col cols="12" md="6">
          <b-form-group id="example-input-group-2" label="Cliente " label-for="example-input-2">
                  <b-form-select
                    id="example-input-2"
                    name="example-input-2"
                    v-model="$v.formUser.client_id.$model"
                    :state="validateState('client_id')"
                    aria-describedby="input-8-live-feedback"
                  ><b-form-select-option v-for="(item, index) in listClients" :key="index" :value= item.id>{{item.name}}</b-form-select-option>
                  </b-form-select>

                  <b-form-invalid-feedback id="input-8-live-feedback">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>
         </b-col>
       </b-row>
        <div class="btn-submit" >
            <router-link class="btn btn-flat btn-secondary btnWidth" :to="{name: 'user'}">
                        <span><i class="fa-solid fa-xmark"></i>Cancelar</span>
            </router-link>
            <b-button class="btn btn-flat btn-info btnWidth" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</b-button>
        </div>
    </b-form>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { required, minLength, maxLength, email, numeric } from "vuelidate/lib/validators";
export default {
    data(){
        return {
            formUser: {},
            listRol: [],
            listClients: []

        }
    },

    mounted(){
        this.getUser();
        this.getlistRol();
        this.getlistClient();
    },

    validations: {
        formUser: {
            role_id: {required},
            name: {required, minLength: minLength(3)},
            document: { required, numeric, minLength: minLength(4), maxLength: maxLength(12) },
            email: { required, email },
            phone: { required },
            password: {required},
            username: { required, minLength: minLength(3) },
            client_id: {required}
        }
    },
    methods: {
        editUserbyId(){
             axios.post( `/administration/user/editUser/${this.$route.params.id}`, this.formUser)
            .then(res => {
                Swal.fire({
                icon: 'success',
                title: 'Actualización exitosa',
                showConfirmButton: false,
                timer: 5000
                })
            })
           this.$router.push('/user');
        },

        getUser() {
              axios.get( `/administration/user/getUser/${this.$route.params.id}`)
            .then(res => {
                    this.formUser = res.data;
            })
        },

        validateState(name) {
            const { $dirty, $error } = this.$v.formUser[name];
        
            return $dirty ? !$error : null;
        },

        getlistRol(){
            axios.get('/administration/rol/getListRoles')
            .then(res => {
                this.listRol = res.data;
            })
        },

        getlistClient(){

            axios.get('/administration/client/getListClients')
            .then(res => {
            console.log(res.data)
                this.listClients = res.data;
            }).catch(error => {
                console.log(error)
            })
        },

        onSubmit(bvModalEvent) {
            bvModalEvent.preventDefault()
            this.$v.formUser.$touch();
            if (this.$v.formUser.$anyError) {
                return;
            }
            
            this.editUserbyId();
            this.$nextTick(() => this.$bvModal.hide(modalId))
        },


    }
}
</script>

<style>

</style>