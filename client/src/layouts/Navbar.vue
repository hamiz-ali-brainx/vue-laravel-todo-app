<script setup>
import { RouterLink } from "vue-router";
import { onMounted, ref } from "vue";
import axios from "axios";

const toggleNav = ref(true);

onMounted(() => {
  console.log(toggleNav.value);
  if (!localStorage.getItem("token")) {
    toggleNav.value = true;
  }
  else toggleNav.value = false;
});

function handleLogout(e) {
  console.log("asdgas");
  axios
    .get("http://127.0.0.1:8000/api/logout", {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
    .then((response) => {
      window.location.reload();
      localStorage.clear();
      toggleNav.value=false;
      console.log(response);
    });
}
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
      <a class="navbar-brand" href="#">Vue</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto" v-if="toggleNav">
          <li class="nav-item">
            <router-link class="nav-link" to="Register"> Register </router-link>
          </li>
          <li>
            <router-link class="nav-link" to="Login"> Login </router-link>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto" v-else>
          <li class="nav-item">
            <router-link class="nav-link" to="/createtodo"
              ><span class="btn btn-primary"> Create Todo </span></router-link
            >
          </li>
          <li>
            <router-link class="nav-link" to="/"
              ><span class="btn btn-primary" @click="handleLogout">
                Logout
              </span></router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
