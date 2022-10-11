import {createStore } from 'vuex';
import auth from './modules/auth/index';
import todo from './modules/todo/index';
const store = createStore({
    modules: {
        auth,
        todo
    }
})


export default store;