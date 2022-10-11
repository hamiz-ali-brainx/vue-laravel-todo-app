import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/index.js";
import "./assets/main.css";
import "bootstrap/dist/css/bootstrap.css";
import axios from 'axios';
import store from "./store/store";

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router);
app.use(store);

app.mount("#app");
