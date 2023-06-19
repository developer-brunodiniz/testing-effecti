// Composables
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/default/Default.vue'),
    children: [
      {
        path: '/status',
        name: 'Listar Status',
        component: () => import('@/views/Status/Index.vue')
      },
      {
        path: '/empresas',
        name: 'Listar Empresas',
        component: () => import('@/views/Empresas/Index.vue')
      },
      {
        path: '/modalidades',
        name: 'Listar Modalidades',
        component: () => import('@/views/Modalidades/Index.vue')
      },
      {
        path: '/licitacoes',
        name: 'Listar Licitações',
        component: () => import('@/views/Licitacoes/Index.vue')
      },
      {
        path: '/',
        name: 'Página inicial',
        component: () => import('@/views/Licitacoes/Index.vue')
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
