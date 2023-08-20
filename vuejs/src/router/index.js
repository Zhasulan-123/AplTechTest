import { createRouter, createWebHistory } from 'vue-router';
import authAdmin from "@/api/auth.admin";

const routes = [
  {
    path: '/',
    name: 'HomeView',
    meta: { title: 'Интернет магазин' },
    component: () => import('@/views/HomeView.vue')
  },
  {
    path: '/login',
    name: 'Login',
    meta: { title: 'Авторизация' },
    component: () => import('@/views/admin/Login.vue')
  },
  {
    path: '/registration',
    name: 'Registration',
    meta: { title: 'Регистрация' },
    component: () => import('@/views/admin/Registration.vue')
  },
  {
    path: '/admin',
    name: 'Admin',
    meta: { title: 'Администратор', admin: true },
    component: () => import('@/views/admin/Admin.vue')
  },
  {
    path: '/admin/orders',
    name: 'Orders',
    meta: { title: 'Заказы', admin: true },
    component: () => import('@/views/admin/Orders.vue')
  },
  {
    path: '/admin/edit/:id',
    props: true,
    name: 'ProductEdit',
    meta: { title: 'Редактирование продукта', admin: true },
    component: () => import('@/views/admin/ProductEdit.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  document.title = `${to.meta.title}`;
  const currentAdmin = authAdmin.isLoggedIn();
  const reqAuthAdmin = to.matched.some(record => record.meta.admin);
  if (reqAuthAdmin && !currentAdmin) {
    next('/login')
  } else {
    next()
  }
});

export default router
