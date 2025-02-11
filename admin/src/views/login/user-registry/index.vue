<template>
  <div class="login--registry--user container">
    <div class="registry--user_title pt-5">
      <h4 class="display-4">Cadastrar Usuário</h4>
    </div>
    <div class="registy--user__form">
      <div class="form--container">
        <div v-if="showForm" class="form--container__form">
          <form class="border rounded p-2" @submit.prevent="submitForm">
            <s-validated-input
              v-model="form.name"
              label="Nome"
              placeholder="Por favor informe seu nome"
              id="name"
              :messages="error"/>
            
            <s-validated-input
              v-model="form.cpf"
              label="CPF"
              placeholder="Por favor informe seu CPF"
              id="cpf"
              :messages="error"/>

            <s-validated-input
              v-model="form.email"
              label="Endereço de e-mail"
              placeholder="Informe seu e-mail"
              id="email"
              type="email"
              :messages="error"/>

            <s-validated-input
              v-model="form.password"
              label="Senha"
              placeholder="Defina sua senha"
              id="password"
              type="password"
              :messages="error"/>

            <div class="form-group d-flex justify-content-end">
              <button type="submit" class="btn btn-primary mr-1">Registrar</button>
              <button @click="cancel" type="button" class="btn btn-danger">Cancelar</button>
            </div>
          </form>
        </div>

        <div v-else class="form--container__search_cpf">
          <form @submit.prevent="searchCpf">
            <div class="form-group">
              <label for="search_cpf">Buscar CPF</label>
              <div class="input-group mb-3">
                <input 
                  id="search_cpf"
                  v-model="form.cpf"
                  type="text"
                  class="form-control"
                  placeholder="Informe seu cpf para consulta"
                  aria-describedby="button-search">
                <div class="input-group-append" id="button-search">
                  <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                  <button class="btn btn-outline-danger" type="button" @click="$router.go(-1)">Cancelar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { create } from "@/api/user"
import { fetchPerson } from "@/api/person"
import ValidatedInput from "@/components/ValidatedInput"

export default {
  name: "LoginRegistry",
  components: {
    "s-validated-input": ValidatedInput
  },
  data() {
    return {
      form: {},
      error: {},
      showForm: false
    }
  },
  beforeMount() {
    this.initializeForm()
  },
  methods: {/**
     * Inicializa o objeto que representa o formulário
     */
    initializeForm() {
      this.form = {
        name: "",
        cpf: "",
        email: "",
        password: ""
      }
    },
    /**
     * Busca os dados de uma pessoa de acordo com o
     * CPF informado
     */
    searchCpf() {
      fetchPerson(this.form.cpf)
        .then((response) => {
          if(response.data.hasUser) {
            this.$toasted.error("Já existe um usuário para esta pessoa!")
            this.$router.push({ name: "login" })
          } else if (Object.prototype.hasOwnProperty.call(response.data, "_embedded")
            && response.data._embedded.person !== null) {
            this.form.name = response.data._embedded.person.name
          }
          this.showForm = true
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })
    },
    /**
     * Submita o formulário com os dados informados
     */
    submitForm() {
      create(this.form)
        .then((response) => {
          this.$toasted.success(response.data.message)
          this.$router.push({ name: "login" })
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.error = { ...error.response.data.validation_messages }
            this.$toasted.error("Por favor corrija os erros no formulário!")
          } else {
            this.$toasted.error(error.response.data.detail)
          }
        })
    },
    /**
     * Cancela o cadastro, limpa o formulário e retorna
     * a página de login
     */
    cancel() {
      this.initializeForm()
      this.$router.go(-1)
    }
  }
}
</script>

<style lang="scss" scoped>
  .login--registry--user {
    height: 100%;
  }
</style>
