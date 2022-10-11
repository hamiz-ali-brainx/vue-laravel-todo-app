import { createRouter, createWebHistory } from "vue-router";
import Register from "../components/auth/Register.vue";
import Login from "../components/auth/Login.vue";
import TodoList from "../components/todo/TodoList.vue";
import TodoCreate from "../components/todo/TodoCreate.vue";
import TodoDetails from "../components/todo/TodoDetails.vue";
import TodoEdit from "../components/todo/TodoEdit.vue"
import { useStore } from "vuex";

const store = useStore();
const guest = (to, from, next) => {
  if (!localStorage.getItem("token")) {
    return next();
  } else {
    return next("/");
  }
};
const auth = (to, from, next) => {
  if (localStorage.getItem("token")) {
    return next();
  } else {
    return next("/login");
  }
};

const routes = [
  {
    path: "/login",
    name: "Login",
    beforeEnter: guest,
    component: Login,
  },
  {
    path: "/register",
    name: "Register",
    beforeEnter: guest,
    component: Register,
  },
  {
    path: "/",
    name: "dashboard",
    beforeEnter: auth,
    component: TodoList,
  },
  {
    path: "/createtodo",
    name: "CreateTodo",
    beforeEnter: auth,
    component: TodoCreate,
  },

  {
    path: "/detailTodo/:id",
    name: "TodoDetails",
    beforeEnter: auth,
    component: TodoDetails,
    props: true,
  },
  {
    path: "/editTodo/:id",
    name: "TodoEdit",
    beforeEnter: auth,
    component: TodoEdit,
    props: true,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
