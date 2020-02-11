<template>
  <div class="login--registry--user container">
    <div class="registry--user_title">
      <h4 class="display-4">Cadastrar Usuário</h4>
    </div>
    <div class="registy--user__form">
      <s-user-form />
    </div>
  </div>
</template>

<script>
import UserForm from "@/components/UserForm"

export default {
  name: "LoginRegistry",
  components: {
    "s-user-form": UserForm
  },
  data() {
    return {

    }
  },
  created() {
    this.initializeForm()
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

<style>

</style>