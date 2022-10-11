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
                    >Email Address</label
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
                    <span class="text-danger" v-if="getEmailError">{{
                      getEmailError
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
                    <span class="text-danger" v-if="getPasswordError">{{
                      getPasswordError
                    }}</span>
                    <span class="text-danger" v-if="getAuthError">{{
                      getAuthError
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

<script setup>
import { ref, computed } from "vue";
import { useStore } from "vuex";

const store = useStore();
const email = ref("");
const password = ref("");

const getAuthError = computed(() => {
  return store.state.auth.authError.length > 0
    ? store.state.auth.authError
    : "";
});
const getEmailError = computed(() => {
  return store.state.auth.emailError.length > 0
    ? store.state.auth.emailError
    : "";
});
const getPasswordError = computed(() => {
  return store.state.auth.passwordError.length > 0
    ? store.state.auth.passwordError
    : "";
});

function handleSubmit(e) {
  e.preventDefault();

  store.commit("auth/setAuthError", {
    authError: "",
  });
  store.commit("auth/setEmailError", {
    emailError: "",
  });
  store.commit("auth/setPasswordError", {
    passwordError: "",
  });
  store.dispatch("auth/login", {
    email: email.value,
    password: password.value,
  });
  
}
</script>
