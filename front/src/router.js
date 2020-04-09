import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'Constructor',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('./layouts/Constructor.vue')
    },
    {
      path: '/lk',
      name: 'LK',
      redirect: '/lk/types',
      component: () => import('./layouts/Lk.vue'),
      children: [
        {
          path: 'types',
          component: () => import('./components/Type/Index.vue')
        },
        {
          path: 'type/create',
          component: () => import('./components/Type/Create.vue')
        },
        {
          path: 'type/:id',
          props: true,
          component: () => import('./components/Type/Edit.vue')
        }
      ]
    }
  ]
})
