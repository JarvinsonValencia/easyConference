<template>
  <div>
    <b-form @submit.stop.prevent="onSubmit">
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
            <b-form-group id="example-input-group-2" label="Rol " label-for="example-input-2">
              <b-form-select
                id="example-input-2"
                name="example-input-2"
                v-model="$v.formUser.role_id.$model"
                :options="foods"
                :state="validateState('role_id')"
                aria-describedby="input-2-live-feedback"
              ></b-form-select>

              <b-form-invalid-feedback id="input-2-live-feedback">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
       </b-row>
         <b-row>
          <b-col cols="12" md="6">
            <b-form-group id="example-input-group-1" label="Documento *" label-for="example-input-1">
                  <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    type="number"
                    v-model="$v.formUser.document.$model"
                    :state="validateState('document')"
                    aria-describedby="input-1-live-feedback"
                  ></b-form-input>

                  <b-form-invalid-feedback
                    id="input-1-live-feedback"
                  >Este campo es requerido.</b-form-invalid-feedback>
              </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group id="example-input-group-2" label="Correo electrónico " label-for="example-input-2">
                   <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    type="email"
                    v-model="$v.formUser.email.$model"
                    :state="validateState('email')"
                    aria-describedby="input-1-live-feedback"
                  ></b-form-input>

              <b-form-invalid-feedback id="input-2-live-feedback">Debe ingresar un email válido.</b-form-invalid-feedback>
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
                    aria-describedby="input-1-live-feedback"
                  ></b-form-input>

                  <b-form-invalid-feedback
                    id="input-1-live-feedback"
                  >Este campo es requerido.</b-form-invalid-feedback>
              </b-form-group>
          </b-col>
          <b-col cols="12" md="6">
            <b-form-group id="example-input-group-2" label="Usuario " label-for="example-input-2">
                   <b-form-input
                    id="example-input-1"
                    name="example-input-1"
                    v-model="$v.formUser.username.$model"
                    :state="validateState('username')"
                    aria-describedby="input-1-live-feedback"
                  ></b-form-input>

              <b-form-invalid-feedback id="input-2-live-feedback">Este campo debe tener al menos 3 caracteres.</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
       </b-row>
       

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button class="ml-2" @click="resetForm()">Reset</b-button>
    </b-form>
  </div>
</template>

<style>

</style>

<script>
import { validationMixin } from "vuelidate";
import { required, email, numeric, minLength } from "vuelidate/lib/validators";

export default {
  //mixins: [validationMixin],
  data() {
    return {
      foods: [
        { value: null, text: "Choose..." },
        { value: "apple", text: "Apple" },
        { value: "orange", text: "Orange" }
      ],
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
  validations: {
    formUser: {
      role_id: {required},
      name: {required, minLength: minLength(3)},
      document: { required, numeric },
      email: { required, email },
      phone: { required },
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
        name: null,
        food: null
      };

      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    onSubmit() {
      this.$v.formUser.$touch();
      if (this.$v.formUser.$anyError) {
        return;
      }
        this.setRegisterUser()
      alert("Form submitted!");
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
                   // this.listRol.push(res.data)
                    console.log(res.data)
            })
       },
  }
};
</script>