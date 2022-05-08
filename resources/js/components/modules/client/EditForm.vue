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
                            <h3 class="card-title">Editar Cliente</h3>
                        </div>
                        <div class="card-body">
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
                            <router-link class="btn btn-flat btn-secondary btnWidth" :to="{name: 'client'}">
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
     data() {
        return {
            fillCreateClient: {},
            listClients: [],
        };
    },
    
    mounted() {
        this.getClient();
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

        onSubmit(bvModalEvent) {
            
        bvModalEvent.preventDefault()
        this.$v.fillCreateClient.$touch();
        if (this.$v.fillCreateClient.$anyError) {
            return;
        }
            this.editClient()
        },

        editClient(){
            axios.post(`/administration/client/editClient/${this.$route.params.id}`, this.fillCreateClient)
                .then(res => {
                this.listClients.push(res.data)
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualización exitosa',
                        showConfirmButton: false,
                        timer: 1500
                    })
            }).catch(error => {
                console.log(error)
            })
            this.$router.push('/client');
        },

        getClient() {
              axios.get( `/administration/client/getClient/${this.$route.params.id}`)
            .then(res => {
                    this.fillCreateClient = res.data;
            })
        },
    }
}
</script>

<style>

</style>