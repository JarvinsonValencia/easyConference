<template>
    <div class="container">
         
                <b-form ref="form" @submit.stop.prevent="onSubmit">
                    <b-form-group 
                        id="example-input-group-1" 
                        label="Nombre " 
                        label-for="example-input-1">
                    <b-form-input
                        id="example-input-1"
                        name="example-input-1"
                        v-model="$v.fillCreateActivity.name.$model"
                        :state="validateState('name')"
                        aria-describedby="input-1-live-feedback"
                    ></b-form-input>

                    <b-form-invalid-feedback
                        id="input-1-live-feedback"
                    >Este campo debe tener al menos 3 caracteres.</b-form-invalid-feedback>
                    </b-form-group>
                    <b-form-group 
                        id="example-input-group-1" 
                        label="Descripción " 
                        label-for="example-input-1">
                    <b-form-input
                        id="example-input-1"
                        name="example-input-1"
                        v-model="$v.fillCreateActivity.description.$model"
                        :state="validateState('description')"
                        aria-describedby="input-2-live-feedback"
                    ></b-form-input>

                    <b-form-invalid-feedback
                        id="input-2-live-feedback"
                    >Debe ingresar una descripción de la actividad.</b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group 
                        id="example-input-group-2" 
                        label="Responsable " 
                        label-for="example-input-2">
                    <b-form-select
                        id="example-input-2"
                        name="example-input-2"
                        v-model="$v.fillCreateActivity.user_id.$model"
                        :state="validateState('user_id')"
                        aria-describedby="input-7-live-feedback"
                    ><b-form-select-option v-for="(item, index) in listUsers" :key="index" :value= item.id>{{item.name}}</b-form-select-option>
                    </b-form-select>

                        <b-form-invalid-feedback id="input-7-live-feedback">Este campo es requerido.</b-form-invalid-feedback>
                    </b-form-group>
       
                    <div class="btn-submit" >
                        <b-button  class="btn btn-flat btn-secondary btnWidth"  @click="closeModal()"><i class="fa-solid fa-xmark"></i> Cancelar</b-button>
                        <b-button class="btn btn-flat btn-info btnWidth" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</b-button>
                    </div>
                </b-form>
           
  </div>
  
</template>
<script>
    import { required, minLength} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            fillCreateActivity: {
                    name: null,
                    description: null,
                    user_id: null
            },
            listActivity: [],
            listUsers: [],
        };
    },

    mounted(){
       this.getlistUsers(this.user.role_id, this.user.client_id);
    },

    props: ['user'],

    validations: {
        fillCreateActivity: {
            user_id: {required},
            name: {required, minLength: minLength(3)},
            description: { required },
        }
    },

    methods: {
    validateState(name) {
        const { $dirty, $error } = this.$v.fillCreateActivity[name];
        
        return $dirty ? !$error : null;
    },

    onSubmit(bvModalEvent) {
        
      bvModalEvent.preventDefault()
      this.$v.fillCreateActivity.$touch();
      if (this.$v.fillCreateActivity.$anyError) {
        return;
      }
        this.setRegisterActivity();
        this.closeModal();
    },

    setRegisterActivity(){
         const params = {
                name: this.fillCreateActivity.name,
                description: this.fillCreateActivity.description,
                user_id: parseInt(this.fillCreateActivity.user_id)
        }
        axios.post('/administration/activity/setCreateActivity', params)
            .then(res => {
                console.log(res.data)
               this.listActivity.push(res.data)
                 Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    showConfirmButton: false,
                    timer: 1500
                })
            }).catch(error => {
                console.log(error)
          })
    },

    getlistUsers(role_id, client_id){
        axios.get(`/administration/user/getListUsers/${role_id}/${client_id}`)
        .then(res => {
            this.listUsers = res.data;
        })
    },

    closeModal() {
        this.$emit('closeModal');
    }

  }
}
</script>

<style>

</style>