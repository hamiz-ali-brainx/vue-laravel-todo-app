<script setup>
import axios from "axios";
import { ref } from "vue";

const email = ref("");
const password = ref("");
const authError = ref("");
const errorEmail = ref("");
const errorPassword = ref("");

function handleSubmit(e) {
  e.preventDefault();
  errorEmail.value = "";
  errorPassword.value = "";
  authError.value = "";
  axios
    .post("http://127.0.0.1:8000/api/login/post", {
      email: email.value,
      password: password.value,
    })
    .then((response) => {
      console.log(response);
      localStorage.setItem("token", response.data[0].token); // to store the token
      window.location.reload();
    })
    .catch((err) => {
      console.log(err.response.data);
      if (!(err.response.data.error === undefined)) {
        authError.value = err.response.data.error;
      }
      if (!(err.response.data.errors.email === undefined)) {
        errorEmail.value = err.response.data.errors.email[0];
      }
      if (!(err.response.data.errors.password === undefined)) {
        errorPassword.value = err.response.data.errors.password[0];
      }
    });
}
</script>

<template>
  <main class="login-form">
    <div class="cotainer">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
              <form method="POST">
                <div class="form-group row">
                  <label
                    for="email_address"
                    class="col-md-4 col-form-label text-md-right"
                    >E-Mail Address</label
                  >
                  <div class="col-md-6">
                    <input
                      type="text"
                      id="email_address"
                      class="form-control"
                      name="email"
                      required
                      v-model="email"
                      autofocus
                    />
                    <span class="text-danger" v-if="errorEmail">{{
                      errorEmail
                    }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label
                    for="password"
                    class="col-md-4 col-form-label text-md-right"
                    >Password</label
                  >
                  <div class="col-md-6">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      v-model="password"
                      required
                    />
                    <span class="text-danger" v-if="errorPassword">{{
                      errorPassword
                    }}</span>
                    <span class="text-danger" v-if="authError">{{
                      authError
                    }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember" /> Remember Me
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 offset-md-4 text-center">
                  <button
                    type="submit"
                    class="btn btn-lg btn-primary"
                    @click="handleSubmit"
                  >
                    Login
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
