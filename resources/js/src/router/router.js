import Main from "@/pages/Main.vue"
import admin_panel from "@/pages/admin_panel.vue"
// import accesses from "@/components/Accesses.vue"
import { createRouter, createWebHistory } from "vue-router"

const routes = [
    {
        path: '/',
        component: Main,
    },
    {
        path: '/admin_panel',
        name: 'admin_panel',
        component: admin_panel,
        children: [
            {
                path: '/',
                component: admin_panel,
            },
            {
                path: 'accesses',
                component: () => import('@/components/Accesses.vue'),
            },
            {
                path: 'teachers',
                component: () => import('@/components/Teachers.vue'),
            },
            {
                path: 'blogPost',
                component: () => import('@/components/blogPost.vue'),
            },
            {
                path: 'blogTag',
                component: () => import('@/components/blogTag.vue'),
            },
            {
                path: 'podcast',
                component: () => import('@/components/podcast.vue'),
            },
            {
                path: 'grammarPost',
                component: () => import('@/components/grammarPost.vue'),
            },
            {
                path: 'grammarLevel',
                component: () => import('@/components/grammarLevel.vue'),
            },
            {
                path: 'videoCategory',
                component: () => import('@/components/videoCategory.vue'),
            },
            {
                path: 'video',
                component: () => import('@/components/video.vue'),
            },

        ],
    }
]

const router = createRouter({
    routes,
    history: createWebHistory('/'),
})

export default router;
