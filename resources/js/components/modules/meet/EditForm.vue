<template>
        <div class="content-header">
   
    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools" >
                    <router-link class="btn btn-info btn-sm" :to="'/meet'">
                        <span><i class="fas fa-arrow-left"></i>Regresar</span>
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Editar Reunión</h3>
                        </div>
                        <div class="card-body">
         <b-form ref="form" @submit.stop.prevent="onSubmit">
                    
                    <b-form-group 
                        id="example-input-group-1" 
                        label="Título " 
                        label-for="example-input-1">
                    <b-form-input
                        id="example-input-1"
                        name="example-input-1"
                        v-model="$v.fillCreateMeet.title.$model"
                        :state="validateState('title')"
                        aria-describedby="input-1-live-feedback"
                    ></b-form-input>

                    <b-form-invalid-feedback
                        id="input-1-live-feedback"
                    >Este campo debe tener al menos 3 caracteres.</b-form-invalid-feedback>
                    </b-form-group>
                    <b-form-group 
                        id="example-input-group-1" 
                        label="Fecha " 
                        label-for="example-input-1">
                    <b-form-input
                        id="example-input-1"
                        name="example-input-1"
                        type="date"
                        v-model="$v.fillCreateMeet.date.$model"
                        :state="validateState('date')"
                        aria-describedby="input-2-live-feedback"
                    ></b-form-input>

                    <b-form-invalid-feedback
                        id="input-2-live-feedback"
                    >Debe selecionar una fecha.</b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group 
                        id="example-input-group-1" 
                        label="Propósito " 
                        label-for="example-input-1">
                    <b-form-textarea
                        id="example-input-1"
                        name="example-input-1"
                        v-model="$v.fillCreateMeet.purpose.$model"
                        :state="validateState('purpose')"
                        aria-describedby="input-3-live-feedback"
                    ></b-form-textarea>

                    <b-form-invalid-feedback
                        id="input-3-live-feedback"
                    >Campo requerido.</b-form-invalid-feedback>
                    </b-form-group>

                    <div class="btn-submit" >
                        <router-link class="btn btn-flat btn-secondary btnWidth" :to="{name: 'meet'}">
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
import { required, minLength } from "vuelidate/lib/validators";
export default {
     data() {
        return {
            listMeets: [],
            fillCreateMeet: {}
        };
    },

    mounted() {
        this.getMeet();
    },

    props: ['user'],

    validations: {
        fillCreateMeet: {
            date: {required},
            title: {required, minLength: minLength(3)},
            purpose: { required },
        }
    },
    methods: {
        validateState(name) {
        const { $dirty, $error } = this.$v.fillCreateMeet[name];
        
        return $dirty ? !$error : null;
        },

        onSubmit(bvModalEvent) {
            
        bvModalEvent.preventDefault()
        this.$v.fillCreateMeet.$touch();
        if (this.$v.fillCreateMeet.$anyError) {
            return;
        }
            
            this.editMeet()
            //this.$router.go(this.$router.currentRoute)
            //this.$nextTick(() => this.$bvModal.hide(modalId))
        },

        editMeet(){
        
            axios.post(`/administration/meet/editMeet/${this.$route.params.id}`, this.fillCreateMeet)
                .then(res => {
                    
                    this.listMeets.push(res.data)
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualización exitosa',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }).catch(error => {
                    console.log(error)
            })
            this.$router.push('/meet');
        },

        getMeet() {
            axios.get( `/administration/meet/getMeet/${this.$route.params.id}`)
             .then(res => {
                 console.log(res.data)
                this.fillCreateMeet = res.data;
            })
        },
    }
}
</script>

<style>

</style>