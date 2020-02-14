<template>
  <div class="container company--form">
    <div class="company--form_title">
      <h1 class="display-4">
        Cadastro de Empresa
      </h1>
    </div>
    <form class="border rounded p-2" @submit.prevent="submit">
      <s-validated-input
        v-model="form.nome"
        :messages="error"
        label="Nome Fantasia"
        id="nome"
        placeholder="Por favor informe o nome fantasia da empresa"/>
      
      <s-validated-input
        v-model="form.rasao_social"
        :messages="error"
        label="Rasão Social"
        id="rasao_social"
        placeholder="Por favor informe a rasão social da empresa"/>
      
      <s-validated-input
        v-model="form.cnpj"
        :messages="error"
        label="CNPJ"
        id="cnpj"
        placeholder="Por favor informe o CNPJ da empresa"/>      

      <div class="social-contract--form_title mb-2">
        <h4>Cadastro do Contrato Social</h4>
      </div>
      <s-social-contract-form v-model="form.contrato_social" />

      <div class="form-group d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary mr-1">Registrar</button>
        <button @click="cancel" type="button" class="btn btn-danger">Cancelar</button>
      </div>
    </form>
  </div>
</template>

<script>
import ValidatedInput from "@/components/ValidatedInput"
import SocialContractForm from "@/components/SocialContractForm"

export default {
  components: {
    "s-validated-input": ValidatedInput,
    "s-social-contract-form": SocialContractForm
  },
  data() {
    return {
      form: {},
      error: {}
    }
  },
  beforeMounted() {
    this.initializeForm()
  },
  methods: {
    /**
     * Inicializa o objeto que representa o formulário
     */
    initializeForm() {
      this.form = {
        nome: "",
        rasao_social: "",
        cnpj: "",
        contrato_social: {
          arquivo: "",
          responsaveis: {}
        }
      }
    },
    /**
     * Limpa o formulário e redireciona para a página
     * anterior
     */
    cancel() {
      this.initializeForm()
      this.$router.go(-1)
    },
    /**
     * Realiza submit do formulário para cadastrar
     * a empresa
     */
    submit() {
      
    }
  }
}
</script>

<style>
 .company--form {
   height: 100%;
 }
</style>