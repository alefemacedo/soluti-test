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
            <b-nav-item to="/user">Usuários</b-nav-item>
            <b-nav-item to="/social-contract" disabled>Contratos Sociais</b-nav-item>
            <b-nav-item to="/company" disabled>Empresas</b-nav-item>
          </b-navbar-nav>

          <b-navbar-nav class="ml-auto">
            <b-nav-item-dropdown right>
              <template v-slot:button-content>
                <em>User</em>
              </template>
              <b-dropdown-item href="#">Profile</b-dropdown-item>
              <b-dropdown-item @click="logout">Sign Out</b-dropdown-item>
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
      background-color: green;
      .app--navbar {
        position: absolute;
        top: 0;
        left: 0;
        width: 190px;
        @media (max-width: 769px) {
          display: none;
        }
        background-color: red;
      }
    }

    .app--footer {
      // background-color: black;
    }
  }
</style>