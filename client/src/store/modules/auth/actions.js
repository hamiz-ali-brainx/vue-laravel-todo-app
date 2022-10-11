import axios from "axios";

export default {
  async login(context, payload) {
    await axios
      .post("http://127.0.0.1:8000/api/login/post", {
        email: payload.email,
        password: payload.password,
      })
      .then((response) => {
        localStorage.setItem("token", response.data[0].token); // to store the tokenw
        context.commit("setToken", {
          token: response.data[0].token,
        });
        window.location.reload();
      })
      .catch((err) => {

        if (err.response.data.error !== undefined) {
          context.commit("setAuthError", {
            authError: err.response.data.error,
          });
        }
        if (err.response.data.errors.email !== undefined) {
          context.commit("setEmailError", {
            emailError: err.response.data.errors.email[0],
          });
        }
        if (err.response.data.errors.password !== undefined) {
          context.commit("setPasswordError", {
            passwordError: err.response.data.errors.password[0],
          });
        }
      });
  },
  async register(context, payload) {
    await axios
      .post("http://127.0.0.1:8000/api/post-registration", {
        email: payload.email,
        password: payload.password,
        name: payload.name,
      })
      .then((response) => {
        console.log(response.data.message)
        context.commit("setSuccess", {
          successMessage: response.data.message,
        });
      })
      .catch((err) => {

        if (err.response.data.error !== undefined) {
          context.commit("setAuthError", {
            authError: err.response.data.error,
          });
        }
        if (err.response.data.errors.name !== undefined) {
          context.commit("setNameError", {
            nameError: err.response.data.errors.name[0],
          });
        }
        if (err.response.data.errors.email !== undefined) {
          context.commit("setEmailError", {
            emailError: err.response.data.errors.email[0],
          });
        }
        if (err.response.data.errors.password !== undefined) {
          context.commit("setPasswordError", {
            passwordError: err.response.data.errors.password[0],
          });
        }
      });
  },
};
