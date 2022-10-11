<template>
  <main class="login-form">
    <div class="cotainer">
      <div class="row justify-content-center">
        <span class="alert-success alert" v-if="getSuccess">
          {{ getSuccess }}
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
                    <span class="text-danger" v-if="getNameError">
                      {{ getNameError }}
                    </span>
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
                    <span class="text-danger" v-if="getEmailError">
                      {{ getEmailError }}
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
                    <span class="text-danger" v-if="getPasswordError">
                      {{ getPasswordError }}
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
<script setup>
import { ref , computed} from "vue";
import { useStore } from "vuex";


const store = useStore();
const email = ref("");
const password = ref("");
const name = ref("");


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

const getNameError = computed(() => {
  return store.state.auth.nameError.length > 0
    ? store.state.auth.nameError
    : "";
});

const getSuccess = computed(() => {
  return store.state.auth.successMessage.length > 0
    ? store.state.auth.successMessage
    : "";
});

async function handleSubmit(e) {
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
  store.commit("auth/setNameError", {
    nameError: "",
  });
  
  await store.dispatch("auth/register", {
    email: email.value,
    password: password.value,
    name: name.value,
  });
  
}
</script>
