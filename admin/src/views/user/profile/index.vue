<template>
  <div class="user--update container">
    <div class="user--update_title pt-5">
      <h4 class="display-4">Alterar Perfil</h4>
    </div>
    <div class="user--update__form">
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
          <button type="submit" class="btn btn-primary mr-1">Salvar</button>
          <button @click="cancel" type="button" class="btn btn-danger">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import ValidatedInput from "@/components/ValidatedInput"
import { update } from "@/api/user"

export default {
  components: {
    "s-validated-input": ValidatedInput
  },
  data() {
    return {
      form: {
        name: "",
        cpf: "",
        email: "",
        password: ""
      },
      error: {}
    }
  },
  mounted() {
    this.getUserData()
  },
  methods: {
    getUserData() {
      this.$store.dispatch("GetUserInfo")
        .then((response) => {
          this.form.email = response.data.email
          this.form.cpf = response.data._embedded.person.cpf
          this.form.name = response.data._embedded.person.name
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })
    },
    /**
     * Submita os dados do formulário de modo a atualizar
     * os dados do usuário logado
     */
    submitForm() {
      update(this.form, this.$store.getters.userId)
        .then((response) => {
          this.$toasted.success(response.data.message)
          this.$router.go(-1)
        })
        .catch((error) => {
          console.log("err", error)
          if (error.response.status === 422) {
            this.error = { ...error.response.data.validation_messages }
            this.$toasted.error("Por favor corrija os erros no formulário!")
          } else {
            this.$toasted.error(error.response.data.detail)
          }
        })
    },
    /**
     * Cancela a atualização do perfil do usuário
     */
    cancel() {
      this.form = {
        name: "",
        cpf: "",
        email: "",
        password: ""
      }
      this.$router.go(-1)
    }
  }
}
</script>

<style>

</style>