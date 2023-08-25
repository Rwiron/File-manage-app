import { createWebHistory,createRouter  } from "vue-router";
import home from './pages/Home.vue';
import forderCreate from './pages/forder/create.vue';
import forderEdit from './pages/forder/Edit.vue';
import fileList from './pages/forder/FileList.vue';



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
    },
    {
        path: '/forders/:id',
        name: 'FileList',
        component: fileList,
        meta: {title: 'File List'}
    },
    {
        path: '/forders/edit/:id',
        name: 'ForderEdit',
        component: forderEdit,
        meta: {title: 'Forder Edit'}
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;