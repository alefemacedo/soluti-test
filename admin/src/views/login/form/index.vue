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
      <div class="form-group">
        <label for="email">E-mail|Login</label>
        <input v-model="form.email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Nunca compartilhe suas informações com terceiros.</small>
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input v-model="form.password" type="password" class="form-control" id="password">
      </div>
      <!-- <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> -->
      <div class="form-group d-flex flex-column justify-content-end">
        <button type="submit" class="btn btn-primary">Entrar</button>
        <label>Caso não possua cadastro, <router-link to="/login/user-registry">clique aqui!</router-link></label>
      </div>
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
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .login--form--container {
    text-align: center;
    background-image: url("~@/assets/beautiful.jpg");

    .login--form {
    background-color: #ffffffd2;
    border-radius: 10px;
    }
  }
</style>