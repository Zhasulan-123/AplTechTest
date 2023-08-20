<template>
    <nav class="navbar bg-primary navbar-expand-lg border-bottom border-body" data-bs-theme="dark">
      <div class="container-fluid">
        <router-link class="navbar-brand" to="/admin">Apl Tech панель управление</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="justify-content-end">
          <ul class="nav">
              <li class="nav-item">
                  <router-link class="nav-link text-white" to="/admin/orders">Заказы</router-link>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-white" href="#" @click="logout">Выход</a>
              </li>
          </ul>
        </div>
      </div>
    </nav>
</template>
  
<script>
  export default {
    name: "Header",
    methods: {
        logout() {
            localStorage.removeItem('ACCESS_TOKEN');
        },
    },
  }
</script>