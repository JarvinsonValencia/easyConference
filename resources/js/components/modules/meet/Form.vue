<template>
    <b-container fluid>
           
                <b-form ref="form" @submit.stop.prevent="onSubmit">
                    
                    <b-form-group 
                        id="example-input-group-1" 
                        label="Título " 
                        label-for="example-input-1">
                    <b-form-input
                        id="example-input-1"
                        name="example-input-1"
                        v-model="$v.fillCreateMeet.name.$model"
                        :state="validateState('name')"
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
                        <b-button  class="btn btn-flat btn-secondary btnWidth"  @click="resetForm()"><i class="fa-solid fa-xmark"></i> Cancelar</b-button>
                        <b-button class="btn btn-flat btn-info btnWidth" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</b-button>
                    </div>
                </b-form>
           
  </b-container>
  
</template>
<script>
import { required, minLength} from "vuelidate/lib/validators";
export default {
    data() {
        return {
        listMeets: [],
        showmodal: false,
        fillCreateMeet: {
            name: null,
            date: null,
            purpose: null,
            userClient: null
        }
        };
    },

    props: ['user'],

    validations: {
        fillCreateMeet: {
            date: {required},
            name: {required, minLength: minLength(3)},
            purpose: { required },
        }
    },
    methods: {
        validateState(name) {
        const { $dirty, $error } = this.$v.fillCreateMeet[name];
        
        return $dirty ? !$error : null;
    },

    resetForm() {
      this.fillCreateMeet = {
        name: null,
        date: null,
        purpose: null,
      };
      //this.$router.go(this.$router.currentRoute)
      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    
    onSubmit(bvModalEvent) {
        
      bvModalEvent.preventDefault()
      this.$v.fillCreateMeet.$touch();
      if (this.$v.fillCreateMeet.$anyError) {
        return;
      }
        
        this.setRegisterMeet()
        this.$router.go(this.$router.currentRoute)
        //this.$nextTick(() => this.$bvModal.hide(modalId))
    },

    setRegisterMeet(){
        const params = {
            name: this.fillCreateMeet.name,
            date: this.fillCreateMeet.date,
            purpose: this.fillCreateMeet.purpose,
            client_id: this.user.client_id
        }
       
        axios.post('/administration/meet/setCreateMeet', params)
            .then(res => {
                console.log(res.data)
               this.listMeets.push(res.data)
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