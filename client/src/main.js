import Vue from 'vue'
import Router from 'vue-router'
import App from './App.vue'

import Category from './components/categories/Category.vue'
import AddCategory from './components/categories/AddCategory.vue'
import UpdateCategory from './components/categories/UpdateCategory.vue'
import Faqs from './components/faqs/Faqs.vue'

Vue.use(Router)

const router = new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      component: Category,
    },
    {
      path: '/faq-category/:id',
      name: 'faq',
      component: Category,
      props: true
    },
    {
      path: '/faqs',
      name: 'faqs',
      component: Faqs,
      props: true
    },
    {
      path: '/add_category',
      name: 'add_category',
      component: AddCategory
    },
    {
      path: '/update_category/:id',
      name: 'update_category',
      component: UpdateCategory,
      props: true
    },
  ]
})

new Vue({
  el: '#app',
  render: h => h(App),
  router
})
