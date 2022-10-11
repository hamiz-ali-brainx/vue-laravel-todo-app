<script setup>
import { ref, computed, onBeforeMount } from "vue";
import { useStore } from "vuex";
import router from "../../router";

const store = useStore();
const name = ref("");
const description = ref("");

const errorName = computed(() => {
  return store.state.todo.todoNameError.length > 0
    ? store.state.todo.todoNameError
    : "";
});

const errorDescription = computed(() => {
  return store.state.todo.todoDescriptionError.length > 0
    ? store.state.todo.todoDescriptionError
    : "";
});



async function onCreateTodo(e) {
  e.preventDefault();

  await store.dispatch("todo/createTodo", {
    name: name.value,
    description: description.value,
  });

  if (
    store.getters["todo/todoErrors"][0] === "" &&
    store.getters["todo/todoErrors"][1] === ""
  ) {
    store.commit("todo/setSuccess",{
      todoSuccess: "Todo Created Successfully"
    });
    router.push("/");
  }
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
