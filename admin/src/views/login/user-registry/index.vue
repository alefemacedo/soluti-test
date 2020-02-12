<template>
  <div class="login--registry--user container">
    <div class="registry--user_title pt-5">
      <h4 class="display-4">Cadastrar Usuário</h4>
    </div>
    <div class="registy--user__form">
      <s-user-form @change-route="changeRoute"/>
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
  methods: {
    changeRoute() {
      this.$router.push({ name: "login" })
    }
  }
}
</script>

<style lang="scss" scoped>
  .login--registry--user {
    height: 100%;
  }
</style>
