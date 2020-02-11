<template>
  <div class="form--container">
    <div class="form--container__search_cpf">
      <div class="form-group">
        <label for="search_cpf">Buscar CPF</label>
        <div class="input-group mb-3">
          <input 
            id="search_cpf"
            type="text"
            class="form-control"
            placeholder="Informe seu cpf para consulta"
            aria-describedby="button-search">
          <div class="input-group-append" id="button-search">
            <button class="btn btn-outline-secondary" type="button">Buscar</button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showForm" class="form--container__form">
      <form>
        <div class="form-group">
          <label for="name">Nome</label>
          <input v-model="form.name" class="form-control" id="name" placeholder="Informe seu nome completo">
        </div>
        <div class="form-group">
          <label for="cpf">CPF</label>
          <input class="form-control" id="cpf" placeholder="Informe seu cpf">
        </div>
        <div class="form-group">
          <label for="email">Endereço de e-mail</label>
          <input type="email" class="form-control" id="email" placeholder="Informe seu e-mail">
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" class="form-control" id="password" placeholder="Defina sua senha">
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirmar senha</label>
          <input type="password" class="form-control" id="password_confirmation" placeholder="Confirme sua senha">
        </div>
        <div class="form-group d-flex justify-content-end">
          <button @click.prevent="submitForm" type="submit" class="btn btn-primary mr-1">Registrar</button>
          <button @click="cancel" type="button" class="btn btn-danger">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "UserForm",
  data() {
    return {
      form: {},
      showForm: false
    }
  },
  methods: {
    initializeForm() {
      this.form = {
        name: "",
        cpf: "",
        email: "",
        password: "",
        password_confirmation: ""
      }
    },
    /**
     * Submita o formulário com os dados informados
     */
    submitForm() {
      console.log("submit")
    },
    /**
     * Cancela o cadastro, limpa o formulário e retorna
     * a página de login
     */
    cancel() {
      this.initializeForm()
    }
  }
}
</script>

<style lang="scss" scoped>

</style>