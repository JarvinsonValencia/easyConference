<template>
  <div class="login-box">
    <div class="login-logo">
      <router-link :to="{name: 'login'}">Easy Conference</router-link>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg" >Iniciar sesión</p>
        <form method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" @keyup.enter="login" v-model="fillLogin.email" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              @keyup.enter="login" 
              v-model="fillLogin.password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
        </form>
        <div class="row">
            <div class="cold-md-12">
                <span v-if="error">
                    <div v-for="(e, index) in msgError" :key="index" v-text="e" class="callout callout-danger"></div>
                </span>
            </div>
        </div>
        <div class="social-auth-links text-center mb-3">
          <button  class="btn btn-flat btn-block btn-info" @click.prevent="login" v-loading.fullscreen.lock="fullscreenLoading">
             Iniciar sesión
          </button>
        </div>
        <p class="mb-0">
          <a href="#" class="text-center"
            >Register a new membership</a
          >
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return {
                fillLogin: {
                email: '',
                password: ''
            },
            fullscreenLoading: false,
            listRolPermitByUser: [],
            listRolPermitByUserFilter: [],
            error: 0,
            msgError: []
        }
    },
    methods: {
        login(){
            if (this.validateLogin()) {
                    return;
            }
             var url = '/authenticate/login'
                axios.post(url, {
                    'email' : this.fillLogin.email,
                    'password': this.fillLogin.password
                }).then(response => {
                    console.log(response.data)
                    if (response.data.code == 401) {
                       this.loginFailed();
                    }
                    if (response.data.code == 200) {
                        this.loginSuccess();
                       // this.getListarRolPermisosByUsuario(response.data.authUser)
                    }
                    // setTimeout(() => {
                    //     loading.close()
                    // }, 2000)
                })
        },
        validateLogin() {
                this.error = 0;
                this.msgError = [];

                if (!this.fillLogin.email) {
                    this.msgError.push('El correo electrónico es un campo obligatorio')
                }
                if (!this.fillLogin.password) {
                    this.msgError.push('La contraseña es un campo obligatorio')
                }
                if(this.msgError.length){
                    this.error = 1;
                }
                return this.error;
        },
        loginFailed(){
                this.error = 0;
                this.msgError = [];
                this.msgError.push('Usuario o contraseña incorrectos');
                this.fillLogin.password = '';
                if(this.msgError.length){
                    this.error = 1;
                }
                return this.error;
        },
        loginSuccess(){
                this.$router.push({name: 'dashboard.index'})
                location.reload();
        }
    }
        
};
</script>

<style>
</style>