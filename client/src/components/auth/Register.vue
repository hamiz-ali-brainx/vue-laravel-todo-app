<script setup>
import axios from "axios";
import { ref } from "vue";

const email = ref("");
const password = ref("");
const name = ref("");
const errorEmail = ref("");
const errorPassword = ref("");
const success = ref("");

function handleSubmit(e) {
  e.preventDefault();
  errorEmail.value = "";
  errorPassword.value = "";
  axios
    .post("http://127.0.0.1:8000/api/post-registration", {
      email: email.value,
      password: password.value,
      name: name.value,
    })
    .then((response) => {
       //   window.location.reload();
      success.value = response.data.message;
    })
    .catch((err) => {
      console.log(err.response.data);
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
        <span class="alert-success alert" v-if="success">
                      {{ success }}
        </span>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
              <form>
                <div class="form-group row">
                  <label
                    for="name"
                    class="col-md-4 col-form-label text-md-right"
                    >Name</label
                  >
                  <div class="col-md-6">
                    <input
                      type="text"
                      id="name"
                      class="form-control"
                      name="name"
                      required
                      v-model="name"
                      autofocus
                    />
                  </div>
                </div>

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
                      v-model="email"
                      required
                      autofocus
                    />
                    <span class="text-danger" v-if="errorEmail">
                      {{ errorEmail }}
                    </span>
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
                    <span class="text-danger" v-if="errorPassword">
                      {{ errorPassword }}
                    </span>
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
                    @click="handleSubmit"
                    class="btn btn-lg btn-primary"
                  >
                    Register
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
