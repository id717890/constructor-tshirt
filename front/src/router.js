import Vue from 'vue'
import Router from 'vue-router'
import authGuard from './plugins/auth-guard'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'Root',
      component: () => import('./layouts/Guest.vue'),
      children: [
        {
          path: '/',
          redirect: '/constructor',
          name: 'Home',
          components: {
            guest: () => import('./views/Home.vue')
          }
        },
        {
          path: '/about',
          name: 'About',
          components: {
            guest: () => import('./views/About.vue')
          }
        },
        {
          path: '/photos',
          name: 'Photos',
          components: {
            guest: () => import('./views/Photogallery.vue')
          }
        },
        {
          path: '/videos',
          name: 'Videos',
          components: {
            guest: () => import('./views/Videogallery.vue')
          }
        },
        {
          path: '/feedbacks',
          name: 'Feedbacks',
          components: {
            guest: () => import('./views/Feedback.vue')
          }
        },
        {
          path: '/faq',
          name: 'FAQ',
          components: {
            guest: () => import('./views/Faq.vue')
          }
        }
      ]
    },
    {
      path: '/login',
      name: 'Login',
      component: () => import('./components/Auth/Login.vue')
    },
    {
      path: '/resetpassword',
      name: 'ResetPassword',
      component: () => import('./components/Auth/ResetPassword.vue')
    },
    {
      path: '/constructor',
      name: 'Constructor',
      // redirect: '/lk/',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      // component: () => import('./layouts/ConstructorEmpty.vue')
      component: () => import('./layouts/Constructor.vue')
    },
    {
      path: '/lk',
      name: 'LK',
      beforeEnter: authGuard,
      redirect: '/lk/types',
      component: () => import('./layouts/Lk.vue'),
      children: [
        {
          path: 'number_sizes',
          beforeEnter: authGuard,
          component: () => import('./components/NumberSize/Index.vue')
        },
        // ПЕРЕНЕСЕНО В ГЛАВНУЮ ТАБЛИЦУ
        // {
        //   path: 'number_size/create',
        //   component: () => import('./components/NumberSize/Create.vue')
        // },
        // {
        //   path: 'number_size/:id',
        //   props: true,
        //   component: () => import('./components/NumberSize/Edit.vue')
        // },
        {
          path: 'text_sizes',
          beforeEnter: authGuard,
          component: () => import('./components/TextSize/Index.vue')
        },
        // ПЕРЕНЕСЕНО В ГЛАВНУЮ ТАБЛИЦУ
        // {
        //   path: 'text_size/create',
        //   component: () => import('./components/TextSize/Create.vue')
        // },
        // {
        //   path: 'text_size/:id',
        //   props: true,
        //   component: () => import('./components/TextSize/Edit.vue')
        // },
        {
          path: 'logo_sizes',
          beforeEnter: authGuard,
          component: () => import('./components/LogoSize/Index.vue')
        },
        {
          path: 'logo_size/create',
          beforeEnter: authGuard,
          component: () => import('./components/LogoSize/Create.vue')
        },
        {
          path: 'logo_size/:id',
          beforeEnter: authGuard,
          props: true,
          component: () => import('./components/LogoSize/Edit.vue')
        },
        // ПЕРЕНЕСЕНО В РАЗМЕРЫ ЛОГО
        // {
        //   path: 'logo_types',
        //   component: () => import('./components/LogoType/Index.vue')
        // },
        // {
        //   path: 'logo_type/create',
        //   component: () => import('./components/LogoType/Create.vue')
        // },
        // {
        //   path: 'logo_type/:id',
        //   props: true,
        //   component: () => import('./components/LogoType/Edit.vue')
        // },
        {
          path: 'logos',
          beforeEnter: authGuard,
          component: () => import('./components/Logo/Index.vue')
        },
        {
          path: 'logo/create',
          beforeEnter: authGuard,
          component: () => import('./components/Logo/Create.vue')
        },
        {
          path: 'logo/:id',
          beforeEnter: authGuard,
          props: true,
          component: () => import('./components/Logo/Edit.vue')
        },
        // ПЕРЕНЕСЕНО В МОДЕЛИ
        // {
        //   path: 'colors',
        //   component: () => import('./components/Color/Index.vue')
        // },
        // {
        //   path: 'color/create',
        //   component: () => import('./components/Color/Create.vue')
        // },
        // {
        //   path: 'color/:id',
        //   props: true,
        //   component: () => import('./components/Color/Edit.vue')
        // },
        // {
        //   path: 'color/size/:id',
        //   props: true,
        //   component: () => import('./components/Color/Size.vue')
        // },
        {
          path: 'model/:model_id/color/size/:id',
          beforeEnter: authGuard,
          props: true,
          component: () => import('./components/Color/Size.vue')
        },
        {
          path: 'models',
          beforeEnter: authGuard,
          component: () => import('./components/Model/Index.vue')
        },
        {
          path: 'model/create',
          beforeEnter: authGuard,
          component: () => import('./components/Model/Create.vue')
        },
        {
          path: 'model/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Model/Edit.vue')
        },
        {
          path: 'types',
          beforeEnter: authGuard,
          component: () => import('./components/Type/Index.vue')
        },
        {
          path: 'type/create',
          beforeEnter: authGuard,
          component: () => import('./components/Type/Create.vue')
        },
        {
          path: 'type/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Type/Edit.vue')
        }
      ]
    }
  ]
})

// router.beforeEach((to, from, next) => {
//   let credetnrials = Vue.auth.getCredentials()
//   if (credetnrials !== null && credetnrials !== undefined) {
//     if (to.matched.some(x => x.meta.protected)) {
//       next('/lk')
//     } else next()
//   } else {
//     next()
//   }
// })

export default router
