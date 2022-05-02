<template>
    <div class="container">
            <b-modal
                    class="modal"
                    id="modal-edit-user"
                    ref="modal"
                    size="lg"
                    title="Editar Usuario"
                    ok-title="Aceptar"
                    @show="resetModal"
                    @hidden="resetModal"
                    @ok="handleOk"
                   
                >
                <form ref="form" @submit.stop.prevent="handleSubmit">
                    <b-row>
                        <b-col cols="12" md="6">
                            <b-form-group
                                label="Nombre *"
                                label-for="name-input"
                                invalid-feedback="Debe completar el campo"
                                :state="nameState"
                                >
                                <b-form-input
                                    id="name-input"
                                    v-model="fillCreateUser.name"
                                    :state="nameState"
                                    required
                                ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group
                                label="Documento *"
                                label-for="document-input"
                                invalid-feedback="Debe ingresar un número de documento"
                                :state="nameState"
                                >
                                <b-form-input
                                    id="document-input"
                                    v-model="fillCreateUser.document"
                                    type="number"
                                    :state="nameState"
                                    required
                                ></b-form-input>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="12" md="6">
                            <b-form-group
                                label="Email *"
                                label-for="email-input"
                                invalid-feedback="Debe ingresar un correo electrónico"
                                :state="nameState"
                                >
                                <b-form-input
                                    id="email-input"
                                    v-model="fillCreateUser.email"
                                    type="email"
                                    :state="nameState"
                                    required
                                ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group
                                label="Usuario "
                                label-for="username-input"
                                invalid-feedback="Debe ingresar un nombre de usuario"
                                :state="nameState"
                                >
                                <b-form-input
                                    id="username-input"
                                    v-model="fillCreateUser.username"
                                    type="text"
                                    :state="nameState"
                                    required
                                ></b-form-input>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="12" md="6">
                            <b-form-group
                                label="Teléfono "
                                label-for="phone-input"
                                invalid-feedback="Debe ingresar un número de teléfono"
                                :state="nameState"
                                >
                                <b-form-input
                                    id="phone-input"
                                    v-model="fillCreateUser.phone"
                                    :state="nameState"
                                    required
                                ></b-form-input>
                            </b-form-group>
                        </b-col>
                        <b-col cols="12" md="6">
                            <b-form-group
                                label="Contraseña *"
                                label-for="password-input"
                                invalid-feedback="Debe ingresar un nombre de usuario"
                                :state="nameState"
                                >
                                <b-form-input
                                    id="password-input"
                                    v-model="fillCreateUser.password"
                                    type="password"
                                    :state="nameState"
                                    required
                                ></b-form-input>
                            </b-form-group>
                        </b-col>
                    </b-row>
                        <b-form-group
                            label="Rol *"
                            label-for="role-input"
                            invalid-feedback="Debe ingresar una contraseña"
                            :state="nameState"
                            >
                            <b-form-select class="mb-3" v-model="fillCreateUser.role_id" id="role-input" >
                            <b-form-select-option v-for="(item, index) in listRol" :key="index" :value="item.id">{{item.name}}</b-form-select-option>
                            </b-form-select>
                        </b-form-group>
                </form>
        </b-modal>
    </div>
</template>
<script>
export default {
    
    data () {
        return {
            fillCreateUser: {
                name: '',
                document: '',
                email: '',
                phone: '',
                username: '',
                password: '',
                role_id: ''
            },
            listRol: [],
            name: '',
            nameState: null,
            submittedNames: []
        }
    },
    mounted(){
        this.getlistRol();
    },
    props: ['showModal'],
    methods: {
        setRegisterUser(){
          console.log(this.fillCreateUser.role_id)
            const params = {
                name: this.fillCreateUser.name,
                document: this.fillCreateUser.document,
                email: this.fillCreateUser.email,
                username: this.fillCreateUser.username,
                phone: this.fillCreateUser.phone,
                password: this.fillCreateUser.password,
                role_id: parseInt(this.fillCreateUser.role_id),
                
                
            }
    
            axios.post('/administration/user/setCreateUser', params)
                .then(res => {
                    this.listRol.push(res.data)
                    Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
       },
        getlistRol(){
                axios.get('/administration/rol/getListRoles')
                .then(res => {
                    this.listRol = res.data;
                    this.$router.push('user');
                })
        },
        checkFormValidity() {
            const valid = this.$refs.form.checkValidity()
            this.nameState = valid
            return valid
        },
        resetModal() {
            this.name = '';
            this.document = '';
            this.email = '';
            this.nameState = null
        },
        handleOk(bvModalEvent) {
            // Prevent modal from closing
            this.setRegisterUser()
            bvModalEvent.preventDefault()
            // Trigger submit handler
            this.handleSubmit()
        },
        handleSubmit() {
          // Exit when the form isn't valid
            if (!this.checkFormValidity()) {
            return
        }
       
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('modal-edit-user')
        })
      }
    } 
}
</script>

<style>
    /* .modal {
        background-color: rgba(255, 255, 255)  !important;
        
    } */
  
</style>