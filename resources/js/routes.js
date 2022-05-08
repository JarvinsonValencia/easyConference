import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        { path: '/login', name: 'login', component: require('./components/modules/authenticate/Login.vue').default},
        { path: '/user', name: 'user', component: require('./components/modules/user/index.vue').default, props:true},
        { path: '/client', name: 'client', component: require('./components/modules/client/index.vue').default},
        { path: '/client/edit/:id', name: 'client.edit', component: require('./components/modules/client/EditForm.vue').default},
        { path: '/', name: 'dashboard.index', component: require('./components/modules/dashboard/index.vue').default},
        { path: '/activity', name: 'activity', component: require('./components/modules/activity/Index.vue').default, props:true},
        { path: '/activity/created', name: 'activity.created', component: require('./components/modules/activity/Create.vue').default},
        { path: '/activity/edit/:id', name: 'activity.edit', component: require('./components/modules/activity/EditForm.vue').default, props:true},
        { path: '/meet', name: 'meet', component: require('./components/modules/meet/Index.vue').default, props:true},
        { path: '/meeting/', name: 'meeting', component: require('./components/modules/meet/Meeting.vue').default, props:true},
        { path: '/meet-activity', name: 'meet-activity', component: require('./components/modules/meet/Meet.vue').default},
        { path: '/meet/edit/:id', name: 'meet.edit', component: require('./components/modules/meet/EditForm.vue').default},
        { path: '/user/create', name: 'user.create', component: require('./components/modules/user/Form.vue').default},
        { path: '/user/edit/:id', name: 'user.edit', component: require('./components/modules/user/Edit.vue').default},
    ],
    mode:'history',
    //routes: rutas,
    //linkActiveClass: 'active'
})