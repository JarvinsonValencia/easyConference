import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        { path: '/login', name: 'login', component: require('./components/modules/authenticate/Login.vue').default},
        { path: '/user', component: require('./components/modules/user/index.vue').default},
        { path: '/client', name: 'client', component: require('./components/modules/client/index.vue').default},
        { path: '/', name: 'dashboard.index', component: require('./components/modules/dashboard/index.vue').default},
        { path: '/activity', name: 'activity', component: require('./components/modules/activity/Index.vue').default},
        { path: '/activity/created', name: 'activity.created', component: require('./components/modules/activity/Create.vue').default},
        { path: '/meet', name: 'meet', component: require('./components/modules/meet/Index.vue').default, props:true},
        { path: '/meeting/', name: 'meeting', component: require('./components/modules/meet/Meeting.vue').default, props:true},
        { path: '/meet-activity', name: 'meet-activity', component: require('./components/modules/meet/Meet.vue').default},
        { path: '/user/create', name: 'user.create', component: require('./components/modules/user/Form.vue').default},
    ],
    mode:'history',
    //routes: rutas,
    //linkActiveClass: 'active'
})