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
      redirect: '/lk/',
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
          path: 'number_sizes',
          component: () => import('./components/NumberSize/Index.vue')
        },
        {
          path: 'number_size/create',
          component: () => import('./components/NumberSize/Create.vue')
        },
        {
          path: 'number_size/:id',
          props: true,
          component: () => import('./components/NumberSize/Edit.vue')
        },
        {
          path: 'text_sizes',
          component: () => import('./components/TextSize/Index.vue')
        },
        {
          path: 'text_size/create',
          component: () => import('./components/TextSize/Create.vue')
        },
        {
          path: 'text_size/:id',
          props: true,
          component: () => import('./components/TextSize/Edit.vue')
        },
        {
          path: 'logo_sizes',
          component: () => import('./components/LogoSize/Index.vue')
        },
        {
          path: 'logo_size/create',
          component: () => import('./components/LogoSize/Create.vue')
        },
        {
          path: 'logo_size/:id',
          props: true,
          component: () => import('./components/LogoSize/Edit.vue')
        },
        {
          path: 'logo_types',
          component: () => import('./components/LogoType/Index.vue')
        },
        {
          path: 'logo_type/create',
          component: () => import('./components/LogoType/Create.vue')
        },
        {
          path: 'logo_type/:id',
          props: true,
          component: () => import('./components/LogoType/Edit.vue')
        },
        {
          path: 'logos',
          component: () => import('./components/Logo/Index.vue')
        },
        {
          path: 'logo/create',
          component: () => import('./components/Logo/Create.vue')
        },
        {
          path: 'logo/:id',
          props: true,
          component: () => import('./components/Logo/Edit.vue')
        },
        {
          path: 'colors',
          component: () => import('./components/Color/Index.vue')
        },
        {
          path: 'color/create',
          component: () => import('./components/Color/Create.vue')
        },
        {
          path: 'color/:id',
          props: true,
          component: () => import('./components/Color/Edit.vue')
        },
        {
          path: 'color/size/:id',
          props: true,
          component: () => import('./components/Color/Size.vue')
        },
        {
          path: 'models',
          component: () => import('./components/Model/Index.vue')
        },
        {
          path: 'model/create',
          component: () => import('./components/Model/Create.vue')
        },
        {
          path: 'model/:id',
          props: true,
          component: () => import('./components/Model/Edit.vue')
        },
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
