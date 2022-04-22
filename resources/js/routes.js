import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        { path: '/login', name: 'login', component: require('./components/modules/authenticate/Login.vue').default},
        { path: '/client', name: 'name', component: require('./components/modules/client/index.vue').default},
        { path: '/', name: 'dashboard.index', component: require('./components/modules/dashboard/index.vue').default},
        { path: '/user', component: require('./components/modules/user/index.vue').default},
        { path: '/user/create', component: require('./components/modules/user/create.vue').default},
        { path: '/user/edit/:id', name: 'user.edit', component: require('./components/modules/user/Edit.vue').default, props:true},
        { path: '/jitsi', component: require('./components/modules/jitsi/Jitsi.vue').default},
        
        
    ],
    mode:'history',
    //routes: rutas,
    //linkActiveClass: 'active'
})