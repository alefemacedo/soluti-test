<template>
  <div class="container">
    <button class="fas fa-arrow-left btn btn-primary" @click="back">Voltar</button>
    <div class="row">
      <div class="col">
        <h1 class="display-2">Oops!</h1>
        <h2>Você não possui permissão para acessar esta página!</h2>
      </div>
      <div class="col">
        <img :src="errGif" width="313" height="428" alt="Girl has dropped her ice cream.">
      </div>
    </div>
  </div>
</template>

<script>
import errGif from "@/assets/401_images/401.gif"

export default {
  name: "Page401",
  data() {
    return {
      errGif: errGif + "?" + +new Date(),
      ewizardClap: "https://wpimg.wallstcn.com/007ef517-bafd-4066-aae4-6883632d9646",
      dialogVisible: false
    }
  },
  methods: {
    back() {
      if (this.$route.query.noGoBack) {
        this.$router.push({ path: "/dashboard" })
      } else {
        this.$router.go(-1)
      }
    }
  }
}
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
  .container {
    width: 800px;
    max-width: 100%;
    margin: 100px auto;
  }
</style>
