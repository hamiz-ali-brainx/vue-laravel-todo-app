<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import router from "../../router/index"
const props = defineProps(["id"]);

const name = ref("");
const description = ref("");

function deleteTodo(e) {
  e.preventDefault();
  axios
    .get(`http://127.0.0.1:8000/api/delete/${props.id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
    .then((response) => {
      console.log(response);
      router.push("/");

      
  //    name.value = response.data.todo[0].name;
      //description.value = response.data.todo[0].description;
      //todos.value = response.data.todo;
      //console.log(todos.value);
    });
}
onMounted(() => {
  axios
    .get(`http://127.0.0.1:8000/api/details/${props.id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
    .then((response) => {
      console.log(response.data.todo);
      name.value = response.data.todo[0].name;
      description.value = response.data.todo[0].description;
      //todos.value = response.data.todo;
      //console.log(todos.value);
    });
});
</script>

<template>
  <div class="card text-center mt-5">
    <div class="card-header">
      <b>TODO DETAILS</b>
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ name }}</h5>
      <p class="card-text">{{ description }}</p>
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
