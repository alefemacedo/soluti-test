<template>
  <div class="form--container">
    <div v-if="showForm" class="form--container__form">
      <form class="border rounded p-2">
        <s-validated-input
          v-model="form.nome"
          label="Nome"
          placeholder="Por favor informe seu nome"
          id="nome"
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
          v-model="form.senha"
          label="Senha"
          placeholder="Defina sua senha"
          id="senha"
          type="password"
          :messages="error"/>

        <div class="form-group d-flex justify-content-end">
          <button @click.prevent="submitForm" type="submit" class="btn btn-primary mr-1">Registrar</button>
          <button @click="cancel" type="button" class="btn btn-danger">Cancelar</button>
        </div>
      </form>
    </div>

    <div v-else class="form--container__search_cpf">
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
            <button class="btn btn-outline-secondary" type="button" @click="searchCpf">Buscar</button>
            <button class="btn btn-outline-danger" type="button" @click="$router.go(-1)">Cancelar</button>
          </div>
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
  name: "UserForm",
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
  methods: {
    initializeForm() {
      this.form = {
        nome: "",
        cpf: "",
        email: "",
        senha: ""
      }
    },
    searchCpf() {
      fetchPerson(this.form.cpf)
        .then((response) => {
          if(response.data.hasUser) {
            this.$toasted.error("Já existe um usuário para esta pessoa!")
            this.$emit("change-route")
          } else if (Object.prototype.hasOwnProperty.call(response.data, "_embbeded")
            && response.data._embedded.person !== null) {
            this.form.nome = response.data._embedded.person.nome
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
          this.$emit("change-route")
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
      this.$router.push({ name: "login" })
    }
  }
}
</script>

<style lang="scss" scoped>
  .form--container {
    height: 100%;
  }
</style>