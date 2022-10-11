export default {
    setTodos (state, payload){
        state.todos = payload.todos
    },
    setDescriptionError(state, payload){
        state.todoDescriptionError = payload.descriptionError
    },
    setNameError(state, payload){
        state.todoNameError = payload.nameError
    },
    setSuccess(state,payload){
        console.log(payload.todoSuccess)
        state.todoSuccess = payload.todoSuccess
    }

}