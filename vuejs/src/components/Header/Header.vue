<template>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
      <div class="container-fluid">
        <router-link class="navbar-brand" to="/">Apl Tech </router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="justify-content-end">
          <ul class="nav">
              <li class="nav-item">
                  <router-link class="nav-link" to="/registration">Регистрация</router-link>
              </li>
              <li class="nav-item">
                  <router-link class="nav-link" to="/login">Вход</router-link>
              </li>
          </ul>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    name: "Header",
  }
  </script>