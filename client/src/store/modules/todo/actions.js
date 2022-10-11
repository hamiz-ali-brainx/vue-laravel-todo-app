import axios from "axios";
export default {
  async getAllTodos(context) {
   await axios
      .get("http://127.0.0.1:8000/api/todo", {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      })
      .then((response) => {
        context.commit("setTodos", {
          todos: response.data.todo,
        });
      });
  },
  async createTodo(context, payload){
    await axios
    .post(
      "http://127.0.0.1:8000/api/store-data",
      {
        name: payload.name,
        description: payload.description,
      },
      {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      }
    ).then((response)=>{
      context.commit("setNameError", {
        nameError: "",
      });
      context.commit("setDescriptionError", {
        descriptionError: "",
      });
    }).catch((err)=>{
        if(err.response.data.errors.description !== undefined){
          context.commit("setDescriptionError", {
            descriptionError: err.response.data.errors.description[0],
          });
        }

        if(err.response.data.errors.name !== undefined){
          context.commit("setNameError", {
            nameError: err.response.data.errors.name[0],
          });
        }
    });
  },
  async updateTodo(context, payload){
    await axios
    .post(
      `http://127.0.0.1:8000/api/update/${payload.id}`,
      {
        name: payload.name,
        description: payload.description,
      },
      {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      }
    ).then((response)=>{
      context.commit("setNameError", {
        nameError: "",
      });
      context.commit("setDescriptionError", {
        descriptionError: "",
      });
    }).catch((err)=>{
        if(err.response.data.errors.description !== undefined){
          context.commit("setDescriptionError", {
            descriptionError: err.response.data.errors.description[0],
          });
        }

        if(err.response.data.errors.name !== undefined){
          context.commit("setNameError", {
            nameError: err.response.data.errors.name[0],
          });
        }
    });
  },
  async deleteTodo(context,payload){
    axios
    .get(`http://127.0.0.1:8000/api/delete/${payload.id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
  }
};
