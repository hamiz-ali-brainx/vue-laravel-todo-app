<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import router from "../../router/index";
const props = defineProps(["id"]);
const name = ref("");
const description = ref("");
const errorName = ref("");
const errorDescription = ref("");

function editTodo(e) {
  e.preventDefault();
  axios
    .post(
      `http://127.0.0.1:8000/api/update/${props.id}`,
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
      console.log(response);
      router.push("/");
    })
    .catch((err) => {
      if (!(err.response.data.errors.description === undefined)) {
        errorDescription.value = err.response.data.errors.description[0];
      }
      if (!(err.response.data.errors.name === undefined)) {
        errorName.value = err.response.data.errors.name[0];
      }
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
      //console.log(response);
      name.value = response.data.todo[0].name;
      description.value = response.data.todo[0].description;
    });
});
</script>

<template>
  <div class="container">
    <form action="/update/{{$todos->id}}" method="post" class="mt-4 p-4">
      <div class="form-group m-3">
        <label for="name">Todo Name</label>
        <input type="text" class="form-control" name="name" v-model="name" />
        <span class="text-danger" v-if="errorName">{{ errorName }}</span>
      </div>
      <div class="form-group m-3">
        <label for="description">Todo Description</label>
        <textarea
          class="form-control"
          v-model="description"
          name="description"
          rows="3"
        >
        </textarea>
        <span class="text-danger" v-if="errorDescription">{{
          errorDescription
        }}</span>
      </div>
      <div class="form-group m-3">
        <input
          type="submit"
          class="btn btn-primary float-end"
          @click="editTodo"
          value="Submit"
        />
      </div>
    </form>
  </div>
</template>
