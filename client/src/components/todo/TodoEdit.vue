<script setup>
import { onMounted, computed, ref } from "vue";
import { useStore } from "vuex";
import router from "../../router/index";

const store = useStore();
const props = defineProps(["id"]);

const name = ref("");
const description = ref("");

const getTodo = computed(() => {
  return store.state.todo.todos.filter((todo) => todo.id == props.id);
});

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

async function editTodo(e) {
  e.preventDefault();
  await store.dispatch("todo/updateTodo", {
    id: props.id,
    name: name.value,
    description: description.value,
  });

  if (
    store.getters["todo/todoErrors"][0] === "" &&
    store.getters["todo/todoErrors"][1] === ""
  ) {
    store.commit("todo/setSuccess",{
      todoSuccess: "Todo Edited Successfully"
    });
    router.push("/");
  }
}

onMounted(() => {
  name.value = getTodo.value[0].name;
  description.value = getTodo.value[0].description;
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
