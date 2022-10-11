<template>
  <div class="row mt-3">
    <span class="alert-success alert" v-if="success">
      {{ success }}
    </span>
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
                params: { id: todo.id }
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

<script setup>
import { onMounted, computed } from "vue";
import { useStore } from "vuex";

const store = useStore();
const todos = computed(() => {
  return store.state.todo.todos;
});

const success = computed(() => {
  return store.state.todo.todoSuccess.length > 0
    ? store.state.todo.todoSuccess
    : "";
});





onMounted(() => {
  store.dispatch("todo/getAllTodos");
  console.log(todos);
});
</script>
