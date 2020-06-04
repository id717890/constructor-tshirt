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
          path: '',
          // redirect: '/constructor',
          components: {
            guest: () => import('./views/Home.vue')
          }
        },
        {
          path: 'catalogs',
          name: 'Catalogs',
          components: {
            guest: () => import('./components/Catalog/IndexGuest.vue')
          }
        },
        {
          path: 'news/:id',
          name: 'SingleNews',
          props: {
            guest: true
          },
          components: {
            guest: () => import('./components/News/Single.vue')
          }
        },
        {
          path: 'news',
          name: 'News',
          components: {
            guest: () => import('./components/News/IndexGuest.vue')
          }
        },
        {
          path: 'discount',
          name: 'Discount',
          components: {
            guest: () => import('./components/Discount/IndexGuest.vue')
          }
        },
        {
          path: 'about',
          name: 'About',
          components: {
            guest: () => import('./views/About.vue')
          }
        },
        {
          path: 'albums',
          name: 'Albums',
          components: {
            guest: () => import('./components/Album/IndexGuest.vue')
          }
        },
        {
          path: 'album/:id',
          name: 'AlbumsSingle',
          props: { guest: true },
          components: {
            guest: () => import('./components/Photo/IndexByAlbumGuest.vue')
          }
        },
        {
          path: 'photos',
          name: 'Photos',
          components: {
            guest: () => import('./components/Photo/IndexGuest.vue')
          }
        },
        {
          path: 'videos',
          name: 'Videos',
          components: {
            guest: () => import('./components/Video/IndexGuest.vue')
          }
        },
        {
          path: 'feedbacks',
          name: 'Feedbacks',
          components: {
            guest: () => import('./components/Feedback/IndexGuest.vue')
          }
        },
        {
          path: 'faq',
          name: 'FAQ',
          components: {
            guest: () => import('./components/Faq/IndexGuest.vue')
          }
        },
        {
          path: 'constructor',
          name: 'Constructor',
          components: {
            guest: () => import('./layouts/Constructor.vue')
          }
        }
      ]
    },
    {
      path: '/print_zakaz',
      name: 'PrintZakaz',
      component: () => import('./components/Print/ZakazAll.vue')
    },
    {
      path: '/print_address',
      name: 'PrintAddress',
      component: () => import('./components/Print/AddressMap.vue')
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
      path: '/lk',
      name: 'LK',
      beforeEnter: authGuard,
      redirect: '/lk/types',
      component: () => import('./layouts/Lk.vue'),
      children: [
        {
          path: 'table_sizes',
          beforeEnter: authGuard,
          component: () => import('./components/TableSize/Index.vue')
        },
        {
          path: 'table_size/create',
          beforeEnter: authGuard,
          component: () => import('./components/TableSize/Create.vue')
        },
        {
          path: 'table_size/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/TableSize/Edit.vue')
        },
        {
          path: 'promocodes',
          beforeEnter: authGuard,
          component: () => import('./components/Promocode/Index.vue')
        },
        {
          path: 'promocode/create',
          beforeEnter: authGuard,
          component: () => import('./components/Promocode/Create.vue')
        },
        {
          path: 'promocode/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Promocode/Edit.vue')
        },
        {
          path: 'catalogs',
          beforeEnter: authGuard,
          component: () => import('./components/Catalog/Index.vue')
        },
        {
          path: 'catalog/create',
          beforeEnter: authGuard,
          component: () => import('./components/Catalog/Create.vue')
        },
        {
          path: 'catalog/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Catalog/Edit.vue')
        },
        {
          path: 'home/partner/edit/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Home/HomePartnerEdit.vue')
        },
        {
          path: 'home/partner/create',
          beforeEnter: authGuard,
          component: () => import('./components/Home/HomePartnerCreate.vue')
        },
        {
          path: 'home/slide/edit/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Home/HomeSlideEdit.vue')
        },
        {
          path: 'home/slide/create',
          beforeEnter: authGuard,
          component: () => import('./components/Home/HomeSlideCreate.vue')
        },
        {
          path: 'home',
          beforeEnter: authGuard,
          component: () => import('./components/Home/Index.vue')
        },
        {
          path: 'albums',
          beforeEnter: authGuard,
          component: () => import('./components/Album/Index.vue')
        },
        {
          path: 'album/create',
          beforeEnter: authGuard,
          component: () => import('./components/Album/Create.vue')
        },
        {
          path: 'album/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Album/Edit.vue')
        },
        {
          path: 'faqs',
          beforeEnter: authGuard,
          component: () => import('./components/Faq/Index.vue')
        },
        {
          path: 'faq/create',
          beforeEnter: authGuard,
          component: () => import('./components/Faq/Create.vue')
        },
        {
          path: 'faq/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Faq/Edit.vue')
        },
        {
          path: 'page/about/image/edit/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Page/AboutImageEdit.vue')
        },
        {
          path: 'page/about/image/create',
          beforeEnter: authGuard,
          component: () => import('./components/Page/AboutImageCreate.vue')
        },
        {
          path: 'page/about',
          beforeEnter: authGuard,
          component: () => import('./components/Page/About.vue')
        },
        {
          path: 'feedbacks',
          beforeEnter: authGuard,
          component: () => import('./components/Feedback/Index.vue')
        },
        {
          path: 'feedback/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Feedback/Edit.vue')
        },
        {
          path: 'photos',
          beforeEnter: authGuard,
          component: () => import('./components/Photo/Index.vue')
        },
        {
          path: 'photo/create',
          beforeEnter: authGuard,
          component: () => import('./components/Photo/Create.vue')
        },
        {
          path: 'photo/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Photo/Edit.vue')
        },
        {
          path: 'videos',
          beforeEnter: authGuard,
          component: () => import('./components/Video/Index.vue')
        },
        {
          path: 'video/create',
          beforeEnter: authGuard,
          component: () => import('./components/Video/Create.vue')
        },
        {
          path: 'video/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Video/Edit.vue')
        },
        {
          path: 'news',
          beforeEnter: authGuard,
          component: () => import('./components/News/Index.vue')
        },
        {
          path: 'news/create',
          beforeEnter: authGuard,
          component: () => import('./components/News/Create.vue')
        },
        {
          path: 'news/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/News/Edit.vue')
        },
        {
          path: 'discounts',
          beforeEnter: authGuard,
          component: () => import('./components/Discount/Index.vue')
        },
        {
          path: 'discount/create',
          beforeEnter: authGuard,
          component: () => import('./components/Discount/Create.vue')
        },
        {
          path: 'discount/:id',
          props: true,
          beforeEnter: authGuard,
          component: () => import('./components/Discount/Edit.vue')
        },
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

router.afterEach((to, from, next) => {
  window.scrollTo({ top: 1, left: 0, behavior: 'smooth' })
})

export default router
