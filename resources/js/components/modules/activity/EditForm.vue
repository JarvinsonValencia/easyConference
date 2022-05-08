<template>
      <div class="content-header">
   
    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools" >
                    <router-link class="btn btn-info btn-sm" :to="'/activity'">
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
                        <router-link class="btn btn-flat btn-secondary btnWidth" :to="{name: 'activity'}">
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
import { required, minLength} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            fillCreateActivity: {},
            listActivity: [],
            listUsers: [],
        };
    },

    mounted(){
       this.getlistUsers(this.user.role_id, this.user.client_id);
       this.getActivity();
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
            this.editActivity();
        },

        editActivity(){
            axios.post(`/administration/activity/editActivity/${this.$route.params.id}`, this.fillCreateActivity)
                .then(res => {
                    console.log(res.data)
                    this.listActivity.push(res.data)
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualización exitosa',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }).catch(error => {
                    console.log(error)
            })
            this.$router.push('/activity');
        },

        getlistUsers(role_id, client_id){
            axios.get(`/administration/user/getListUsers/${role_id}/${client_id}`)
            .then(res => {
                this.listUsers = res.data;
            })
        },

        getActivity() {
              axios.get( `/administration/activity/getActivity/${this.$route.params.id}`)
            .then(res => {
                console.log(res.data)
                    this.fillCreateActivity = res.data;
            })
        },

  }
}
</script>

<style>

</style>