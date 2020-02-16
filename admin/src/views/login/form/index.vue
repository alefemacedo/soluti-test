<template>
  <div
    class="
    login--form--container 
    d-flex
    justify-content-center
    justify-content-sm-end
    align-items-center">
    <div class="login--form p-4 border mr-sm-5 m-1">
      <div class="login--form_title">
        <h2 class="">Bem Vindo!!</h2>
      </div>

      <form @submit.prevent="submit">
        <div class="form-group">
          <label for="email">E-mail|Login</label>
          <input v-model="form.email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">Nunca compartilhe suas informações com terceiros.</small>
        </div>

        <div class="form-group">
          <label for="password">Senha</label>
          <input v-model="form.password" type="password" class="form-control" id="password">
        </div>

        <div class="form-group d-flex flex-column justify-content-end">
          <button type="submit" class="btn btn-primary">Entrar</button>
          <label>Caso não possua cadastro, <router-link to="/login/user-registry">clique aqui!</router-link></label>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginForm",
  data() {
    return {
      form: {
        email: "",
        password: ""
      },
      redirect: undefined
    }
  },
  whatch: {
    $route: {
      handler: function(route) {
        this.redirect = route.query && route.query.redirect
      },
      immediate: true
    }
  },
  methods: {
    /**
     * Realiza o login com os dados informados
     */
    submit() {
      this.$store.dispatch("Login", this.form)
        .then(() => {
          this.$router.push({ path: this.redirect || "/" })
        })
        .catch((error) => {
          if (error.response.status === 401
            && error.response.data.title === "invalid_grant") {
            this.$toasted.error("Falha ao autenticar: login ou senha incorretos.")
          } if(error.response.status === 400
            && error.response.data.title === "invalid_client") {
            this.$toasted.error("Falha ao autenticar: esse usuário não existe.")
          } else {
            this.$toasted.error(error.response.data.detail)
          }
        })
    }
  }
}
</script>

<style lang="scss" scoped>
  .login--form--container {
    height: 100%;
    text-align: center;
    background-image: url("~@/assets/beautiful.jpg");

    .login--form {
      background-color: #ffffffd2;
      border-radius: 10px;
    }
  }
</style>