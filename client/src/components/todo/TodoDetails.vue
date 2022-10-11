<script setup>
import { computed, onMounted } from "vue";
import { useStore } from "vuex";
import router from "../../router";

const store = useStore();
const props = defineProps(["id"]);

const getTodo = computed(() => {
  return store.state.todo.todos.filter((todo) => todo.id == props.id);
});

async function deleteTodo(e){
  e.preventDefault();
  await store.dispatch("todo/deleteTodo", {
    id: props.id
  });
  router.push("/");
  store.commit("todo/setSuccess",{
      todoSuccess: "Todo Deleted Successfully"
    });
}

</script>
<template>
  <div class="card text-center mt-5">
    <div class="card-header">
      <b>TODO DETAILS</b>
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ getTodo[0].name }}</h5>
      <p class="card-text">{{ getTodo[0].description }}</p>
      <router-link
        style="text-decoration: none; color: black"
        :to="{
          name: 'TodoEdit',
          params: { id: id },
        }"
        ><span class="btn btn-primary btn-lg">Edit</span></router-link
      >
      <a style="margin: 2em"
        ><span class="btn btn-danger btn-lg" @click="deleteTodo">Delete</span></a
      >
    </div>
  </div>
</template>