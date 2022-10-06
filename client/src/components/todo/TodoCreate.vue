<script setup>
import { ref } from "vue";
import axios from "axios";
import router from "../../router/index";
const name = ref("");
const description = ref("");
const errorName = ref("");
const errorDescription = ref("");

function onCreateTodo(e) {
  e.preventDefault();
  axios
    .post(
      "http://127.0.0.1:8000/api/store-data",
      {
        name: name.value,
        description: description.value,
      },
      {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      }
    )
    .then((response) => {
      //todos.value = response.data.todo;
      console.log(response.data.Sucess);
      router.push("/");
    })
    .catch((err) => {
      console.log("ashgdjs");
      console.log(err);
      if (!(err.response.data.errors.description === undefined)) {
        errorDescription.value = err.response.data.errors.description[0];
      }
      if (!(err.response.data.errors.name === undefined)) {
        errorName.value = err.response.data.errors.name[0];
      }
    });
}
</script>

<template>
  <div class="container">
    <form action="store-data" method="post" class="mt-4 p-4">
      <div class="form-group m-3">
        <label for="name">Todo Name</label>
        <input type="text" class="form-control" name="name" v-model="name" />
        <span class="text-danger" v-if="errorName">{{ errorName }}</span>
      </div>
      <div class="form-group m-3">
        <label for="description">Todo Description</label>
        <textarea
          class="form-control"
          name="description"
          rows="3"
          v-model="description"
        ></textarea>
        <span class="text-danger" v-if="errorDescription">{{
          errorDescription
        }}</span>
      </div>
      <div class="form-group m-3">
        <input
          type="submit"
          class="btn btn-primary float-end"
          @click="onCreateTodo"
          value="Submit"
        />
      </div>
    </form>
  </div>
</template>
