export default {
    setToken (state, payload){
        state.token = payload.token
    },
    setAuthError (state, payload){
        state.authError = payload.authError

    },
    setEmailError (state, payload){
        state.emailError = payload.emailError
    },
    setPasswordError (state, payload){
        state.passwordError = payload.passwordError
    },
    setNameError(state,payload){
        state.nameError = payload.nameError
    },
    setSuccess(state,payload){
        console.log(payload.successMessage);
        state.successMessage = payload.successMessage
    },
    setToken(state,payload){
        state.token = payload.token;
    }
}