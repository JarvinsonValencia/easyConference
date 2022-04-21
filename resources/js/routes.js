import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        { path: '/login', name: 'login', component: require('./components/modules/authenticate/Login.vue').default},
        { path: '/category', component: require('./components/modules/category/index.vue').default},
        { path: '/client', component: require('./components/modules/client/index.vue').default},
        { path: '/', name: 'dashboard.index', component: require('./components/modules/dashboard/index.vue').default},
        { path: '/order', component: require('./components/modules/order/index.vue').default},
        { path: '/permission', component: require('./components/modules/permission/index.vue').default},
        { path: '/product', component: require('./components/modules/product/index.vue').default},
        { path: '/report', component: require('./components/modules/report/index.vue').default},
        { path: '/role', component: require('./components/modules/role/index.vue').default},
        { path: '/person', component: require('./components/modules/user/index.vue').default},
        { path: '/person/create', component: require('./components/modules/user/create.vue').default},
        { path: '/person/edit/:id', name: 'person.edit', component: require('./components/modules/user/Edit.vue').default, props:true},
        { path: '/jitsi', component: require('./components/modules/jitsi/Jitsi.vue').default},
        { path: '/user/create', component: require('./components/modules/user/Register.vue').default},
        
    ],
    mode:'history',
    //routes: rutas,
    //linkActiveClass: 'active'
})