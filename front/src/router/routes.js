
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') },
      { path: '/catalogue', component: () => import('pages/CatalogPage.vue') },
      { path: '/catalogue/:tag', component: () => import('pages/SpecialTagPage.vue') },
      { path: '/contact', component: () => import('pages/ContactPage.vue') },
      { path: '/contact/:id', component: () => import('pages/ContactPage.vue') },
      { path: '/produit/:id', component: () => import('pages/ProductPage.vue') },



    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
