import { createWebHistory,createRouter  } from "vue-router";
import home from './pages/Home.vue';
import forderCreate from './pages/forder/create.vue';


const routes= [
    {
        path: '/',
        name: 'Home',
        component: home,
        meta: {title: 'File Manager'}
    },
    {
        path: '/forders/create',
        name: 'ForderCreate',
        component: forderCreate,
        meta: {title: 'Forder Create'}
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;