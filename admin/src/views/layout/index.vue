<template>
  <div class="app--wrapper h-100 d-flex flex-column">
    <div class="app--header">
      <b-navbar toggleable="lg" type="light" variant="light">
        <b-navbar-brand href="/">
          <img src="~@/assets/clientes-soluti.png" height="50">
        </b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-item to="/">Home</b-nav-item>
            <b-nav-item to="/contract">Contratos Sociais</b-nav-item>
            <b-nav-item-dropdown right>
              <template v-slot:button-content>
                Empresas
              </template>
              <b-dropdown-item to="/company">Listar</b-dropdown-item>
              <b-dropdown-item to="/company/create">Cadastrar</b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>

          <b-navbar-nav class="ml-auto">
            <b-nav-item-dropdown right>
              <template v-slot:button-content>
                <em>{{ $store.getters.user }}</em>
              </template>
              <b-dropdown-item to="/user/profile">Perfil</b-dropdown-item>
              <b-dropdown-item @click="logout">Sair</b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </div>
    <div class="app--body p-2 flex-grow-1 flex-column">
      <router-view/>
    </div>
    <div class="app--footer p-2 font-weight-light text-center bg-gradient-light">
      © Soluti Certificação Digital. Todos os direitos reservados.
    </div>
  </div>
</template>

<script>
export default {
  name: "Layout",
  methods: {
    /**
     * Desloga da aplicação
     */
    logout() {
      this.$store.dispatch("LogOut")
        .then(() => {
          this.$router.push({ path: "/login" })
        })
    }
  }
}
</script>

<style lang="scss" scoped>
  .app--wrapper {
    .app--header {

    }

    .app--body {

    }

    .app--footer {
      // background-color: black;
    }
  }
</style>