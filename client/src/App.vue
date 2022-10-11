<template>
  <Navbar />
  <router-view ></router-view>
</template>

<script setup>
  import Navbar from "./layouts/Navbar.vue";
  import { RouterView } from "vue-router";
</script>
  