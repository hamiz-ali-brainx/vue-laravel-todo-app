<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";

const todos = ref([]);

onMounted(() => {
  axios
    .get("http://127.0.0.1:8000/api/todo", {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
    .then((response) => {
      todos.value = response.data.todo;
      console.log(todos.value);
    });
});
</script>

<template>
  <div class="row mt-3">
    <div class="container">
      <h1 class="text-center">Welcome!</h1>
    </div>
    <div class="col-12 align-self-center">
      <div class="container" v-if="todos.length > 0">
        <ul class="list-group">
          <li class="list-group-item" v-for="todo in todos" :key="todo.id">
            <router-link
              style="text-decoration: none; color: black"
              :to="{
                name: 'TodoDetails',
                params: { id: todo.id },
              }"
              >{{ todo.name }}
            </router-link>
          </li>
        </ul>
      </div>
      <div class="container" v-else>
        <h1 class="text-center">Sad No Todo Here!</h1>
      </div>
    </div>
  </div>
</template>

<style lang="css" scoped></style>
