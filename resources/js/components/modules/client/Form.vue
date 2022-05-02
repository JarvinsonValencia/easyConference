<template>
    <div class="container">
                <b-form ref="form" @submit.stop.prevent="onSubmit">
                    <b-row>
                        <b-col cols="12" md="6">
                            <b-form-group 
                                id="example-input-group-1" 
                                label="Nombre *" 
                                label-for="example-input-1">
                            <b-form-input
                                id="example-input-1"
                                name="example-input-1"
                                v-model="$v.fillCreateClient.name.$model"
                                :state="validateState('name')"
                                aria-describedby="input-1-live-feedback"
                            ></b-form-input>

                            <b-form-invalid-feedback
                                id="input-1-live-feedback"
                            >   Este campo debe tener al menos 3 caracteres.</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group 
                                id="example-input-group-1" 
                                label="Documento *" 
                                label-for="example-input-1">
                                <b-form-input
                                    id="example-input-1"
                                    name="example-input-1"
                                    type="number"
                                    v-model="$v.fillCreateClient.document.$model"
                                    :state="validateState('document')"
                                    aria-describedby="input-2-live-feedback"
                                ></b-form-input>

                                <b-form-invalid-feedback
                                    id="input-2-live-feedback"
                                >   Este campo es requerido.</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="12" md="6">
                            <b-form-group 
                                id="example-input-group-1" 
                                label="Correo electrónico *" 
                                label-for="example-input-1">
                            <b-form-input
                                id="example-input-1"
                                name="example-input-1"
                                type="email"
                                v-model="$v.fillCreateClient.email.$model"
                                :state="validateState('email')"
                                aria-describedby="input-3-live-feedback"
                            ></b-form-input>

                            <b-form-invalid-feedback
                                id="input-3-live-feedback"
                            >   Debe ingresar un correo electrónico válido.</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group 
                                id="example-input-group-1" 
                                label="Telefóno *" 
                                label-for="example-input-1">
                                <b-form-input
                                    id="example-input-1"
                                    name="example-input-1"
                                    v-model="$v.fillCreateClient.phone.$model"
                                    :state="validateState('phone')"
                                    aria-describedby="input-4-live-feedback"
                                ></b-form-input>

                                <b-form-invalid-feedback
                                    id="input-4-live-feedback"
                                >   Este campo es requerido.</b-form-invalid-feedback>
                            </b-form-group>
                        </b-col>
                    </b-row>
                        <b-form-group 
                            id="example-input-group-1" 
                            label="Dirección *" 
                            label-for="example-input-1">
                            <b-form-input
                                id="example-input-1"
                                name="example-input-1"
                                v-model="$v.fillCreateClient.address.$model"
                                :state="validateState('address')"
                                aria-describedby="input-4-live-feedback"
                            ></b-form-input>

                            <b-form-invalid-feedback
                                id="input-4-live-feedback"
                            >   Este campo es requerido.</b-form-invalid-feedback>
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
            fillCreateClient: {
                    name: '',
                    document: '',
                    email: '',
                    phone: '',
                    address: ''
            },
            listClients: [],
            name: '',
            nameState: null,
            submittedNames: []
        };
    },
    validations: {
        fillCreateClient: {
            name: {required, minLength: minLength(3)},
            document: { required, numeric, minLength: minLength(4), maxLength: maxLength(12) },
            email: { required, email },
            phone: { required },
            address: {required},
        },
        listMeet: []
    },
    methods: {
    validateState(name) {
        const { $dirty, $error } = this.$v.fillCreateClient[name];
        
        return $dirty ? !$error : null;
    },

    resetForm() {
      this.fillCreateClient = {
        name: null,
        document: null,
        email: null,
        phone: null,
        address: null
      };
     // this.$router.go(this.$router.currentRoute)
      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    
    onSubmit(bvModalEvent) {
        
      bvModalEvent.preventDefault()
      this.$v.fillCreateClient.$touch();
      if (this.$v.fillCreateClient.$anyError) {
        return;
      }
        this.setRegisterMeet()
        this.$router.go(this.$router.currentRoute)
        //this.$nextTick(() => this.$bvModal.hide(modalId))
    },

    setRegisterMeet(){
        const params = {
            name: this.fillCreateClient.name,
            document: this.fillCreateClient.document,
            email: this.fillCreateClient.email,
            phone: this.fillCreateClient.phone,
            address: this.fillCreateClient.address,
        }
        axios.post('/administration/client/setCreateClient', params)
            .then(res => {
               this.listClients.push(res.data)
                 Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    showConfirmButton: false,
                    timer: 1500
                })
          }).catch(error => {
            console.log(error)
          })
          //this.$nextTick(() => this.$bvModal.hide(modalId))
    },
  }
}
</script>

<style>

</style>